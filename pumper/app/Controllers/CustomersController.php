<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class CustomersController extends BaseController
{
    private function requireLogin()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return null;
    }

    public function index()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $customerModel = new CustomerModel();

        return view('customers/index', [
            'customers' => $customerModel->orderBy('full_name', 'ASC')->findAll(),
            'full_name' => session()->get('full_name'),
        ]);
    }

    public function new()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        return view('customers/form', [
            'customer' => [],
            'formAction' => site_url('customers/create'),
            'formTitle' => 'Add Customer',
        ]);
    }

    public function create()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        if (! $this->validate($this->customerRules())) {
            return view('customers/form', [
                'customer' => [],
                'formAction' => site_url('customers/create'),
                'formTitle' => 'Add Customer',
                'validation' => $this->validator,
            ]);
        }

        (new CustomerModel())->insert([
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email' => trim((string) $this->request->getPost('email')),
            'phone' => trim((string) $this->request->getPost('phone')),
        ]);

        return redirect()->to('/customers')->with('success', 'Customer added.');
    }

    public function edit($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $customer = (new CustomerModel())->find($id);

        if (! $customer) {
            return redirect()->to('/customers')->with('error', 'Customer not found.');
        }

        return view('customers/form', [
            'customer' => $customer,
            'formAction' => site_url('customers/update/' . $id),
            'formTitle' => 'Edit Customer',
        ]);
    }

    public function update($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $customerModel = new CustomerModel();
        $customer = $customerModel->find($id);

        if (! $customer) {
            return redirect()->to('/customers')->with('error', 'Customer not found.');
        }

        if (! $this->validate($this->customerRules())) {
            return view('customers/form', [
                'customer' => $customer,
                'formAction' => site_url('customers/update/' . $id),
                'formTitle' => 'Edit Customer',
                'validation' => $this->validator,
            ]);
        }

        $customerModel->update($id, [
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'email' => trim((string) $this->request->getPost('email')),
            'phone' => trim((string) $this->request->getPost('phone')),
        ]);

        return redirect()->to('/customers')->with('success', 'Customer updated.');
    }

    public function delete($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        (new CustomerModel())->delete($id);

        return redirect()->to('/customers')->with('success', 'Customer deleted.');
    }

    private function customerRules(): array
    {
        return [
            'full_name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email|max_length[100]',
            'phone' => 'permit_empty|max_length[20]',
        ];
    }
}