<link rel="stylesheet" href="<?= base_url('public/style.css') ?>">

<aside class="sidebar">
    <a class="logo" href="<?= site_url('/') ?>">
        <span class="logo-icon">P</span>
        <span>Pointify POS</span>
    </a>

    <p class="menu-label">MAIN MENU</p>

    <nav class="side-nav">
        <a href="<?= site_url('/') ?>">⌂ <span>Dashboard</span></a>
        <a href="<?= site_url('about') ?>">ⓘ <span>About System</span></a>
    </nav>

    <p class="menu-label">ACCOUNTS</p>

    <nav class="side-nav">
        <a href="<?= site_url('customers') ?>">♙ <span>Customers</span></a>
        <a href="<?= site_url('users') ?>">♟ <span>Staff Users</span></a>
    </nav>

    <div class="sidebar-footer">
        CodeIgniter 4<br>
        POS Laboratory Activity
    </div>
</aside>