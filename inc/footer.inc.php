<?php

if (strlen($modaltext) > 1) {
  $toast = "M.toast({html: '$modal_text'})";
} else {
  $toast = "";
}


  echo <<<HEREDOC
  </main>
  <!--Footer section-->
  <footer class="page-footer $site_color_accent">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">Footer Content</h5>
            <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
          </div>
          <div class="col l4 offset-l2 s12">
            <h5 class="white-text">Links</h5>
            <ul>
              <li><a class="grey-text text-lighten-3" href="https://www.php-einfach.de/experte/php-codebeispiele/loginscript/">Loginsystem von Nils Reimers</a></li>
              <li><a class="grey-text text-lighten-3" href="https://next.materializecss.com">Framework Materialize</a></li>
              <li><a class="grey-text text-lighten-3" href="https://github.com/ZugBahnHof/MPOS">Diese Projekt auf GitHub</a></li>
              <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer-copyright">
        <div class="container">
        © 2018 by Julian Leucker
        <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
      </div>
    </footer>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('select').material_select();
        $(".button-collapse").sideNav();
        $('.materialboxed').materialbox();
        $('.tooltipped').tooltip({delay: 50});
      });
      var instance = M.Tabs.init(el, options);
    </script>
    <script type="text/javascript">

      var elem = document.querySelector('.tooltipped');
      var elem2 = document.querySelector('.tooltipped');
      var instance = M.Tooltip.init(elem);
      var instance = M.Tooltip.init(elem2);
   </script>
  </body>
</html>
HEREDOC;
 ?>
