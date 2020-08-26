<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="google-site-verification" content="poofw779AXX9ijpwPltTpOcACdMtsMkdZTDZviEa8kI" />
    <meta name="robots" content="index, follow" />
    <link rel="shortcut icon" href="https://www.pedicurepraktijkpapendrecht.nl/webshop/images/favicon.ico"
        type="image/x-icon" />
    <meta property="og:description" content="De pedicure webshop met cadeau bonnen en andere producten." />
    <meta property="og:title" content="Webshop - Pedicurepraktijk Papendrecht" />
    <meta property="fb:app_id" content="1612528282242884" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="webshop - Pedicurepraktijk Papendrecht" />
    <meta property="og:image" content="https://www.pedicurepraktijkpapendrecht.nl/webshop/img/thumbnail.JPG" />
    <meta property="og:url" content="https://www.pedicurepraktijkpapendrecht.nl/webshop/index.php" />
    <meta name="description" content="De pedicure webshop met cadeau bonnen en andere producten." />
    <meta name="keywords"
        content="webshop, cadeau, cadeaubon, producten, nagellak, tegoedbon, pedicure, <papendrecht>, pedicure papendrecht, <pedicurepraktijk papendrecht>, nagels, ambulant, provoet, voet, voeten, voetreflex, voetreflextherapeut" />
    <link rel="”canonical”" href="https://www.pedicurepraktijkpapendrecht.nl/" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://www.pedicurepraktijkpapendrecht.nl/webshop/css/product.css" />
    <title>Login - Pedicurepraktijk Papendrecht</title>
</head>

<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-lg w-full px-6">
            <a href="https://www.pedicurepraktijkpapendrecht.nl/webshop">
                <img class="w-1/3 mx-auto w-auto" src="https://www.pedicurepraktijkpapendrecht.nl/images/logo.jpg"
                    alt="Pedicurepraktijk Papendrecht">
            </a>
            <p class="my-4 leading-5 text-center text-sm text-gray-900">Login om te kunnen shoppen</p>
            <form action="index.php" method="post">
                <div>
                    <div class="<?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <input type="username" name="username"
                            class="appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-t-md focus:shadow-outline focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                            placeholder="Uw naam" required>
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>
                    <div class="-mt-px <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <input type="password" name="password"
                            class="appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-b-md focus:shadow-outline focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                            placeholder="Wachtwoord" required>
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="mt-5">
                        <input type="submit" value="Login"
                            class="appearance-none cursor-pointer w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="text-center my-4">
                        <a href="https://www.pedicurepraktijkpapendrecht.nl/webshop/account/registreer/">Nog geen
                            account? Maak nu een account aan.</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>