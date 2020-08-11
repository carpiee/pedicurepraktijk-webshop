<?php

$Allesbestellingen = $cms->RenderBestellingen();
if (isset($_POST['id']) && ($_POST['verander'])) {
    $cms->EditBestelling($_POST['id'], $_POST['verander']);
}
?>


<div class="w-full rounded-t-lg py-4 px-2 mt-10 flex justify-center">
    <span class="relative w-full max-w-md md:mr-12 focus:outline-none text-gray-600">
        <span class="absolute inset-y-0 left-0 pl-2 py-2">
            <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                <path class="heroicon-ui"
                    d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
            </svg>
        </span>
        <input
            class="block border-2 border-gray-300 bg-white font-semibold leading-5 py-2 w-full rounded-lg pl-10 pr-5 text-md"
            type="text" name="filter" autocomplete="off" placeholder="zoek naar een bestelling/factuur..." />
    </span>
</div>
<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 mb-20 overflow-x-auto">
    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden bg-white">
        <table class="producten min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-no-wrap">
                        Product Naam
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-no-wrap">
                        Gebruikt/Afgeleverd
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-no-wrap">
                        Bon code
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-no-wrap">
                        Factuur
                    </th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($Allesbestellingen as $bestelling) {
                    if ($bestelling->gebruikt == 'nee') {
                        $select1 = 'nee';
                        $select2 = 'ja';
                    } elseif ($bestelling->gebruikt == 'ja') {
                        $select2 = 'nee';
                        $select1 = 'ja';
                    }
                    $kleur = $bestelling->gebruikt === 'nee' ? 'text-red-700' : 'text-green-700';
                    $edit_gebruikt = '<div class="flex ' . $kleur . '"><div class="inline-flex relative mr-4" id="test"><select id="' . $bestelling->id . '" class="gebruikt block appearance-none w-auto max-w-xs bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" onchange="edit_gebruikt(' . $bestelling->id . ')"><option value="' . $select1 . '">' . $select1 . '</option><option value="' . $select2 . '">' . $select2 . '</option></select><div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
      </div></div><input onchange="edit_date(' . $bestelling->id . ')" class="text-gray-900" type="date" id="datum-' . $bestelling->id . '" name="datum" value="' . $bestelling->updated_at . '"></div>';
                    $bestel = $users->GetUserLoggedInInfo($bestelling->klant_name);
                    $link = '';
                    if (!empty($bestelling->aankoop_id)) {
                        $link = "https://www.pedicurepraktijkpapendrecht.nl/webshop/download.php?email=" . $bestel->email . "&id=" . $bestelling->aankoop_id . "&bon=" . $bestelling->bon;
                    }
                    $singleProduct = $producten->GetPerProductInfoByName($bestelling->bon);
                    echo '<tr class="product" data-id="' . $bestelling->klant_name . $bestelling->aankoop_id . $bestelling->factuur_id . $bestelling->gebruikt . $bestelling->updated_at . '">';
                    echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><div class="flex items-center"><div class="flex-shrink-0 w-10 h-10"><img src="https://www.pedicurepraktijkpapendrecht.nl/webshop/' . $singleProduct->product_img . '" class="w-full h-full rounded-full"></div><div class="ml-3"><p class="text-gray-900 whitespace-no-wrap">' . $bestelling->bon . '</p></div></div></td>';
                    echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">';
                    // if ($bestelling->gebruikt === 'nee') {
                    //     echo '<p class="text-red-700">';
                    // } else {
                    //     echo '< class="text-green-700">';
                    // }
                    echo $edit_gebruikt . '</td>';
                    echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><a class="underline" href="' . $link . '">' . $bestelling->aankoop_id . '</a></td>';
                    echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><a class="underline" href="?factuur=' . $bestelling->factuur_id . '">' . $bestelling->factuur_id . '</a></td></tr>';
                }

                ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
$(':input[name=filter]').on('input', function() {
    var val = this.value.toLowerCase();
    $('.producten').find('.product').filter(function() {
            return $(this).data('id').toLowerCase().indexOf(val) > -1;
        })
        .show()
        .end().filter(':visible')
        .filter(function() {
            return $(this).data('id').toLowerCase().indexOf(val) === -1;
        })
        .fadeOut();

});

function edit_date(id) {
    var datumInput = $("#datum-" + id);
    var date = new Date($("body").find(datumInput).val());
    day = date.getDate();
    month = date.getMonth() + 1;
    year = date.getFullYear();
    var datum = [year, month, day].join('/');
    $.ajax({
        url: './fetch.php',
        type: 'post',
        data: {
            datum: datum,
            id: id
        },
        cache: false,
        success: function() {},
    });
}

function edit_gebruikt(id) {
    const gebruikt = document.getElementById(id)[1];
    const verander = gebruikt.innerText;
    $.ajax({
        url: './fetch.php',
        type: 'post',
        data: {
            id: id,
            verander: verander,
        },
        cache: false,
        success: function() {},
    });

}
</script>
