<?php


?>
<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 mt-10 mb-20 overflow-x-auto">
    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Bewerk
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Product Naam
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Oude Prijs
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        nieuwe Prijs
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Min. Voorraad
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Voorraad
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $products = $producten->GetAllProducten();
                foreach ($products as $product) :

                ?>
                <tr id="<?= $product->id; ?>">
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            <input
                                class="delete_product btn bg-red-600 text-white font-semibold py-2 px-4 mr-2 rounded cursor-pointer"
                                type="submit" name="delete" id="<?= $product->id; ?>" value="X">
                            <input id="<?= $product->id; ?>"
                                class="edit_product btn btn-primary bg-blue-600 text-white font-semibold py-2 px-4 rounded cursor-pointer"
                                type="submit" name="edit" value="Bewerk product">
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-10 h-10">
                                <img class="w-full h-full rounded-full object-cover"
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
                            <?= $product->product_oudeprijs; ?>
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            <?= $product->product_nieuwprijs; ?>
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            <?= $product->min_voorraad; ?>
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">
                            <?= $product->voorraad; ?>
                        </p>
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div id="add_data_Modal"
    class="modal opacity-0 pointer-events-none fixed w-full h-screen left-0 top-0 z-20 flex items-center justify-center overflow-y-auto">
    <div class="modal-overlay opacity-25 bg-black absolute w-full h-screen top-0 left-0 cursor-pointer">
    </div>
    <div class="modal-dialog bg-white shadow border rounded-lg overflow-hidden z-50 mb-24 lg:mb-0 lg:mt-24">
        <div class="modal-content">
            <div class="modal-header flex justify-center font-bold text-xl border-b-2 py-2">
                <h4 class="modal-title">Bewerk product</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form" class="px-4 py-6">
                    <label class="font-semibold">Enter product Name</label>
                    <input class="border px-4 py-2 w-full mt-2 mb-4 rounded-lg" type="text" name="prodname" id="name"
                        class="form-control" />
                    <br />
                    <label class="font-semibold">Enter product beschrijving</label>
                    <textarea class="border px-4 py-2 w-full mt-2 mb-4 rounded-lg" name="disc" id="disc"
                        class="form-control">
                    </textarea>
                    <br />
                    <label class="font-semibold">Enter product oude prijs</label>
                    <input class="border px-4 py-2 w-full mt-2 mb-4 rounded-lg" type="text" name="oudeprijs"
                        id="oudeprijs" class="form-control">
                    <br />
                    <label class="font-semibold">Enter product nieuwe prijs</label>
                    <input class="border px-4 py-2 w-full mt-2 mb-4 rounded-lg" type="text" name="nieuwprijs"
                        id="nieuwprijs" class="form-control">
                    <br />
                    <label class="font-semibold">Enter product minimale voorraad</label>
                    <input class="border px-4 py-2 w-full mt-2 mb-4 rounded-lg" type="number" name="min_voorraad"
                        id="min_voorraad" class="form-control">
                    <br />
                    <label class="font-semibold">Enter product voorraad</label>
                    <input class="border px-4 py-2 w-full mt-2 mb-4 rounded-lg" type="number" name="voorraad"
                        id="voorraad" class="form-control">
                    <br />
                    <input type="hidden" name="bewerk_product_id" id="bewerk_id" />
                    <input type="submit" name="insert" id="insert" value="Toevoegen"
                        class="btn bg-green-400 text-white font-semibold px-4 py-2 mt-4 cursor-pointer" />
                </form>
            </div>
            <div class="modal-footer border-t-2">
                <button type="button"
                    class="btn bg-gray-200 w-full font-semibold px-4 py-2 modal-button">Sluiten</button>
            </div>
        </div>
    </div>
</div>
<div id="succes"
    class="hidden fixed bottom-0 right-0 mb-10 mx-0 w-full rounded-lg bg-teal-100 shadow-lg px-4 py-2 max-w-sm">
    <div class="flex">
        <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <path
                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
            </svg></div>

        <div>
            <h1 class="font-bold text-teal-900 text-lg">Product is bijgewerkt!</h1>
            <p class="text-teal-900 text-md">Als u de pagina refresh dan worden de aanpassingen zichbaar.</p>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    function toggleModal() {
        const modal = document.querySelector('.modal');
        modal.classList.toggle('opacity-0');
        modal.classList.toggle('pointer-events-none');
    }
    const button = document.querySelector('.modal-button');
    button.addEventListener('click', toggleModal);

    const overlay = document.querySelector('.modal-overlay');
    overlay.addEventListener('click', toggleModal);
    $(document).on('click', '.edit_product', function() {
        var employee_id = $(this).attr("id");
        $.ajax({
            url: "./fetch.php",
            method: "POST",
            data: {
                employee_id: employee_id
            },
            dataType: "json",
            success: function(data) {
                $('#name').val(data.product_naamdis);
                $('#disc').val(data.product_disc);
                $('#oudeprijs').val(data.product_oudeprijs);
                $('#nieuwprijs').val(data.product_nieuwprijs);
                $('#min_voorraad').val(data.min_voorraad);
                $('#voorraad').val(data.voorraad);
                $('#bewerk_id').val(data.id);
                $('#insert').val("Wijzigen");
                toggleModal();
            }
        });
    });
    $(document).on('click', '.delete_product', function(event) {
        var delete_id = event.target.id;;
        if (window.confirm('Weet u zeker dat u dit product wilt verwijderen?')) {
            $.ajax({
                url: "./fetch.php",
                method: "POST",
                data: {
                    delete_id: delete_id
                },
                success: function() {
                    $('#' + delete_id).fadeOut();
                }
            });
        }
    });
    $('#insert_form').on("submit", function(event) {
        event.preventDefault();
        if ($('#name').val() == "") {
            alert("Er moet een naam ingevuld zijn!");
        } else if ($('#nieuwprijs').val() == '') {
            alert("Er moet een nieuwe prijs ingevuld zijn!");
        } else if ($('#min_voorraad').val() == '') {
            alert("Er moet een minimale voorraad ingevuld zijn!");
        } else if ($('#voorraad').val() == '') {
            alert("Er moet een voorraad ingevuld zijn!");
        } else {
            $.ajax({
                url: "./update_product.php",
                method: "POST",
                data: $('#insert_form').serialize(),
                beforeSend: function() {
                    $('#insert').val("Inserting");
                },
                success: function(data) {
                    $('#insert_form')[0].reset();
                    toggleModal();
                    // location.reload();
                    $('#succes').fadeIn('fast').delay(5000).fadeOut('slow')
                }
            });
        }
    });
});
</script>
