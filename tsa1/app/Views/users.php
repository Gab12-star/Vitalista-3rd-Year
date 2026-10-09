<?= $this->include('partials/nav') ?>

<main class="dashboard">
    <header class="topbar">
        <div>
            <p class="eyebrow">STAFF DIRECTORY</p>
            <h1>User Accounts</h1>
            <p class="subtext">System users and staff information from MySQL database.</p>
        </div>

        <div class="record-count"><?= count($users) ?> Users</div>
    </header>

    <section class="list-panel">
        <div class="panel-heading">
            <h2>Staff User List</h2>
            <span>Username · Full Name · Created At</span>
        </div>

        <div class="customer-list">
            <?php foreach ($users as $user): ?>
                <article class="person-row">
                    <div class="avatar user-avatar">
                        <?= esc(strtoupper(substr($user['full_name'], 0, 1))) ?>
                    </div>

                    <div class="person-name">
                        <strong><?= esc($user['full_name']) ?></strong>
                        <small>@<?= esc($user['username']) ?></small>
                    </div>

                    <div class="person-detail">
                        <small>Username</small>
                        <span><?= esc($user['username']) ?></span>
                    </div>

                    <div class="person-detail">
                        <small>Created At</small>
                        <span class="role"><?= esc($user['created_at']) ?></span>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>