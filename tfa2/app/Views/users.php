<?= $this->include('partials/nav') ?>

<main class="dashboard">
    <header class="topbar">
        <div>
            <p class="eyebrow">STAFF DIRECTORY</p>
            <h1>User Accounts</h1>
            <p class="subtext">System users and staff roles from static PHP array data.</p>
        </div>

        <div class="record-count">5 Users</div>
    </header>

    <section class="list-panel">
        <div class="panel-heading">
            <h2>Staff User List</h2>
            <span>Username · Full Name · Role</span>
        </div>

        <div class="customer-list">
            <?php foreach ($users as $user): ?>
                <article class="person-row">
                    <div class="avatar user-avatar">
                        <?= esc(strtoupper(substr($user['name'], 0, 1))) ?>
                    </div>

                    <div class="person-name">
                        <strong><?= esc($user['name']) ?></strong>
                        <small>@<?= esc($user['username']) ?></small>
                    </div>

                    <div class="person-detail">
                        <small>Username</small>
                        <span><?= esc($user['username']) ?></span>
                    </div>

                    <div class="person-detail">
                        <small>System Role</small>
                        <span class="role"><?= esc($user['role']) ?></span>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>