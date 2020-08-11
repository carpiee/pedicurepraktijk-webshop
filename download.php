<?php
require_once './config/init.php';
$bestellingen = new Bestellingen();
$bestelling = $bestellingen->GetBestellingenForDownloadByIdAndName($_GET['id'], $_GET['bon']);
if (!$bestelling) {
    header("location: https://www.pedicurepraktijkpapendrecht.nl/webshop/");
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
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
        <script src="https://js.stripe.com/v3/"></script>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
        <link rel="stylesheet" href="./css/style.css">
        <title>Download uw tegoedbon - Pedicurepraktijk Papendrecht</title>
    </head>

    <body>
        <style>
        body {
            flex-wrap: wrap;
        }

        p {
            opacity: .5;
        }

        </style>
        <form action="" class="form cadeau" id="invoice">
            <div class="geheel">
                <div class="img">
                    <?php
                if ($bestelling->gebruikt == "ja") {
                    echo '<h1>hellaas heeft u al uw tegoedbon ingeleverd!</h1>';
                } else {
                    if ($bestelling->bon == "voetreflex") {
                        echo '<img src="./img/voetreflex_bon.jpg" alt="">';
                    } elseif ($bestelling->bon == "voetbehandeling") {
                        echo '<img src="./img/voetbehandeling_bon.jpg" alt="">';
                    }


                ?>
                </div>
                <div class="overlay">
                    <p><?php echo $_GET['id']; ?></p>
                </div>
            </div>
        </form>
        <div class="button">
            <button onclick="generatePDF()">Download as PDF</button>
        </div>
        <?php
                }


?>

        <script>
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        function generatePDF() {
            const element = document.getElementById("invoice");
            // Choose the element and save the PDF for our user.
            html2pdf()
                .set({
                    html2canvas: {
                        scale: 4
                    }
                })
                .from(element)
                .save();
        }
        </script>
    </body>

</html>
