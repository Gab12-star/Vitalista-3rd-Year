<?= $this->include('partials/nav') ?>

<main class="dashboard">
    <header class="topbar">
        <div>
            <p class="eyebrow">ACCOUNT DIRECTORY</p>
            <h1>Customer Accounts</h1>
            <p class="subtext">Registered customer information from MySQL database.</p>
        </div>

        <div class="record-count"><?= count($customers) ?> Customers</div>
    </header>

    <section class="list-panel">
        <div class="panel-heading">
            <h2>Customer List</h2>
            <span>Full Name · Email · Phone</span>
        </div>

        <div class="customer-list">
            <?php foreach ($customers as $customer): ?>
                <article class="person-row">
                    <div class="avatar">
                        <?= esc(strtoupper(substr($customer['full_name'], 0, 1))) ?>
                    </div>

                    <div class="person-name">
                        <strong><?= esc($customer['full_name']) ?></strong>
                        <small>Customer Account</small>
                    </div>

                    <div class="person-detail">
                        <small>Email Address</small>
                        <span><?= esc($customer['email']) ?></span>
                    </div>

                    <div class="person-detail">
                        <small>Phone Number</small>
                        <span><?= esc($customer['phone']) ?></span>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>