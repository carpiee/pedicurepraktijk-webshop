<?php
require_once("./vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable("./");
$dotenv->load();
\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
$cart = new Cart();
$header = new Cms();
$product = new Producten();
$content = $header->GetContent();


$cartOutput = "";
$cartTotal = "0";
$pp_checkout_btn = '';
$product_id_array = '';

if (isset($_GET['betalen'])) {
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: https://www.pedicurepraktijkpapendrecht.nl/webshop/account/login/");
        exit;
    } else {
        $naam = $_GET['betalen'];
        $wasFound = false;
        $i = 0;
        if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
            $_SESSION["cart_array"] = array(0 => array("item_naam" => $naam, "quantity" => 1));
        } else {
            foreach ($_SESSION["cart_array"] as $each_item) {
                $i++;
                while (list($key, $value) = each($each_item)) {
                    if ($key == "item_naam" && $value == $naam) {
                        $checkvoorraad = $product->GetPerProductInfo($each_item['item_naam']);
                        if ($each_item['quantity'] < $checkvoorraad->voorraad) {
                            array_splice($_SESSION["cart_array"], $i - 1, 1, array(array("item_naam" => $naam, "quantity" => $each_item['quantity'] + 1)));
                        } else {
                            echo '<script>alert("De voorraad is: " + ' . $max_voorraad . ' + ". Hellaas kunt u niet meer dan de voorraad bestellen.")</script>';
                        }
                        $wasFound = true;
                    }
                }
            }
            if ($wasFound == false) {
                array_push($_SESSION["cart_array"], array("item_naam" => $naam, "quantity" => 1));
            }
        }
        header("location: ?cart");
        exit();
    }
}

if (isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != "") {
    $checkvoorraad = $product->GetPerProductInfo($_POST['item_to_adjust']);
    if ($checkvoorraad->voorraad == null) {
        $max_voorraad = '100';
    } else {
        $max_voorraad = $checkvoorraad->voorraad;
    }
    $quantity = $_POST['quantity'];
    $quantity = preg_replace('#[^0-9]#i', '', $quantity); // filter everything but numbers
    if ($quantity >= $max_voorraad) {
        $quantity = $max_voorraad;
        echo '<script>alert("De voorraad is: " + ' . $max_voorraad . ' + ". Hellaas kunt u niet meer dan de voorraad bestellen.")</script>';
    }
    if ($quantity < 1) {
        $quantity = 1;
    }
    if ($quantity == "") {
        $quantity = 1;
    }
    $i = 0;
    foreach ($_SESSION["cart_array"] as $each_item) {
        $i++;
        while (list($key, $value) = each($each_item)) {
            if ($key == "item_naam" && $value == $_POST['item_to_adjust']) {
                array_splice($_SESSION["cart_array"], $i - 1, 1, array(array("item_naam" => $_POST['item_to_adjust'], "quantity" => $quantity)));
            }
        }
    }
}

if (isset($_POST['index_to_remove']) && $_POST['index_to_remove'] != "") {
    $key_to_remove = $_POST['index_to_remove'];
    if (count($_SESSION["cart_array"]) <= 1) {
        unset($_SESSION["cart_array"]);
    } else {
        unset($_SESSION["cart_array"]["$key_to_remove"]);
        sort($_SESSION["cart_array"]);
    }
}


