<?php helper(['form', 'security']); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/pos.css') ?>">
</head>
<body class="login-page">
    <main class="login-layout">
        <section class="login-brand-panel">
            <div class="login-brand">
                <div class="login-brand-mark">P</div>
                <span>Pumper</span>
            </div>

            <div class="login-brand-copy">
                <p class="login-eyebrow">CONSTRUCTION SAFETY GEAR POS</p>
<h1>Safety essentials, managed in one place.</h1>
<p>
    Track safety gear, inventory, customers, and sales for your construction supply store.
</p>
            </div>

            <div class="login-brand-footer">
                <span class="login-status-dot"></span>
                Staff access portal
            </div>
        </section>

        <section class="login-form-panel">
            <div class="login-card">
                <p class="login-eyebrow login-eyebrow-teal">STAFF PORTAL</p>
                <h2>Welcome back</h2>
                <p class="login-description">
                    Sign in with your staff account to continue.
                </p>

                <?php if (isset($error)): ?>
                    <div class="message-error"><?= esc($error) ?></div>
                <?php endif; ?>

                <?php if ($message = session()->getFlashdata('success')): ?>
                    <div class="message-success"><?= esc($message) ?></div>
                <?php endif; ?>

                <?php if ($message = session()->getFlashdata('error')): ?>
                    <div class="message-error"><?= esc($message) ?></div>
                <?php endif; ?>

                <form action="<?= site_url('login') ?>" method="post">
                    <?= csrf_field() ?>

                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        autocomplete="username"
                        placeholder="Enter your username"
                        required
                    >

                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        autocomplete="current-password"
                        placeholder="Enter your password"
                        required
                    >

                    <button class="login-submit" type="submit">
                        Sign In
                        <span aria-hidden="true">→</span>
                    </button>
                </form>

                <p class="login-note">Authorized staff access only.</p>
            </div>
        </section>
    </main>
</body>
</html>