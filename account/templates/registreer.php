<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="google-site-verification" content="poofw779AXX9ijpwPltTpOcACdMtsMkdZTDZviEa8kI" />
        <meta name="robots" content="index, follow" />
        <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
        <link rel="icon" href="./images/favicon.ico" type="image/x-icon" />
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
        <title>Registreer - Pedicurepraktijk Papendrecht</title>
    </head>

    <body>
        <div class="min-h-screen flex items-center justify-center bg-gray-100">
            <div class="max-w-lg w-full px-6">
                <a href="https://www.pedicurepraktijkpapendrecht.nl/webshop">
                    <img class="w-1/3 mx-auto w-auto" src="https://www.pedicurepraktijkpapendrecht.nl/images/logo.jpg"
                        alt="Pedicurepraktijk Papendrecht">
                </a>
                <p class="my-4 leading-5 text-center text-sm text-gray-900">Maak een account om te kunnen shoppen</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div>
                        <div class="<?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <input type="username" name="username"
                                class="appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-t-md focus:shadow-outline focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                                placeholder="Uw naam" required>
                        </div>
                        <div class="-mt-px flex">
                            <input type="text" name="postcode"
                                class="w-1/2 appearance-none relative block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:shadow-outline focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                                placeholder="Postcode" required>
                            <input type="text" name="huisnummer"
                                class="w-1/2 appearance-none relative block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:shadow-outline focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                                placeholder="Huisnummer" required>
                            <span class="help-block">
                        </div>
                        <div class="-mt-px flex">
                            <input type="text" name="straatnaam"
                                class="appearance-none relative block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:shadow-outline focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                                placeholder="Straatnaam" required>
                            <span class="help-block">
                        </div>
                        <div class="-mt-px flex">
                            <input type="text" name="plaatsnaam"
                                class="appearance-none relative block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:shadow-outline focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                                placeholder="Plaatsnaam" required>
                            <span class="help-block">
                        </div>
                        <div class="-mt-px flex <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <input type="email" name="email"
                                class="appearance-none relative block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:shadow-outline focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                                placeholder="Email adres" required>
                            <span class="help-block">
                        </div>
                        <div class="-mt-px flex">
                            <input type="tel" name="nmr"
                                class="appearance-none relative block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:shadow-outline focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                                placeholder="Telefoon nummer" required>
                            <span class="help-block">
                        </div>
                        <div class="-mt-px flex <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <input type="password" name="password"
                                class="appearance-none relative block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:shadow-outline focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                                placeholder="Wachtwoord" required>
                            <span class="help-block">
                        </div>
                        <div class="-mt-px flex <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                            <input type="password" name="confirm_password"
                                class="appearance-none relative block w-full px-3 py-2 border border-gray-300 rounded-b-md focus:outline-none focus:shadow-outline focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"
                                placeholder="Herhaal wachtwoord" required>
                            <span class="help-block">
                        </div>
                        <div class="mt-5">
                            <input type="submit" value="Maak nu een account"
                                class="appearance-none cursor-pointer w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="text-center my-4">
                            <a href="https://www.pedicurepraktijkpapendrecht.nl/webshop/account/login/">Heeft u al een
                                account? Log nu in.</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </body>

</html>
