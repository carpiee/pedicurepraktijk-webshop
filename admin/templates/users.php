<?php
$allUsers = $cms->GetAllUsers();

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
            type="text" name="filter" autocomplete="off" placeholder="zoek naar een Gebruiker..." />
    </span>
</div>
<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 mb-20 overflow-x-auto">
    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden bg-white">
        <table class="users min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-no-wrap">
                        Klant Naam
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-no-wrap">
                        Bestellingen
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-no-wrap">
                        Aantal aankopen
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-no-wrap">
                        Laatst bestel op
                    </th>
                </tr>
            </thead>
            <tbody>

                <?php

                foreach ($allUsers as $user) {
                    if (!in_array($user->username, $admins)) {
                        $aankoopCount = $cms->GetProductenByCustomer($user->username);
                        $getlast = $cms->GetProductenByCustomer($user->username);
                        $laatstBesteld = end($getlast);
                        $temp = [];
                        $i = 0;
                        foreach ($aankoopCount as $aankoop) {
                            $temp[] = $aankoop->factuur_id;
                            $i = count(array_unique($temp));
                        }
                        echo '<tr class="user show-info-user" name="' . $user->username . '" data-id="' . $user->username . '">';
                        echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><div class="flex items-center"><p class="text-gray-900 font-semibold whitespace-no-wrap">' . $user->username . '</p></div></td>';
                        echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><button id="' . $user->id . '">Bekijk alle bestellingen</button></td>';
                        echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><p>' . $i . '</p></td>';
                        echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">';
                        echo $getlast ? '<p>' . date("d-m-Y", strtotime($laatstBesteld->datum)) . '</p>' : '<p>Geen bestellingen</p>';
                        echo '</td></tr>';
                    }
                }

                ?>
            </tbody>
        </table>
    </div>
</div>
<?php if (isset($_GET['username'])) : ?>

<?php
    $orders = $cms->GetProductenByCustomer($_GET['username']);
    $userInfo = $cms->GetUserData($_GET['username'])
    ?>
<div class="info-modal-user fixed w-full h-screen left-0 top-0 z-20 flex items-center justify-center overflow-y-auto">
    <div class="info-modal-user-overlay opacity-25 bg-black absolute w-full h-screen top-0 left-0 cursor-pointer">
    </div>
    <div class="max-w-lg w-full bg-white shadow border rounded-lg overflow-hidden z-50 mb-24 lg:mb-0 lg:mt-24">
        <div class="flex flex-col">
            <div class="md:mt-0 mt-12 modal-header flex justify-center font-bold text-xl border-b-2 py-2">
                <h4><?= $_GET['username']; ?></h4>
            </div>
            <div class="px-4 py-6 h-full">
                <h2 class="font-bold text-xl">Persoonlijke gegevens</h2>
                <br />
                <p>
                    <?= $userInfo->straatnaam . ' ' . $userInfo->huisnummer; ?>
                </p>
                <p>
                    <?= $userInfo->postcode . ' ' . $userInfo->plaatsnaam; ?>
                </p>
                <br />
                <p class="mb-6 font-semibold text-lg">Alle gekochten producten</p>
                <div class="h-64 lg:h-48 pr-4 overflow-y-auto">
                    <?php foreach ($orders as $order) : ?>
                    <?php
                            $product = $cms->GetProductInfoByName($order->bon);
                            ?>
                    <div class="flex mb-4 items-center justify-between relative"><?php if ($order->gebruikt === 'ja') {
                                                                                                echo '<svg class="h-10 w-10 text-green-500 absolute" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>';
                                                                                            } ?><img
                            class="mr-2 rounded-full h-10 w-10"
                            src="https://www.pedicurepraktijkpapendrecht.nl/webshop/<?= $product->product_img; ?>">
                        <p class="flex-1"><?= $product->product_naamdis; ?></p><a
                            href="?factuur=<?= $order->factuur_id; ?>"><?= $order->factuur_id; ?></a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <a href="?users"
                class="block btn text-center bg-gray-200 w-full font-semibold py-4 info-modal-user-button">Sluiten</a>
        </div>
    </div>
</div>
<?php endif; ?>
<script type="text/javascript">
$(document).ready(function() {
    function toggleUserModal() {
        $(".info-modal-user").toggleClass('opacity-0');
        $(".info-modal-user").toggleClass('pointer-events-none');
    }
    $(document).on('click', '.show-info-user', function() {
        var username = $(this).attr("name");
        window.location.href = '?users&username=' + username;
    });
    // const button1 = document.querySelector('.info-modal-user-button');
    // button1.addEventListener('click', window.location.href = '?users');

    // const overlay1 = document.querySelector('.info-modal-user-overlay');
    // overlay1.addEventListener('click', window.location.href = '?users');
    $(':input[name=filter]').on('input', function() {
        var val = this.value.toLowerCase();
        $('.users').find('.user').filter(function() {
                return $(this).data('id').toLowerCase().indexOf(val) > -1;
            })
            .show()
            .end().filter(':visible')
            .filter(function() {
                return $(this).data('id').toLowerCase().indexOf(val) === -1;
            })
            .fadeOut();

    });
});
</script>
