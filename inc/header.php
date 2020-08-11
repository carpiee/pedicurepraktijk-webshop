<?php
$cart = new Cart();
$header = new Cms();
$content = $header->GetContent();
$products = new Producten();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_GET['naam'])) {
    $naam = str_replace('product/', '', $_GET['naam']);
    $product = $products->GetPerProductInfo(str_replace('-', ' ', $naam));
    $name = $product->product_naamdis;
    $img = $product->product_img;
    $description = $product->product_disc;
} elseif (isset($_GET['id'])) {
    $product = $products->GetPerProductInfoById($_GET['id']);
    $name = $product->product_naamdis;
    $img = $product->product_img;
    $description = $product->product_disc;
} else {
    $name = 'Webshop';
    $description = 'De pedicure webshop met cadeau bonnen en andere producten.';
    $img = 'https://www.pedicurepraktijkpapendrecht.nl/webshop/img/thumbnail.JPG';
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="google-site-verification" content="poofw779AXX9ijpwPltTpOcACdMtsMkdZTDZviEa8kI" />
        <meta name="robots" content="index, follow">
        <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="./images/favicon.ico" type="image/x-icon">
        <meta property="og:description" content="<?= $description; ?>">
        <meta property="og:title" content="<?= $name; ?> - Pedicurepraktijk Papendrecht">
        <meta property="fb:app_id" content="1612528282242884">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="<?= $name; ?> - Pedicurepraktijk Papendrecht">
        <meta property="og:image" content="<?= 'https://www.pedicurepraktijkpapendrecht.nl/webshop' . $img; ?>">
        <meta property="og:url"
            content="https://www.pedicurepraktijkpapendrecht.nl/webshop/<?= $_GET ? 'product/' . str_replace(' ', '-', strip_tags($name)) : 'index.php' ?>" />
        <meta name="description" content="<?= substr($description, 0, 200) . '...'; ?>" />
        <meta name="keywords"
            content="webshop, cadeau, cadeaubon, producten, nagellak, tegoedbon, pedicure, <papendrecht>, pedicure papendrecht, <pedicurepraktijk papendrecht>, nagels, ambulant, provoet, voet, voeten, voetreflex, voetreflextherapeut">
        <link rel=”canonical” href="https://www.pedicurepraktijkpapendrecht.nl/">
        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
        <script src="https://js.stripe.com/v3/"></script>
        <link rel="stylesheet" href="https://www.pedicurepraktijkpapendrecht.nl/webshop/css/table.css">
        <link rel="stylesheet" href="https://www.pedicurepraktijkpapendrecht.nl/webshop/js/jquery-steps.css" />
        <link rel="stylesheet" href="https://www.pedicurepraktijkpapendrecht.nl/webshop/css/style_step.css" />
        <link rel="stylesheet" type="text/css"
            href="https://www.pedicurepraktijkpapendrecht.nl/webshop/css/product.css">
        <link rel="stylesheet" href="https://www.pedicurepraktijkpapendrecht.nl/webshop/css/dropdown.css">
        <title><?= $name; ?> - Pedicurepraktijk Papendrecht</title>
    </head>

    <body class="bg-gray-200">
        <style>
        .strike {
            position: relative;

        }

        .strike:before {
            position: absolute;
            content: "";
            left: 0;
            top: 50%;
            right: 0;
            border-top: 1px solid;
            border-color: red;

            -webkit-transform: rotate(-5deg);
            -moz-transform: rotate(-5deg);
            -ms-transform: rotate(-5deg);
            -o-transform: rotate(-5deg);
            transform: rotate(-5deg);
        }

        </style>
        <div class="block w-full px-6 py-4 rounded-b-lg mx-auto container max-w-7xl">
            <div class="flex justify-center items-center">
                <img class="h-16 w-16 mr-5 sm:mr-10" src="https://www.pedicurepraktijkpapendrecht.nl/images/logo.jpg"
                    alt="">
                <h1 class="font-bold flex-shrink-0 sm:text-lg tracking-wider"><a
                        href="https://www.pedicurepraktijkpapendrecht.nl/webshop">Pedicurepraktijk
                        Papendrecht</a></h1>
            </div>
        </div>
        <div class="container mx-auto px-6 flex flex-col flex-1 max-w-7xl">
            <div>
            </div>
        </div>
        <div class=" container mx-auto max-w-7xl">
            <div class="bg-white rounded-t-lg xl:rounded-lg px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="items-center hidden sm:block">
                        <div class="flex-shrink-0 w-64">
                            <p class="text-gray-600 font-semibold">
                                <!-- Aantal tegoedbonnen verkocht: -->
                                <?php
                            // print_r($getaantal->rowCountQuery()[0]); 
                            ?>
                            </p>
                        </div>
                    </div>
                    <?php if (empty($_GET)) : ?>
                    <span class="relative w-full max-w-md md:mr-12 focus:outline-none text-gray-600 hidden xl:block">
                        <span class="absolute inset-y-0 left-0 pl-2 py-2">
                            <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                                <path class="heroicon-ui"
                                    d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                            </svg>
                        </span>
                        <input
                            class="block border-2 border-gray-300 bg-white font-semibold leading-5 py-2 w-full rounded-lg pl-10 pr-5 text-md"
                            type="text" autocomplete="off" placeholder="Zoek naar producten" />
                    </span>
                    <?php endif;  ?>
                    <div class="sm:ml-4 ml-1 flex w-full sm:w-auto justify-between sm:justify-end">
                        <a href="https://www.pedicurepraktijkpapendrecht.nl/webshop/?cart"
                            class="flex py-1 border-2 border-transparent text-gray-600 rounded-full hover:text-gray-700">
                            <svg class="fill-current hover:text-black mr-1" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M21,7H7.462L5.91,3.586C5.748,3.229,5.392,3,5,3H2v2h2.356L9.09,15.414C9.252,15.771,9.608,16,10,16h8 c0.4,0,0.762-0.238,0.919-0.606l3-7c0.133-0.309,0.101-0.663-0.084-0.944C21.649,7.169,21.336,7,21,7z M17.341,14h-6.697L8.371,9 h11.112L17.341,14z">
                                </path>
                                <circle cx="10.5" cy="18.5" r="1.5"></circle>
                                <circle cx="17.5" cy="18.5" r="1.5"></circle>
                            </svg>
                            <span class="group text-gray-600 font-semibold">
                                <?= $cart->CheckCartQuantity(); ?>
                            </span>
                        </a>


                        </button>
                        <?php if (isset($_SESSION['loggedin'])) : ?>
                        <div class="inline-block relative dropdown pl-8">
                            <button
                                class="dropbtn max-w-xs flex items-center text-sm text-white focus:outline-none focus:shadow-solid">

                                <svg class="fill-current h-6 w-6 -mb-3 mr-1 text-gray-700 hover:text-black font-bold"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <circle fill="none" cx="12" cy="7" r="3"></circle>
                                    <path
                                        d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z">
                                    </path>

                                </svg>
                                <span class="naam text-gray-600 font-semibold pt-3 hover:text-gray-800 leading-3">Mijn
                                    account</span>
                            </button>
                            <div
                                class="dropdown-content absolute right-0 mt-2 w-48 rounded-md shadow-lg overflow-hidden z-50">
                                <div class="pb-1 bg-gray-200">
                                    <p class="block px-4 py-2 text-sm text-gray-700">
                                        <?= htmlspecialchars($_SESSION["username"]) ?></p>
                                </div>
                                <?php $admins = array('admin', 'Marian Gonlag');
                                if (in_array($_SESSION["username"], $admins)) : ?>
                                <div class="py-1 bg-gray-200">
                                    <p class="block px-4 text-sm font-semibold text-gray-800">Admin acties:</p>
                                    <p class="flex text-sm text-gray-700">
                                        <form class="block text-sm px-4 text-gray-700 hover:bg-gray-100 flex-shrink-0"
                                            action="https://www.pedicurepraktijkpapendrecht.nl/webshop/emailLijst/email_list.php"
                                            method="post" name="upload_excel" enctype="multipart/form-data">
                                            <span class="px-4 flex items-center">-<input
                                                    class=" cursor-pointer pl-1 py-2 bg-transparent text-sm text-gray-700 hover:bg-gray-100"
                                                    type="submit" name="Export" value="Export Email Lijst" /></span>

                                        </form>

                                    </p>
                                    <p class="flex text-sm text-gray-700">
                                        <span class="block text-sm px-4 text-gray-700 hover:bg-gray-100 flex-shrink-0">
                                            <span class="px-4 flex items-center">-
                                                <a href="https://www.pedicurepraktijkpapendrecht.nl/webshop/admin/?Bewerk_content"
                                                    class="block pl-1 py-2 text-sm text-gray-700 hover:bg-gray-100 flex-shrink-0">
                                                    Bewerk content</a>
                                            </span>
                                        </span>
                                    </p>
                                    <p class="flex text-sm text-gray-700">
                                        <span class="block text-sm px-4 text-gray-700 hover:bg-gray-100 flex-shrink-0">
                                            <span class="px-4 flex items-center">-
                                                <a href="https://www.pedicurepraktijkpapendrecht.nl/webshop/admin/?producten"
                                                    class="block pl-1 py-2 text-sm text-gray-700 hover:bg-gray-100 flex-shrink-0">
                                                    Bewerk producten</a>
                                            </span>
                                        </span>
                                    </p>

                                    <p class="flex text-sm text-gray-700">
                                        <span class="block text-sm px-4 text-gray-700 hover:bg-gray-100 flex-shrink-0">
                                            <span class="px-4 flex items-center">-
                                                <a href="https://www.pedicurepraktijkpapendrecht.nl/webshop/admin/?bestellingen"
                                                    class="block pl-1 py-2 text-sm text-gray-700 hover:bg-gray-100 flex-shrink-0">
                                                    Alle bestellingen</a>
                                            </span>
                                        </span>
                                    </p>
                                </div>
                                <?php endif; ?>
                                <div class="py-1 bg-white">
                                    <a href="https://www.pedicurepraktijkpapendrecht.nl/webshop/account/?mijn_informatie"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mijn
                                        informatie</a>
                                </div>
                                <div class="py-1 bg-white">
                                    <a href="https://www.pedicurepraktijkpapendrecht.nl/webshop/account/?bestellingen"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mijn
                                        bestellingen</a>
                                </div>
                                <div class="rounded-b-md bg-white">
                                    <a href="https://www.pedicurepraktijkpapendrecht.nl/webshop/account/logout/"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Uitloggen</a>
                                </div>
                            </div>
                        </div>
                        <?php else : echo '<div class="mt-px py-1"><a class="pl-8 font-bold hover:text-gray-500" href="https://www.pedicurepraktijkpapendrecht.nl/webshop/account/login/">Log nu in</a></div>';
                    endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- <header class="bg-white shadow block sm:hidden z-40">
            <div class="max-w-7xl w-full py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center flex-1 w-full">
                    <div class="flex-shrink-0 text-gray-600 font-semibold">
                        <p class="pl-2">
                            Aantal tegoedbonnen verkocht:
                            <?php
                            // print_r($getaantal->rowCountQuery()[0]); 
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </header> -->

        <?php if (empty($_GET)) : ?>
        <div class="container max-w-7xl mx-auto xl:hidden relative">
            <div class="rounded-b-lg flex justify-center bg-white">
                <div class="w-full flex justify-center search py-4 px-6">
                    <span
                        class="relative w-full max-w-md focus:outline-none sm:mx-10 md:mx-16 text-gray-600 block xl:hidden">
                        <span class="absolute inset-y-0 left-0 pl-2 py-2">
                            <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                                <path class="heroicon-ui"
                                    d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z">
                                </path>
                            </svg>

                        </span>

                        <input
                            class="block border-2 border-gray-300 xl:hidden bg-white font-semibold leading-5 py-2 w-full rounded-lg pl-10 pr-5 text-md"
                            type="text" autocomplete="off" placeholder="Zoek naar producten">
                    </span>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if (!empty($_GET)) : ?>
        <div class="bg-transparent font-semibold max-w-7xl">
            <div class="container w-full mx-auto max-w-7xl px-6 py-3">
                <span class="flex items-center">
                    <img src="https://www.pedicurepraktijkpapendrecht.nl/webshop/img/back.svg"
                        class="h-3 w-3 -mb-px mr-px" alt="">
                    <a href="https://www.pedicurepraktijkpapendrecht.nl/webshop/">
                        Terug naar de webshop
                    </a>
                </span>
            </div>
        </div>
        <?php endif; ?>
