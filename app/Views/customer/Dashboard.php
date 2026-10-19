<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/css/sunson.css">
    <title>Customer Dashboard</title>
</head>

<body class="dashboard-page">
    <header class="dashboard-header">
        <strong>SUN SON SOLAR</strong>
        <span><?= esc(session('name')) ?></span>
        <a href="/logout">Logout</a>
    </header>

    <main class="dashboard-main">
        <h1>Customer Dashboard</h1>

        <?php if (session('message')): ?>
            <div class="notice"><?= esc(session('message')) ?></div>
        <?php endif; ?>

        <?php if (session('error')): ?>
            <div class="server-message error"><?= esc(session('error')) ?></div>
        <?php endif; ?>

        <div class="dashboard-grid nav-cards">
            <div class="panel">
                <h3>Schedule a Service</h3>

                <form method="post" action="/customer/bookings">
                    <?= csrf_field() ?>

                    <select name="service_id" required>
                        <?php foreach ($services as $s): ?>
                            <option value="<?= $s['ID'] ?>">
                                <?= esc($s['name']) ?> - ₱<?= number_format($s['price'], 2) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <input type="date" name="preferred_date" required>
                    <input name="address" value="<?= esc($user['Address']) ?>" placeholder="Service address" required>
                    <textarea name="notes" placeholder="Notes"></textarea>
                    <button>Request Service</button>
                </form>
            </div>

            <div class="panel">
                <h3>Notifications</h3>

                <?php foreach ($notifications as $n): ?>
                    <p>
                        <strong><?= esc($n['title']) ?></strong><br>
                        <?= esc($n['message']) ?>
                    </p>
                <?php endforeach; ?>

                <?php if (!$notifications): ?>
                    <p>No notifications.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="panel">
            <h2>My Schedule</h2>

            <div class="table-wrap">
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>

                    <?php foreach ($bookings as $b): ?>
                        <tr>
                            <td><?= esc($b['preferred_date']) ?></td>
                            <td><?= esc($b['status']) ?></td>
                            <td><?= esc($b['address']) ?></td>
                            <td>
                                <?php if ($b['status'] === 'Pending'): ?>
                                    <form class="inline-form" method="post" action="/customer/bookings/cancel/<?= $b['ID'] ?>">
                                        <?= csrf_field() ?>
                                        <button class="danger">Cancel</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="panel">
                <h3>Profile</h3>

                <form method="post" action="/customer/profile">
                    <?= csrf_field() ?>
                    <input name="Firstname" value="<?= esc($user['Firstname']) ?>">
                    <input name="Lastname" value="<?= esc($user['Lastname']) ?>">
                    <input name="Phonenumber" value="<?= esc($user['Phonenumber']) ?>">
                    <input name="Address" value="<?= esc($user['Address']) ?>">
                    <button>Update Profile</button>
                </form>

                <h3>Change Password</h3>

                <form method="post" action="/customer/password">
                    <?= csrf_field() ?>
                    <input type="password" name="current_password" placeholder="Current password">
                    <input type="password" name="new_password" placeholder="New password">
                    <button>Change Password</button>
                </form>
            </div>

            <div class="panel">
                <h3>History, Payments & Receipts</h3>

                <?php foreach ($payments as $p): ?>
                    <p>
                        Receipt <?= esc($p['receipt_number']) ?> · ₱<?= number_format($p['amount'], 2) ?> · <?= esc($p['status']) ?>
                    </p>
                <?php endforeach; ?>

                <?php if (!$payments): ?>
                    <p>No payment records yet.</p>
                <?php endif; ?>
            </div>

            <div class="panel">
                <h3>Support / Help</h3>

                <form method="post" action="/customer/tickets">
                    <?= csrf_field() ?>
                    <input name="subject" placeholder="Subject" required>
                    <textarea name="message" placeholder="Describe the concern" required></textarea>
                    <button>Submit Ticket</button>
                </form>

                <?php foreach ($tickets as $t): ?>
                    <p>
                        <strong><?= esc($t['subject']) ?></strong> · <?= esc($t['status']) ?>
                    </p>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <script src="/js/sunson.js"></script>
</body>

</html>
