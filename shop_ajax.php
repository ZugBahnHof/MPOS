<?php
@session_start();
include_once "inc/functions.inc.php";


header( "Content-Type: application/json" );

function give_result() {
	global $result;
	echo json_encode( $result );
	die();
}

function give_error( $message ) {
	global $result;
	$result = array(
		"error"   => true,
		"success" => false,
		"message" => $message
	);
	give_result();
}

function give_success( $message ) {
	global $result;
	$result = array(
		"error"   => false,
		"success" => true,
		"message" => $message
	);
	give_result();
}


function get_article( $barcode ) {
	global $pdo;
	$statement = $pdo->prepare( "SELECT * FROM articles WHERE barcode = :barcode" );
	$statement->execute( array( "barcode" => $barcode ) );
	$result = $statement->fetch( PDO::FETCH_ASSOC );
	if ( $result != [] ) {
		return $result;
	} else {
		return false;
	}
}

$result = false;
if ( ! check_user() ) {
	give_error( "Eine Anmeldung liegt nicht vor." );
}

if ( empty( $_GET["action"] ) ) {
	give_error( "Keine Aktion angegeben." );
}

if ( ! isset( $_SESSION["cart"] ) ) {
	$_SESSION["cart"] = array();
}

$result = array();
$action = $_GET["action"];
switch ( $action ) {
	case "get_cart":
		$result = $_SESSION["cart"];
		give_result();
		break;
	case "add_to_cart":
		if ( empty( $_GET["barcode"] ) ) {
			give_error( "Es muss ein Barcode angegeben werden." );
		}
		if ( empty( $_GET["quantity"] ) ) {
			give_error( "Es muss eine Menge angegeben werden." );
		}
		$barcode  = $_GET["barcode"];
		$quantity = $_GET["quantity"];

		$article = get_article( $barcode );
		if ( ! $article ) {
			give_error( "Dieser Artikel existiert leider nicht." );
		}

		if ( ! is_numeric( $quantity ) || ! ( doubleval( $quantity ) > 0 ) ) {
			give_error( "Die Menge muss ein positiver numerischer Wert sein." );
		}
		$quantity = doubleval( $quantity );

		$needed_quantity = $quantity;
		$key             = array_search( $barcode, array_column( $_SESSION["cart"], "barcode" ) );
		if ( $key !== false ) {
			// Existiert bereits
			$needed_quantity += $_SESSION["cart"][ $key ]["quantity"];
		}

		$available_quantity = $article["quantity"];

		if ( ! ( $quantity <= $available_quantity ) ) {
			give_error( "Die gewählte Menge ist leider nicht auf Lager. Auf Lager ist noch: " . $available_quantity . " Stück" );
		}

		if ( $key === false ) {
			//Existiert nicht
			$cart_object = array(
				"barcode"  => $barcode,
				"quantity" => $quantity,
				"article"  => $article,

			);

			array_push( $_SESSION["cart"], $cart_object );

			give_success( "Der Artikel wurde erfolgreich hinzugefügt" );
		} else {
			$_SESSION["cart"][ $key ]["quantity"] += $quantity;
			give_success( "Die Menge wurde erfolgreich zum bereits bestehenden Artikel hinzuaddiert." );
		}

		break;
	case "delete_cart":
		if ( isset( $_SESSION["cart"] ) ) {
			unset( $_SESSION["cart"] );
		}
		give_success( "Der Warenkorb wurde geleert." );
		break;
	default:
		give_error( "Die angegebene Aktion existiert nicht." );
}

give_result();