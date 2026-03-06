<?php

namespace App\Controllers;
use App\Models\RecordModel;

class RecordsController extends BaseController
{
    protected $session;
    protected $recordModel;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->recordModel = new RecordModel();
    }

    // List all records
    public function index()
    {
        $data['records'] = $this->recordModel->findAll();
        return view('records/index', $data);
    }

    // Show create form / handle create
    public function create()
    {
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $this->recordModel->save([
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description')
            ]);
            return redirect()->to('/records');
        }
        return view('records/create');
    }

    // Show edit form / handle edit
    public function edit($id)
    {
        helper(['form']);
        $record = $this->recordModel->find($id);

        if ($this->request->getMethod() == 'post') {
            $this->recordModel->update($id, [
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description')
            ]);
            return redirect()->to('/records');
        }

        $data['record'] = $record;
        return view('records/edit', $data);
    }

    // Delete record
    public function delete($id)
    {
        $this->recordModel->delete($id);
        return redirect()->to('/records');
    }
}