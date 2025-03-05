<?php
session_start();
include 'db.php';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Help Gaming</title>
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
                    <li><a href="index.php" class="active"><i class="fa-solid fa-newspaper"></i> Latest News</a></li>
                    <li><a href="platform.php"><i class="fa-solid fa-layer-group"></i> Game Platform</a></li>
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

         <div class="top-header-index">
            <h1>Latest News</h1>
         </div>

         <article class="article-container">
            <section class="main-news">

               <section class="news">
                  <a href="https://www.gameinformer.com/review/destiny-2-the-final-shape/for-the-guardians" target="_blank"><img src="image/destiny 2 final shape review.webp" alt="destiny 2 final shape review picture" class="news-picture" width="300px"></a>
                  <a href="https://www.gameinformer.com/review/destiny-2-the-final-shape/for-the-guardians" target="_blank"><h3>Destiny 2: The Final Shape Review</h3></a>
                  <p>After ten years of storytelling, Bungie wraps up its long-running storyline with an exhilarating and poignant concluding act and sets the stage for what's next.</p>
                  <p1>By <i>Jing Liang</i> <span>on Jun 17, 2024</span></p1>
               </section>
               <br>
               <section class="news">
                  <a href="https://gamerant.com/steam-summer-sale-starts-next-week/" target="_blank"><img src="image/steam summer sale.webp" alt="Steam Summer Sale picture" class="news-picture" width="300px"></a>
                  <a href="https://gamerant.com/steam-summer-sale-starts-next-week/" target="_blank"><h3>Steam Summer Sale Starts Next Week</h3></a>                  
                  <p>The Steam Summer Sales are an absolute blast for PC gamers, containing tons of discounts, and it looks like this year's will be starting soon.</p>
                  <br>
                  <p1>By <i>Qi Yan</i> <span>on Jun 17, 2024</span></p1>
               </section>
               <br>
               <section class="news">
                  <a href="https://gamerant.com/banana-free-to-play-game-steam-player-count-blowing-up/" target="_blank"><img src="image/steam pic.png" alt="steam picture" class="news-picture" width="300px"></a>
                  <a href="https://gamerant.com/banana-free-to-play-game-steam-player-count-blowing-up/" target="_blank"><h3>Strange Free-to-Play Game is Blowing Up on Steam</h3></a>
                  <p>A recent free-to-play title continues attracting new players on Steam, reaching an incredible player count milestone on the platform.</p>
                  <p1>By <i>Qi Yan</i> <span>on Jun 16, 2024</span></p1>
               </section>
               <br>
               <section class="news">
                  <a href="https://gamerant.com/once-human-aaa-influences-days-gone-remnant-ghostwire/" target="_blank"><img src="image/once human pic.png" alt="once human picture" class="news-picture" width="300px"></a>
                  <a href="https://gamerant.com/once-human-aaa-influences-days-gone-remnant-ghostwire/" target="_blank"><h3>Once Human is a Melting Pot of AAA Influences</h3></a>
                  <p>Upcoming survival role-playing game Once Human seems to borrow a lot of ideas from the broader AAA gaming space, for better or worse.</p>
                  <p1>By <i>Jing Liang</i> <span>on Jun 16, 2024</span></p1>
               </section>
               <br>
               <section class="news">
                  <a href="https://gamerant.com/video/when-does-cod-call-of-duty-black-ops-6-bo6-take-place-in-the-timeline/" target="_blank"><img src="image/BO6_LP-meta_image.jpg" alt="black ops 6 picture" class="news-picture" width="300px"></a>
                  <a href="https://gamerant.com/video/when-does-cod-call-of-duty-black-ops-6-bo6-take-place-in-the-timeline/" target="_blank"><h3>When Does Call of Duty: Black Ops 6 Take Place In The Timeline?</h3></a>
                  <p>Now that official details on the Call of Duty: Black Ops 6 campaign are available, we know exactly where it falls in the series' timeline.</p>
                  <p1>By <i>Jing Liang</i> <span>on Jun 15, 2024</span></p1>
               </section>
               <br>
               <section class="news">
                  <a href="https://gamerant.com/fallout-1-2-remake-port-todd-howard-bethesda/" target="_blank"><img src="image/Fallout news pic.png" alt="fallout picture" class="news-picture" width="300px"></a>
                  <a href="https://gamerant.com/fallout-1-2-remake-port-todd-howard-bethesda/" target="_blank"><h3>Todd Howard Has Bad News for Fallout 1 and 2 Fans</h3></a>
                  <p>Bethesda Game Studios director Todd Howard has some bad news to share for fans of the original, Interplay-published Fallout games.</p>
                  <p1>By <i>Qi Yan</i> <span>on Jun 15, 2024</span></p1>
               </section>
               <br>
               <section class="news">
                  <a href="https://gamerant.com/final-fantasy-14-director-yoshi-p-switch-2-port-comments/" target="_blank"><img src="image/Final Fantasy 14 switch 2 port.png" alt="final fantasy 14 picture" class="news-picture" width="300px"></a>
                  <a href="https://gamerant.com/final-fantasy-14-director-yoshi-p-switch-2-port-comments/" target="_blank"><h3>Final Fantasy 14 Director Addresses Possibility of Switch 2 Port</h3></a>
                  <p>The director of the massively popular MMORPG has wanted to bring the game to a Nintendo platform for years, and the chance may finally arise.</p>
                  <p1>By <i>Jing Liang</i> <span>on Jun 15, 2024</span></p1>
               </section>
               <br>
               <section class="show-more-btn-section">
                  <a class="show-more-btn">Coming Soon</a>
              </section>
            </section>

            <section class="sidebar">
               <div class="sidebar-header">
                  <h2>Trending</h2>
               </div>    
               <section class="sidebar-news-section">
                  <div class="sidebar-news">
                     <a href="https://sea.ign.com/star-citizen/217077/news/star-citizen-exploit-crackdown-leads-to-over-600-account-bans" target="_blank"><img src="image/star citizen.png" alt="star citizen picture" class="news-picture" width="130px"></a>
                     <a href="https://sea.ign.com/star-citizen/217077/news/star-citizen-exploit-crackdown-leads-to-over-600-account-bans" target="_blank"><h3>Star Citizen Exploit Crackdown Leads to Over 600 Account Bans</h3></a>
                  </div>
                  
                  <div class="sidebar-news">
                     <a href="https://sea.ign.com/shovel-knight/217082/news/the-original-shovel-knight-is-getting-an-enhanced-edition-in-shovel-knight-shovel-of-hope-dx" target="_blank"><img src="image/shovel-knight-shovel-of-hope-dx.png" alt="shovel knight picture" class="news-picture" width="130px"></a>
                     <a href="https://sea.ign.com/shovel-knight/217082/news/the-original-shovel-knight-is-getting-an-enhanced-edition-in-shovel-knight-shovel-of-hope-dx" target="_blank"><h3>The Original Shovel Knight Is Getting an Enhanced Edition: Shovel of Hope DX</h3></a>
                  </div>
                  
                  <div class="sidebar-news">
                     <a href="https://sea.ign.com/the-walking-dead/217067/news/seven-who-played-dog-on-the-walking-dead-has-died" target="_blank"><img src="image/walking-dead-dogs-death.jpg" alt="seven the dog picture" class="news-picture" width="130px"></a>
                     <a href="https://sea.ign.com/the-walking-dead/217067/news/seven-who-played-dog-on-the-walking-dead-has-died" target="_blank"><h3>Seven, Who Played Dog on The Walking Dead, Has Died</h3></a>
                  </div>
                  
                  <div class="sidebar-news">
                     <a href="https://sea.ign.com/playstation-5-1/217042/news/ps5-owners-will-soon-be-able-to-join-discord-calls-directly-from-their-console" target="_blank"><img src="image/discord-ps5.png" alt="discord picture" class="news-picture" width="130px"></a>
                     <a href="https://sea.ign.com/playstation-5-1/217042/news/ps5-owners-will-soon-be-able-to-join-discord-calls-directly-from-their-console" target="_blank"><h3>PS5 Owners Will Soon Be Able to Join Discord Calls Directly From Their Console</h3></a>
                  </div>
               </section>
            </section>

         </article>

      <!--footer-->

         <div class="space-index"></div>

         <footer class="footer">

            <p>&copy; 2023 Help Gaming. All rights reserved.</p>
          
         </footer>


         <!--java script-->

         <script src="main.js"></script>
    </body>

</html>