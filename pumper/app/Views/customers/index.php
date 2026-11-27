<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customers</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/pos.css') ?>">
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <div class="sidebar-brand">Pumper</div>

            <nav>
                <a href="<?= site_url('dashboard') ?>">Dashboard</a>
                <a href="<?= site_url('products') ?>">Products</a>
                <a class="active" href="<?= site_url('customers') ?>">Customers</a>

                <?php if (session()->get('role') === 'admin'): ?>
                    <a href="<?= site_url('staff') ?>">Staff</a>
                <?php endif; ?>

                <a href="<?= site_url('sales/new') ?>">Record Sale</a>
                <a href="<?= site_url('sales/history') ?>">Sales History</a>
                <a href="<?= site_url('logout') ?>">Log Out</a>
            </nav>
        </aside>

        <main class="main-area">
            <header class="topbar">
                <strong>Customers</strong>
                <span><?= esc($full_name ?? 'Staff') ?></span>
            </header>

            <section class="page-content">
                <h1>Customers</h1>
                <p class="dashboard-subtitle">View and manage customer records.</p>

                <?php if ($message = session()->getFlashdata('success')): ?>
                    <div class="message-success"><?= esc($message) ?></div>
                <?php endif; ?>

                <?php if ($message = session()->getFlashdata('error')): ?>
                    <div class="message-error"><?= esc($message) ?></div>
                <?php endif; ?>

                <div class="products-toolbar">
                    <input
                        type="search"
                        placeholder="Search customers…"
                        aria-label="Search customers"
                    >
                    <a class="button" href="<?= site_url('customers/new') ?>">
                        Add Customer
                    </a>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (empty($customers)): ?>
                                <tr>
                                    <td colspan="4">No customers have been added yet.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($customers as $customer): ?>
                                    <tr>
                                        <td><?= esc($customer['full_name']) ?></td>
                                        <td><?= esc($customer['email']) ?></td>
                                        <td><?= esc($customer['phone'] ?? '') ?></td>
                                        <td>
                                            <a href="<?= site_url('customers/edit/' . $customer['id']) ?>">
                                                Edit
                                            </a>

                                            <form
                                                action="<?= site_url('customers/delete/' . $customer['id']) ?>"
                                                method="post"
                                                style="display: inline"
                                                onsubmit="return confirm('Delete this customer?')"
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