<?php
session_start();

// Include database connection
include 'db.php';

// Check if user is not logged in or not admin
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header('Location: community.php'); // Redirect to community page if not admin
    exit();
}

// Fetch data for the dashboard
$today = date('Y-m-d');
$todays_posts_query = "SELECT COUNT(*) AS count FROM posts WHERE DATE(post_date) = '$today'";
$todays_posts_result = mysqli_query($conn, $todays_posts_query);

if (!$todays_posts_result) {
    die("Query Failed: " . mysqli_error($conn));
}

$todays_posts = mysqli_fetch_assoc($todays_posts_result)['count'];

$total_posts_query = "SELECT COUNT(*) AS count FROM posts";
$total_posts_result = mysqli_query($conn, $total_posts_query);

if (!$total_posts_result) {
    die("Query Failed: " . mysqli_error($conn));
}

$total_posts = mysqli_fetch_assoc($total_posts_result)['count'];

$total_topics_query = "SELECT COUNT(*) AS count FROM topics";
$total_topics_result = mysqli_query($conn, $total_topics_query);

if (!$total_topics_result) {
    die("Query Failed: " . mysqli_error($conn));
}

$total_topics = mysqli_fetch_assoc($total_topics_result)['count'];

// Fetch total unique logins
$total_loggedin_query = "SELECT COUNT(*) AS count FROM user_logins";
$total_loggedin_result = mysqli_query($conn, $total_loggedin_query);

if (!$total_loggedin_result) {
    die("Query Failed: " . mysqli_error($conn));
}

$total_loggedin = mysqli_fetch_assoc($total_loggedin_result)['count'];

// Fetch recent posts
$recent_posts_query = "SELECT id, user, content, post_date FROM posts ORDER BY post_date DESC LIMIT 10";
$recent_posts_result = mysqli_query($conn, $recent_posts_query);

if (!$recent_posts_result) {
    die("Query Failed: " . mysqli_error($conn));
}

// Fetch user login times
$login_times_query = "SELECT users.email, user_logins.login_time FROM user_logins JOIN users ON user_logins.user_id = users.id ORDER BY user_logins.login_time DESC LIMIT 10";
$login_times_result = mysqli_query($conn, $login_times_query);

if (!$login_times_result) {
    die("Query Failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <a class="Home-Page-Title" href="admin.php"><h2>Dashboard</h2></a>
            <nav class="adminNavbar">
                <ul>
                    <li><a href="index.php"><i class="fa fa-home"></i> Home Page</a></li>
                    <li><a href="community.php"><i class="fa-solid fa-comments"></i> Community</a></li>
                    <!-- Add more admin functionalities as needed -->
                </ul>
            </nav>
            <div class="nav__actions">
               <i class="fa-solid fa-user nav__login" id="login-btn"></i>
               <span id="user-email" class="user-email"></span>
               <form id="logout-form" action="logout2.php" method="POST" style="display: inline;">
                  <button type="submit" id="logout-btn" class="logout-btn">Logout</button>
              </form>
            </div>
        </header>

        <main class="main-container">
            <section class="admin_panel">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Today's Posts</h5>
                                    <p class="card-text">
                                        <i class="fas fa-comments fa-2x"></i>
                                    </p>
                                    <p class="card-text"><?php echo $todays_posts; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Total Posts</h5>
                                    <p class="card-text">
                                        <i class="fas fa-comments fa-2x"></i>
                                    </p>
                                    <p class="card-text"><?php echo $total_posts; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Total Topics</h5>
                                    <p class="card-text">
                                        <i class="fas fa-file-alt fa-2x"></i>
                                    </p>
                                    <p class="card-text"><?php echo $total_topics; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Total Logged in</h5>
                                    <p class="card-text">
                                        <i class="fas fa-file-alt fa-2x"></i>
                                    </p>
                                    <p class="card-text"><?php echo $total_loggedin; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="posts_section">
                <div class="container mt-4">
                    <h2>Total Posts</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Content</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($recent_posts_result)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['user']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['content']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['post_date']) . "</td>";
                                echo "<td>";
                                echo "<a href='edit_post.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a> ";
                                echo "<a href='delete_post.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="login_times_section">
                <div class="container mt-4">
                    <h2>Recent User Login Times</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User Email</th>
                                <th>Login Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($login_times_result)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['login_time']) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>

        <!--footer-->

        <div class="footer-main-content">
         <!-- Your main content -->
         </div>

         <footer class="footer-community">

            <p>&copy; 2023 Help Gaming. All rights reserved.</p>
         
         </footer>

        <!--java script-->
        <script src="main.js"></script>
    </body>
</html>
