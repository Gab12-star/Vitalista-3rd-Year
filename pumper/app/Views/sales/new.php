<?php helper(['form', 'security']); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Record Sale | Pumper POS</title>
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

                <a class="active" href="<?= site_url('sales/new') ?>">Record Sale</a>
                <a href="<?= site_url('sales/history') ?>">Sales History</a>
                <a href="<?= site_url('logout') ?>">Log Out</a>
            </nav>
        </aside>

        <main class="main-area">
            <header class="topbar">
                <strong>Record Sale</strong>
                <span><?= esc($full_name ?? 'Staff') ?></span>
            </header>

            <section class="page-content">
                <h1>Record Sale</h1>
                <p class="dashboard-subtitle">Choose a product and enter the quantity sold.</p>

                <?php if ($message = session()->getFlashdata('error')): ?>
                    <div class="message-error"><?= esc($message) ?></div>
                <?php endif; ?>

                <?php if (isset($validation)): ?>
                    <div class="message-error"><?= $validation->listErrors() ?></div>
                <?php endif; ?>

                <?php if (empty($products)): ?>
                    <div class="message-error">
                        No products are available yet. Add a product before recording a sale.
                    </div>
                <?php else: ?>
                    <form class="card sale-form" action="<?= site_url('sales/record') ?>" method="post">
                        <?= csrf_field() ?>

                        <label for="product_id">Product</label>
                        <select id="product_id" name="product_id" required>
                            <option value="">Select a product</option>

                            <?php foreach ($products as $product): ?>
                                <option
                                    value="<?= esc($product['id']) ?>"
                                    data-price="<?= esc($product['price']) ?>"
                                    data-stock="<?= esc($product['stock_quantity']) ?>"
                                    <?= old('product_id') == $product['id'] ? 'selected' : '' ?>
                                >
                                    <?= esc($product['name']) ?>
                                    — ₱<?= number_format((float) $product['price'], 2) ?>
                                    (Stock: <?= esc($product['stock_quantity']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="customer_id">Customer account (optional)</label>
                        <select id="customer_id" name="customer_id">
                            <option value="">Guest checkout (no saved customer account)</option>

                            <?php foreach ($customers as $customer): ?>
                                <option
                                    value="<?= esc($customer['id']) ?>"
                                    <?= old('customer_id') == $customer['id'] ? 'selected' : '' ?>
                                >
                                    <?= esc($customer['full_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label for="quantity">Quantity</label>
                        <input
                            type="number"
                            id="quantity"
                            name="quantity"
                            min="1"
                            step="1"
                            value="<?= esc(old('quantity', '1')) ?>"
                            required
                        >

                        <div class="sale-total">
                            <span>Estimated total</span>
                            <strong id="estimated-total">₱0.00</strong>
                        </div>

                        <button type="submit">Save Sale</button>
                    </form>
                <?php endif; ?>
            </section>
        </main>
    </div>

    <script>
        const productSelect = document.getElementById('product_id');
        const quantityInput = document.getElementById('quantity');
        const totalOutput = document.getElementById('estimated-total');

        function updateEstimatedTotal() {
            const option = productSelect?.selectedOptions[0];
            const price = Number(option?.dataset.price || 0);
            const quantity = Number(quantityInput?.value || 0);

            if (totalOutput) {
                totalOutput.textContent = '₱' + (price * quantity).toFixed(2);
            }
        }

        productSelect?.addEventListener('change', updateEstimatedTotal);
        quantityInput?.addEventListener('input', updateEstimatedTotal);
        updateEstimatedTotal();
    </script>
</body>
</html>