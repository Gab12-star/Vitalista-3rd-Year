<!DOCTYPE html>
<html>
<head>
    <title>User Accounts</title>
</head>
<body>

<h1>User Accounts</h1>

<nav>
    /Vitalista-3rd-Year/tfa1/public/Home</a> |
    /Vitalista-3rd-Year/tfa1/public/aboutAbout</a> |
    /Vitalista-3rd-Year/tfa1/public/customersCustomers</a> |
    /Vitalista-3rd-Year/tfa1/public/usersUsers</a>
</nav>

<hr>

<table border="1" cellpadding="8">
    <tr>
        <th>Username</th>
        <th>Full Name</th>
        <th>Role</th>
    </tr>

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user['username']; ?></td>
        <td><?= $user['fullname']; ?></td>
        <td><?= $user['role']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>