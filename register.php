<?php
session_start();
require_once( "inc/config.inc.php" );
require_once( "inc/functions.inc.php" );

$site_title = "Registrierung";
include( "inc/header.inc.php" )

?>
<h1 class="<?php echo $site_color_accent_text; ?>">Registrierung</h1>
<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if ( isset( $_GET['register'] ) ) {
	$error     = false;
	$vorname   = trim( $_POST['vorname'] );
	$nachname  = trim( $_POST['nachname'] );
	$email     = trim( $_POST['email'] );
	$passwort  = $_POST['passwort'];
	$passwort2 = $_POST['passwort2'];

	if ( empty( $vorname ) || empty( $nachname ) || empty( $email ) ) {
		echo 'Bitte alle Felder ausfüllen<br>';
		$error = true;
	}

	if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
		echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
		$error = true;
	}
	if ( strlen( $passwort ) == 0 ) {
		echo 'Bitte ein Passwort angeben<br>';
		$error = true;
	}
	if ( $passwort != $passwort2 ) {
		echo 'Die Passwörter müssen übereinstimmen<br>';
		$error = true;
	}

	//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
	if ( ! $error ) {
		$statement = $pdo->prepare( "SELECT * FROM users WHERE email = :email" );
		$result    = $statement->execute( array( 'email' => $email ) );
		$user      = $statement->fetch();

		if ( $user !== false ) {
			echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
			$error = true;
		}
	}

	//Keine Fehler, wir können den Nutzer registrieren
	if ( ! $error ) {
		$passwort_hash = password_hash( $passwort, PASSWORD_DEFAULT );

		$statement = $pdo->prepare( "INSERT INTO users (email, passwort, vorname, nachname) VALUES (:email, :passwort, :vorname, :nachname)" );
		$result    = $statement->execute( array(
			'email'    => $email,
			'passwort' => $passwort_hash,
			'vorname'  => $vorname,
			'nachname' => $nachname
		) );

		if ( $result ) {
			echo '<p>Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a></p>';
			$showFormular = false;
		} else {
			echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
		}
	}
}

if ( $showFormular ) {
	?>

    <div class="row">
        <form action="?register=1" method="post" class="col s12">
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">account_circle</i>
                <label for="inputVorname">Vorname</label>
                <input type="text" id="inputVorname" size="40" maxlength="250" name="vorname" class="form-control"
                       required>
            </div>

            <div class="input-field col s12 m6">
                <i class="hide-on-med-and-up material-icons prefix">account_circle</i>
                <label for="inputNachname">Nachname</label>
                <input type="text" id="inputNachname" size="40" maxlength="250" name="nachname" class="form-control"
                       required>
            </div>

            <div class="input-field col s12 m12">
                <i class="material-icons prefix">email</i>
                <label for="inputEmail">E-Mail</label>
                <input type="email" id="inputEmail" size="40" maxlength="250" name="email" class="validate" required>
            </div>

            <div class="input-field col s12 m6">
                <i class="material-icons prefix">lock</i>
                <label for="inputPasswort">Dein Passwort</label>
                <input type="password" id="inputPasswort" size="40" maxlength="250" name="passwort" class="form-control"
                       required>
            </div>

            <div class="input-field col s12 m6">
                <i class="hide-on-med-and-up material-icons prefix">lock</i>
                <label for="inputPasswort2">Passwort wiederholen</label>
                <input type="password" id="inputPasswort2" size="40" maxlength="250" name="passwort2"
                       class="form-control" required>
            </div>

            <button type="submit" class="<?php echo $site_color_accent; ?> btn waves-effect waves-light col s12 m6 l3">
                Registrieren<i class="material-icons right">send</i></button>
        </form>
    </div>

	<?php
} //Ende von if($showFormular)


?>
<?php
include( "inc/footer.inc.php" )
?>
