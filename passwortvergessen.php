<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

include("inc/header.inc.php");
?>
	<h2 >Passwort vergessen</h2>


<?php
$showForm = true;

if(isset($_GET['send']) ) {
	if(!isset($_POST['email']) || empty($_POST['email'])) {
		$error = "<b>Bitte eine E-Mail-Adresse eintragen</b>";
	} else {
		$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
		$result = $statement->execute(array('email' => $_POST['email']));
		$user = $statement->fetch();

		if($user === false) {
			$error = "<b>Kein Benutzer gefunden</b>";
		} else {

			$passwortcode = random_string();
			$statement = $pdo->prepare("UPDATE users SET passwortcode = :passwortcode, passwortcode_time = NOW() WHERE id = :userid");
			$result = $statement->execute(array('passwortcode' => sha1($passwortcode), 'userid' => $user['id']));

			$empfaenger = $user['email'];
			$betreff = "Neues Passwort für deinen Account auf www.php-einfach.de"; //Ersetzt hier den Domain-Namen
			$from = "From: Vorname Nachname <absender@domain.de>"; //Ersetzt hier euren Name und E-Mail-Adresse
			$url_passwortcode = getSiteURL().'passwortzuruecksetzen.php?userid='.$user['id'].'&code='.$passwortcode; //Setzt hier eure richtige Domain ein
			$text = 'Hallo '.$user['vorname'].',
für deinen Account auf leucker.net wurde nach einem neuen Passwort gefragt. Um ein neues Passwort zu vergeben, rufe innerhalb der nächsten 24 Stunden die folgende Website auf:
'.$url_passwortcode.'

Sollte dir dein Passwort wieder eingefallen sein oder hast du dies nicht angefordert, so bitte ignoriere diese E-Mail.

Viele Grüße,
dein leucker.net-Team';

			//echo $text;

			mail($empfaenger, $betreff, $text, $from);

			echo "Ein Link um dein Passwort zurückzusetzen wurde an deine E-Mail-Adresse gesendet.";
			$showForm = false;
		}
	}
}

if($showForm):
?>
	Gib hier deine E-Mail-Adresse ein, um ein neues Passwort anzufordern.<br><br>

	<?php
	if(isset($error) && !empty($error)) {
		echo $error;
	}

	?>
  <div class="row">
	<form action="?send=1" method="post" class="col s12">
    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">email</i>
        <input id="email" name="email" type="email" class="validate" value="<?php echo isset($_POST['email']) ? htmlentities($_POST['email']) : ''; ?>" required>
        <label for="email">Email</label>
      </div>
    </div>
    <button class="<?php echo $site_color_accent; ?> btn waves-effect waves-light" type="submit" name="action">Neues Passwort
      <i class="material-icons right">send</i>
    </button>
	</form>
  </div>
<?php
endif; //Endif von if($showForm)
?>



<?php
include("inc/footer.inc.php")
?>
