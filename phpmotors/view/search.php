<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen">
        <title>PHP Motors</title>
    </head>
    <body>
        <img id="main-background" src="../images/site/small_check.jpg" alt="square background">
        <div class="container">
            <header>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
            </header>
            <nav>
                <?php echo $navList; ?>
            </nav>
            <main class="mainClass">
                <h1>Search</h1>
                <?php if(isset($message)){
                    echo $message;
                }  ?>
                <form action="/phpmotors/search/" method="post">
                    <label for="searchString" class="formLabel">What are you looking for today?<input id="searchString" type="text" name="searchString" required></label>
                    <input class="formButton" type="submit" name="SearchButton" value="Search">
                    <input type="hidden" name="action" value="search">
                </form>
                <h1>Returned <?php if(isset($resultsCount)){echo $resultsCount;}?> results for: <?php if(isset($resultsCount)){echo $searchString;}?></h1>
                
                <?php if(isset($displayResults)){
                    echo $displayResults;
                }
                ?>
                <?php if(isset($paginationBar)){
                    echo $paginationBar;
                }
                ?>
            </main>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
        <script src="/phpmotors/scripts/script.js"></script>
    </body>
</html>