if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $cartOutput = "<h2 align='center'>Your shopping cart is empty</h2>";
    header('location: index.php');
} else {
    $i = 0;
    foreach ($_SESSION["cart_array"] as $each_item) {
        $productinfo = $product->GetPerProductInfo($each_item['item_naam']);
        $product_name = $productinfo->product_naam;
        $product_namedis = $productinfo->product_naamdis;
        $price = str_replace('.', '', $productinfo->product_nieuwprijs);
        $details = $productinfo->product_disc;
        $product_img = $productinfo->product_img;
        $pricetotal = ($price / 100) * $each_item['quantity'];
        $cartTotal = $pricetotal + $cartTotal;
        $niewtot = number_format($cartTotal, 2, ',', '');
        setlocale(LC_MONETARY, "en_US");
        $x = $i + 1;
        $pp_checkout_btn .= '<input type="hidden" name="item_name_' . $x . '" value="' . $product_name . '">
        <input type="hidden" name="amount_' . $x . '" value="' . $price . '">
        <input type="hidden" name="quantity_' . $x . '" value="' . $each_item['quantity'] . '">  ';
        $product_id_array .= "$product_name-" . $each_item['quantity'] . ",";
        $cartOutput .= '<div class="flex flex-wrap justify-center px-4 md:px-2 py-4 border-b-2 border-r-0 border-l-0 mr-auto">';
        $cartOutput .= '';
        $cartOutput .= '<div class="flex"><div class="mr-6 ml-2 w-1/2 lg:pt-1 pt-3"><img style="max-height:150px;" class="w-auto h-auto" src=".' . $product_img . '"></div>';
        $cartOutput .= '<div class="block w-1/2 pt-4 mr-8 mx-auto text-left"><a href="product/?naam=' . $product_namedis . '">' . $product_namedis . '</a></div></div>';
        $cartOutput .= '<div class="w-1/2"></div><div class="mx-auto flex w-full md:w-1/2 mr-4"><form class="py-3" action="?cart" method="post"><input class="block cursor-pointer bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mr-4 rounded focus:outline-none focus:shadow-outline" name="deleteBtn' . $product_name . '" type="submit" value="Verwijder" /><input name="index_to_remove" type="hidden" value="' . $i . '" /></form><form class="flex pt-3 w-1/2" action="?cart" method="post">
            <input class="max-w-sm w-3/4 h-10 mr-4 appearance-none relative block px-4 py-2 border border-gray-300 rounded-md focus:shadow-outline focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-3" name="quantity" type="number" min="1" value="' . $each_item['quantity'] . '" size="1" maxlength="2" />
            <input class="h-10 cursor-pointer bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" name="adjustBtn' . $product_namedis . '" type="submit" value="Opslaan" />
            <input name="item_to_adjust" type="hidden" value="' . $product_namedis . '" />
            </form></div>';
        $cartOutput .= '</div>';
        $i++;
    }
    if (isset($_GET['nu_betalen'])) {
        $bon = '';
        $CHECKOUT_SESSION_ID = '115413';
        $aantal = $_SESSION["cart_array"];
        $email = $_SESSION['email'];
        $productinfo = $product->GetPerProductInfoByName($product_name);
        $prijsbf = $productinfo->product_nieuwprijs;
        $img = $productinfo->product_img;
        $prijs = str_replace(".", "", $prijsbf);
        $disc = $productinfo->product_disc;
        $betaalprijs = ($cartTotal * 100);
        $aantal = "";
        $kopen = array();
        $index = 0;
        foreach ($_SESSION['cart_array'] as $item_aantal_count) {
            $checkprijs = $product->GetPerProductInfo($item_aantal_count["item_naam"]);
            $img_per = $checkprijs->product_img;
            if ($checkprijs->voorraad > 0) {
                $prijsforeach = str_replace(".", "", $checkprijs->product_nieuwprijs);
                $bon = trim($item_aantal_count['item_naam'] . ',' . $bon, ',');
                $aantal = trim($item_aantal_count['quantity'] . ',' . $aantal, ',');
                $string = (strlen($checkprijs->product_disc) > 13) ? substr($checkprijs->product_disc, 0, 150) . '...' : $checkprijs->product_disc;
                $kopen[] = [
                    'name' => $checkprijs->product_naamdis,
                    'description' => $string,
                    'images' => ['https://www.pedicurepraktijkpapendrecht.nl/webshop' . $img_per],
                    'amount' => $prijsforeach,
                    'currency' => 'eur',
                    'quantity' => $item_aantal_count['quantity'],
                ];
            } else {
                unset($_SESSION["cart_array"][$index]);
                echo '<script>console.log("' . $index . '");</script>';
                echo '<script>alert("Helaas had u een item in u winkelwagen die niet opvoorraad is op dit moment! Het item is verwijderd uit u winkelwagen."); window.location.href="cart.php";</script>';
            }
            $index++;
        }
        $session = \Stripe\Checkout\Session::create([
            'customer_email' => $email,
            'payment_method_types' => ['ideal'],
            'line_items' => [$kopen],
            'success_url' => 'https://www.pedicurepraktijkpapendrecht.nl/webshop/cadeau.php?session_id={CHECKOUT_SESSION_ID}' . '&bon=' . $bon . '&aantal=' . $aantal . '&email=' . $email . '&name=' . $_SESSION["username"],
            'cancel_url' => 'https://www.pedicurepraktijkpapendrecht.nl/webshop/index.php?cancel',
        ]);
        $stripeSession = array($session);
        $sessId = ($stripeSession[0]['id']);
    }
}
require_once './inc/header.php';
include './cart/templates/cart.php';

?>
<div class="my-48 container w-full max-w-7xl mx-auto">
    <?php require_once('./inc/feed.html') ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="./js/jquery-steps.js"></script>
<script src="./js/server.js"></script>
<?php if(isset($_GET['nu_betalen'])): ?>
<script type="text/javascript">
var ssId = "<?php echo $sessId; ?>";
const checkout_Id = (ssId);
stripe.redirectToCheckout({
    sessionId: checkout_Id
}).then(function(result) {

});
</script>
<?php endif; ?>
<script type="text/javascript">
$("#demo").steps({
    onChange: function(currentIndex, newIndex, stepDirection) {
        // step2
        if (currentIndex === 1) {
            if (stepDirection === "forward") {}
            if (stepDirection === "backward") {}
        }
        // step4
        if (currentIndex === 3) {
            if (stepDirection === "forward") {}
            if (stepDirection === "backward") {}
        }
        // step5
        if (currentIndex === 4) {
            if (stepDirection === "forward") {}
            if (stepDirection === "backward") {}
        }
        return true;
    },
    onFinish: function() {
        alert("Wizard Completed");
    },
});
</script>
<footer>
    <div class="container w-full max-w-7xl mx-auto bg-white">
        <?php require_once('./inc/footer.html') ?>
    </div>
</footer>