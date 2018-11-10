<?php
$site_title = "Geldfluss";
include 'inc/header.inc.php';
$user = check_user();
if (isset($_POST['sum'])) {
  if (!empty($_POST['sum'])) {
    $money_to_add = $_POST['sum'];
    $userid = $user['id'];

    $money_to_add = floatval($money_to_add);

    global $pdo;
    $sql = "SELECT `balance` FROM `money` ORDER BY `id` DESC LIMIT 1";
    $curr_balance = $pdo->query($sql)->fetch();

    $curr_balance = floatval($curr_balance['balance']);
    $new_balance = $curr_balance + $money_to_add;

    $statement = $pdo->prepare( "INSERT INTO `money` (`id`, `change_price`, `balance`, `updated_by`, `created_at`) VALUES (NULL, :money, :new_balance, :user, CURRENT_TIMESTAMP);" );
		$result    = $statement->execute( array(
			'money'    => $money_to_add,
			'new_balance' => $new_balance,
			'user'  => $userid
		) );
  }
}
if (isset($_POST['diff'])) {
  if (!empty($_POST['diff'])) {
    $money_to_substract = $_POST['diff'];
    $userid = $user['id'];

    $money_to_substract = floatval($money_to_substract);

    global $pdo;
    $sql = "SELECT `balance` FROM `money` ORDER BY `id` DESC LIMIT 1";
    $curr_balance = $pdo->query($sql)->fetch();

    $curr_balance = floatval($curr_balance['balance']);
    $new_balance = $curr_balance - $money_to_substract;

    $statement = $pdo->prepare( "INSERT INTO `money` (`id`, `change_price`, `balance`, `updated_by`, `created_at`) VALUES (NULL, :money, :new_balance, :user, CURRENT_TIMESTAMP);" );
		$result    = $statement->execute( array(
			'money'    => $money_to_substract,
			'new_balance' => $new_balance,
			'user'  => $userid
		) );
  }
}
?>
<?php
//############################################################################################################################
// IDEA:  Tabelle nur kleiner machen und dann in mehrere Tabellen auf verschiedenen Seiten aufteilen (siehe auch https://materializecss.com/pagination.html)
//############################################################################################################################
?>
<script>
name_data = $.getJSON("money_ajax.php?action=get_users");

function updateTable() {
  $.getJSON("money_ajax.php?action=get_balance", function (data) {
      console.log(data);
      $("#money-table tbody").empty();
      $.each(data, function (index, value) {
          $("#money-table tbody").append("<tr>" +
              "<td>" +
              value.id +
              "</td>" +
              "<td>" +
              value.change_price + "€" +
              "</td>" +
              "<td>" +
              value.balance + "€" +
              "</td>" +
              "<td class= 'id" + value.updated_by + "'>" +
              value.updated_by +
              "</td>" +
              "<td>" +
              value.created_at +
              "</td>" +
              "</tr>")
      });
  });
  updateUsers();
}
function updateUsers() {
  $.getJSON("money_ajax.php?action=get_users", function (name_data) {
    $.each(name_data, function (index, value) {
      console.log("id" + value.id);
      $(".id"+value.id).text(value.vorname + " " + value.nachname);
    });
  });
}
function getCurrBalance(id) {
  $.getJSON("money_ajax.php?action=get_curr_balance", function (data) {
      $('#currBalance').text(data.balance + "€");
  });
}
$(document).ready(function () {
        getCurrBalance();
        updateTable();
        $("#reload").click(function(){
          getCurrBalance();
          updateTable();
        });
});
</script>
<div class="row">
  <div class="col s8">
    <table class="highlight" id="money-table">
      <thead>
        <tr>
          <th>Buchungs-ID</th>
          <th>Änderung</th>
          <th>Kontostand</th>
          <th>geändert von</th>
          <th>geändert am</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td colspan="5">
            Keine Zahlungen vorhanden!
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col s4">
    <div class="card grey lighten-3 card_padding">
      <h6 class="<?=$site_color_text?> center">DERZEITIGER KONTOSTAND:</h6>
      <h1 class="<?=$site_color_text?> center" id="currBalance"></h1>
      <a class="btn-floating halfway-fab waves-effect waves-light <?=$site_color_accent?> btn-large" id="reload"><i class="material-icons">refresh</i></a>
    </div>
    <div class="collection">
        <a href="#add_money" class="collection-item modal-trigger">
          <i class="material-icons red-text">add</i>
          <span class="grey-text">Geld einzahlen</span>
        </a>
        <a href="#substract_money" class="collection-item modal-trigger">
          <i class="material-icons blue-text">remove</i>
          <span class="grey-text">Geld auszahlen</span>
        </a>
        <a href="#!" class="collection-item">
          <i class="material-icons green-text">receipt</i>
          <span class="grey-text">Barcode erzeugen</span>
        </a>
    </div>
  </div>
</div>

<!-- MODALS-->
<div id="add_money" class="modal ">
    <div class="modal-content">
      <h4>Geld einzahlen</h4>
      <p>Füllen Sie alle Felder aus!</p>
      <div class="row">
        <form class="col s12" id="add-article" action="money.php" method="post">
          <div class="row">
            <div class="input-field col s6">
              <input id="sum" name="sum" type="text" class="validate" required>
              <label for="sum">Summe</label>
            </div>
          </div>
          <div class="divider"></div>
          <br>
          <button type="submit" class="waves-effect waves-light green btn-flat col s12">Einzahlen</button>
        </form>
      </div>
    </div>
  </div>
  <div id="substract_money" class="modal ">
      <div class="modal-content">
        <h4>Geld auszahlen</h4>
        <p>Füllen Sie alle Felder aus!</p>
        <div class="row">
          <form class="col s12" id="add-article" action="money.php" method="post">
            <div class="row">
              <div class="input-field col s6">
                <input id="diff" name="diff" type="text" class="validate" required>
                <label for="sum">Geld</label>
              </div>
            </div>
            <div class="divider"></div>
            <br>
            <button type="submit" class="waves-effect waves-light orange btn-flat col s12">Auszahlen</button>
          </form>
        </div>
      </div>
    </div>
<?php
include 'inc/footer.inc.php';
?>
