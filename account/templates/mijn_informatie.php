<div class="info w-full max-w-screen-lg px-10">
    <h1 class="font-bold text-2xl py-6">U informatie</h1>
    <h2 class="font-semibold text-l">Persoonlijke informatie</h2>
    <div class="w-full border-b-2 h-2 border-gray-400">
    </div>
    <div class="flex py-6 pb-10">
        <div class="w-1/3 pr-10 hidden md:block">
            <p class="text-gray-700 text-sm">U kunt hier alle informatie over u zelf wijzigen!<br><b>*LET
                    OP dat u adres klopt met uw woonadres voorals u een product koopt!</br></p>
        </div>
        <div class="md:w-2/3 w-full">
            <form method="post">
                <div class="flex pb-2">
                    <label class="w-1/2 max-w-xs font-semibold text-gray-700">Naam:</label>
                </div>
                <div class="flex">
                    <input type="text" name="naam"
                        class="appearance-none max-w-xs w-3/4 rounded-lg py-2 px-4 bg-gray-200 text-gray-600 font-semibold border-2 border-gray-400"
                        value="<?= $GetUserData->username; ?>">
                </div>
                <div class="flex pb-2">
                    <label class="w-1/2 max-w-xs font-semibold text-gray-700">Telefoon nummer:</label>
                </div>
                <div class="flex">
                    <input type="text" name="nmr"
                        class="appearance-none max-w-xs w-3/4 rounded-lg py-2 px-4 bg-gray-200 text-gray-600 font-semibold border-2 border-gray-400"
                        value="<?= $GetUserData->nmr; ?>">
                </div>
                <div class="flex pt-4 py-2">
                    <label class="sm:w-1/2 max-w-xs w-2/3 font-semibold text-gray-700">Straatnaam:</label>
                    <label
                        class="sm:w-1/2 max-w-xs w-1/3 lg:pl-2 sm:pl-3 pl-1 text-gray-700 font-semibold">Huisnmr.:</label>
                </div>
                <div class="flex w-full">
                    <input type="text" name="straatnaam"
                        class="appearance-none max-w-xs sm:w-1/2 w-2/3 rounded-lg py-2 px-4 text-gray-600 bg-gray-200 font-semibold border-2 border-gray-400"
                        value="<?= $GetUserData->straatnaam; ?>" required>
                    <input type="text" name="huisnummer"
                        class="appearance-none max-w-xs sm:w-1/2 w-1/3 rounded-lg py-2 px-4 ml-4 bg-gray-200 text-gray-600 font-semibold border-2 border-gray-400"
                        value="<?= $GetUserData->huisnummer; ?>" required>
                </div>
                <div class="flex pt-4 py-2 w-full">
                    <label class="w-1/2 max-w-xs font-semibold text-gray-700">Postcode:</label>
                    <label class="w-1/2 max-w-xs lg:pl-2 sm:pl-3 pl-2 font-semibold text-gray-700">Plaatsnaam:</label>
                </div>
                <div class="flex w-full">
                    <input type="text" name="postcode"
                        class="appearance-none max-w-xs w-1/2 rounded-lg py-2 px-4 bg-gray-200 text-gray-600 font-semibold border-2 border-gray-400"
                        value="<?= $GetUserData->postcode; ?>" required>
                    <input type="text" name="plaatsnaam"
                        class="appearance-none max-w-xs w-1/2 rounded-lg py-2 px-4 ml-4 bg-gray-200 text-gray-600 font-semibold border-2 border-gray-400"
                        value="<?= $GetUserData->plaatsnaam; ?>" required>
                </div>
                <button name="wijzig_info"
                    class="btn btn-primary bg-blue-600 text-white font-semibold py-2 px-6 rounded mt-6">Opslaan</button>
            </form>
        </div>

    </div>
    <h2 class="font-semibold text-l">Email adres</h2>
    <div class="w-full border-b-2 h-2 border-gray-400">
    </div>
    <div class="flex py-6 pb-10">
        <div class="w-1/3 pr-10 hidden md:block">
            <p class="text-gray-700 text-sm">U kunt hier u email adres wijzigen! Hier worden alle emails naar
                toegestuurd.</p>
        </div>
        <div class="md:w-2/3 w-full">
            <form method="post">
                <div class="flex pb-2">
                    <label class="md:w-1/2 md:max-w-xs max-w-md font-semibold text-gray-700">Email:</label>
                </div>
                <div class="flex">
                    <input type="email" name="email"
                        class="appearance-none md:w-1/2 md:max-w-xs max-w-md rounded-lg py-2 px-4 text-gray-600 bg-gray-200 font-semibold border-2 border-gray-400"
                        value="<?= $GetUserData->email; ?>" required>
                </div>

                <button name="wijzig_email"
                    class="btn btn-primary bg-blue-600 text-white font-semibold py-2 px-6 rounded mt-6">Opslaan</button>
            </form>
        </div>

    </div>
    <h2 class="font-semibold text-l">Wachtwoord</h2>
    <div class="w-full border-b-2 h-2 border-gray-400">
    </div>
    <div class="flex py-6 pb-10">
        <div class="w-1/3 pr-10 hidden md:block">
            <p class="text-gray-700 text-sm">U kunt hier u wachtwoord wijzigen!<b><br>*LET OP dat u een
                    wachtwoord
                    kiest die u niet voor alles gebruikt!</b></p>
        </div>
        <div class="md:w-2/3 w-full">
            <form method="post" autocomplete="off">
                <div class="flex pb-2">
                    <label class="md:w-1/2 md:max-w-xs max-w-md font-semibold text-gray-700">Nieuw
                        wachtwoord:</label>
                </div>
                <div class="flex">
                    <input type="password" name="password"
                        class="appearance-none md:w-1/2 md:max-w-xs max-w-md rounded-lg py-2 px-4 bg-gray-200 font-semibold border-2 border-gray-400 text-gray-600"
                        required>
                </div>
                <div class="flex pb-2 pt-4">
                    <label class="md:w-1/2 md:max-w-xs max-w-md font-semibold text-gray-700">Herhaal
                        nieuw
                        wachtwoord:</label>
                </div>
                <div class="flex">
                    <input type="password" name="herhaal_password"
                        class="appearance-none md:w-1/2 md:max-w-xs max-w-md rounded-lg py-2 px-4 bg-gray-200 font-semibold border-2 border-gray-400 text-gray-600"
                        required>
                </div>
                <button name="wijzig_password"
                    class="btn btn-primary bg-blue-600 text-white font-semibold py-2 px-6 rounded mt-6">Opslaan</button>
            </form>
        </div>

    </div>

</div>
