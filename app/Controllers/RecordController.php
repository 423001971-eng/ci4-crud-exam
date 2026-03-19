<?php

namespace App\Controllers;

use App\Models\RecordModel;

class RecordController extends BaseController
{
    public function index()
    {
        $model = new RecordModel();
        $data['records'] = $model->findAll();
        return view('records/index', $data);
    }

    public function show($id)
    {
        $model = new RecordModel();
        $data['record'] = $model->find($id);
        if (!$data['record']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('records/show', $data);
    }

    public function create()
    {
        return view('records/create');
    }

    public function store()
    {
        $rules = [
            'name'        => 'required|min_length[3]',
            'description' => 'required',
            'email'       => 'required|valid_email|is_unique[records.email]',
            'course'      => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new RecordModel();
        $model->save($this->request->getPost());
        return redirect()->to(base_url('students'))->with('success', 'Student record created successfully!');
    }

    public function edit($id)
    {
        $model = new RecordModel();
        $data['record'] = $model->find($id);
        if (!$data['record']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        return view('records/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'name'        => 'required|min_length[3]',
            'description' => 'required',
            'email'       => "required|valid_email|is_unique[records.email,id,{$id}]",
            'course'      => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new RecordModel();
        $model->update($id, $this->request->getPost());
        return redirect()->to(base_url('students'))->with('success', 'Student record updated successfully!');
    }

    public function delete($id)
    {
        $model = new RecordModel();
        $model->delete($id);
        return redirect()->to(base_url('students'))->with('success', 'Student record deleted.');
    }
}
