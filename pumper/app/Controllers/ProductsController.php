<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductsController extends BaseController
{
    public function index()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $productModel = new ProductModel();

        return view('products/index', [
            'products' => $productModel->orderBy('name', 'ASC')->findAll(),
            'full_name' => session()->get('full_name'),
        ]);
    }

    public function new()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('products/form');
    }

    public function create()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $rules = [
            'name' => 'required|max_length[100]',
            'price' => 'required|decimal|greater_than_equal_to[0]',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
        ];

        if (! $this->validate($rules)) {
            return view('products/form', [
                'validation' => $this->validator,
            ]);
        }

        $imageName = null;
        $image = $this->request->getFile('image');

        if ($image && $image->getError() !== UPLOAD_ERR_NO_FILE) {
            if (! $image->isValid() || $image->hasMoved()) {
                return view('products/form', [
                    'uploadError' => 'The image could not be uploaded. Please choose it again.',
                ]);
            }

            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

            if (
                ! in_array($image->getMimeType(), $allowedTypes, true)
                || $image->getSize() > 2 * 1024 * 1024
            ) {
                return view('products/form', [
                    'uploadError' => 'Choose a JPG, PNG, or WEBP image smaller than 2 MB.',
                ]);
            }

            $uploadPath = FCPATH . 'uploads/products';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0775, true);
            }

            $imageName = $image->getRandomName();
            $image->move($uploadPath, $imageName);
        }

        $productModel = new ProductModel();
        $productModel->insert([
            'name' => trim((string) $this->request->getPost('name')),
            'price' => (float) $this->request->getPost('price'),
            'stock_quantity' => (int) $this->request->getPost('stock_quantity'),
            'image' => $imageName,
        ]);

        return redirect()->to('/products')->with('success', 'Product added.');
    }
}