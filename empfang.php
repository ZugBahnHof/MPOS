<?php
$site_title = "Rechnung";
include 'inc/header.inc.php';
echo "<h1 class=".$site_color_accent_text.">Rechnung</h1>";
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
  //$art_data = [];
  $anzahl = $_POST['Menge'];
  //$art_name = $art_data['anzahl'];
  $art_num = $_POST['Artikelnummer'];
  //$E_preis = $art_data['anzahl'];
  //$G_preis = $anzahl * $E_preis;
	echo '
    <tr>
      <td>'.$anzahl[$i].'</td>
      <td>'.$art_name.'</td>
      <td>'.$art_num[$i].'</td>
      <td>'.$E_preis.'</td>
      <td>'.$G_preis.'</td>
    </tr>
    ';
}
echo '
    </tbody>
  </table>
  ';
echo "<b>Zu zahlen:</b>";
include 'inc/footer.inc.php';
?>
