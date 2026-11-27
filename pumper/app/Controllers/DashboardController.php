<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;

class DashboardController extends BaseController
{
    public function index()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $todayStart = date('Y-m-d 00:00:00');
        $tomorrowStart = date('Y-m-d 00:00:00', strtotime('+1 day'));

        $salesRow = db_connect()
            ->table('sales')
            ->selectSum('total_price', 'total')
            ->where('created_at >=', $todayStart)
            ->where('created_at <', $tomorrowStart)
            ->get()
            ->getRowArray();

        return view('dashboard', [
            'full_name' => session()->get('full_name'),
            'product_count' => (new ProductModel())->countAllResults(),
            'customer_count' => (new CustomerModel())->countAllResults(),
            'sales_today' => $salesRow['total'] ?? 0,
        ]);
    }
}