<!DOCTYPE html>
<html>
<head>
    <title>Customer Accounts</title>
</head>
<body>

<h1>Customer Accounts</h1>

<nav>
    /Vitalista-3rd-Year/tfa1/public/Home</a> |
    /Vitalista-3rd-Year/tfa1/public/aboutAbout</a> |
    /Vitalista-3rd-Year/tfa1/public/customersCustomers</a> |
    /Vitalista-3rd-Year/tfa1/public/usersUsers</a>
</nav>

<hr>

<table border="1" cellpadding="8">
    <tr>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>

    <?php foreach ($customers as $customer): ?>
    <tr>
        <td><?= $customer['fullname']; ?></td>
        <td><?= $customer['email']; ?></td>
        <td><?= $customer['phone']; ?></td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>