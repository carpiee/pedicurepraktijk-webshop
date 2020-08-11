<?php
require_once './config/init.php';
$producten = new Producten();
$products = $producten->GetAllProducten();
foreach ($products as $product) :
    if ($product->voorraad > 1) :
?>
<form class="relative w-full mx-auto max-w-sm rounded-lg overflow-hidden shadow-lg mb-5 bg-white" method="GET"
    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="relative">
        <a href="product/<?= str_replace(' ', '-', $product->product_naamdis); ?>">
            <img class="w-auto h-48 mx-auto" src=".<?= $product->product_img; ?>"
                alt="<?= $product->product_naamdis; ?>">
        </a>
        <?php if (!($product->cat === 'Tegoedbon')) : ?>
        <span class="absolute bottom-0 pl-6 flex text-sm">
            Voorraad:
            <p class="px-1">
                <?= $product->voorraad; ?>
            </p>
        </span>
        <?php endif;
                if (!($product->product_oudeprijs) == '') {
                    $oudeprijs = '<span class="strike text-red-700">€ ' . $product->product_oudeprijs . '</span>';
                } else {
                    $oudeprijs = '';
                }
                $leesmeer = '<a class="text-blue-400" href="product/' . str_replace(' ', '-', $product->product_naamdis) . '">Lees meer</a>';
                ?>
    </div>
    <div class="px-6 pt-4">
        <input type="hidden" name="betalen" value="<?= $product->product_naamdis ?>">
        <span class="font-bold text-xl mb-6"><?= $product->product_naamdis ?></span>
    </div>
    <div class="px-6 py-4 mb-10">
        <p class="text-gray-700 text-base" style="min-height: 144px;">
            <?= nl2br(substr($product->product_disc, 0, 200)) . ' ' . $leesmeer; ?>
        </p>
    </div>
    <div class="absolute bottom-0">
        <div class="px-6 py-4">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                <?= $oudeprijs . ' € ' . $product->product_nieuwprijs; ?>
            </span>
        </div>
    </div>
    <div class="absolute bottom-0 right-0">
        <div class="px-6 py-4">
            <input type="submit" id="button" value="Voeg nu toe"
                class="ml-auto cursor-pointer inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700" />
        </div>
    </div>
</form>

<?php else : ?>
<form class=" relative mx-auto w-full max-w-sm rounded-lg overflow-hidden shadow-lg mb-5 bg-white">
    <div class="relative">
        <a href="product/<?= str_replace(' ', '-', $product->product_naamdis); ?>">
            <img class="w-auto h-48 mx-auto" src=".<?= $product->product_img; ?>"
                alt="<?= $product->product_naamdis; ?>">
        </a>
        <?php if (!($product->cat === 'Tegoedbon')) : ?>
        <span class="absolute bottom-0 h-10 bg-gray-200 px-2 py-2 w-full mb-2 opacity-75">
            <p class="text-red-500 font-bold text-center text-md">Helaas is dit product niet leverbaar</p>
        </span>
        <?php endif;
                if (!($product->product_oudeprijs) == '') {
                    $oudeprijs = '<span class="strike text-red-700">€ ' . $product->product_oudeprijs . '</span>';
                } else {
                    $oudeprijs = '';
                }
                $leesmeer = '<a class="text-blue-400" href="product/' . str_replace(' ', '-', $product->product_naamdis) . '">Lees meer</a>';
                ?>
    </div>
    <div class="px-6 pt-4">
        <span class="font-bold text-xl mb-6"> <?= $product->product_naamdis; ?></span>
    </div>
    <div class="px-6 py-4 mb-10">
        <p class="text-gray-700 text-base" style="min-height: 144px;">
            <?= nl2br(substr($product->product_disc, 0, 250)) . ' ' . $leesmeer; ?>
        </p>
    </div>
    <div class="absolute bottom-0">
        <div class="px-6 py-4">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                <?= $oudeprijs . ' € ' . $product->product_nieuwprijs; ?>
            </span>
        </div>
    </div>
    <div class="absolute bottom-0 right-0">
    </div>
</form>

<?php
    endif;
endforeach;
?>
