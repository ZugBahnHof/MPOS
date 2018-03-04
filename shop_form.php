<?php
  $site_title = "Verkauf - ";
  include 'inc/header.inc.php';
 ?>

 <script type="text/javascript">
 function clone_this(objButton)
 {
   tmpNode = objButton.form.elements[0].parentNode.parentNode.cloneNode(true);
   objButton.form.insertBefore(tmpNode,objButton);
   objButton.previousSibling.firstChild.firstChild.value='';

 }
 </script>
 <h1 class="<?php echo $site_color_accent_text; ?>">Verkauf</h1>
 <p>Geben sie ein.</p>
 <form action="empfang.php" method="post">
   <div class="row col s12">
     <div class="input-field col s4 m3 l2">
        <input name="Menge[]" type="text" id="Menge">
        <label for="Menge">Menge</label>
     </div>
     <div class="input-field col s8 m9 l10">
        <input name="Artikelnummer[]" type="text" id="Nummer">
        <label for="Nummer">Artikelnummer</label>
     </div>
   </div>


  <input value="Noch ein Artikel" onclick="clone_this(this)" type="button" class="btn <?php echo $site_color_accent; ?>">

  <button class="btn waves-effect waves-light <?php echo $site_color; ?>" type="submit" name="action">Submit
    <i class="material-icons right">send</i>
  </button>
 </form>
<?php
  include 'inc/footer.inc.php';
 ?>
