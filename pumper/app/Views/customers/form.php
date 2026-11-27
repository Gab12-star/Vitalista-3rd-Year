<?php helper(['form', 'security']); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($formTitle ?? 'Customer') ?> | Pumper POS</title>
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
                <strong><?= esc($formTitle ?? 'Customer') ?></strong>
                <span><?= esc(session()->get('full_name') ?? 'Staff') ?></span>
            </header>

            <section class="page-content">
                <h1><?= esc($formTitle ?? 'Customer') ?></h1>
                <p class="dashboard-subtitle">Enter the customer’s information.</p>

                <?php if (isset($validation)): ?>
                    <div class="message-error">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <form class="card" action="<?= esc($formAction) ?>" method="post">
                    <?= csrf_field() ?>

                    <label for="full_name">Full Name</label>
                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        maxlength="100"
                        value="<?= esc(old('full_name', $customer['full_name'] ?? '')) ?>"
                        required
                    >

                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        maxlength="100"
                        value="<?= esc(old('email', $customer['email'] ?? '')) ?>"
                        required
                    >

                    <label for="phone">Phone (optional)</label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        maxlength="20"
                        value="<?= esc(old('phone', $customer['phone'] ?? '')) ?>"
                    >

                    <button type="submit">Save Customer</button>
                    <a href="<?= site_url('customers') ?>">Cancel</a>
                </form>
            </section>
        </main>
    </div>
</body>
</html>