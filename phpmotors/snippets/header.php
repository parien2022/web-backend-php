<div class="logo-div">
    <img id="logo" src="/phpmotors/images/site/logo.png" alt="PHP Motors logo "/>
</div>
<div>
    <?php if(isset($_SESSION['clientData']['clientFirstname'])){
        echo "<a href='/phpmotors/accounts/'><span>Welcome " . $_SESSION['clientData']['clientFirstname'] . "</span><a/>";}?>
    <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE){
        echo "<a class='my-account' href='/phpmotors/accounts/index.php?action=Logout'><button class='my-account-button'>Log out</button></a>";
    }else{
        echo "<a class='my-account' href='/phpmotors/accounts/index.php?action=login'><button class='my-account-button'>My Account</button></a>";
    }?>
</div>
