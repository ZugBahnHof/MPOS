<?php
session_start();
function giveSucces($msg=''){
  $_SESSION['msg'] = '<i class="material-icons">check</i>  ' . $msg;
  header("Location:articles.php");
}
include 'inc/header.inc.php';
if (empty($_GET['action'])) {
  $_SESSION['msg'] = "Es ist ein Fehler aufgetreten. Bitte versuchen sie es erneut!";
  header("Location:articles.php");
}
if (empty($_GET['article_id'])) {
  $_SESSION['msg'] = "Es ist ein Fehler aufgetreten. Bitte versuchen sie es erneut!";
  header("Location:articles.php");
}
$action = $_GET['action'];
$article_id = $_GET['article_id'];
switch ($action) {
  case 'update_article':
  // TODO: MACHEN!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    giveSucces("Der Artikel wurde erfolgreich bearbeitet!");
    break;

  case 'delete_article':
    global $pdo;
    $statement = $pdo->prepare( "DELETE FROM `articles` WHERE `id` = $article_id");
		$result    = $statement->execute();
    giveSucces("Der Artikel wurde erfolgreich gelöscht!");
    break;

  case 'update_quantity':
  // TODO: MACHEN!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    giveSucces("Die Menge wurde erfolgreich hinzugefügt!");
    break;

  default:
    $_SESSION['msg'] = "Es ist ein Fehler aufgetreten. Bitte versuchen sie es erneut!";
    header("Location:articles.php");
    break;
  }
 ?>
