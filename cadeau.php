<?php
require_once './config/init.php';
$producten = new Producten();
$session_id = $_GET['session_id'];
if (isset($_GET['session_id'])) {


?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="google-site-verification" content="poofw779AXX9ijpwPltTpOcACdMtsMkdZTDZviEa8kI" />
        <meta name="robots" content="index, follow">
        <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="./images/favicon.ico" type="image/x-icon">
        <meta property="og:description" content="De pedicure webshop met cadeau bonnen en andere producten.">
        <meta property="og:title" content="Webshop - Pedicurepraktijk Papendrecht">
        <meta property="fb:app_id" content="1612528282242884">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="webshop - Pedicurepraktijk Papendrecht">
        <meta property="og:image" content="https://www.pedicurepraktijkpapendrecht.nl/webshop/img/thumbnail.JPG">
        <meta property="og:url" content="https://www.pedicurepraktijkpapendrecht.nl/webshop/index.php" />
        <meta name="description" content="De pedicure webshop met cadeau bonnen en andere producten.">
        <meta name="keywords"
            content="webshop, cadeau, cadeaubon, producten, nagellak, tegoedbon, pedicure, <papendrecht>, pedicure papendrecht, <pedicurepraktijk papendrecht>, nagels, ambulant, provoet, voet, voeten, voetreflex, voetreflextherapeut">
        <link rel=”canonical” href="https://www.pedicurepraktijkpapendrecht.nl/">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <script src="https://js.stripe.com/v3/"></script>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/product.css">
        <title>Bedankt voor uw bestelling - Pedicurepraktijk Papendrecht</title>
    </head>

    <body>

        <div class="form-row">
            <h1 class="text-2xl font-bold pb-4 text-center">Bedankt voor uw bestelling!</h1>
            <p class="text-md">Uw ontvangt direct een mail met daarin een link.</p>
            <p class="text-md pb-4">Door middel van deze link kunt u uw tegoedbon downloaden.</p>
            <p>U kunt ook u producten/factuur bekijken in mijn account: webshop -> mijn account -> Mijn
                bestellingen</p>
            <h3 id="countdown"></h3>
            <div class="grid-cols-1">
                <?php
                $myString = $_GET['bon'];
                $myaantal = $_GET['aantal'];
                $bon = explode(',', $myString);
                $aantal = explode(',', $myaantal);
                foreach (array_combine($bon, $aantal) as $bon => $aantal) {
                    $product = $producten->GetPerProductInfo($bon);
                    $naam = $product->product_naamdis;
                    $img = $product->product_img;
                    $cat = $product->cat;
                    echo '<div class="gekocht-item flex max-w-md md:max-w-none flex-wrap sm:flex-no-wrap sm:justify-between bg-white rounded-lg overflow-hidden my-4">
                    <img class="sm:w-56 max-w-md sm:max-w-none w-full sm:pr-4" src=".' . $img . '" alt="">
                    <div class="text-sm py-4 px-4 sm:flex-1 sm:px-0">
                        <p class="font-semibold pr-4"><span class="font-bold">Product naam:</span> ' . $cat . ' ' . $naam . '</p>
                        <p class="font-semibold pr-4"><span class="font-bold">Aantal:</span> ' . $aantal . '</p>
                    </div>
                </div>';
                }
                ?>

            </div>
            <div class="flex">
                <a href="https://www.pedicurepraktijkpapendrecht.nl/"
                    class="btn text-center margin-right max-width">Naar de
                    website</a>
                <a href="https://www.pedicurepraktijkpapendrecht.nl/webshop"
                    class="btn text-center margin-right max-width">Nog een tegoedbon kopen?</a>
            </div>

        </div>
        <script>
        var timeleft = 20;
        var downloadTimer = setInterval(function() {
            if (timeleft <= 0) {
                clearInterval(downloadTimer);
                document.getElementById("countdown").innerHTML = "U wordt doorgestuurd";
                window.location.href = "https://www.pedicurepraktijkpapendrecht.nl/";
            } else {
                document.getElementById("countdown").innerHTML = "U word over " + timeleft +
                    " seconden doorgestuurd naar de officiele website.";
            }
            timeleft -= 1;
        }, 1000);
        </script>

    </body>

</html>
<?php
} else {
    header('location: index.php');
}
?>
