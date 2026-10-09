<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'title'      => 'Finish laboratory activity',
                'status'     => 'pending',
                'task_date'  => date('Y-m-d'),
                'created_at' => $now,
            ],
            [
                'title'      => 'Review CodeIgniter lesson',
                'status'     => 'completed',
                'task_date'  => date('Y-m-d'),
                'created_at' => $now,
            ],
            [
                'title'      => 'Create database migration',
                'status'     => 'pending',
                'task_date'  => date('Y-m-d'),
                'created_at' => $now,
            ],
            [
                'title'      => 'Study MVC pattern',
                'status'     => 'pending',
                'task_date'  => date('Y-m-d', strtotime('-1 day')),
                'created_at' => $now,
            ],
            [
                'title'      => 'Practice CodeIgniter routing',
                'status'     => 'completed',
                'task_date'  => date('Y-m-d', strtotime('-1 day')),
                'created_at' => $now,
            ],
            [
                'title'      => 'Create the task model',
                'status'     => 'pending',
                'task_date'  => date('Y-m-d', strtotime('-2 days')),
                'created_at' => $now,
            ],
            [
                'title'      => 'Design the task list page',
                'status'     => 'pending',
                'task_date'  => date('Y-m-d', strtotime('-2 days')),
                'created_at' => $now,
            ],
            [
                'title'      => 'Test the application',
                'status'     => 'pending',
                'task_date'  => date('Y-m-d', strtotime('-2 days')),
                'created_at' => $now,
            ],
        ];

        $this->db->table('tasks')->insertBatch($data);
    }
}