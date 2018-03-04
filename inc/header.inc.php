<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
$site_color = "amber";
$site_color_accent = "red accent-4";
$site_color_text = "amber-text";
$site_color_accent_text = "red-text text-accent-4";
$modal_text = $_GET['msg'];

if (is_checked_in() == TRUE) {$logged_in = TRUE;}
switch ($logged_in) {
	case TRUE:
		$logging_link = "logout.php";
		$logging_imag = "clear";
		$logging_text = "Logout";
		$image_lock = "lock_open";
		$preferences_text_a = '<li><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Einstellungen" href="settings.php"><i class="material-icons">settings</i></a></li>';
		$preferences_text_b = '<li><a href="settings.php"><i class="material-icons">settings</i>Einstellungen</a></li>';
		break;

	default:
		$logging_link = "login.php";
		$logging_imag = "check";
		$logging_text = "Login";
		$image_lock = "lock";
		break;
}


echo <<<HEREDOC
<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title>$site_title MPOS</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import custom.css-->
    <link type="text/css" rel="stylesheet" href="css/style.css"/>
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>

<body>
<!--Header section-->
  <header>
    <nav>
      <div class="nav-wrapper $site_color">
      <div class="container">
        <a href="index.php" class="brand-logo">MPOS</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
           <li><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Verkaufen" href="shop_form.php"><i class="material-icons">shopping_cart</i></a></li>
  			   <li><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Artikel" href=""><i class="material-icons">widgets</i></a></li>
     			 <li><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Kontostand" href=""><i class="material-icons">attach_money</i></a></li>
           $preferences_text_a
     			<li><a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="$logging_text" href="$logging_link"><i class="material-icons">$logging_imag</i></a></li>
        </ul>
      </div>
      </div>
    </nav>
  </header>
  <!--main section-->
	<main>
	<div class="container " >
HEREDOC;
