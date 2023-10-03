<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Gejala as ModelGejala;
use App\Models\JenisTanaman;

class Gejala extends BaseController
{
    public function generateKodeGejala()
    {
        $model = new ModelGejala();

        $highestCode = $model->selectMax('kodegejala')->first();

        if ($highestCode['kodegejala']) {
            $numericPart = (int)substr($highestCode['kodegejala'], 1);
            $numericPart++;

            $kodeGejala = 'G' . sprintf('%03d', $numericPart);
        } else {
            $kodeGejala = 'G001';
        }

        return $kodeGejala;
    }

    public function index()
    {
        $model = new ModelGejala();
        $tanaman = new JenisTanaman();
        
        if ($this->request->getMethod(true) !== 'POST') {
            return view('Pages/gejala', [
                'title' => 'Data Gejala',
                'content' => $model->findAllAssociated(),
                'jenis' => $tanaman->findAll(),
            ]);
        }

        $data = [
            'kodegejala' => $this->generateKodeGejala(),
            'jenistanaman' => $this->request->getVar('jenisTanaman'),
            'gejala' => $this->request->getVar('gejala'),
            'daerah' => $this->request->getVar('daerah'),
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
        $model = new ModelGejala();

        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON($model->find($id));
        }

        $data = [
            'jenistanaman' => $this->request->getVar('jenistanaman'),
            'gejala' => $this->request->getVar('gejala'),
            'daerah' => $this->request->getVar('daerah'),
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
        $model = new ModelGejala();

        $model->where('id', $id)->delete($id);
        
        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data telah dihapus'
        ]);
    }
}
