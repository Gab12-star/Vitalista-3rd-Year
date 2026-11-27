<?php

namespace App\Controllers;

use App\Models\UserModel;

class StaffController extends BaseController
{
    private function requireAdmin()
    {
        if (! session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (session()->get('role') !== 'admin') {
            return redirect()->to('/dashboard')
                ->with('error', 'Admin access is required.');
        }

        return null;
    }

    public function index()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $staff = (new UserModel())
            ->select('id, username, full_name, avatar, created_at, role')
            ->orderBy('full_name', 'ASC')
            ->findAll();

        return view('staff/index', [
            'staff' => $staff,
            'full_name' => session()->get('full_name'),
        ]);
    }

    public function new()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        return view('staff/form', [
            'staffMember' => [],
            'formTitle' => 'Add User',
            'formAction' => site_url('staff/create'),
        ]);
    }

    public function create()
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        if (! $this->validate($this->staffRules(null, true))) {
            return view('staff/form', [
                'staffMember' => [],
                'formTitle' => 'Add User',
                'formAction' => site_url('staff/create'),
                'validation' => $this->validator,
            ]);
        }

        [$avatarName, $avatarError] = $this->saveAvatar();

        if ($avatarError) {
            return view('staff/form', [
                'staffMember' => [],
                'formTitle' => 'Add User',
                'formAction' => site_url('staff/create'),
                'uploadError' => $avatarError,
            ]);
        }

        $userModel = new UserModel();

        $userModel->insert([
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'password' => password_hash(
                (string) $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'role' => (string) $this->request->getPost('role'),
            'avatar' => $avatarName,
        ]);

        return redirect()->to('/staff')->with('success', 'User account created.');
    }

    public function edit($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $staffMember = (new UserModel())->find($id);

        if (! $staffMember) {
            return redirect()->to('/staff')->with('error', 'User not found.');
        }

        return view('staff/form', [
            'staffMember' => $staffMember,
            'formTitle' => 'Edit User',
            'formAction' => site_url('staff/update/' . $id),
        ]);
    }

    public function update($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        $userModel = new UserModel();
        $staffMember = $userModel->find($id);

        if (! $staffMember) {
            return redirect()->to('/staff')->with('error', 'User not found.');
        }

        if (! $this->validate($this->staffRules((int) $id, false))) {
            return view('staff/form', [
                'staffMember' => $staffMember,
                'formTitle' => 'Edit User',
                'formAction' => site_url('staff/update/' . $id),
                'validation' => $this->validator,
            ]);
        }

        [$avatarName, $avatarError] = $this->saveAvatar();

        if ($avatarError) {
            return view('staff/form', [
                'staffMember' => $staffMember,
                'formTitle' => 'Edit User',
                'formAction' => site_url('staff/update/' . $id),
                'uploadError' => $avatarError,
            ]);
        }

        $data = [
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'role' => (string) $this->request->getPost('role'),
        ];

        $newPassword = (string) $this->request->getPost('password');

        if ($newPassword !== '') {
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        if ($avatarName !== null) {
            $data['avatar'] = $avatarName;
        }

        $userModel->update($id, $data);

        return redirect()->to('/staff')->with('success', 'User account updated.');
    }

    public function delete($id)
    {
        if ($redirect = $this->requireAdmin()) {
            return $redirect;
        }

        if ((int) $id === (int) session()->get('user_id')) {
            return redirect()->to('/staff')
                ->with('error', 'You cannot delete your own account.');
        }

        $userModel = new UserModel();
        $staffMember = $userModel->find($id);

        if (! $staffMember) {
            return redirect()->to('/staff')->with('error', 'User not found.');
        }

        $salesCount = db_connect()
            ->table('sales')
            ->where('sold_by', $id)
            ->countAllResults();

        if ($salesCount > 0) {
            return redirect()->to('/staff')
                ->with('error', 'This user has sales records and cannot be deleted.');
        }

        $userModel->delete($id);

        if (! empty($staffMember['avatar'])) {
            $avatarPath = FCPATH . 'uploads/avatars/' . $staffMember['avatar'];

            if (is_file($avatarPath)) {
                unlink($avatarPath);
            }
        }

        return redirect()->to('/staff')->with('success', 'User account deleted.');
    }

    private function staffRules(?int $id, bool $isCreate): array
    {
        $usernameRule = 'required|min_length[3]|max_length[50]';

        if ($id === null) {
            $usernameRule .= '|is_unique[users.username]';
        } else {
            $usernameRule .= '|is_unique[users.username,id,' . $id . ']';
        }

        return [
            'username' => $usernameRule,
            'full_name' => 'required|max_length[100]',
            'role' => 'required|in_list[admin,staff]',
            'password' => $isCreate
                ? 'required|min_length[8]'
                : 'permit_empty|min_length[8]',
            'confirm_password' => $isCreate
                ? 'required|matches[password]'
                : 'permit_empty|matches[password]',
        ];
    }

    private function saveAvatar(): array
    {
        $avatar = $this->request->getFile('avatar');

        if (! $avatar || $avatar->getError() === UPLOAD_ERR_NO_FILE) {
            return [null, null];
        }

        if (! $avatar->isValid() || $avatar->hasMoved()) {
            return [null, 'The avatar could not be uploaded. Please choose it again.'];
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        if (
            ! in_array($avatar->getMimeType(), $allowedTypes, true)
            || $avatar->getSize() > 2 * 1024 * 1024
        ) {
            return [null, 'Choose a JPG, PNG, or WEBP avatar smaller than 2 MB.'];
        }

        $uploadPath = FCPATH . 'uploads/avatars';

        if (! is_dir($uploadPath)) {
            mkdir($uploadPath, 0775, true);
        }

        $avatarName = $avatar->getRandomName();
        $avatar->move($uploadPath, $avatarName);

        return [$avatarName, null];
    }
}