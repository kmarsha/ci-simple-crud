<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Employee as ModelsEmployee;
use App\Models\User;

class Employee extends BaseController
{
    public function __construct()
    {
        $this->model = new ModelsEmployee();
        $this->userModel = new User();

        $this->rules = [
            'username' => 'required|alpha_numeric_punct|min_length[3]|is_unique[users.username]',
            'password' => 'required|alpha_numeric_punct|min_length[4]',
            'nama_karyawan' => 'required|string',
            'usia' => 'required|integer',
        ];
    }

    public function index()
    {
        $data = [
            'employees' => $this->model->findAll(),
        ];

        return view('employee/index', $data);
    }

    public function new()
    {
        return view('employee/new');
    }

    public function create()
    {
        $validated = $this->validate([
            'username' => 'is_unique[users.username]',
        ]);

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nama_karyawan = $this->request->getPost('nama_karyawan');
        $usia = $this->request->getPost('usia');
        $vaksin1 = $this->request->getPost('vaksin1');
        $vaksin2 = $this->request->getPost('vaksin2');
        $vaksin3 = $this->request->getPost('vaksin3');

        if ($validated) {
            $this->userModel->insert([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'role' => 'karyawan',
            ]);

            $user = $this->userModel->where('username', $username)->get();
            $user_id = $user->getResult()[0]->user_id;

            $this->model->insert([
                'id_user' => $user_id,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'nama_karyawan' => $nama_karyawan,
                'usia' => $usia,
                'status_vaksin_1' => $vaksin1,
                'status_vaksin_2' => $vaksin2,
                'status_vaksin_3' => $vaksin3,
            ]);

            if ($this->request->isAJAX()) {
                $data = [
                    'success' => true,
                    'msg' => 'Data berhasil ditambahkan',
                ];

                return $this->response->setJSON($data);
            } else {
                return redirect()->route('employees');
            }
        } else {
            if ($this->request->isAJAX()) {
                $data = [
                    'error' => true,
                    'msg' => 'Username telah dipakai',
                ];

                return $this->response->setJSON($data);
            } else {
                return redirect()->back()->withInput()->with('error', 'Please check your input!');
            }
        }
    }

    public function edit($id)
    {
        $employee = $this->model->find($id);

        $data = [
            'employee' => $employee,
        ];
        
        return view('employee/edit', $data);
    }

    public function update($id)
    {
        $nama_karyawan = $this->request->getPost('nama_karyawan');
        $usia = $this->request->getPost('usia');
        $vaksin1 = $this->request->getPost('vaksin1');
        $vaksin2 = $this->request->getPost('vaksin2');
        $vaksin3 = $this->request->getPost('vaksin3');

        $data = [
            'nama_karyawan' => $nama_karyawan,
            'usia' => $usia,
            'status_vaksin_1' => $vaksin1,
            'status_vaksin_2' => $vaksin2,
            'status_vaksin_3' => $vaksin3,
        ];

        $this->model->update($id, $data);

        return redirect()->route('employees');
    }

    public function delete($id)
    {
        $karyawan = $this->model->find($id);
        $id_user = $karyawan->id_user;

        $this->model->delete($id);
        $this->userModel->delete($id_user);

        return redirect()->route('employees');
    }
}
