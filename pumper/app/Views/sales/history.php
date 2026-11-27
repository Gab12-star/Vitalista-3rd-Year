<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales History | Pumper POS</title>
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

                <?php if (session()->get('role') === 'admin'): ?>
                    <a href="<?= site_url('staff') ?>">Staff</a>
                <?php endif; ?>

                <a href="<?= site_url('sales/new') ?>">Record Sale</a>
                <a class="active" href="<?= site_url('sales/history') ?>">Sales History</a>
                <a href="<?= site_url('logout') ?>">Log Out</a>
            </nav>
        </aside>

        <main class="main-area">
            <header class="topbar">
                <strong>Sales History</strong>
                <span><?= esc($full_name ?? 'Staff') ?></span>
            </header>

            <section class="page-content">
                <h1>Sales History</h1>
                <p class="dashboard-subtitle">Review completed sales and their details.</p>

                <?php if ($message = session()->getFlashdata('success')): ?>
                    <div class="message-success"><?= esc($message) ?></div>
                <?php endif; ?>

                <?php if ($message = session()->getFlashdata('error')): ?>
                    <div class="message-error"><?= esc($message) ?></div>
                <?php endif; ?>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Staff</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($sales)): ?>
                                <tr>
                                    <td colspan="6">No sales have been recorded yet.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($sales as $sale): ?>
                                    <tr>
                                        <td>
                                            <?= esc(date('M d, Y h:i A', strtotime($sale['created_at']))) ?>
                                        </td>
                                        <td><?= esc($sale['product_name']) ?></td>
                                        <td><?= esc($sale['customer_name'] ?? 'Guest checkout') ?></td>
                                        <td><?= esc($sale['staff_name']) ?></td>
                                        <td><?= esc($sale['quantity']) ?></td>
                                        <td>₱<?= number_format((float) $sale['total_price'], 2) ?></td>
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