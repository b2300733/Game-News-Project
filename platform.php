<?php
session_start();
include 'db.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Game Platform</title>
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
                    <li><a href="platform.php" class="active"><i class="fa-solid fa-layer-group"></i> Game Platform</a></li>
                    <li><a href="library.php"><i class="fa-solid fa-gamepad"></i> Game Library</a></li>
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


         <article class="platform-container">
            <section class="all-platform">
               <div class="platform">
                  <a href="https://store.steampowered.com/" title="Steam Website" target="_blank">
                  <img src="Image/steam.jpg" alt="Steam">
                  </a>
                  <a href="https://store.steampowered.com/" title="Steam Website" target="_blank">
                  <h1>Steam</h1>
                  </a>
                  <h3><i class="fa fa-thumbs-up">95%</i></h3>
               </div>

               <div class="platform">
                  <a href="https://store.epicgames.com/en-US/" title="Epic Games Website" target="_blank">
                  <img src="Image/epic.jpg" alt="Epic Games">
                  </a>
                  <a href="https://store.epicgames.com/en-US/" title="Epic Games Website" target="_blank">
                  <h1>Epic Games</h1>
                  </a>
                  <h3><i class="fa fa-thumbs-up">93%</i></h3>
               </div>

               <div class="platform">
                  <a href="https://www.riotgames.com/en" title="Riot Games Website" target="_blank">
                  <img src="Image/riot.jpg" alt="Steam">
                  </a>
                  <a href="https://www.riotgames.com/en" title="Riot Games Website" target="_blank">
                  <h1>Riot Games</h1>
                  </a>
                  <h3><i class="fa fa-thumbs-up">92%</i></h3>
               </div>
               <br>
               <div class="platform">
                  <a href="https://www.ubisoft.com/en-sg/" title="Ubisoft Website" target="_blank">
                  <img src="Image/ubisoft.jpg" alt="Ubisoft">
                  </a>
                  <a href="https://www.ubisoft.com/en-sg/" title="Ubisoft Website" target="_blank">
                  <h1>Ubisoft</h1>
                  </a>
                  <h3><i class="fa fa-thumbs-up">90%</i></h3>
               </div>

               <div class="platform">
                  <a href="https://us.shop.battle.net/en-us" title="BattleNet Website" target="_blank">
                  <img src="Image/battlenet.jpg" alt="Epic Games">
                  </a>
                  <a href="https://us.shop.battle.net/en-us" title="BattleNet Website" target="_blank">
                  <h1>BattleNet</h1>
                  </a>
                  <h3><i class="fa fa-thumbs-up">89%</i></h3>
               </div>

               <div class="platform">
                  <a href="https://www.ea.com/en-gb" title="Electronics Arts Website" target="_blank">
                  <img src="Image/ea.jpg" alt="Steam">
                  </a>
                  <a href="https://www.ea.com/en-gb" title="Electronics Arts Website" target="_blank">
                  <h1>Electronics Arts</h1>
                  </a>
                  <h3><i class="fa fa-thumbs-up">88%</i></h3>
               </div>
               <br>
            </section>
         </article>

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