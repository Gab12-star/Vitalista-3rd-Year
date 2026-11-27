<?php
$isEditing = ! empty($staffMember['id']);
$currentRole = old('role', $staffMember['role'] ?? 'staff');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($formTitle ?? 'Add User') ?> | Pumper</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/pos.css') ?>">
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <div class="sidebar-brand">Pumper</div>

            <nav>
                <a href="<?= site_url('dashboard') ?>">Dashboard</a>
                <a href="<?= site_url('products') ?>">Products</a>
                <a href="<?= site_url('customers') ?>">Customers</a>
                <a class="active" href="<?= site_url('staff') ?>">Staff</a>
                <a href="<?= site_url('sales/new') ?>">Record Sale</a>
                <a href="<?= site_url('sales/history') ?>">Sales History</a>
                <a href="<?= site_url('logout') ?>">Log Out</a>
            </nav>
        </aside>

        <main class="main-area">
            <header class="topbar">
                <strong><?= esc($formTitle ?? 'Add User') ?></strong>
                <span><?= esc(session()->get('full_name') ?? 'Admin') ?></span>
            </header>

            <section class="page-content">
                <h1><?= esc($formTitle ?? 'Add User') ?></h1>
                <p class="dashboard-subtitle">
                    Enter the account details and choose the user's access role.
                </p>

                <?php if (isset($validation)): ?>
                    <div class="message-error">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($uploadError)): ?>
                    <div class="message-error">
                        <?= esc($uploadError) ?>
                    </div>
                <?php endif; ?>

                <form
                    class="card"
                    action="<?= esc($formAction) ?>"
                    method="post"
                    enctype="multipart/form-data"
                >
                    <?= csrf_field() ?>

                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        maxlength="50"
                        value="<?= esc(old('username', $staffMember['username'] ?? '')) ?>"
                        required
                    >

                    <label for="full_name">Full Name</label>
                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        maxlength="100"
                        value="<?= esc(old('full_name', $staffMember['full_name'] ?? '')) ?>"
                        required
                    >

                    <label for="role">Account Role</label>
                    <select id="role" name="role" required>
                        <option value="staff" <?= $currentRole === 'staff' ? 'selected' : '' ?>>
                            Staff
                        </option>
                        <option value="admin" <?= $currentRole === 'admin' ? 'selected' : '' ?>>
                            Admin
                        </option>
                    </select>

                    <label for="password">
                        Password<?= $isEditing ? ' (leave blank to keep current password)' : '' ?>
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        minlength="8"
                        <?= $isEditing ? '' : 'required' ?>
                    >

                    <label for="confirm_password">Confirm Password</label>
                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        minlength="8"
                        <?= $isEditing ? '' : 'required' ?>
                    >

                    <label for="avatar">Profile Image (optional)</label>
                    <input
                        type="file"
                        id="avatar"
                        name="avatar"
                        accept=".jpg,.jpeg,.png,.webp"
                    >
                    <p>JPG, PNG, or WEBP; maximum 2 MB.</p>

                    <button type="submit">
                        <?= $isEditing ? 'Save Changes' : 'Create User' ?>
                    </button>

                    <a href="<?= site_url('staff') ?>">Cancel</a>
                </form>
            </section>
        </main>
    </div>
</body>
</html>