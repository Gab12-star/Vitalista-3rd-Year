<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff</title>
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
                <strong>Staff</strong>
                <span><?= esc($full_name ?? 'Staff') ?></span>
            </header>

            <section class="page-content">
                <h1>Staff</h1>
                <p class="dashboard-subtitle">Manage staff accounts and profiles.</p>

                <?php if ($message = session()->getFlashdata('success')): ?>
                    <div class="message-success"><?= esc($message) ?></div>
                <?php endif; ?>

                <?php if ($message = session()->getFlashdata('error')): ?>
                    <div class="message-error"><?= esc($message) ?></div>
                <?php endif; ?>

                <div class="products-toolbar">
                    <input type="search" placeholder="Search staff…" aria-label="Search staff">
                    <a class="button" href="<?= site_url('staff/new') ?>">Add Staff</a>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Avatar</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($staff)): ?>
                                <tr>
                                    <td colspan="5">No staff members found.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($staff as $member): ?>
                                    <tr>
                                        <td>
                                            <?php if (! empty($member['avatar'])): ?>
                                                <img
                                                    src="<?= base_url('uploads/avatars/' . esc($member['avatar'])) ?>"
                                                    alt="<?= esc($member['full_name']) ?> avatar"
                                                    class="avatar-thumbnail"
                                                >
                                            <?php else: ?>
                                                <span class="image-placeholder">No avatar</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($member['full_name']) ?></td>
                                        <td><?= esc($member['username']) ?></td>
                                        <td><?= esc($member['created_at']) ?></td>
                                        <td>
                                            <a href="<?= site_url('staff/edit/' . $member['id']) ?>">Edit</a>

                                            <form
                                                action="<?= site_url('staff/delete/' . $member['id']) ?>"
                                                method="post"
                                                style="display:inline"
                                                onsubmit="return confirm('Delete this staff account?')"
                                            >
                                                <?= csrf_field() ?>
                                                <button type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>