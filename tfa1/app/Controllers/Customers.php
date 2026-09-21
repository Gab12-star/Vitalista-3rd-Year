<?php

namespace App\Controllers;

class Customers extends BaseController
{
    public function index()
    {
        $data['customers'] = [
            [
                'name' => 'Carl Gabriel Vitalista',
                'email' => 'carl.vitalista@example.com',
                'phone' => '09171234567',
            ],
            [
                'name' => 'Anne Cruz',
                'email' => 'anne.cruz@example.com',
                'phone' => '09181234567',
            ],
            [
                'name' => 'Mark Santos',
                'email' => 'mark.santos@example.com',
                'phone' => '09191234567',
            ],
            [
                'name' => 'Jessa Reyes',
                'email' => 'jessa.reyes@example.com',
                'phone' => '09201234567',
            ],
            [
                'name' => 'Kevin Lim',
                'email' => 'kevin.lim@example.com',
                'phone' => '09211234567',
            ],
        ];

        return view('customers', $data);
    }
}