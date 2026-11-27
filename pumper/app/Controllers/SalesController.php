<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\SaleModel;

class SalesController extends BaseController
{
    private function requireLogin()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return null;
    }

    public function new()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        return view('sales/new', [
            'products' => (new ProductModel())->orderBy('name', 'ASC')->findAll(),
            'customers' => (new CustomerModel())->orderBy('full_name', 'ASC')->findAll(),
            'full_name' => session()->get('full_name'),
        ]);
    }

    public function record()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $rules = [
            'product_id' => 'required|integer',
            'customer_id' => 'permit_empty|integer',
            'quantity' => 'required|integer|greater_than[0]',
        ];

        if (! $this->validate($rules)) {
            return view('sales/new', [
                'products' => (new ProductModel())->orderBy('name', 'ASC')->findAll(),
                'customers' => (new CustomerModel())->orderBy('full_name', 'ASC')->findAll(),
                'full_name' => session()->get('full_name'),
                'validation' => $this->validator,
            ]);
        }

        $productId = (int) $this->request->getPost('product_id');
        $quantity = (int) $this->request->getPost('quantity');
        $customerInput = $this->request->getPost('customer_id');
        $customerId = ($customerInput === '' || $customerInput === null)
            ? null
            : (int) $customerInput;

        if ($customerId !== null && ! (new CustomerModel())->find($customerId)) {
            return redirect()->back()->withInput()->with('error', 'Choose a valid customer.');
        }

        $db = db_connect();
        $db->transBegin();

        try {
            $product = $db->query(
                'SELECT * FROM products WHERE id = ? FOR UPDATE',
                [$productId]
            )->getRowArray();

            if (! $product) {
                $db->transRollback();
                return redirect()->back()->withInput()->with('error', 'Product not found.');
            }

            if ($quantity > (int) $product['stock_quantity']) {
                $available = (int) $product['stock_quantity'];
                $db->transRollback();

                return redirect()->back()->withInput()->with(
                    'error',
                    "Only {$available} unit(s) of this product are in stock."
                );
            }

            $totalPrice = (float) $product['price'] * $quantity;

            $db->table('products')
                ->where('id', $productId)
                ->update([
                    'stock_quantity' => (int) $product['stock_quantity'] - $quantity,
                ]);

            (new SaleModel())->insert([
                'product_id' => $productId,
                'customer_id' => $customerId,
                'sold_by' => (int) session()->get('user_id'),
                'quantity' => $quantity,
                'total_price' => $totalPrice,
            ]);

            if ($db->transStatus() === false) {
                $db->transRollback();
                return redirect()->back()->withInput()->with('error', 'The sale could not be saved.');
            }

            $db->transCommit();
        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', 'Sale recording failed: ' . $e->getMessage());

            return redirect()->back()->withInput()->with(
                'error',
                'The sale could not be saved. Please try again.'
            );
        }

        return redirect()->to('/sales/history')->with('success', 'Sale recorded successfully.');
    }

    public function history()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $sales = db_connect()
            ->table('sales')
            ->select(
                'sales.id, products.name AS product_name, ' .
                'customers.full_name AS customer_name, users.full_name AS staff_name, ' .
                'sales.quantity, sales.total_price, sales.created_at'
            )
            ->join('products', 'products.id = sales.product_id')
            ->join('customers', 'customers.id = sales.customer_id', 'left')
            ->join('users', 'users.id = sales.sold_by')
            ->orderBy('sales.created_at', 'DESC')
            ->get()
            ->getResultArray();

        return view('sales/history', [
            'sales' => $sales,
            'full_name' => session()->get('full_name'),
        ]);
    }
}