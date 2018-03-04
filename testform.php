<html>
<head>
    <title>Test</title>
    <script type="text/javascript">
        <!--
        function clone_this(objButton) {
            /**
             *  Das div, in welchem sich das erste input befindet, wird geclont
             **/

            tmpNode = objButton.form.elements[0].parentNode.cloneNode(true);


            /**
             *  das geklonte div wird vor dem Button eingefügt
             *  Syntax...Elternknoten.insertBefore(einzufügenderKnoten,KnotenVorDemEingefügtWerdenSoll);
             **/

            objButton.form.insertBefore(tmpNode, objButton);


            /**  Den Wert des eingefügten inputs wieder löschen
             * previousSibling ist der vorige Knoten eines Typs vor einem anderen Knoten...
             * in diesem Fall das neue div vor dem Button....firstChild wieder das erste Kindelement darin...also das input
             **/

            objButton.previousSibling.firstChild.value = '';

        }

        //-->
    </script>
</head>
<body>
<form action="empfang.php" method="post">
    <div><input size="20" name="textfeldname[]" type="text"></div>
    <input value="noch eins" onclick="clone_this(this)" type="button">
    <input type="submit" name="submit">
</form>
</body>
</html>
