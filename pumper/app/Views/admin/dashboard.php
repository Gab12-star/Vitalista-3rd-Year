<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/pos.css') ?>">
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <div class="sidebar-brand">Pumper Admin</div>

            <nav>
                <a class="active" href="<?= site_url('admin/dashboard') ?>">Admin Dashboard</a>
                <a href="<?= site_url('products') ?>">Products</a>
                <a href="<?= site_url('customers') ?>">Customers</a>
                <a href="<?= site_url('staff') ?>">Staff</a>
                <a href="<?= site_url('sales/new') ?>">Record Sale</a>
                <a href="<?= site_url('sales/history') ?>">Sales History</a>
                <a href="<?= site_url('logout') ?>">Log Out</a>
            </nav>
        </aside>

        <main class="main-area">
            <header class="topbar">
                <strong>Admin Dashboard</strong>
                <span><?= esc($full_name ?? 'Admin') ?></span>
            </header>

            <section class="page-content">
                <h1>Welcome, <?= esc($full_name ?? 'Admin') ?></h1>
                <p class="dashboard-subtitle">
                    Manage your store, staff, products, customers, and sales.
                </p>

                <article class="card welcome-card">
                    <h2>Store Administration</h2>
                    <p>Use the menu to manage staff accounts and oversee store activity.</p>
                </article>
            </section>
        </main>
    </div>
</body>
</html>