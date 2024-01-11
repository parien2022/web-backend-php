<?php
if(isset($_SESSION['message'])){
    $message = $_SESSION['message'];
}
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen">
        <title>Image Management</title>
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
                <h1>Image Management</h1>

                <h2>Add New Vehicle Image</h2>
                <?php
                if (isset($message)) {
                echo $message;
                } ?>

                <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">

                    <label for="invItem">Vehicle</label>
                    <?php echo $prodSelect; ?>

                    <fieldset class=fieldset-upload-img>
                        <label>Is this the main image for the vehicle?</label>
                        <label for="priYes" class="formLabel">Yes<input type="radio" name="imgPrimary" id="priYes" class="input-radio" value="1"></label>
                        <label for="priNo" class="formLabel">No<input type="radio" name="imgPrimary" id="priNo" class="input-radio" checked value="0"></label>  
                    </fieldset>

                    <label class="formLabel">Upload Image:</label>
                    <input type="file" class="formButton" name="file1">
                    <input type="submit" class="formButton" value="Upload">
                    <input type="hidden" name="action" value="upload">

                </form>
                <h2>Existing images</h2>
                <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
                <?php if(isset($imageDisplay)){
                    echo $imageDisplay;
                } ?>
            </main>
            <footer>
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
            </footer>
        </div>
        <script src="/phpmotors/scripts/script.js"></script>
    </body>
</html>
<?php unset($_SESSION['message']);?>