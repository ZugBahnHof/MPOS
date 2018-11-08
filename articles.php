<?php
$site_title = "Produkte";
include 'inc/header.inc.php';
$user = check_user();

?>
<div class="row">
  <div class="col s9">
    <div class="row article-row">
<?php
$sql = "SELECT * FROM articles";
foreach ($pdo->query($sql) as $row) {
  echo '
    <div class="">
      <div class="card-panel red accent-1 article">
        <h6 class="white-text">Artikel '.$row['id'].': <i>'.$row['name'].'</i></h6>
        <span class="white-text">Ausführung: '.$row['description'].'</span>
        <br>
        <span class="white-text">Preis: '.$row['price'].'€</span>
        <br>
        <span class="white-text">Barcode: '.$row['barcode'].'</span>
        <div class="divider"></div>
        <div class="card-action row card-row">
          <a href="update_article.php?action=delete_article&article_id='.$row['id'].'"  class="btn-flat  col s4"><i class="material-icons">delete</i></a>
          <a href="update_article.php?action=update_quantity&article_id='.$row['id'].'" class="btn-flat col s4"><i class="material-icons">library_add</i></a>
          <a href="update_article.php?action=update_article&article_id='.$row['id'].'"  class="btn-flat col s4"><i class="material-icons">edit</i></a>
        </div>
      </div>
    </div>
  ';
}
  ?>
    </div>
  </div>
  <div class="col s3">
    <div class="collection">
        <a href="#add-article" class="collection-item modal-trigger"><i class="material-icons">add</i>Artikel hinzufügen</a>
        <a href="#!" class="collection-item"><i class="material-icons">receipt</i>Barcode erzeugen</a>
    </div>
  </div>
</div>
<?php
include 'inc/footer.inc.php';
 ?>
