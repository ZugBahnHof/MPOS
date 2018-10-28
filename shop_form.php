<?php
$site_title = "Verkauf";
include 'inc/header.inc.php';
$user = check_user();
?>

<script type="text/javascript">
    // function clone_this(objButton) {
    //     tmpNode = objButton.form.elements[0].parentNode.parentNode.cloneNode(true);
    //     objButton.form.insertBefore(tmpNode, objButton);
    //     objButton.previousSibling.firstChild.firstChild.value = '';
    //
    // }

    function updateCart() {
        $.getJSON("shop_ajax.php?action=get_cart", function (data) {
            console.log(data);
            $("#cart tbody").empty();
            var gpreis = 0;
            $.each(data, function (index, value) {
                gpreis = gpreis + value.quantity * value.article.price;
                $("#cart tbody").append("<tr>" +
                    "<td>" +
                    value.quantity +
                    "</td>" +
                    "<td>" +
                    value.article.barcode +
                    "</td>" +
                    "<td>" +
                    value.article.name +
                    "</td>" +
                    "<td>" +
                    value.article.price + "€" +
                    "</td>" +
                    "<td>" +
                    value.quantity * value.article.price + "€" +
                    "</td>" +
                    "</tr>")
            });
            $("#cart tbody").append("<tr>" +
              "<th colspan='4'>" +
              "Gesamt:" +
              "</th>" +
              "<th>" +
              gpreis + "€" +
              "</th>" +
              "</tr>")

        });
    }

    $(document).ready(function () {
            updateCart();

            $("#shop-form").submit(function (e) {
                    e.preventDefault();
                    console.log("[ACTION] Add article to cart");
                    var quantity = $("#quantity-in").val();
                    var barcode = $("#barcode-in").val();
                    console.log(quantity + " * " + barcode);

                    var url = "shop_ajax.php?action=add_to_cart&barcode=" + barcode + "&quantity=" + quantity;
                    $.getJSON(url, function (data) {
                        console.log("[ACTION RESULT OF add_to_cart]");
                        console.log(data);
                        if (data.success || data.error) {
                            var html = "";
                            if (data.success) {
                                html += '<i class="material-icons left">check</i>';
                            } else if (data.error) {
                                html += '<i class="material-icons left">error</i>';
                            }
                            html += data.message;
                            M.toast({html: html});
                        }
                        updateCart();
                    });


                }
            );
        }
    );
</script>
<h1 class="<?php echo $site_color_accent_text; ?>">Verkauf</h1>
<div class="row">
    <div class="col s12 m6">
        <p class="flow-text">Geben sie ein.</p>
        <form id="shop-form" action="" method="post">
            <div class="row col s12">
                <div class="input-field col s4 m3 l2">
                    <input name="quantity" type="text" id="quantity-in" autofocus>
                    <label for="quantity">Menge</label>
                </div>
                <div class="input-field col s8 m9 l10">
                    <input name="barcode" type="text" id="barcode-in">
                    <label for="article">Artikelnummer</label>
                </div>
            </div>


            <!--<input value="Noch ein Artikel" onclick="clone_this(this)" type="button"
           class="btn <?php /*echo $site_color_accent; */ ?>">
-->
            <button class="btn waves-effect waves-light <?=$site_color?> col s12" type="submit" name="action">
                Hinzufügen
                <i class="material-icons right">add_shopping_cart</i>
            </button>
        </form>
    </div>

    <div class="col s12 m6">
        <table class="striped" id="cart">
            <thead>
            <tr>
                <th>Menge</th>
                <th>Barcode</th>
                <th>Artikelname</th>
                <th>EPREIS</th>
                <th>GPREIS</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td colspan="5">
                    Noch keine Artikel …
                </td>
            </tr>
          </tbody>
        </table>
        <a class="waves-effect waves-light btn <?=$site_color_accent?> col s12" href="pay.php"><i class="material-icons right">shopping_cart</i>Bezahlen</a>
    </div>
</div>

<?php
include 'inc/footer.inc.php';
?>
