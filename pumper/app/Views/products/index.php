<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
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
                <strong>Products</strong>
                <span><?= esc($full_name ?? 'Staff') ?></span>
            </header>

            <section class="page-content">
                <h1>Products</h1>
                <p class="dashboard-subtitle">View and manage your store inventory.</p>

                <div class="products-toolbar">
                    <input type="search" placeholder="Search products…" aria-label="Search products">
                    <a class="button" href="<?= site_url('products/new') ?>">Add Product</a>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($products)): ?>
                                <tr>
                                    <td colspan="5">No products have been added yet.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td>
                                            <?php if (! empty($product['image'])): ?>
                                                <img
                                                    class="product-thumbnail"
                                                    src="<?= base_url('uploads/products/' . esc($product['image'])) ?>"
                                                    alt="<?= esc($product['name']) ?>"
                                                >
                                            <?php else: ?>
                                                <span class="image-placeholder">No image</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($product['name']) ?></td>
                                        <td>₱<?= number_format((float) $product['price'], 2) ?></td>
                                        <td><?= esc($product['stock_quantity']) ?></td>
                                        <td>
                                            <a href="#">Edit</a>
                                            &nbsp;·&nbsp;
                                            <a href="#">Delete</a>
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