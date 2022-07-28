<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Admin as ModelsAdmin;
use App\Models\User;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->model = new ModelsAdmin();
        $this->userModel = new User();

        $this->rules = [
            'nama' => 'required|alpha_space|min_length[3]',
            'username' => 'required|alpha_numeric_punct|min_length[3]|is_unique[users.username]',
            'password' => 'required|alpha_numeric_punct|min_length[4]',
        ];
    }

    public function index()
    {
        $data = [
            'admins' => $this->model->findAll(),
        ];

        return view('admin/index', $data);
    }

    public function create()
    {
        $validated = $this->validate($this->rules);

        if ($validated) {
            $nama = $this->request->getPost('nama');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $dataUser = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'role' => 'admin',
            ];

            $this->userModel->insert($dataUser);

            $user = $this->userModel->where('username', $username)->get();
            $user_id = $user->getResult()[0]->user_id;

            $dataAdmin = [
                'user_id' => $user_id,
                'nama' => $nama,
            ];

            $this->model->insert($dataAdmin);

            return redirect()->route('admins');
        } else {
            return redirect()->back()->withInput()->with('error', 'Please check your input!');
        }
    }

    public function update($id)
    {
        $this->model->update($id, [
            'nama' => $this->request->getPost('updateNama'),
        ]);

        return redirect()->route('admins');
    }

    public function delete($id)
    {
        $admin = $this->model->find($id);
        $user_id = $admin->user_id;

        $this->model->delete($id);
        $this->userModel->delete($user_id);

        return redirect()->route('admins');
    }
}
