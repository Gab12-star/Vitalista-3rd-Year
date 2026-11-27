<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return $this->redirectToDashboard();
        }

        if ($this->request->getMethod() === 'POST') {
            $username = trim((string) $this->request->getPost('username'));
            $password = (string) $this->request->getPost('password');

            $userModel = new UserModel();
            $user = $userModel->where('username', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                session()->regenerate(true);

                session()->set([
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'full_name' => $user['full_name'],
                    'role'      => $user['role'] ?? 'staff',
                    'logged_in' => true,
                ]);

                return $this->redirectToDashboard();
            }

            return view('auth/login', [
                'error' => 'Invalid username or password.',
            ]);
        }

        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }

    public function setup()
    {
        $userModel = new UserModel();

        if ($userModel->countAllResults() > 0) {
            return redirect()->to('/login')
                ->with('error', 'Setup is already complete. Please log in.');
        }

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
                'full_name' => 'required|max_length[100]',
                'password' => 'required|min_length[8]',
                'confirm_password' => 'required|matches[password]',
            ];

            if (! $this->validate($rules)) {
                return view('auth/setup', [
                    'validation' => $this->validator,
                ]);
            }

            $userModel->insert([
                'username' => trim((string) $this->request->getPost('username')),
                'full_name' => trim((string) $this->request->getPost('full_name')),
                'password' => password_hash(
                    (string) $this->request->getPost('password'),
                    PASSWORD_DEFAULT
                ),
                'role' => 'admin',
            ]);

            return redirect()->to('/login')
                ->with('success', 'Admin account created. Please log in.');
        }

        return view('auth/setup');
    }

    private function redirectToDashboard()
    {
        if (session()->get('role') === 'admin') {
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->to('/dashboard');
    }
}