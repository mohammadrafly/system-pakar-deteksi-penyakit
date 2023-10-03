<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Auth extends BaseController
{
    private function setSession($data)
    {
        return session()->set([
            'isLoggedIn' => TRUE,
            'id' => $data['id'],
            'name' => $data['name'],
            'username' => $data['username'],
        ]);
    }

    public function index()
    {
        $model = new User();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        if ($this->request->getMethod(true) !== 'POST') {
            return view('Auth/Login');
        }

        $dataAuth = $model->where('username', $username)->first();

        if (!$dataAuth) {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Email tidak ada di database.'
            ]);
        }

        if (password_verify($password, $dataAuth['password'])) {
            $this->setSession($dataAuth);
            return $this->response->setJSON([
                'status' => true,
                'icon' => 'success',
                'title' => 'Success!',
                'text' => 'Sign in berhasil.',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Password Salah.'
            ]);
        }
    }

    public function logout()
    {
        session()->destroy();
        return $this->response->setJSON([
            'status' => true,
            'icon' => 'success',
            'title' => 'Success!',
            'text' => 'Logout berhasil.'
        ]);
    }
}
