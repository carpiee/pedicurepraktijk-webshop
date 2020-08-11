<?php

$name = $_GET['term'];

require_once '../config/init.php';
$zoekenen = new Producten();
$zoekproducten = $zoekenen->zoekProducten($name);

if (empty($zoekproducten)) {
    echo '<div class="w-full absolute left-0 flex justify-center text-center"><h1 class="md:flex-shrink-0 font-medium text-md">Kon helaas geen product vinden met de naam:  <span class="font-semibold">' . $name . '</span>.</h1></div>';
} else {
    foreach ($zoekproducten as $zoeken) {
        if ($zoeken->voorraad > 1) :
?>
<form class="relative w-full mx-auto max-w-sm rounded-lg overflow-hidden shadow-lg mb-5 bg-white" method="GET"
    action="./">
    <div class="relative">
        <a href="product/<?= $zoeken->product_naamdis; ?>">
            <img class="w-auto h-48 mx-auto" src=".<?= $zoeken->product_img; ?>">
        </a>
        <?php if (!($zoeken->cat === 'Tegoedbon')) : ?>
        <span class="absolute bottom-0 pl-6 flex text-sm">
            Voorraad:
            <p class="px-1">
                <?= $zoeken->voorraad; ?>
            </p>
        </span>
        <?php endif;
                    if (!($zoeken->product_oudeprijs) == '') {
                        $oudeprijs = '<span class="strike text-red-700">€ ' . $zoeken->product_oudeprijs . '</span>';
                    } else {
                        $oudeprijs = '';
                    }
                    $leesmeer = '<a class="text-blue-400" href="product/' . str_replace(' ', '-', $zoeken->product_naamdis) . '">Lees meer</a>';
                    ?>
    </div>
    <div class="px-6 pt-4">
        <input type="hidden" name="betalen" value="<?= $zoeken->product_naamdis ?>">
        <span class="font-bold text-xl mb-6"><?= $zoeken->product_naamdis ?></span>
    </div>
    <div class="px-6 py-4 mb-10">
        <p class="text-gray-700 text-base" style="min-height: 144px;">
            <?= nl2br(substr($zoeken->product_disc, 0, 200)) . ' ' . $leesmeer; ?>
        </p>
    </div>
    <div class="absolute bottom-0">
        <div class="px-6 py-4">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                <?= $oudeprijs . ' € ' . $zoeken->product_nieuwprijs; ?>
            </span>
        </div>
    </div>
    <div class="absolute bottom-0 right-0">
        <div class="px-6 py-4">
            <input type="submit" name="button" id="button" value="Voeg nu toe"
                class="ml-auto cursor-pointer inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700" />
        </div>
    </div>
</form>

<?php else : ?>
<form class=" relative mx-auto w-full max-w-sm rounded-lg overflow-hidden shadow-lg mb-5 bg-white">
    <div class="relative">
        <a href="product/<?= $zoeken->product_naamdis; ?>">
            <img class="w-auto h-48 mx-auto" src=".<?= $zoeken->product_img; ?>">
        </a>
        <?php if (!($zoeken->cat === 'Tegoedbon')) : ?>
        <span class="absolute bottom-0 h-10 bg-gray-200 px-2 py-2 w-full mb-2 opacity-75">
            <p class="text-red-500 font-bold text-center text-md">Helaas is dit product niet leverbaar</p>
        </span>
        <?php endif;
                    if (!($zoeken->product_oudeprijs) == '') {
                        $oudeprijs = '<span class="strike text-red-700">€ ' . $zoeken->product_oudeprijs . '</span>';
                    } else {
                        $oudeprijs = '';
                    }
                    $leesmeer = '<a class="text-blue-400" href="product/' . str_replace(' ', '-', $zoeken->product_naamdis) . '">Lees meer</a>';
                    ?>
    </div>
    <div class="px-6 pt-4">
        <span class="font-bold text-xl mb-6"> <?= $zoeken->product_naamdis; ?></span>
    </div>
    <div class="px-6 py-4 mb-10">
        <p class="text-gray-700 text-base" style="min-height: 144px;">
            <?= nl2br(substr($zoeken->product_disc, 0, 250)) . ' ' . $leesmeer; ?>
        </p>
    </div>
    <div class="absolute bottom-0">
        <div class="px-6 py-4">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                <?= $oudeprijs . ' € ' . $zoeken->product_nieuwprijs; ?>
            </span>
        </div>
    </div>
    <div class="absolute bottom-0 right-0">
    </div>
</form>

<?php
        endif;
    }
}




?>
