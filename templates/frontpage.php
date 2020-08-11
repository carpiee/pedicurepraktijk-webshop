<?php include_once './inc/header.php'; ?>


<?php
foreach ($zoeken as $zoeken) :

    if ($zoeken->voorraad > 1) {
?>
<form class="relative w-full mx-auto max-w-sm rounded-lg overflow-hidden shadow-lg mb-5 bg-white" method="GET"
    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="relative">
        <img class="w-auto h-48 mx-auto" src=".<?php echo $zoeken->product_img; ?>">
        <?php if (!($zoeken->cat === 'Tegoedbon')) { ?>
        <span class="absolute bottom-0 pl-6 flex text-sm">Voorraad: <p class="px-1"><?php echo $zoeken->voorraad; ?>
            </p>
        </span>
        <?php
                }
                if (!($zoeken->product_oudeprijs) == '') {
                    $oudeprijs = '<span class="strike text-red-700">€ ' . $zoeken->product_oudeprijs . '</span>';
                } else {
                    $oudeprijs = '';
                }
                $leesmeer = '<a class="text-blue-400" href="product/' . $zoeken->product_naamdis . '">Lees meer</a>';
                ?>
    </div>
    <div class="px-6 pt-4">
        <input type="hidden" name="betalen" value="<?php echo $zoeken->product_naam; ?>">
        <span class="font-bold text-xl mb-6"><?php echo $zoeken->product_naam; ?></span>
    </div>
    <div class="px-6 py-4 mb-10">
        <p class="text-gray-700 text-base" style="min-height: 144px;">
            <?php echo substr($zoeken->product_disc, 0, 200) . ' ' . $leesmeer; ?>
        </p>
    </div>
    <div class="absolute bottom-0">
        <div class="px-6 py-4">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                <?php echo $oudeprijs . ' € ' . $zoeken->product_nieuwprijs; ?>
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
<?php
    } else {
    ?>
<form class="relative mx-auto w-full max-w-sm rounded-lg overflow-hidden shadow-lg mb-5 bg-white">
    <div class="relative">
        <img class="w-auto h-48 mx-auto" src=".<?php echo $zoeken->product_img; ?>">
        <?php if (!($zoeken->cat === 'Tegoedbon')) { ?>
        <span class="absolute bottom-0 h-10 bg-gray-200 px-2 py-2 w-full mb-2 opacity-75">
            <p class="text-red-500 font-bold text-center text-md">Helaas is dit product niet leverbaar
            </p>
        </span>
        <?php
                }
                if (!($zoeken->product_oudeprijs) == '') {
                    $oudeprijs = '<span class="strike text-red-700">€ ' . $zoeken->product_oudeprijs . '</span>';
                } else {
                    $oudeprijs = '';
                }
                $leesmeer = '<a class="text-blue-400" href="product/' . $zoeken->product_naamdis . '">Lees meer</a>';
                ?>
    </div>
    <div class="px-6 pt-4">
        <span class="font-bold text-xl mb-6"><?php echo $zoeken->product_naamdis; ?></span>
    </div>
    <div class="px-6 py-4 mb-10">
        <p class="text-gray-700 text-base" style="min-height: 144px;">
            <?php echo substr($zoeken->product_disc, 0, 250) . ' ' . $leesmeer; ?>
        </p>
    </div>
    <div class="absolute bottom-0">
        <div class="px-6 py-4">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                <?php echo $oudeprijs . ' € ' . $zoeken->product_nieuwprijs; ?>
            </span>
        </div>
    </div>
    <div class="absolute bottom-0 right-0">
    </div>
</form>
<?php

    }
endforeach;

foreach ($jobs as $job) :

    if ($job->voorraad > 1) {
    ?>
<form class="relative w-full mx-auto max-w-sm rounded-lg overflow-hidden shadow-lg mb-5 bg-white" method="POST"
    action="cart.php">
    <div class="relative">
        <img class="w-auto h-48 mx-auto" src=".<?php echo $job->product_img; ?>">
        <?php if (!($job->cat === 'Tegoedbon')) { ?>
        <span class="absolute bottom-0 pl-6 flex text-sm">Voorraad: <p class="px-1"><?php echo $job->voorraad; ?>
            </p>
        </span>
        <?php
                }
                if (!($job->product_oudeprijs) == '') {
                    $oudeprijs = '<span class="strike text-red-700">€ ' . $job->product_oudeprijs . '</span>';
                } else {
                    $oudeprijs = '';
                }
                $leesmeer = '<a class="text-blue-400" href="?id=' . $job->id . '">Lees meer</a>';
                ?>
    </div>
    <div class="px-6 pt-4">
        <input type="hidden" name="betalen" value="<?php echo $job->product_naam; ?>">
        <span class="font-bold text-xl mb-6"><?php echo $job->product_naam; ?></span>
    </div>
    <div class="px-6 py-4 mb-10">
        <p class="text-gray-700 text-base" style="min-height: 144px;">
            <?php echo substr($job->product_disc, 0, 200) . ' ' . $leesmeer; ?>
        </p>
    </div>
    <div class="absolute bottom-0">
        <div class="px-6 py-4">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                <?php echo $oudeprijs . ' € ' . $job->product_nieuwprijs; ?>
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
<?php
    } else {
    ?>
<form class="relative mx-auto w-full max-w-sm rounded-lg overflow-hidden shadow-lg mb-5 bg-white" method="POST"
    action="cart.php">
    <div class="relative">
        <img class="w-auto h-48 mx-auto" src=".<?php echo $job->product_img; ?>">
        <?php if (!($job->cat === 'Tegoedbon')) { ?>
        <span class="absolute bottom-0 h-10 bg-gray-200 px-2 py-2 w-full mb-2 opacity-75">
            <p class="text-red-500 font-bold text-center text-md">Helaas is dit product niet leverbaar
            </p>
        </span>
        <?php
                }
                if (!($job->product_oudeprijs) == '') {
                    $oudeprijs = '<span class="strike text-red-700">€ ' . $job->product_oudeprijs . '</span>';
                } else {
                    $oudeprijs = '';
                }
                $leesmeer = '<a class="text-blue-400" href="?id=' . $job->id . '">Lees meer</a>';
                ?>
    </div>
    <div class="px-6 pt-4">
        <span class="font-bold text-xl mb-6"><?php echo $job->product_naamdis; ?></span>
    </div>
    <div class="px-6 py-4 mb-10">
        <p class="text-gray-700 text-base" style="min-height: 144px;">
            <?php echo substr($job->product_disc, 0, 250) . ' ' . $leesmeer; ?>
        </p>
    </div>
    <div class="absolute bottom-0">
        <div class="px-6 py-4">
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                <?php echo $oudeprijs . ' € ' . $job->product_nieuwprijs; ?>
            </span>
        </div>
    </div>
    <div class="absolute bottom-0 right-0">
    </div>
</form>
<?php

    }
endforeach;

if (isset($_GET['account_info'])) {
    include('account.php');
} elseif (isset($_GET['bestellingen'])) {
    include('account.php');
} elseif (isset($_GET['factuur'])) {
    include('account.php');
} elseif (isset($_GET['admin_bestellingen'])) {
    include('admin.php');
} elseif (isset($_GET['producten'])) {
    include('admin.php');
} elseif (isset($_GET['id'])) {
    include('product_page.php');
}

?>


<?php include_once './inc/footer.php' ?>
