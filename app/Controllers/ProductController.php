<?php 

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController {
    
    // 3.2 READ: Index
    public function index() {
        $model = new ProductModel();
        $data['products'] = $model->findAll();
        return view('products/index', $data);
    }

    // 3.2 READ: Show Details
    public function show($id) {
        $model = new ProductModel();
        $data['product'] = $model->find($id);
        if (!$data['product']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('products/show', $data);
    }

    public function create() { 
        return view('products/create'); 
    }

    // 3.1 CREATE: Store with Validation
    public function store() {
        $rules = [
            'title'       => 'required|min_length[3]',
            'description' => 'required',
            'price'       => 'required|decimal',
            'stock'       => 'required|is_natural'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Please correct the errors.');
        }

        $model = new ProductModel();
        $model->save($this->request->getPost());
        return redirect()->to('/products')->with('success', 'Product created successfully!');
    }

    public function edit($id) {
        $model = new ProductModel();
        $data['product'] = $model->find($id);
        return view('products/edit', $data);
    }

    // 3.3 UPDATE: Update with Validation
    public function update($id) {
        $rules = [
            'title' => 'required|min_length[3]',
            'price' => 'required|decimal',
            'stock' => 'required|is_natural'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Update failed. Check your inputs.');
        }

        $model = new ProductModel();
        $model->update($id, $this->request->getPost());
        return redirect()->to('/products')->with('success', 'Product updated successfully!');
    }

    // --- Inserted Method Below ---
    
    /**
     * 3.4 DELETE: Hard Delete
     * Requirement: Flash success message after deletion
     */
    public function delete($id)
    {
        $model = new ProductModel();
        $model->delete($id);
        
        // Fixed the typo from '/pro ducts' to '/products'
        return redirect()->to('/products')->with('success', 'Record deleted successfully.');
    }
}