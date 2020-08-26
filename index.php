<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once('./vendor/stripe/stripe-php/init.php');
require_once './config/init.php';
if (isset($_GET['cancel'])) {
    include './inc/cancel.html';
}

$producten = new Producten();
$products = $producten->GetAllProducten();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $login =  new Login;
    $user = $login->GetUserData($_SESSION['username']);
}

include './inc/header.php';
?>

<style>
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
<div class="max-w-7xl w-full h-full min-h-screen">
    <div class="container mx-auto px-4 py-10">

        <?php
        if (empty($_GET)) : ?>
        <div class="search-box">
            <div class="result grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-4">
                <?php require './templates/producten_view.php'; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php
        if (isset($_GET["cart"])) {
            include('./cart/index.php');
        }
        if (isset($_GET['betalen'])) {
            include('./cart/index.php');
        }
        if (isset($_GET["nu_betalen"])) {
            include('./cart/index.php');
        } elseif (isset($_GET['id'])) {
            header('location: product/?id=' . $_GET['id']);
        }
        ?>
    </div>
</div>
<div class="my-48 container w-full max-w-7xl mx-auto">
    <?php require_once('./inc/feed.html') ?>
</div>
<footer>
    <div class="container w-full max-w-7xl mx-auto bg-white">
        <?php require_once('./inc/footer.html') ?>
    </div>
</footer>


</script>

<?php if (isset($_GET['cancel'])) : ?>
<script type='text/javascript'>
toggleModal();

function close() {
    window.location.href = 'index.php';
}

const overlay = document.querySelector('.modal-overlay');
overlay.addEventListener('click', close);

var closemodal = document.querySelectorAll('.modal-close')
for (var i = 0; i < closemodal.length; i++) {
    closemodal[i].addEventListener('click', close);
}

document.onkeydown = function(evt) {
    evt = evt || window.event;
    var isEscape = false;
    if ('key' in evt) {
        isEscape = (evt.key === 'Escape' || evt.key === 'Esc');
    } else {
        isEscape = (evt.keyCode === 27);
    }
    if (isEscape && document.body.classList.contains('modal-active')) {
        close();
        return false;
    }
};


function toggleModal() {
    const body = document.querySelector('body');
    const modal = document.querySelector('.modal');
    modal.classList.toggle('opacity-0');
    modal.classList.toggle('pointer-events-none');
    body.classList.toggle('modal-active');

}
</script>
<?php endif; ?>
<script src="./js/server.js"></script>