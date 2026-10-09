<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>

    <h1>Demo User Profile</h1>

    <?php if (!empty($user)): ?>

        <p>
            <strong>Username:</strong>
            <?= esc($user['username']) ?>
        </p>

        <p>
            <strong>Full Name:</strong>
            <?= esc($user['full_name']) ?>
        </p>

        <p>
            <strong>Email:</strong>
            <?= esc($user['email']) ?>
        </p>

        <p>
            <strong>Created At:</strong>
            <?= esc($user['created_at']) ?>
        </p>

    <?php else: ?>

        <p>No user found.</p>

    <?php endif; ?>

</body>
</html>