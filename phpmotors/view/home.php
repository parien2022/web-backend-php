<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css\style.css" type="text/css" rel="stylesheet" media="screen">
        <title>PHP Motors</title>
    </head>
    <body>
        <img id="main-background" src="images/site/small_check.jpg" alt="square background">
        <div class="container">
            <header>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
            </header>
            <nav>
                <?php echo $navList; ?>
            </nav>
            <main>
                <h1 class="title">Welcome to PHP Motors!</h1>
                <div class="car-div">
                    <div class="car-details">
                        <h3>DMC Delorean</h3>
                        <p>3 Cup holders <br>Superman doors <br>Fuzzy dice</p>
                        <div class="own-today-div">
                            <img id="own-today" src="images/site/own_today.png" alt="own today">
                        </div>
                    </div>
                    <img id="car" src="/phpmotors/images/vehicles/1982-dmc-delorean.jpg" alt="car">
                    
                </div>

                <div class="wrapper">
                    <div class="reviews">
                        <h3>DMC Delorean Reviews</h3>
                        <ul class="reviews-ul">
                            <li>"So fast its almost like traveling in time." (4/5)</li>
                            <li>"Coolest ride on the road." (4/5)</li>
                            <li>"I'm feeling Marty McFly!" (5/5)</li>
                            <li>"The most futuristic ride of our day." (4. 5/5)</li>
                            <li>"80's livin and I love it!" (5/5)</li>
                        </ul>
                    </div>
                    <div class="upgrades">
                        <h3 class="upgrades-title">Delorean Upgrades</h3>
                        <div class="img-1-div">
                        <img id="flux" src="images/upgrades/flux-cap.png" alt="flux capacitator">
                        </div>
                        <a id="flux-text" href="#">Flux capacitator</a>
                        <div class="img-2-div">
                        <img id="flame" src="images/upgrades/flame.jpg" alt="flame decals">
                        </div>
                        <a id="flame-text" href="#">Flame decals</a>
                        <div class="img-3-div">
                        <img id="bumper" src="images/upgrades/bumper_sticker.jpg" alt="bumper stickers">
                        </div>
                        <a id="bumper-text" href="#">Bumper stickers</a>
                        <div class="img-4-div">
                        <img id="hub" src="images/upgrades/hub-cap.jpg" alt="hub caps">
                        </div>
                        <a id="hub-text" href="#">Hub caps</a>
                    </div>
                </div>
                
            </main>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
        <script src="/phpmotors/scripts/script.js"></script>
    </body>
</html>