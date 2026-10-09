<!DOCTYPE html>
<html>
<head>
    <title>All Tasks</title>
</head>
<body>

    <h1>All Tasks</h1>

    <?php if (empty($tasks)): ?>
        <p>No tasks for today.</p>
    <?php else: ?>

        <?php foreach ($tasks as $task): ?>
            <div>
                <h3><?= esc($task['title']) ?></h3>
                <p>Status: <?= esc($task['status']) ?></p>
                <p>Date: <?= esc($task['task_date']) ?></p>
            </div>
            <hr>
        <?php endforeach; ?>

    <?php endif; ?>

</body>
</html>