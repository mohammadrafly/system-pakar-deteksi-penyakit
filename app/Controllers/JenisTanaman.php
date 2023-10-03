<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JenisTanaman as ModelJT;

class JenisTanaman extends BaseController
{
    public function index()
    {
        $model = new ModelJT();
        
        if ($this->request->getMethod(true) !== 'POST') {
            return view('Pages/jenisTanaman', [
                'title' => 'Data Gejala',
                'content' => $model->findAll()
            ]);
        }

        $data = [
            'jenistanaman' => $this->request->getVar('jenisTanaman'),
        ];

        if (!$model->insert($data)) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal insert data',
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Berhasil insert data',
        ]);
    }

    public function update($id)
    {
        $model = new ModelJT();

        if ($this->request->getMethod(true) !== 'POST') {
            return $this->response->setJSON($model->find($id));
        }

        $data = [
            'jenistanaman' => $this->request->getVar('jenisTanaman'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (!$model->where('id', $id)->replace($data)) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Gagal update data',
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
        $model = new ModelJT();

        $model->where('id', $id)->delete($id);
        
        return $this->response->setJSON([
            'status' => TRUE,
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data telah dihapus'
        ]);
    }
}
