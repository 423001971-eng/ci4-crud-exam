<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RoleModel;
use App\Models\UserModel;

class RoleController extends BaseController
{
    protected $roleModel;

    public function __construct()
    {
        $this->roleModel = new RoleModel();
    }

    public function index()
    {
        $data['roles'] = $this->roleModel->getRolesWithUserCount();
        return view('admin/roles/index', $data);
    }

    public function create()
    {
        return view('admin/roles/create');
    }

    public function store()
    {
        $rules = [
            'slug' => 'required|alpha_dash|is_unique[roles.slug]',
            'name' => 'required|min_length[3]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->roleModel->save([
            'slug' => strtolower($this->request->getPost('slug')),
            'name' => $this->request->getPost('name')
        ]);

        return redirect()->to('/admin/roles')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $data['role'] = $this->roleModel->find($id);
        if (!$data['role']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        
        return view('admin/roles/edit', $data);
    }

    public function update($id)
    {
        $role = $this->roleModel->find($id);
        if (!$role) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $rules = [
            'name' => 'required|min_length[3]'
        ];

        // Only allow slug update if it's NOT a core role
        $coreRoles = ['admin', 'teacher', 'student'];
        if (!in_array($role['slug'], $coreRoles)) {
            $rules['slug'] = "required|alpha_dash|is_unique[roles.slug,id,{$id}]";
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = ['name' => $this->request->getPost('name')];
        if (!in_array($role['slug'], $coreRoles)) {
            $updateData['slug'] = strtolower($this->request->getPost('slug'));
        }

        $this->roleModel->update($id, $updateData);
        return redirect()->to('/admin/roles')->with('success', 'Role updated successfully.');
    }

    public function delete($id)
    {
        $role = $this->roleModel->find($id);
        if (!$role) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        if ($role['slug'] === 'admin') {
            return redirect()->to('/admin/roles')->with('error', 'The admin role cannot be deleted.');
        }

        // Unassign users before deleting
        $userModel = new UserModel();
        $userModel->where('role_id', $id)->set(['role_id' => null])->update();

        $this->roleModel->delete($id);
        return redirect()->to('/admin/roles')->with('success', 'Role deleted and affected users unassigned.');
    }
}
