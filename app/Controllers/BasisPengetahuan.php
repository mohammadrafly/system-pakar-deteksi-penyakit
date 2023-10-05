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
        $model = new Penyakit();
        
        if (preg_match('/^P\d+/', $id)) {
            $query = $model->getPenyakitByCode($id);
        } else {
            $query = $model->getPenyakitByName($id);
        }
    
        $result = $query->getResult();
    
        return view('Pages/basisPengetahuanSingleData', [
        //dd([
            'title' => 'Detail Penyakit',
            'content' => $result
        ]);
    }

    public function update($id)
    {
        $model = new ModelBP();
        $gejala = new Gejala();
        $penyakit = new Penyakit();

        if ($this->request->getMethod(true) !== 'POST') {
            return view('Pages/update/basispengetahuan', [
            //dd([
                'title' => 'Update Data',
                'content' => $model->findAllAssociatedByID($id),
                'penyakit' => $penyakit->findAll(),
                'gejala' => $gejala->findAll(),
            ]);
        }

        $data = [
            'namapenyakit' => $this->request->getVar('namapenyakit'),
            'gejala' => $this->request->getVar('gejala'),
            'nilaibobot' => $this->request->getVar('nilaibobot'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (!$model->update($id, $data)) {
            return redirect()->to(base_url('admin/basis-pengetahuan'))->with('error', 'Gagal melakukan update');
        }
        return redirect()->to(base_url('admin/basis-pengetahuan'))->with('success', 'Berhasil melakukan update');
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
