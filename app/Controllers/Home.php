<?php

namespace App\Controllers;

use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\BasisPengetahuan as ModelBP;

class Home extends BaseController
{
    public function index(): string
    {
        return view('index');
    }

    public function about(): string
    {
        return view('Pages/about', [
            'title' => 'About'
        ]);
    }

    public function daftarPenyakit(): string
    {
        $model = new Penyakit();

        return view('Pages/daftarPenyakit', [
            'title' => 'Daftar Penyakit',
            'content' => $model->findAllAssociated()
        ]);
    }

    public function diagnosaPenyakit()
    {
        $model = new Gejala();
    
        if ($this->request->getMethod(true) !== 'POST') {
            return view('Pages/diagnosaPenyakit', [
                'title' => 'Diagnosa Penyakit',
                'content' => $model->findAll(),
                'diseasesProbability' => null,
            ]);
        }
    
        $selectedSymptoms = $this->request->getVar('selected_gejalas[]');
        $diseasesProbability = $this->calculateEuclideanProbability($selectedSymptoms);
    
        return view('Pages/diagnosaPenyakit', [
        //dd([
            'title' => 'Diagnosa Penyakit',
            'content' => $model->findAll(),
            'diseasesProbability' => $diseasesProbability,
        ]);
    }    

    private function calculateEuclideanProbability($selectedSymptoms)
    {
        $model = new ModelBP();
        $nilaiBobotArray = [];

        foreach ($selectedSymptoms as $data) {
            $result = $model->where('gejala', $data)->first();
            if ($result) {
                $nilaiBobotArray[] = $result;
            }
        }

        $sumsByNamapenyakit = [];
        foreach ($nilaiBobotArray as $result) {
            $namapenyakit = $result['namapenyakit'];
            $bobot = $result['nilaibobot'];

            // If this namapenyakit is not in the sums array yet, initialize it with 0
            if (!isset($sumsByNamapenyakit[$namapenyakit])) {
                $sumsByNamapenyakit[$namapenyakit] = 0;
            }

            // Add the bobot to the sum for this namapenyakit
            $sumsByNamapenyakit[$namapenyakit] += $bobot;
        }

        // Calculate the total sum of all penyakits
        $totalSum = array_sum($sumsByNamapenyakit);

        // Calculate percentages and store them in a new array
        $percentages = [];
        foreach ($sumsByNamapenyakit as $namapenyakit => $sum) {
            // Calculate the percentage for this penyakit
            $percentage = ($sum / $totalSum) * 100;
            // Format the percentage with two decimal places
            $formattedPercentage = number_format($percentage, 2);
            $percentages[$namapenyakit] = $formattedPercentage . '%';
        }

        return $percentages;
    }
}
