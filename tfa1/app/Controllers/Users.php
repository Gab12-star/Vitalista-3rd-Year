<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
        $users = [
            [
                'username' => 'admin',
                'fullname' => 'System Admin',
                'role' => 'Administrator'
            ],
            [
                'username' => 'cashier1',
                'fullname' => 'John Smith',
                'role' => 'Cashier'
            ],
            [
                'username' => 'cashier2',
                'fullname' => 'Jane Cruz',
                'role' => 'Cashier'
            ],
            [
                'username' => 'manager1',
                'fullname' => 'Robert Reyes',
                'role' => 'Manager'
            ],
            [
                'username' => 'staff1',
                'fullname' => 'Chris Lopez',
                'role' => 'Staff'
            ]
        ];

        return view('users', ['users' => $users]);
    }
}