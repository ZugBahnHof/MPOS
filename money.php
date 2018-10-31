<?php
$site_title = "Geldfluss";
include 'inc/header.inc.php';
$user = check_user();
$retVal = (condition) ? a : b ;
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
  </div>
</div>
<?php
include 'inc/footer.inc.php';
?>
