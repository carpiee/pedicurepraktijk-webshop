<?php

use Stripe\Product;

require_once '../config/init.php';

require_once '../inc/header.php';
$products = new Producten();

?>
<div class="max-w-7xl w-full h-full min-h-screen overflow-hidden">
    <div class="container mx-auto px-4 py-10 overflow-hidden">

        <?php
        if (isset($_GET['naam']) or ($_GET['id'])) {
            $randomProduct = $products->GetRandomProducten();
            if (isset($_GET['naam'])) {
                $naam = str_replace('product/', '', $_GET['naam']);
                $product = $products->GetPerProductInfo(str_replace('-', ' ', $naam));
            } elseif (isset($_GET['id'])) {
                $product = $products->GetPerProductInfoById($_GET['id']);
            }

            if ($product) {
                if ($product->voorraad > 1) {
                    if (!($product->product_oudeprijs) == '') {
                        $oudeprijs = '<span class="strike text-red-700">€ ' . $product->product_oudeprijs . '</span>';
                    } else {
                        $oudeprijs = '';
                    }
                    echo '
                <div class="mx-auto max-w-3xl h-full w-full bg-gray-200 overflow-hidden">
                    <div class="md:flex justify-center p-6">
                        <div class="md:w-1/2 md:mb-0 mb-6 flex items-center justify-center pr-8">
                                <img style="max-height:350px;" class="max-h-full w-auto" src="https://www.pedicurepraktijkpapendrecht.nl/webshop' . $product->product_img . '" alt="">
                        </div>
                        <div class="md:w-1/2">
                        <form method="GET" action="../">
                            <input type="hidden" name="betalen" value="' . $product->product_naamdis . '">
                            <h1 class="font-bold mb-4 text-xl">' . $product->product_naamdis . '</h1>
                            <div class="mb-6 overflow-hidden">' . nl2br($product->product_disc) . '</div>
                            <div class="flex justify-between w-full">
                                <span class="inline-block bg-white rounded-full px-3 py-1 text-sm font-semibold text-gray-700">' . $oudeprijs . ' € ' . $product->product_nieuwprijs . '</span>
                                <input type="submit" id="button" value="Voeg nu toe" class="mr-2 shadow border ml-auto cursor-pointer inline-block bg-white rounded-full px-3 py-1 text-sm font-semibold text-gray-700" />
                            </div>
                            
                        </form>
                            
                        </div>
                    </div>    
                </div>';
                } else {
                    if (!($product->product_oudeprijs) == '') {
                        $oudeprijs = '<span class="strike text-red-700">€ ' . $product->product_oudeprijs . '</span>';
                    } else {
                        $oudeprijs = '';
                    }
                    echo '
                <div class="mx-auto max-w-3xl h-full w-full bg-gray-200">
                    <div class="md:flex justify-center p-6">
                        <div class="md:w-1/2 md:mb-0 mb-6 flex items-center justify-center pr-8 relative">
                                <img style="max-height:350px;" class="max-h-full w-auto" src="https://www.pedicurepraktijkpapendrecht.nl/webshop' . $product->product_img . '" alt="">
                                <span class="absolute bottom-auto h-10 bg-gray-200 px-2 py-2 w-full mb-2 opacity-75"><p class="text-red-500 font-bold text-center text-md">Helaas is dit product niet leverbaar</p></span>
                        </div>
                        <div class="md:w-1/2">
                        <form method="POST" action="cart.php">
                            <h1 class="font-bold mb-4 text-xl">' . $product->product_naamdis . '</h1>
                            <p class="mb-6">' . nl2br($product->product_disc) . '</p>
                            <div class="flex justify-between w-full">
                                <span class="inline-block bg-white rounded-full px-3 py-1 text-sm font-semibold text-gray-700">' . $oudeprijs . ' € ' . $product->product_nieuwprijs . '</span>
                            </div>
                            
                        </form>
                            
                        </div>
                    </div>    
                </div>';
                }
            } else {
                echo '<h1 class="font-bold text-md">Helaas hebben we geen product kunnen vinden!</h1>';
            }
            echo '<div class="border-t-2 mt-10 mb-4"></div>';
            echo '<h1 class="mb-10 text-md font-semibold">Producten die andere mensen bezochten:</h1>';
            echo '<div class="grid gap-5 xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 w-full">';
            foreach ($randomProduct as $random) {
                if (!($random->product_oudeprijs) == '') {
                    $oudeprijs = '<span class="strike text-red-700">€ ' . $random->product_oudeprijs . '</span>';
                } else {
                    $oudeprijs = '';
                }
                $leesmeer = '<a class="text-blue-400" href="' . str_replace(' ', '-', $random->product_naamdis) . '">Lees meer</a>';
                echo '
                        <form class="relative pt-4 px-4 bg-white rounded-lg overflow-hidden w-auto" method="GET" action="../">
                            <input type="hidden" name="betalen" value="' . $random->product_naamdis . '">
                            <div class="flex justify-center mb-2">
                                <a href="' . str_replace(' ', '-', $random->product_naamdis) . '">
                                    <img class="h-32 w-auto" src="..' . $random->product_img . '">
                                </a>
                            </div>
                            <a href="' . str_replace(' ', '-', $random->product_naamdis) . '">
                                <h1 class="font-bold">
                                    ' . $random->product_naamdis . '
                                </h1>
                            </a>
                            <div class="py-4 mb-10 overflow-hidden">
                                ' . substr($random->product_disc, 0, 200) . ' ' . $leesmeer . '
                            </div>
                            <div class="absolute bottom-0 left-0 mr-4">
                                <div class="px-4 py-4">
                                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                                    ' . $oudeprijs . ' € ' . $random->product_nieuwprijs . '
                                    </span>
                                </div>
                            </div>
                            <div class="absolute bottom-0 right-0">
                                <div class="px-6 py-4">
                                    <input type="submit" value="Voeg toe" class="ml-auto cursor-pointer inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700" />
                                </div>
                            </div>
                        </form>';
            }
            echo '</div>';
        } else {
            header('location: https://www.pedicurepraktijkpapendrecht.nl/webshop/');
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
