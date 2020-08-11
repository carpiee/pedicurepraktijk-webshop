<?php
require('./vendor/autoload.php');
require_once './config/init.php';


\Stripe\Stripe::setApiKey('sk_live_1OWDuIFgyHZbB8hyaK0bcOOc00Tz8bw4cG');

// You can find your endpoint's secret in your webhook settings
$endpoint_secret = 'whsec_mDStEgjZ0PnP6fWXclrBFtI8e1Y0ibDR';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
  $event = \Stripe\Webhook::constructEvent(
    $payload,
    $sig_header,
    $endpoint_secret
  );
} catch (\UnexpectedValueException $e) {
  // Invalid payload
  http_response_code(400);
  exit();
} catch (\Stripe\Exception\SignatureVerificationException $e) {
  // Invalid signature
  http_response_code(400);
  exit();
}

// Handle the checkout.session.completed event
if ($event->type == 'checkout.session.completed') {
  $session = $event->data->object;


  // Fulfill the purchase...
  handle_checkout_session($session);
}
function generateRandomString($length = 10)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
function handle_checkout_session($session)
{
  $producten = new Producten();
  $bestellingen = new Bestellingen();
  $factuurs = new Factuur();
  $users = new Users();
  $i = 1;
  $successUrl = $session['success_url'];
  $parts = parse_url($successUrl);
  parse_str($parts['query'], $query);
  $session_id = $query['session_id'];
  $email = $query['email'];
  $aankoopcheck = $bestellingen->CheckIfBestellingenExistById($session_id);
  if ($aankoopcheck) {
    echo "<h1 class='gestuurd'>De email is al verstuurd!</h1>";
  } else {
    $oldFactuurNrm = $factuurs->SelectLastFactuurNummer();
    $factuurnrm = $oldFactuurNrm->nr;
    $newfk = $oldFactuurNrm->nr + 1;
    $factuurs->UpdateNewFactuurNummer($factuurnrm, $newfk);
    $datumgekocht = date("d/m/y");
    $from = 'info@pedicurepraktijkpapendrecht.nl';
    $subject = "Pedicurepraktijk Papendrecht bestelling";
    $message = "<html>
        <body>
            <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                    <td align='center'>
                        <h1 style='text-align:center;'>Bedankt voor uw aankoop.</h1>
                        ";
    $checkklant1 = $query["name"];
    $bonnen = array("voetreflex", "voetbehandeling", "moederdag_cadeaubon");
    $myString = $query['bon'];
    $myaantal = $query['aantal'];
    $bon = explode(',', $myString);
    $aantal = explode(',', $myaantal);
    foreach (array_combine($bon, $aantal) as $bon => $aantal) {
      $i++;
      if (in_array($bon, $bonnen)) {
        for ($i = 1; $i <= $aantal; $i++) {
          $aankoop_id = generateRandomString();
          $gebruikt = "nee";
          $bestellingen->MakeBestelling($aankoop_id, $checkklant1, $gebruikt, $bon, $session_id, $newfk);
          $message .= "<p style='text-align:center;'>U kunt de tegoedbon downloaden via deze link: https://www.pedicurepraktijkpapendrecht.nl/webshop/download.php?email=" . trim($email . "&id=" . $aankoop_id . "&bon=" . $bon) . "</p>";
        }
      } else {
        $gebruikt = "nee";
        $bestellingen->MakeBestelling('', $checkklant1, $gebruikt, $bon, $session_id, $newfk);
        $message .= "<p style='text-align:center;'>Uw product (" . $bon . ") wordt binnen 3 werkdagen bij u thuis geleverd!</p>";
        $voorraad_aantal = $producten->GetVoorraaad($bon);
        $update_voorraad = $voorraad_aantal->voorraad - $aantal;
        $producten->UpdateVoorraaad($bon, $update_voorraad);
        if ($update_voorraad < $voorraad_aantal->min_voorraad) {
          $to_voorraad      = 'info@pedicurepraktijkpapendrecht.nl';
          $subject_voorraad = 'Voorraad van ' . $bon . ' is beneden';
          $message_voorraad = 'De voorraad van ' . $bon . ' is lager dan ' . $voorraad_aantal['min_voorraad'];
          $headers_voorraad = 'From: info@pedicurepraktijkpapendrecht.nl' . "\r\n" .
            'Reply-To: info@pedicurepraktijkpapendrecht.nl' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

          mail($to_voorraad, $subject_voorraad, $message_voorraad, $headers_voorraad);
        }
      }
    }
    $klant = $users->GetUserLoggedInInfo($query["name"]);
    $message .= $klant->straatnaam . " " . $klant->huisnummer . "<br>" . $klant->postcode . " " . $klant->plaatsnaam . "<br>" . $klant->nmr;
    $message .= "<p style='margin-top: 45px;'>Om de tegoedbon te verzilveren en een afspraak in te plannen kunt u contact opnemen via <a href='tel:0636176087'>06 - 36176087</a></p>
                        <p style='text-align:center;'>Pedicure -en Voetreflexmassagepraktijk Papendrecht</p>
                    </td>
                </tr>
            </table>";
    $klant_naam = $klant->username;
    $klant_email = $klant->email;

    $message .= '<hr style="width:100%;margin-top: 27px;margin-bottom: 38px;"><table style="width:755px;" align="center">
        <div align="center">
        <img style="width:100px;" src="https://www.pedicurepraktijkpapendrecht.nl/webshop/img/logo.jpg">
    </div>
        <h1>Factuur</h1>
        <div style="display:flex; flex:wrap; justify:space-between;">

        <div class="" style="display:flex; margin-right:auto;">
        <div>
          <div><span>Klant:</span></div>
          <div><span>Email:</span></div>
          <div><span>Datum: </span></div>
          <div><span>Factuur nr.: </span></div>
        </div>
        <div>
          <span style="display:block;">' . $klant_naam . '</span>
          <a style="display:block;">' . $klant_email . '</a>
          <span style="display:block;">' . $datumgekocht . '</span>
          <span style="display:block;">' . $newfk . '</span>
        </div>
        </div>


        <div>
            <div>Pedicurepraktijk Papendrecht</div>
            <div>Rembrandtlaan 18,<br /> 3351RH, Papendrecht</div>
            <div>06 - 36176087</div>
            <div><a>info@pedicurepraktijkpapendrecht.nl</a></div>
        </div></div>
</table>
    <table style="width:755px;" border="1" align="center">
        <thead>
            <tr>
                <th style="text-align: left;">Beschrijving</th>
                <th style="text-align: left;">Prijs</th>
                <th style="text-align: middle;">Aantal</th>
                <th style="text-align: right;">Totaal</th>
            </tr>
        </thead>
        <tbody align="center" width="100%">';
    $subtotaal = "0";
    $product = explode(",", $query["bon"]);
    $aantal1 = explode(",", $query["aantal"]);
    foreach (array_combine($product, $aantal1) as $product => $aantal1) {
      $f = $producten->GetPerProductInfo($product);
      if ($f) {
        $prodnaam = $f->product_naamdis;
        $cat = $f->cat;
        $prijs = $f->product_nieuwprijs / 1.21;
        $aantal = $aantal1;
        $totaalper = $aantal1 * $prijs;
        $subtotaal += $totaalper;
        $message .= '
            <tr>
                <td style="text-align: left;">';
        $allids = $bestellingen->GetBestellingenByIdAndName($session_id, $product);
        $codesaantal = '';
        foreach ($allids as $codes) {
          $codesaantal = trim($codes->aankoop_id . ',' . $codesaantal, ',');
        }
        $message .= $cat . ' ' . $prodnaam . ' ' . $codesaantal;
        $message .= '</td>
                <td style="text-align: left;">&euro;' . number_format($prijs, 2, '.', '') . '</td>
                <td style="text-align: middle;">' . $aantal1 . '</td>
                <td style="text-align: right;">&euro;' . number_format($totaalper, 2, '.', '') . '</td>
            </tr>
            ';
      }
    }
    $btw = ($subtotaal * 0.21);
    $eindtotaal = $subtotaal + $btw;
    $message .= '

            <tr>
                <td colspan="3" style="text-align: right;">Totaal excl. BTW</td>
                <td style="text-align: right;">&euro;' . number_format($subtotaal, 2, ".", "") . '</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;">BTW 21%</td>
                <td style="text-align: right;">&euro;' . number_format($btw, 2, ",", "") . '</td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;">Totaal incl. BTW</td>
                <td style="text-align: right;">&euro;' . number_format($eindtotaal, 2, ".", "") . '</td>
            </tr>
        </tbody>
    </table>
    <table width="100%" style="text-align:center; margin-top: 13px;">    
    <div>KVK: 63256983, BTW: NL001640691B67, IBAN: NL37INGB0006844547</div>
    </table>
</body>

</html>';
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'Bcc: info@pedicurepraktijkpapendrecht.nl' . "\r\n";
    $headers .= 'From: ' . $from . "\r\n" .
      'Reply-To: ' . $from . "\r\n" .
      'X-Mailer: PHP/' . phpversion();

    if (mail($email, $subject, $message, $headers)) {
      echo 'verzonden';
    } else {
      echo 'niet gelukt om te zenden';
    }
  }
}

http_response_code(200);
