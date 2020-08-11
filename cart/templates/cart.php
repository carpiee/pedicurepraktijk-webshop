<?php


?>

<div id="demo">
    <div class="step-app max-w-3xl mx-auto">
        <ul class="step-steps ">
            <li>
                <a href="#tab1"><span class="number">1</span>Winkelwagen</a>
            </li>
            <li>
                <a href="#tab2"><span class="number">2</span>Bezorg opties</a>
            </li>
            <li>
                <a href="#tab3"><span class="number">3</span>Afrekenen</a>
            </li>
        </ul>
        <div class="step-content">
            <div class="step-tab-panel max-w-3xl mx-auto" id="tab1">
                <div class="w-full max-w-xl h-auto flex flex-wrap mx-auto overflow-hidden bg-gray-200">
                    <div class="py-5 px-5 border border-b-1 w-full">
                        <h2 class="font-bold text-2xl">Uw winkelwagen</h2>
                    </div>
                    <?php echo $cartOutput; ?>
                </div>
                <div class="w-full max-w-xl h-auto flex flex-wrap mx-auto overflow-hidden bg-gray-200">
                    <?php echo '<div class="ml-auto px-4 pt-2 font-bold">Totaal bedrag: &euro; '.$niewtot.'</div>' ?>
                </div>
                <div class="px-4 py-6 w-full max-w-xl h-auto flex justify-between mx-auto overflow-hidden bg-gray-200">
                    <a class="py-2 px-4 rounded-lg border-2 border-white font-semibold hover:bg-white hover:text-gray-700"
                        href="./">Verder met
                        winkelen <span class="font-extrabold">&#62;</span></a>
                </div>
            </div>
            <div class="step-tab-panel max-w-3xl mx-auto" id="tab2">
                <div class="w-full max-w-xl h-auto flex flex-wrap mx-auto overflow-hidden bg-gray-200 px-6 py-6">
                    <h3 class="font-bold text-2xl mb-4">Bezorg opties</h3>
                    <p>
                        <b>Wij bezorgen alléén binnen Papendrecht!</b>...bezorging is gratis.<br /><br />
                        Producten die door de brievenbus passen bezorgen wij binnen 3
                        werkdagen.<br />
                        Voor het bezorgen van producten die niet door de brievenbus passen
                        nemen wij telefonisch contact met u op om een levermoment met u af
                        te spreken.<br /><br />
                        <u>Voor levering buiten Papendrecht</u> kijken wij graag met u naar de
                        mogelijkheden om producten te leveren. Neem daarvoor telefonisch
                        contact met ons op; 06-36176087.
                    </p>
                </div>
            </div>
            <div class="step-tab-panel max-w-3xl mx-auto" id="tab3">
                <div class="w-full max-w-xl h-auto flex flex-wrap mx-auto overflow-hidden bg-gray-200 px-6 py-6">
                    <h3 class="font-bold text-2xl mb-4">Afrekenen</h3>
                    <div class="w-full h-64 flex items-center justify-center">
                        <a href="?nu_betalen"
                            class="cursor-pointer bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Nu
                            afrekenen</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="step-footer flex justify-center">
            <button data-direction="prev" class="step-btn mr-4">Vorige stap</button>
            <button data-direction="next" class="step-btn">Volgende stap</button>
        </div>
    </div>
</div>
