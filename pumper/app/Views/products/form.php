<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Product</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/pos.css') ?>">
</head>
<body>
    <div class="app-shell">
        <aside class="sidebar">
            <div class="sidebar-brand">Pumper</div>
            <nav>
                <a href="<?= site_url('dashboard') ?>">Dashboard</a>
                <a class="active" href="<?= site_url('products') ?>">Products</a>
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
                <strong>Add Product</strong>
                <span><?= esc(session()->get('full_name') ?? 'Staff') ?></span>
            </header>

            <section class="page-content">
                <h1>Add Product</h1>
                <p class="dashboard-subtitle">Enter the product details and optional image.</p>

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
                    action="<?= site_url('products/create') ?>"
                    method="post"
                    enctype="multipart/form-data"
                >
                    <?= csrf_field() ?>

                    <label for="name">Product Name</label>
                    <input type="text" id="name" name="name" maxlength="100" required>

                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" min="0" step="0.01" required>

                    <label for="stock_quantity">Stock Quantity</label>
                    <input
                        type="number"
                        id="stock_quantity"
                        name="stock_quantity"
                        min="0"
                        step="1"
                        required
                    >

                    <label for="image">Product Image (optional)</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp"
                    >
                    <p>JPG, PNG, or WEBP; maximum 2 MB.</p>

                    <button type="submit">Save Product</button>
                    <a href="<?= site_url('products') ?>">Cancel</a>
                </form>
            </section>
        </main>
    </div>
</body>
</html>