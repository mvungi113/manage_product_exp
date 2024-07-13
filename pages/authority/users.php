<?php
session_start();
include_once '../../config/db_config.php';

// Pagination parameters
$usersPerPage = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $usersPerPage;

// Fetch users from the database excluding those with the admin role
$sql = "SELECT id, first_name, last_name, email, phone_number, gender, role, country, district, ward, region FROM users WHERE role != 'admin' AND role != 'authority'  LIMIT $offset, $usersPerPage";
$result = $conn->query($sql);

// Calculate total number of users
$totalUsers = $result->num_rows;

// Calculate total number of pages
$totalPages = ceil($totalUsers / $usersPerPage);

// Include the header
include_once '../../includes/header.php';
include_once './authority_header.php';
?>

<div class="container mt-5">
    <h2>Registered Users</h2>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Gender</th>
                <th>Role</th>
                <th>Country</th>
                <th>District</th>
                <th>Ward</th>
                <th>Region</th>
                <th>Action</th> <!-- Add Action column -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . strtoupper(htmlspecialchars($row['first_name'])) . "</td>";
                    echo "<td>" . strtoupper(htmlspecialchars($row['last_name'])) . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone_number'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo "<td>" . ($row['country'] ? htmlspecialchars($row['country']) : 'Null') . "</td>";
                    echo "<td>" . ($row['district'] ? htmlspecialchars($row['district']) : 'Null') . "</td>";
                    echo "<td>" . ($row['ward'] ? htmlspecialchars($row['ward']) : 'Null') . "</td>";
                    echo "<td>" . ($row['region'] ? htmlspecialchars($row['region']) : 'Null') . "</td>";
                    echo "<td>";
                    echo "<a href='edit_user.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>&nbsp;";
                    echo "<a href='delete_user.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='12'>No users found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php include_once '../../includes/footer.php' ?>
