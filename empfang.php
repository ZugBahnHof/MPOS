<?php

include 'inc/header.inc.php';
echo '
  <table class="striped">
    <thead>
      <th>Anzahl</th>
      <th>Artikelname</th>
      <th>Artikelnummer</th>
      <th>Einzelpreis</th>
      <th>Gesamtpreis</th>
    </thead>
    <tbody>';
for ( $i = 0; $i < count( $_POST['Menge'] ); $i ++ ) {
	echo '
    <tr>
    ';
}
echo '
    </tbody>
  </table>
  ';
echo "Zu zahlen:";
?>

