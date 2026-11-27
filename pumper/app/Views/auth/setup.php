<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create First Staff Account | Pumper POS</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/pos.css') ?>">
</head>
<body class="auth-page">
    <main class="auth-card">
        <h1>Pumper</h1>
        <p class="subtitle">Staff Account</p>

        <?php if (isset($validation)): ?>
            <div class="message-error">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('setup') ?>" method="post">
            <?= csrf_field() ?>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" maxlength="50" required>

            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" maxlength="100" required>

            <label for="password">Password (at least 8 characters)</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <button type="submit">Create Staff Account</button>
        </form>
    </main>
</body>
</html>