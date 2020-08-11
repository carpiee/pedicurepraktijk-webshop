<?php

$bestellingen = new Bestellingen();
$getbestellingen = $bestellingen->RenderBestellingen(); 
$checkbestelling = $bestellingen->CheckIfBestellingenExist();

$title = 'Mijn bestellingen';
?>


<div class="w-full rounded-t-lg py-4 px-2 flex justify-center">
    <span class="relative w-full max-w-md md:mr-12 focus:outline-none text-gray-600">
        <span class="absolute inset-y-0 left-0 pl-2 py-2">
            <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                <path class="heroicon-ui"
                    d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
            </svg>
        </span>
        <input
            class="block border-2 border-gray-300 bg-white font-semibold leading-5 py-2 w-full rounded-lg pl-10 pr-5 text-md"
            type="text" autocomplete="off" placeholder="zoek naar een bestelling/factuur..." />
    </span>
</div>
<div class="flex w-full overflow-x-auto scrolling-auto">
    <div class="w-full flex-1 rounded-lg mx-auto container max-w-screen-lg relative h-auto bg-white">
        <table class="producten" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr class="border-b border-gray-500 bg-gray-200 max-w-screen-md">
                <th class="pt-1 pl-6 pb-3 text-left font-semibold" align="left">Product naam</th>
                <th class="pt-1 pl-6 pb-3 text-left font-semibold" align="left">Gebruikt</th>
                <th class="pt-1 pl-6 pb-3 text-left font-semibold" align="left">Bon code</th>
                <th class="pt-1 pl-6 pb-3 text-left font-semibold" align="left">Factuur</th>
            </tr>
            <?php
                if($checkbestelling){
                    foreach($getbestellingen as $bestelling){
                        if(!empty($bestelling->aankoop_id)){
                            $link = "https://www.pedicurepraktijkpapendrecht.nl/webshop/download.php?email=".$_SESSION['email']."&id=".$bestelling->aankoop_id."&bon=".$bestelling->bon;
                        }else{
                            $link = '';
                        }                        
                        echo '<tr >';
                        echo '<td class="text-left">'.$bestelling->bon.'</td>';
                        echo '<td class="text-left">';
                        if($bestelling->gebruikt ==='nee'){
                            echo'<p class="text-red-700">';
                        }else{
                            echo'<p class="text-green-700">';
                        } 
                        echo $bestelling->gebruikt; 
                        echo'</p></td>';
                        echo '<td class="pl-6 py-4 text-left"><a class="underline" href="'.$link.'">'.$bestelling->aankoop_id.'</a></td>';
                        echo '<td class="pl-6 py-4 sm:pr-0 pr-6 text-left"><a class="underline" href="?factuur='.$bestelling->factuur_id.'">'.$bestelling->factuur_id.'</a></td></tr>';

                    } 
                }else{
                    echo'<tr><td colspan="4"><h1 class="text-center font-bold">U heeft nog geen bestellingen</h1></td></tr>';
                }
                    
                ?>
        </table>
    </div>
</div>
