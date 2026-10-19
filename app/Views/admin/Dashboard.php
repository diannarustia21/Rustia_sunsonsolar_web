<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/css/sunson.css">
    <title>Admin Dashboard</title>
</head>

<body class="dashboard-page">
    <header class="dashboard-header">
        <strong>SUN SON SOLAR</strong>
        <span><?= esc(session('name')) ?></span>
        <a href="/logout">Logout</a>
    </header>

    <main class="dashboard-main">
        <h1>Admin / HR / Dispatcher Dashboard</h1>

        <?php if (session('message')): ?>
            <div class="notice"><?= esc(session('message')) ?></div>
        <?php endif; ?>

        <div class="dashboard-grid">
            <div class="panel">
                <div class="stat"><?= $stats['customers'] ?></div>
                <p>Customers</p>
            </div>
            <div class="panel">
                <div class="stat"><?= $stats['employees'] ?></div>
                <p>Employees</p>
            </div>
            <div class="panel">
                <div class="stat"><?= $stats['bookings'] ?></div>
                <p>Bookings</p>
            </div>
            <div class="panel">
                <div class="stat">₱<?= number_format($stats['revenue'], 2) ?></div>
                <p>Revenue</p>
            </div>
        </div>

        <div class="panel">
            <h2>Create Employee Account</h2>

            <form method="post" action="/admin/users/create">
                <?= csrf_field() ?>

                <div class="dashboard-grid">
                    <input name="Firstname" placeholder="First name" required>
                    <input name="Lastname" placeholder="Last name" required>
                    <input name="Middlename" placeholder="Middle name">
                    <input type="date" name="Birthdate" required>
                    <select name="Gender">
                        <option>Male</option>
                        <option>Female</option>
                        <option>Other</option>
                    </select>
                    <input name="Phonenumber" placeholder="Phone" required>
                    <input type="email" name="Email" placeholder="Email" required>
                    <input name="Address" placeholder="Address">
                    <select name="Departments">
                        <option>Administration</option>
                        <option>IT</option>
                        <option>Dispatch</option>
                        <option>Accounting</option>
                        <option>HR</option>
                        <option>Marketing</option>
                        <option>Sales</option>
                        <option>Customer Service</option>
                    </select>
                    <select name="Role">
                        <option>Admin</option>
                        <option>HR</option>
                        <option>Dispatcher</option>
                        <option>Technician</option>
                    </select>
                    <input name="Username" placeholder="Username" required>
                    <input type="password" name="Password" placeholder="Temporary password" required>
                </div>

                <button>Create Account</button>
            </form>
        </div>

        <div class="panel">
            <h2>User Management</h2>

            <div class="table-wrap">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr>

                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?= esc($u['Firstname'] . ' ' . $u['Lastname']) ?></td>
                            <td><?= esc($u['Role']) ?></td>
                            <td><?= esc($u['Departments'] ?? '') ?></td>
                            <td><?= esc($u['Status']) ?></td>
                            <td>
                                <form method="post" action="/admin/users/status/<?= $u['ID'] ?>">
                                    <?= csrf_field() ?>
                                    <select name="Status">
                                        <option>Active</option>
                                        <option>Inactive</option>
                                    </select>
                                    <button>Save</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>

        <div class="panel">
            <h2>Schedule Overview & Technician Assignment</h2>

            <?php foreach ($bookings as $b): ?>
                <div class="notice">
                    <strong><?= esc($b['Firstname'] . ' ' . $b['Lastname']) ?></strong>
                    · <?= esc($b['service_name']) ?>
                    · <?= esc($b['preferred_date']) ?>
                    · <?= esc($b['status']) ?>

                    <form method="post" action="/admin/bookings/<?= $b['ID'] ?>">
                        <?= csrf_field() ?>
                        <select name="status">
                            <option>Approved</option>
                            <option>Declined</option>
                            <option>Scheduled</option>
                            <option>Completed</option>
                        </select>
                        <select name="technician_id">
                            <option value="">Unassigned</option>
                            <?php foreach ($technicians as $t): ?>
                                <option value="<?= $t['ID'] ?>"><?= esc($t['Firstname'] . ' ' . $t['Lastname']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input name="admin_notes" placeholder="Schedule notes">
                        <button>Update</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="dashboard-grid">
            <div class="panel">
                <h3>Notifications Control</h3>

                <form method="post" action="/admin/notifications">
                    <?= csrf_field() ?>
                    <select name="audience">
                        <option>All</option>
                        <option>Customer</option>
                        <option>Technician</option>
                    </select>
                    <select name="type">
                        <option>Reminder</option>
                        <option>Promotion</option>
                        <option>System Update</option>
                    </select>
                    <input name="title" placeholder="Title">
                    <textarea name="message" placeholder="Message"></textarea>
                    <button>Send</button>
                </form>
            </div>

            <div class="panel">
                <h3>Service Settings</h3>

                <form method="post" action="/admin/services">
                    <?= csrf_field() ?>
                    <input name="name" placeholder="Service category">
                    <input name="description" placeholder="Description">
                    <input type="number" step="0.01" name="price" placeholder="Price">
                    <label>
                        <input type="checkbox" name="is_active" value="1" checked> Available
                    </label>
                    <button>Save Service</button>
                </form>
            </div>

            <div class="panel">
                <h3>Employee Announcement</h3>

                <form method="post" action="/admin/announcements">
                    <?= csrf_field() ?>
                    <select name="audience">
                        <option>All</option>
                        <option>Technician</option>
                    </select>
                    <input name="title" placeholder="Title">
                    <textarea name="message" placeholder="Safety guideline, reminder, or urgent notice"></textarea>
                    <button>Post</button>
                </form>
            </div>
        </div>

        <div class="panel">
            <h2>Support Tickets & Technician Reports</h2>

            <?php foreach ($tickets as $t): ?>
                <p>Ticket #<?= $t['ID'] ?> · <?= esc($t['subject']) ?> · <?= esc($t['status']) ?></p>
            <?php endforeach; ?>

            <?php foreach ($reports as $r): ?>
                <p>Report #<?= $r['ID'] ?> · <?= esc($r['problem']) ?> · <?= esc($r['status']) ?></p>
            <?php endforeach; ?>
        </div>
    </main>

    <script src="/js/sunson.js"></script>
</body>

</html>
