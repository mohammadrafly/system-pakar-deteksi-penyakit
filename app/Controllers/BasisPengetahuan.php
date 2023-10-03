<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BasisPengetahuan as ModelBP;
use App\Models\Gejala;
use App\Models\Penyakit;

class BasisPengetahuan extends BaseController
{
    public function index()
    {
        $model = new ModelBP();
        $gejala = new Gejala();
        $penyakit = new Penyakit();
        
        if ($this->request->getMethod(true) !== 'POST') {
            return view('Pages/basisPengetahuan', [
            //dd([    
                'title' => 'Data Gejala',
                'content' => $model->findAllAssociated(),
                'gejala' => $gejala->findAll(),
                'penyakit' => $penyakit->findAll()
            ]);
        }

        $data = [
            'namapenyakit' => $this->request->getVar('namaPenyakit'),
            'nilaibobot' => $this->request->getVar('nilaibobot'),
            'gejala' => $this->request->getVar('gejala'),
        ];

        if (!$model->insert($data)) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal melakukan insert data',
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil melakukan insert data',
        ]);
    }

    public function singleData($id) 
    {
        $model = new ModelBP();
        
        if (preg_match('/^P\d+/', $id)) {
            $query = $model->table('basispengetahuan')
                ->select('
                    j.jenistanaman as nama_tanaman,
                    p.*,
                    gejala.*
                ')
                ->join('penyakit as p', 'p.namapenyakit = basispengetahuan.namapenyakit')
                ->join('jenistanaman as j', 'p.jenistanaman = j.id')
                ->join('gejala', 'basispengetahuan.gejala = gejala.id')
                ->where('p.kodepenyakit', $id)
                ->get();
        } else {
            $query = $model->table('basispengetahuan')
                ->select('
                    j.jenistanaman as nama_tanaman,
                    p.*,
                    gejala.*
                ')
                ->join('penyakit as p', 'p.namapenyakit = basispengetahuan.namapenyakit')
                ->join('jenistanaman as j', 'p.jenistanaman = j.id')
                ->join('gejala', 'basispengetahuan.gejala = gejala.id')
                ->where('p.namapenyakit', $id)
                ->get();
        }
    
        $result = $query->getResult();
    
        return view('Pages/basisPengetahuanSingleData', [
            'title' => 'Detail Penyakit',
            'content' => $result
        ]);
    }    

    public function update($id)
    {
        $model = new ModelBP();

        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON($model->find($id));
        }

        $data = [
            'namapenyakit' => $this->request->getVar('namapenyakit'),
            'gejala' => $this->request->getVar('gejala'),
            'nilaibobot' => $this->request->getVar('nilaibobot'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (!$model->where('id', $id)->replace($data)) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal melakukan update',
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil melakukan update',
        ]);
    }

    public function delete($id)
    {
        $model = new ModelBP();

        $model->where('id', $id)->delete($id);
        
        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data telah dihapus'
        ]);
    }
}
