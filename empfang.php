<?php
<<<<<<< HEAD
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
  for ($i=0; $i < count($_POST['Menge']); $i++) {
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
=======
var_dump( $_POST );
?>
>>>>>>> 8ff7bed6f3f5d4985a40279a3b4b7c9c09d4a72f
