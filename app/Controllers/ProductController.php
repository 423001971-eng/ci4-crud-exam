<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;

class ProductController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    // List all products
    public function index()
    {
        $data['products'] = $this->productModel->findAll();
        return view('products/index', $data);
    }

    // Show create form
    public function create()
    {
        return view('products/create');
    }

    // Store new product
    public function store()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'title' => 'required|min_length[3]',
            'description' => 'required',
            'price' => 'required|decimal',
            'stock' => 'required|integer'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->productModel->save([
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock')
        ]);

        return redirect()->to('/products')->with('success', 'Product added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $data['product'] = $this->productModel->find($id);
        return view('products/edit', $data);
    }

    // Update product
    public function update($id)
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'title' => 'required|min_length[3]',
            'description' => 'required',
            'price' => 'required|decimal',
            'stock' => 'required|integer'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->productModel->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock')
        ]);

        return redirect()->to('/products')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function delete($id)
    {
        $this->productModel->delete($id);
        return redirect()->to('/products')->with('success', 'Product deleted successfully!');
    }
}