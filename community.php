<?php
session_start();
include 'db.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Community</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        
    </head>
    
    <body>

      <!--nav bar-->

        <header>
            <a class="Home-Page-Title" href="index.php"><h2><span style="color: red;">Help</span>Gaming</h2></a>
            <nav class="navbar">
                <ul>
                    <li><a href="index.php"><i class="fa-solid fa-newspaper"></i> Latest News</a></li>
                    <li><a href="platform.php"><i class="fa-solid fa-layer-group"></i> Game Platform</a></li>
                    <li><a href="library.php"><i class="fa-solid fa-gamepad"></i> Game Library</a></li>
                    <li><a href="community.php" class="active"><i class="fa-solid fa-comments"></i> Community</a></li>
                </ul>
            </nav>
            <div class="nav__actions">
               <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                  <a href="admin.php"><i class="fa fa-id-badge" id="adminPage-btn"></i></a>
               <?php endif; ?>
               <i class="fa-solid fa-magnifying-glass nav__search" id="search-btn"></i>    
               <i class="fa-solid fa-user nav__login" id="login-btn"></i>
               <span id="user-email" class="user-email"></span>
               <form id="logout-form" action="logout2.php" method="POST" style="display: inline;">
                  <button type="submit" id="logout-btn" class="logout-btn">Logout</button>
              </form>
            </div>
        </header>
        <div class="search" id="search">
            <form action="#" id="search__form" class="search__form">
               <i class="fa-solid fa-magnifying-glass search__icon"></i>
               <input type="text" placeholder="Search HelpGaming Games" class="search__input" id="search-input">
               <button type="submit" id="searchButton" class="searchButton">Search</button>
            </form>
            <div id="resultsContainer" class="resultsContainer"></div>
   
            <i class="fa-solid fa-xmark search__close" id="search-close"></i>
         </div>

         <div class="login" id="login">
            <form action="login.php" id="login-form" class="login__form">
               <h2 class="login__title">Log In</h2>
               
               <div class="login__group">
                  <div>
                     <label for="email" class="login__label">Email</label>
                     <input type="email" name="email" placeholder="Enter email" id="login-email" class="login__input">
                 </div>
                  
                  <div>
                     <label for="password" class="login__label">Password</label>
                     <input type="password" name="password" placeholder="Enter password" id="login-password" class="login__input">
                  </div>
               </div>
   
               <div>
                  <p class="login__signup">
                     Not a member? <a class="signup__btnlink" id="login__signup">Sign up</a>
                  </p>
      
                  <a class="login__forgot" id="login__forgot">
                     Forgot password?
                  </a>
      
                  <button type="submit" id="login__button"  class="login__button">Log In</button>
               </div>
            </form>
            
            <i class="fa-solid fa-xmark login__close" id="login-close"></i>
         </div>

         <div class="signup" id="signup">
            <form action="signup.php" class="signup__form">
               <h2 class="signup__title">Sign Up</h2>
               
               <div class="signup__group">
                  <div>
                     <label for="email" class="signup__label">Email</label>
                     <input type="email" name="email" placeholder="Enter email" id="email" class="signup__input">
                  </div>
                  
                  <div>
                     <label for="password" class="signup__label">Password</label>
                     <input type="password" name="password" placeholder="Enter password" id="password" class="signup__input">
                  </div>
               </div>
   
               <div>
                  <p class="signup__login">
                     Already a member? <a class="lognin__btnlink" id="signup__login">Log In</a>
                  </p>
      
                  <button type="submit" id="signup__button" class="signup__button">Sign Up</button>
               </div>
            </form>
   
            <i class="fa-solid fa-xmark signup__close" id="signup-close"></i>
         </div>

         <div class="forgot" id="forgot">
            <form action="forgot.php" class="forgot__form">
               <h2 class="forgot__title">Reset Password</h2>
               
               <div class="forgot__group">
                  <div>
                     <label for="email" class="forgot__label">Email</label>
                     <input type="email" name="email" placeholder="Enter email" id="email" class="forgot__input">
                  </div>
                  
                  <div>
                     <label for="password" class="forgot__label">New Password</label>
                     <input type="password" name="password" placeholder="Enter new password" id="password" class="forgot__input">
                  </div>
               </div>   
               <div>    
                  <button type="submit" id="forgot__button" class="forgot__button">Change Password</button>
               </div>
            </form>
   
            <i class="fa-solid fa-xmark forgot__close" id="forgot-close"></i>
         </div>

      <!--main content-->

         <section class="subforum-container">
            <section class="subforum-header"><h2>General Discussions</h2>
            <?php

               $sql = "SELECT * FROM topics";
               $result = $conn->query($sql);

               if ($result->num_rows > 0) {
                  $index = 0;
                  while ($row = $result->fetch_assoc()) {
                     $class = $index % 2 == 0 ? 'even' : 'odd';
                     echo '<section class="subforum-row ' . $class . '">
                              <div class="subforum-icon subforum-column center ' . $class . '">
                                 <i class="fa-solid fa-comments center"></i>
                              </div>
                              <div class="subforum-description subforum-column ' . $class . '">
                                 <h4><a href="topic.php?id=' . $row["id"] . '">' . $row["title"] . '</a></h4>
                                 <p>' . $row["description"] . '</p>
                              </div>
                              <div class="subforum-stats subforum-column center ' . $class . '">
                                 <span>' . $row["posts_count"] . ' Posts</span>
                              </div>
                              <div class="subforum-info subforum-column ' . $class . '">
                                 <b><a href="topic.php?id=' . $row["id"] . '#last-post">Last post</a></b> by <a href="#">' . $row["last_post_user"] . '</a>
                                 <br>on <small>' . $row["last_post_date"] . '</small>
                              </div>
                           </section>';
                     $index++;
                  }
               } else {
                  echo "0 results";
               }
               $conn->close();
            ?>

            </section>
         </section>

         <!-- Add Topic Form Toggle Button -->
          <div class="btn-secondary-section">
            <button id="add-topic-button" class="btn btn-secondary">Add New Topic</button>
            </div>

         <!-- Add Topic Form -->
         <section class="add-topic-container">
            <h2>Add New Topic</h2>
            <form action="add_topic.php" method="post">
               <div class="form-group">
                     <label for="title">Title</label>
                     <input type="text" class="form-control" id="title" name="title" placeholder="Enter topic name here" required>
               </div>
               <div class="form-group">
                     <label for="description">Description</label>
                     <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description here" required></textarea>
               </div>
               <div class="form-group">
               <input type="hidden" name="email" value="<?php echo $email; ?>">
               <?php
               if (!isset($_SESSION['email'])) {
                  echo '<p>You need to <b>log in/enter correct email and password</b> first to add a topic.</p>';
               } else {
                  echo '<button class="btn btn-primary" onclick="window.location.href=\'add_topic.php\'">Add Topic</button>';
               }
               ?>
               
            </form>
         </section>

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