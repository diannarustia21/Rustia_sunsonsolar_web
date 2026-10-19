<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/css/sunson.css">
    <title>Technician Dashboard</title>
</head>

<body class="dashboard-page">
    <header class="dashboard-header">
        <strong>SUN SON SOLAR</strong>
        <span><?= esc(session('name')) ?></span>
        <a href="/logout">Logout</a>
    </header>

    <main class="dashboard-main">
        <h1>Technician Dashboard</h1>

        <?php if (session('message')): ?>
            <div class="notice"><?= esc(session('message')) ?></div>
        <?php endif; ?>

        <div class="panel">
            <h2>Announcements</h2>

            <?php foreach ($announcements as $a): ?>
                <div class="notice">
                    <strong><?= esc($a['title']) ?></strong><br>
                    <?= esc($a['message']) ?>
                </div>
            <?php endforeach; ?>

            <?php if (!$announcements): ?>
                <p>No announcements.</p>
            <?php endif; ?>
        </div>

        <h2>Assigned Jobs</h2>

        <?php foreach ($jobs as $j): ?>
            <div class="panel">
                <h3><?= esc($j['service_name']) ?> · <?= esc($j['preferred_date']) ?></h3>

                <p>
                    <strong>Customer:</strong> <?= esc($j['Firstname'] . ' ' . $j['Lastname']) ?><br>
                    <strong>Address:</strong> <?= esc($j['address']) ?><br>
                    <strong>Status:</strong> <?= esc($j['status']) ?>
                </p>

                <button onclick="technicianCheckIn(this, <?= $j['ID'] ?>)">📍 Check In at Site</button>

                <form method="post" action="/technician/reports/<?= $j['ID'] ?>">
                    <?= csrf_field() ?>
                    <textarea name="problem" placeholder="Problem encountered" required></textarea>
                    <textarea name="action_taken" placeholder="Action taken"></textarea>
                    <button>Submit Report to Admin</button>
                </form>
            </div>
        <?php endforeach; ?>

        <?php if (!$jobs): ?>
            <div class="panel">No assigned jobs.</div>
        <?php endif; ?>
    </main>

    <script src="/js/sunson.js"></script>
</body>

</html>
