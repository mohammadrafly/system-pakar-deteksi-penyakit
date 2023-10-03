<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenisTanaman;
use App\Models\Penyakit;

class HamaDanPenyakit extends BaseController
{
    public function generateKodePenyakit()
    {
        $model = new Penyakit();

        $highestCode = $model->selectMax('kodepenyakit')->first();

        if ($highestCode['kodepenyakit']) {
            $numericPart = (int)substr($highestCode['kodepenyakit'], 1);
            $numericPart++;

            $kodePenyakit = 'P' . sprintf('%03d', $numericPart);
        } else {
            $kodePenyakit = 'P001';
        }

        return $kodePenyakit;
    }

    public function index()
    {
        $model = new Penyakit();
        $tanaman = new JenisTanaman();
        
        if ($this->request->getMethod(true) !== 'POST') {
            return view('Pages/hamaDanPenyakit', [
                'title' => 'Data Gejala',
                'content' => $model->findAllAssociated(),
                'jenis' => $tanaman->findAll(),
            ]);
        }

        $data = [
            'kodepenyakit' => $this->generateKodePenyakit(),
            'namapenyakit' => $this->request->getVar('namaPenyakit'),
            'jenistanaman' => $this->request->getVar('jenisTanaman'),
            'fisikmekanis' => $this->request->getVar('fisikMekanis'),
            'kulturteknis' => $this->request->getVar('kulturTeknis'),
            'kimiawi' => $this->request->getVar('kimiawi'),
            'hayati' => $this->request->getVar('hayati'),
            'nilaibobot' => $this->request->getVar('nilaiBobot'),
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

    public function update($id)
    {
        $model = new Penyakit();

        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON($model->find($id));
        }

        $data = [
            'namapenyakit' => $this->request->getVar('namaPenyakit'),
            'fisikmekanis' => $this->request->getVar('fisikMekanis'),
            'jenistanaman' => $this->request->getVar('jenisTanaman'),
            'kulturteknis' => $this->request->getVar('kulturTeknis'),
            'kimiawi' => $this->request->getVar('kimiawi'),
            'hayati' => $this->request->getVar('hayati'),
            'nilaibobot' => $this->request->getVar('nilaiBobot'),
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
        $model = new Penyakit();

        $model->where('id', $id)->delete($id);
        
        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data telah dihapus'
        ]);
    }
}
