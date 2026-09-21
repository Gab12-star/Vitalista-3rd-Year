<?= $this->include('partials/nav') ?>

<main class="dashboard">
    <header class="topbar">
        <div>
            <p class="eyebrow">OVERVIEW</p>
            <h1>POS Dashboard</h1>
        </div>

        <div class="profile">
            <span class="profile-circle">CV</span>
            <div>
                <strong>Carl Vitalista</strong>
                <small>Administrator</small>
            </div>
        </div>
    </header>

    <section class="welcome-banner">
        <div>
            <p class="eyebrow light">WELCOME BACK</p>
            <h2>Manage your POS accounts<br>in one place.</h2>
            <p>View customer records and staff user accounts using static PHP array data.</p>
        </div>

        <div class="banner-symbol">₱</div>
    </section>

    <section class="stat-grid">
        <a class="stat-card pink" href="<?= site_url('customers') ?>">
            <span class="stat-icon">♙</span>
            <div>
                <p>Customer Accounts</p>
                <h3>5 Records</h3>
                <small>View customer list →</small>
            </div>
        </a>

        <a class="stat-card purple" href="<?= site_url('users') ?>">
            <span class="stat-icon">♟</span>
            <div>
                <p>Staff Users</p>
                <h3>5 Records</h3>
                <small>View user list →</small>
            </div>
        </a>
    </section>

    <section class="dashboard-note">
        <span>✦</span>
        <p>
            This basic POS system is built with CodeIgniter 4.
            No database is used yet; records come from static PHP arrays.
        </p>
    </section>
</main>