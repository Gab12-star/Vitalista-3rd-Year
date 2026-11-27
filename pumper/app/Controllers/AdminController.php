<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function index()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')
                ->with('error', 'Admin access required.');
        }

        return view('admin/dashboard', [
            'full_name' => session()->get('full_name'),
        ]);
    }
}