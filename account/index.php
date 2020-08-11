<?php
require_once '../config/init.php';
$user = new Users();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header("location: ../index.php");
    exit;
} else {
    $GetUserData = $user->GetUserLoggedInInfo($_SESSION['username']);
}
if (isset($_POST['wijzig_info'])) {
    if (!empty($_POST['nmr'] || $_POST['straatnaam'] || $_POST['huisnummer'] || $_POST['postcode'] || $_POST['plaatsnaam'])) {
        $updateInfo = $user->UpdateInfo($_POST['nmr'], $_POST['straatnaam'], $_POST['huisnummer'], $_POST['postcode'], $_POST['plaatsnaam']);
        header("location: ?mijn_informatie");
    }
}

if (isset($_POST['wijzig_email'])) {
    if (!empty($_POST['email'])) {
        $updateEmail = $user->UpdateEmail($_POST['email']);
        header("location: ?mijn_informatie");
    }
}

if (isset($_POST['wijzig_password'])) {
    if (!empty($_POST['password'] || $_POST['herhaal_password'])) {
        if ($_POST['password'] === $_POST['herhaal_password']) {
            $updatePassword = $user->UpdatePassword($_POST['password'], $_POST['herhaal_password']);
            header("location: ?mijn_informatie");
        }
    }
}

if (empty($_GET)) {
    header('location: ?mijn_informatie');
}

include '../inc/header.php';
?>
<div class="flex w-full overflow-x-auto mt-20 scrolling-auto">
    <div class="w-full flex-1 rounded-lg mx-auto container max-w-screen-lg relative h-auto bg-white">
        <?php
        if (isset($_GET['mijn_informatie'])) {
            $title = 'Mijn informatie';
            include_once './templates/mijn_informatie.php';
        } elseif (isset($_GET['bestellingen'])) {
            $title = 'Mijn bestellingen';
            include('./templates/bestellingen.php');
        } elseif (isset($_GET['factuur'])) {
            $title = 'Mijn factuur: ' . $_GET['factuur'];
            include('./templates/factuur.php');
        }
        ?>
    </div>
</div>

<div class="my-48 container w-full max-w-7xl mx-auto">
    <?php require_once('../inc/feed.html') ?>
</div>
<footer>
    <div class="container w-full max-w-7xl mx-auto bg-white">
        <?php require_once('../inc/footer.html') ?>
    </div>
</footer>
