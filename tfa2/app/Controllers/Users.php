<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
        $data['users'] = [
            [
                'username' => 'carlv',
                'name' => 'Carl Gabriel Vitalista',
                'role' => 'Administrator',
            ],
            [
                'username' => 'annec',
                'name' => 'Anne Cruz',
                'role' => 'Cashier',
            ],
            [
                'username' => 'marks',
                'name' => 'Mark Santos',
                'role' => 'Inventory Staff',
            ],
            [
                'username' => 'jessar',
                'name' => 'Jessa Reyes',
                'role' => 'Cashier',
            ],
            [
                'username' => 'kevinl',
                'name' => 'Kevin Lim',
                'role' => 'Manager',
            ],
        ];

        return view('users', $data);
    }
}