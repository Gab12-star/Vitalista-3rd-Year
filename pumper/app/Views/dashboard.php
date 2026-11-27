<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/pos.css') ?>">
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">Pumper</div>

            <nav>
                <a class="active" href="<?= site_url('dashboard') ?>">Dashboard</a>
                <a href="<?= site_url('products') ?>">Products</a>
                <a href="<?= site_url('customers') ?>">Customers</a>

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
                <div class="topbar-start">
                    <button
                        class="sidebar-toggle"
                        id="sidebarToggle"
                        type="button"
                        aria-label="Hide menu"
                        aria-controls="sidebar"
                        aria-expanded="true"
                    >☰</button>
                    <strong>Dashboard</strong>
                </div>

                <span><?= esc($full_name ?? 'Staff') ?></span>
            </header>

            <section class="page-content">
                <div class="dashboard-hero">
                    <div class="dashboard-hero-content">
                        <span class="dashboard-kicker">
                            CONSTRUCTION SUPPLIES · POINT OF SALE
                        </span>
                        <h1>Welcome, <?= esc($full_name ?? 'Staff') ?></h1>
                        <p>
                            Keep your safety gear inventory, customers, and daily sales organized in one place.
                        </p>
                        <a class="dashboard-hero-button" href="<?= site_url('sales/new') ?>">
                            Start a Sale <span aria-hidden="true">→</span>
                        </a>
                    </div>

                    <div class="dashboard-hero-icon" aria-hidden="true">P</div>
                </div>

                <div class="dashboard-section-heading">
                    <div>
                        <h2>Store Overview</h2>
                        <p>Your current inventory and sales snapshot.</p>
                    </div>
                </div>

                <div class="stat-grid">
                    <a class="card stat-card dashboard-stat-link" href="<?= site_url('products') ?>">
                        <span class="stat-label">Products in Inventory</span>
                        <strong class="stat-value"><?= esc($product_count ?? 0) ?></strong>
                        <span class="stat-note">View safety gear and stock</span>
                    </a>

                    <a class="card stat-card dashboard-stat-link" href="<?= site_url('customers') ?>">
                        <span class="stat-label">Customers</span>
                        <strong class="stat-value"><?= esc($customer_count ?? 0) ?></strong>
                        <span class="stat-note">View customer records</span>
                    </a>

                    <a class="card stat-card dashboard-stat-link" href="<?= site_url('sales/history') ?>">
                        <span class="stat-label">Sales Today</span>
                        <strong class="stat-value">
                            ₱<?= number_format((float) ($sales_today ?? 0), 2) ?>
                        </strong>
                        <span class="stat-note">View sales history</span>
                    </a>
                </div>

                <div class="dashboard-section-heading">
                    <div>
                        <h2>Quick Actions</h2>
                        <p>Go directly to a common task.</p>
                    </div>
                </div>

                <div class="dashboard-quick-grid">
                    <a class="card quick-action" href="<?= site_url('products') ?>">
                        <span class="quick-action-icon" aria-hidden="true">▦</span>
                        <span>
                            <strong>Manage Products</strong>
                            <small>Add gear or update stock and prices.</small>
                        </span>
                        <span class="quick-action-arrow" aria-hidden="true">→</span>
                    </a>

                    <a class="card quick-action" href="<?= site_url('sales/new') ?>">
                        <span class="quick-action-icon" aria-hidden="true">₱</span>
                        <span>
                            <strong>Record a Sale</strong>
                            <small>Check out a customer’s purchase.</small>
                        </span>
                        <span class="quick-action-arrow" aria-hidden="true">→</span>
                    </a>

                    <a class="card quick-action" href="<?= site_url('customers') ?>">
                        <span class="quick-action-icon" aria-hidden="true">♙</span>
                        <span>
                            <strong>View Customers</strong>
                            <small>Open your customer records.</small>
                        </span>
                        <span class="quick-action-arrow" aria-hidden="true">→</span>
                    </a>
                </div>
            </section>
        </main>
    </div>

    <script src="<?= base_url('assets/js/sidebar-toggle.js') ?>"></script>
</body>
</html>