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

        if (empty($selectedSymptoms)) {
            return redirect()->to('diagnosa-penyakit')->with('error', 'Maaf, Anda harus memilih setidaknya satu gejala.');
        }        

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
        $symptomDetails = [];

        $sumsByNamapenyakit = [];

        foreach ($selectedSymptoms as $data) {
            $result = $model->getSymptomDetailsByID($data);

            if ($result) {
                $nilaiBobotArray[] = $result;
                $namapenyakit = $result[0]['namapenyakit'];
                $bobot = $result[0]['nilaibobot'];

                if (!isset($symptomDetails[$namapenyakit])) {
                    $symptomDetails[$namapenyakit] = [];
                }

                $symptomDetails[$namapenyakit][] = [
                    'gejala' => $result[0]['gejala'],
                    'bobot' => $bobot,
                ];

                if (!isset($sumsByNamapenyakit[$namapenyakit])) {
                    $sumsByNamapenyakit[$namapenyakit] = 0;
                }

                $sumsByNamapenyakit[$namapenyakit] += $bobot;
            }
        }

        return [
            'percentages' => $sumsByNamapenyakit,
            'symptomDetails' => $symptomDetails,
        ];
    }
}
