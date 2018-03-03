<?php
session_start();
//require_once("inc/config.inc.php");
$site_title = "Index - ";
$site_color = "amber";
$site_color_accent = "red accent-4";
$site_color_text = "amber-text";
$site_color_accent_text = "red-text text-accent-4";
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
        <a href="index.php" class="brand-logo">MPOS</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="sass.html">Sass</a></li>
          <li><a href="badges.html">Components</a></li>
          <li><a href="collapsible.html">JavaScript</a></li>
        </ul>
      </div>
    </nav>
  </header>
  <!--main section-->
	<main>
	<div class="container " >
HEREDOC;
