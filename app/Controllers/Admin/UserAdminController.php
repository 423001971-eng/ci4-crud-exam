<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoleModel;

class UserAdminController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $roleModel = new RoleModel();

        $data['users'] = $userModel->select('users.*, roles.name as role_name')
                                   ->join('roles', 'roles.id = users.role_id', 'left')
                                   ->get()->getResultArray();
        $data['roles'] = $roleModel->findAll();

        return view('admin/users/index', $data);
    }

    public function assignRole($id)
    {
        $userModel = new UserModel();
        $currentUser = session('user');

        if ($id == $currentUser['id']) {
            return redirect()->to('/admin/users')->with('error', 'You cannot change your own role.');
        }

        $roleId = $this->request->getPost('role_id');
        $userModel->update($id, ['role_id' => $roleId]);

        return redirect()->to('/admin/users')->with('success', 'User role updated. Changes will take effect on their next login.');
    }
}
