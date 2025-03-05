<?php
session_start();

if (isset($_GET['query'])) {
    $query = urlencode($_GET['query']);
    $apiKey = '99973af7a6cb44f1a606bbb5193f27c5';  // Replace with your RAWG API key
    $apiUrl = "https://api.rawg.io/api/games?key=$apiKey&search=$query";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo json_encode(['error' => curl_error($ch)]);
    } else {
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code !== 200) {
            echo json_encode(['error' => 'API request failed with response code ' . $http_code]);
        } else {
            header('Content-Type: application/json');
            echo $response;
        }
    }

    curl_close($ch);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Game Library</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        
    </head>
    
    <body class="librarybody">

      <!--nav bar-->
      
        <header>
            <a class="Home-Page-Title" href="index.php"><h2><span style="color: red;"">Help</span>Gaming</h2></a>
            <nav class="navbar">
                <ul>
                    <li><a href="index.php"><i class="fa-solid fa-newspaper"></i> Latest News</a></li>
                    <li><a href="platform.php"><i class="fa-solid fa-layer-group"></i> Game Platform</a></li>
                    <li><a href="library.php" class="active"><i class="fa-solid fa-gamepad"></i> Game Library</a></li>
                    <li><a href="community.php"><i class="fa-solid fa-comments"></i> Community</a></li>
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
        <div class="gamelibrary-container">
         <div class="order-by">
            <label for="order-select">Order by:</label>
            <select id="order-select">
                <option value="popularity">Popularity</option>
                <option value="rating">Rating</option>
                <option value="released">Released</option>
            </select>
        </div>

        <br>

            <div id="game-list" class="game-list">
                <!-- Games will be dynamically added here -->
            </div>

            <br>
            <div class="show-more-btn-section">
            <button id="show-more-btn" class="show-more-btn">Show More</button>
            </div>
        </div>

      <!--footer-->

      <div class="space-index"></div>

      <footer class="footer">

         <p>&copy; 2023 Help Gaming. All rights reserved.</p>
       
      </footer>


      <!--java script-->  

         <script src="main.js"></script>
    </body>


</html>