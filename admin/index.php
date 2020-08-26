<?php
require_once '../config/init.php';
$users =  new Users;
$admins = array("admin", "marian gonlag");
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $admins = array('admin', 'Marian Gonlag');
    if (in_array($_SESSION['username'], $admins)) {
        $user = $users->GetUserLoggedInInfo($_SESSION['username']);
    } else {
        header("location: https://www.pedicurepraktijkpapendrecht.nl/webshop");
        exit;
    }
} else {
    header("location: https://www.pedicurepraktijkpapendrecht.nl/webshop");
    exit;
}

$cms = new Cms();
$vandaagGekocht = $cms->GekochtVandaag();
$NogLeveren = $cms->NogWegBrengen();
$producten = new Producten();
if (isset($_GET['factuur'])) {
    $getFactuur = new Factuur();
    $producten = new Producten();
    $factuurData = $getFactuur->GetFactuurInfo($_GET['factuur']);
    $AllfactuurData = $getFactuur->GetAllFactuurData($_GET['factuur']);
    $GetUserData = $cms->GetUserDataForCorrectFactuur($factuurData->klant_name);
}

require('../vendor/autoload.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="https://www.pedicurepraktijkpapendrecht.nl/webshop/images/favicon.ico"
        type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        Admin Panel - Pedicurepraktijk Papendrecht
    </title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    <link href="https://www.pedicurepraktijkpapendrecht.nl/webshop/css/product.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <style>
    .bg-black-alt {
        background: #191919;
    }

    .text-black-alt {
        color: #191919;
    }

    .border-black-alt {
        border-color: #191919;
    }
    </style>
</head>

<body class="bg-black-alt font-sans leading-normal tracking-normal">
    <nav id="header" class="bg-gray-900 fixed w-full z-10 top-0 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center mt-0 py-3 lg:pb-0">
            <div class="w-1/2 pl-4 md:pl-2">
                <a class="text-gray-100 text-base xl:text-xl no-underline hover:no-underline font-bold" href="../">
                    <span class="whitespace-no-wrap"> Pedicurepraktijk Papendrecht</span>
                </a>
            </div>
            <div class="w-1/2 pr-0">
                <div class="flex relative float-right">
                    <div class="relative text-sm text-gray-100">
                        <button id="userButton" class="flex items-center focus:outline-none mr-3">
                            <!-- <img class="w-8 h-8 rounded-full mr-4" src="http://i.pravatar.cc/300"
                                    alt="Avatar of User" /> -->
                            <span class="hidden lg:inline-block text-gray-100">Hi, <?= $user->username; ?></span>

                        </button>
                        <ul id="dropdown-list" class="list-reset flex-1 px-4 md:px-0 hidden">
                            <li class="mr-6 my-2 md:my-0">
                                <a href="./"
                                    class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900 hover:border-blue-400">
                                    <i class="fas fa-home fa-fw mr-3"></i>
                                    <span class="pb-1 md:pb-0 text-sm">Home</span>
                                </a>
                            </li>
                            <li class="mr-6 my-2 md:my-0">
                                <form
                                    class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900 hover:border-pink-400"
                                    action="../emailLijst/email_list.php" method="post" name="upload_excel"
                                    enctype="multipart/form-data">
                                    <i class="fas fa-envelope fa-fw mr-3"></i>
                                    <input class="cursor-pointer pb-1 md:pb-0 text-sm bg-transparent" type="submit"
                                        name="Export" value="Export Email Lijst" />

                                </form>

                            </li>
                            <li class="mr-6 my-2 md:my-0">
                                <a href="?Bewerk_content"
                                    class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900 hover:border-purple-400">
                                    <i class="fa fa-tasks fa-fw mr-3"></i>
                                    <span class="pb-1 md:pb-0 text-sm">Bewerk pagina's</span>
                                </a>
                            </li>
                            <li class="mr-6 my-2 md:my-0">
                                <a href="?producten"
                                    class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900 hover:border-green-400">
                                    <i class="fas fa-store fa-fw mr-3"></i>
                                    <span class="pb-1 md:pb-0 text-sm">Bewerk Producten</span>
                                </a>
                            </li>
                            <li class="mr-6 my-2 md:my-0">
                                <a href="?bestellingen"
                                    class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900 hover:border-red-400">
                                    <i class="fa fa-wallet fa-fw mr-3"></i>
                                    <span class="pb-1 md:pb-0 text-sm">Alle Bestellingen</span>
                                </a>
                            </li>
                            <li class="mr-6 my-2 md:my-0">
                                <a href="?users"
                                    class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900 hover:border-blue-400">
                                    <i class="fas fa-users fa-fw mr-3"></i>
                                    <span class="pb-1 md:pb-0 text-sm">Users</span>
                                </a>
                            </li>
                        </ul>

                    </div>

                    <div class="block lg:hidden pr-4">
                        <button id="nav-toggle"
                            class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-100 hover:border-teal-500 appearance-none focus:outline-none">
                            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-gray-900 z-20"
                id="nav-content">
                <ul class="list-reset lg:flex flex-1 items-center px-4 md:px-0">
                    <li class="mr-6 my-2 md:my-0">
                        <a href="./"
                            class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900 hover:border-blue-400">
                            <i class="fas fa-home fa-fw mr-3"></i>
                            <span class="pb-1 md:pb-0 text-sm">Home</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <form
                            class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900 hover:border-pink-400"
                            action="../emailLijst/email_list.php" method="post" name="upload_excel"
                            enctype="multipart/form-data">
                            <i class="fas fa-envelope fa-fw mr-3"></i>
                            <input class="cursor-pointer pb-1 md:pb-0 text-sm bg-transparent" type="submit"
                                name="Export" value="Export Email Lijst" />

                        </form>

                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="?Bewerk_content"
                            class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900 hover:border-purple-400">
                            <i class="fa fa-tasks fa-fw mr-3"></i>
                            <span class="pb-1 md:pb-0 text-sm">Bewerk pagina's</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="?producten"
                            class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900 hover:border-green-400">
                            <i class="fas fa-store fa-fw mr-3"></i>
                            <span class="pb-1 md:pb-0 text-sm">Bewerk Producten</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="?bestellingen"
                            class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900 hover:border-red-400">
                            <i class="fa fa-wallet fa-fw mr-3"></i>
                            <span class="pb-1 md:pb-0 text-sm">Alle Bestellingen</span>
                        </a>
                    </li>
                    <li class="mr-6 my-2 md:my-0">
                        <a href="?users"
                            class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-100 border-b-2 border-gray-900 hover:border-red-400">
                            <i class="fa fa-users fa-fw mr-3"></i>
                            <span class="pb-1 md:pb-0 text-sm">Users</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!--Container-->
    <div class="container w-full mx-auto pt-20 overflow-y-auto overflow-x-hidden">
        <?php if (empty($_GET)) : ?>
        <div class="w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-green-600">
                                    <i class="fa fa-wallet fa-2x fa-fw fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-400">
                                    Totaal verkochten producten
                                </h5>
                                <h3 class="font-bold text-3xl text-gray-600">
                                    <?= $cms->GetAantalGekochtProducten(); ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-green-600">
                                    <i class="fa fa-wallet fa-2x fa-fw fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-400">
                                    Vandaag verkocht
                                </h5>
                                <h3 class="font-bold text-3xl text-gray-600">
                                    <?= $cms->GetVandaagAantalGekochtProducten(); ?>
                                    <span id="vdgekocht" class="text-green-500"><i class="fas fa-caret-up"></i></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-orange-600">
                                    <i class="fas fa-users fa-2x fa-fw fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-400">Totaal gebruikers</h5>
                                <h3 class="font-bold text-3xl text-gray-600">
                                    <?= $cms->GetAantalUsers(); ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                    <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded p-3 bg-yellow-600">
                                    <i class="fas fa-user-plus fa-2x fa-fw fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h5 class="font-bold uppercase text-gray-400">Nieuwe gebruikers</h5>
                                <h3 class="font-bold text-3xl text-gray-600">
                                    <?= $cms->GetnewUsersToday(); ?>
                                    <span id="vdgebruiker" class="text-green-600"><i class="fas fa-caret-up"></i></span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--Divider-->
            <hr class="border-b-2 border-gray-600 my-8 mx-4" />
            <div class="flex flex-wrap">
                <div class="w-full xl:w-1/2 p-3">
                    <div>
                        <h2 class="text-2xl font-semibold leading-tight text-white">Nog af te leveren</h2>
                    </div>

                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Product Naam
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Klant Naam
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Gekocht Op
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($NogLeveren as $nogwegbrengen) :
                                            $product = $producten->GetPerProductInfoByName($nogwegbrengen->bon);
                                        ?>
                                    <tr class="show-info" id="<?= $nogwegbrengen->id; ?>-<?= $nogwegbrengen->bon; ?>"
                                        name="<?= $nogwegbrengen->klant_name; ?>">
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-full h-full rounded-full"
                                                        src="<?= 'https://www.pedicurepraktijkpapendrecht.nl/webshop' . $product->product_img; ?>"
                                                        alt="<?= $product->product_naamdis; ?>" />
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        <?= $product->product_naamdis; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                <?= $nogwegbrengen->klant_name; ?>
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                <?= $nogwegbrengen->datum; ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="w-full xl:w-1/2 p-3">
                    <div>
                        <h2 class="text-2xl font-semibold leading-tight text-white">Vandaag Gekocht</h2>
                    </div>

                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Product Naam
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Klant Naam
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Gekocht Op
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($vandaagGekocht as $vdGekocht) : ?>
                                    <?php
                                            $product = $producten->GetPerProductInfoByName($vdGekocht->bon);

                                            ?>
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10">
                                                    <img class="w-full h-full rounded-full"
                                                        src="<?= 'https://www.pedicurepraktijkpapendrecht.nl/webshop/' . $product->product_img; ?>"
                                                        alt="" />
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        <?= $product->product_naamdis; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                <?= $vdGekocht->klant_name; ?>
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                <?= $vdGekocht->datum; ?>
                                            </p>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php elseif (isset($_GET['producten'])) : ?>

        <?php require_once './templates/producten.php'; ?>

        <?php elseif (isset($_GET['bestellingen'])) : ?>

        <?php require_once './templates/bestellingen.php'; ?>

        <?php elseif (isset($_GET['factuur'])) : ?>

        <div class="rounded-lg bg-white mt-16 mb-20">
            <?php require_once './templates/factuur.php'; ?>
        </div>

        <?php elseif (isset($_GET['Bewerk_content'])) : ?>

        <div class="rounded-lg bg-white mt-16 mb-20">
            <?php require_once './cms/index.php'; ?>
        </div>
        <?php elseif (isset($_GET['users'])) :
            include('./templates/users.php');
        ?>
        <?php endif; ?>
    </div>
    </div>

    <div
        class="info-modal opacity-0 pointer-events-none fixed w-full h-screen left-0 top-0 z-20 flex items-center justify-center overflow-y-auto">
        <div class="info-modal-overlay opacity-25 bg-black absolute w-full h-screen top-0 left-0 cursor-pointer">
        </div>
        <div
            class="info-modal-dialog max-w-lg sm:h-auto h-full w-full bg-white shadow border rounded-lg overflow-hidden z-50 mb-24 lg:mb-0 lg:mt-24">
            <div class="h-full flex flex-col modal-content">
                <div class="md:mt-0 mt-12 modal-header flex justify-center font-bold text-xl border-b-2 py-2">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="flex-1 modal-body">
                    <form method="post" id="insert_form" class="px-4 py-6">
                        <div class="w-64 mx-auto">
                            <img class="w-full h-auto" id="image" src="">
                        </div>
                        <br />
                        <textarea class="border px-4 py-2 w-full mt-2 mb-4 rounded-lg" id="info" rows="5"
                            class="form-control">
                            </textarea>
                        <br />

                    </form>
                </div>
                <div class="md:mt-0 -mt-64 modal-footer border-t-2">
                    <button type="button"
                        class="btn bg-gray-200 w-full font-semibold px-4 py-2 info-modal-button">Sluiten</button>
                </div>
            </div>
        </div>
    </div>

    <?php




    ?>
    <script>
    $(document).ready(function() {
        function toggleModal() {
            $(".info-modal").toggleClass('opacity-0');
            $(".info-modal").toggleClass('pointer-events-none');
        }
        const button = document.querySelector('.info-modal-button');
        button.addEventListener('click', toggleModal);

        const overlay = document.querySelector('.info-modal-overlay');
        overlay.addEventListener('click', toggleModal);
        $(document).on('click', '.show-info', function() {
            var info_id = $(this).attr("id");
            var name = $(this).attr("name");
            $.ajax({
                url: "./fetch.php",
                method: "POST",
                data: {
                    info_id: info_id,
                    name: name
                },
                dataType: "json",
                success: function(data) {
                    $('#image').attr("src",
                        'https://www.pedicurepraktijkpapendrecht.nl/webshop' + data
                        .product.product_img);
                    $('#klant_name').html(data.user.username);
                    $('#info').html(data.user.username + '\n' + data.user.straatnaam +
                        ' ' + data.user.huisnummer +
                        '\n' + data.user.postcode + ' ' + data.user.plaatsnaam);
                    $('.modal-title').html(data.user.username + ' - ' + data.product
                        .product_naamdis);
                    toggleModal();
                }
            });
        });
        if ($("#vdgekocht").val = '0') {
            $("#vdgekocht").addClass("hidden");
        }
        if ($("#vdgebruiker").val = '0') {
            $("#vdgebruiker").addClass("hidden");
        }

        var userMenuDiv = document.getElementById("dropdown-list");
        var userMenu = document.getElementById("userButton");

        var navMenuDiv = document.getElementById("nav-content");
        var navMenu = document.getElementById("nav-toggle");

        document.onclick = check;

        function check(e) {
            var target = (e && e.target) || (event && event.srcElement);
            //User Menu
            if (!checkParent(target, userMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, userMenu)) {
                    // click on the link
                    if (userMenuDiv.classList.contains("invisible")) {
                        userMenuDiv.classList.remove("invisible");
                    } else {
                        userMenuDiv.classList.add("invisible");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    userMenuDiv.classList.add("invisible");
                }
            }

            //Nav Menu
            if (!checkParent(target, navMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, navMenu)) {
                    // click on the link
                    if (navMenuDiv.classList.contains("hidden")) {
                        navMenuDiv.classList.remove("hidden");
                    } else {
                        navMenuDiv.classList.add("hidden");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    navMenuDiv.classList.add("hidden");
                }
            }
        }

        function checkParent(t, elm) {
            while (t.parentNode) {
                if (t == elm) {
                    return true;
                }
                t = t.parentNode;
            }
            return false;
        }
    });
    </script>

</body>

</html>