<?php
$getFactuur = new Factuur();
$producten = new Producten();
$factuurData = $getFactuur->GetFactuurInfo($_GET['factuur']);
$AllfactuurData = $getFactuur->GetAllFactuurData($_GET['factuur']);

if (isset($_GET['factuur']) && !empty($_GET['factuur'])) {
    $title = 'Mijn factuur: ' . $_GET['factuur'];


?>
<div id="print" class="flex flex-wrap px-6 pt-4 overflow-auto scrolling-auto w-full">
    <div class="block w-full">
        <div class="flex justify-center">
            <img style="width:auto; height:100px;" src="https://www.pedicurepraktijkpapendrecht.nl/images/logo.jpg">
        </div>
        <h1 class="font-bold text-3xl">Factuur</h1>
        <div class="flex flex-wrap justify-between">

            <div class="mr-auto flex">
                <div class="block">
                    <div><span>Klant:</span></div>
                    <div><span>Email:</span></div>
                    <div><span>Factuur nr.: </span></div>
                    <div><span>Datum: </span></div>
                </div>
                <div class="block">
                    <span style="display:block;"><?= $GetUserData->username; ?></span>
                    <a style="display:block;"><?= $GetUserData->email; ?></a>
                    <span style="display:block;" id="factuurnmr"><?= $GetUserData->nmr; ?></span>
                    <span style="display:block;"><?= $factuurData->datum; ?></span>
                </div>
            </div>


            <div class="sm:mt-0 mb-4 mt-4">
                <div>Pedicurepraktijk Papendrecht</div>
                <div>Rembrandtlaan 18,</div>
                <div>3351RH, Papendrecht</div>
                <div>06 - 36176087</div>
                <div><a>info@pedicurepraktijkpapendrecht.nl</a></div>
            </div>
        </div>

    </div>
    <div class="block w-full">
        <table class="factuur">
            <thead>
                <tr>
                    <th style="text-align: left;">Beschrijving</th>
                    <th style="text-align: left;">Prijs</th>
                    <th style="text-align: middle;">Aantal</th>
                    <th style="text-align: right;">Totaal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $subtotaal = "0";
                    $bon = '';
                    foreach ($AllfactuurData as $item) {
                        $bon = trim($item->bon . ',' . $bon, ',');
                    }
                    $product = explode(",", $bon);
                    $productlast = array_unique(array_map(function ($val) {
                        return $val;
                    }, $product));
                    foreach ($productlast as $product2) {
                        $productInfo = $producten->GetPerProductInfoByName($product2);
                        $prodnaam = $productInfo->product_naamdis;
                        $cat = $productInfo->cat;
                        $prijs = $productInfo->product_nieuwprijs / 1.21;
                        $count = $getFactuur->CountPerProduct($product2);
                        $aantal = (count($count));
                        $totaalper = $aantal * $prijs;
                        $subtotaal += $totaalper;
                    ?>
                <tr>
                    <td style="text-align: left;"><?php

                                                            $codesaantal = '';
                                                            foreach ($count as $codes) {
                                                                $codesaantal = trim($codes->aankoop_id . ', ' . $codesaantal, ', ');
                                                            }

                                                            echo $cat . ' ' . $prodnaam . ' ' . $codesaantal;
                                                            ?>
                    </td>
                    <td style="text-align: left;">&euro;<?= number_format($prijs, 2, '.', '') ?></td>
                    <td style="text-align: middle;"><?= $aantal ?></td>
                    <td style="text-align: right;">&euro;<?= number_format($totaalper, 2, '.', '') ?></td>
                </tr>
                <?php




                    }
                    $btw = ($subtotaal * 0.21);
                    $eindtotaal = $subtotaal + $btw;
                    ?>
                <tr>
                    <td colspan="3" style="text-align: right;">Totaal excl. BTW</td>
                    <td style="text-align: right;">&euro;<?= number_format($subtotaal, 2, ".", "") ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;">BTW 21%</td>
                    <td style="text-align: right;">&euro;<?= number_format($btw, 2, ",", "") ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right;">Totaal incl. BTW</td>
                    <td style="text-align: right;">&euro;<?= number_format($eindtotaal, 2, ".", "") ?></td>
                </tr>
            </tbody>
        </table>
        <table width="100%" style="text-align:center; margin-top: 13px;">
            <div>KVK: 63256983, BTW: NL001640691B67, IBAN: NL37INGB0006844547</div>
        </table>
    </div>

</div>

<div class="w-10 h-10" id="editor">

</div>
<div class="p-1">
    <input class="cursor-pointer rounded-bl bg-blue-400 text-white py-2 px-4 sm:mb-0 mb-2 hover:bg-blue-700"
        type="button" value="Download factuur" id="download" onclick="generatePDF()">
    <input class="cursor-pointer bg-blue-400 text-white py-2 px-4 hover:bg-blue-700" type="button"
        value="Terug naar bestellingen" onclick="terug()">
</div>



<?php
} else {
    header('location: ?bestellingen');
}
?>
<script>
function terug() {
    window.location.href = "?bestellingen";
}

function generatePDF() {
    const element = document.getElementById("print");
    factuurnmr = document.getElementById("factuurnmr").innerHTML;
    // Choose the element and save the PDF for our user.
    var opt = {
        margin: 1,
        filename: 'factuur' + factuurnmr + '.pdf',
        image: {
            type: 'jpeg',
            quality: 1
        },
        html2canvas: {
            scale: 4
        },
        jsPDF: {
            format: 'a4'
        }
    };
    html2pdf()
        .set(opt)
        .from(element)
        .save();
}
</script>
