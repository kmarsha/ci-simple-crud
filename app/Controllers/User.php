<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User as ModelsUser;

class User extends BaseController
{
    public function __construct() {
        $this->model = new ModelsUser();

        $this->rules = [
            'username' => 'required|alpha_numeric_punct|min_length[3]',
            'password' => 'permit_empty|alpha_numeric_punct|min_length[4]',
        ];
    }

    public function index()
    {
        $admins = $this->model->join('admins', 'admins.user_id = users.user_id')
            ->get();
        $employees = $this->model->join('employees', 'employees.id_user = users.user_id')
            ->get();

        $data = [
            'admins' => $admins->getResult(),
            'employees' => $employees->getResult(),
        ];

        return view('user/index', $data);
    }

    public function edit($id)
    {
        $user = $this->model->find($id);

        $data = [
            'user' => $user,
        ];
        
        return view('user/edit', $data);
    }

    public function update($id)
    {
        $validated = $this->validate($this->rules);

        if ($validated) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            
            $data['username'] = $username;

            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_BCRYPT);
            }

            $this->model->update($id, $data);

            return redirect()->route('users');
        } else {
            return redirect()->back()->withInput()->with('error', 'Please check your input!');
        }
    }
}
