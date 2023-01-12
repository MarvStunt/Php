<nav>
   <ul>
      <li><a <?php
               if (isset($_GET["page"]) && $_GET["page"] == "productPage") {
               ?>class="selection" <?
                                 }
                                    ?> href="/annexe/php/productPage.php?page=productPage">Les produits</a></li>
      <li><a href="/annexe/html/basketPage.html">Mon panier</a></li>
      <li><a class="selection">Accueil</a></li>
      <li><a href="#">Mon compte</a></li>
      <li><a href="/annexe/html/loginPage.html">Se connecter</a></li>
   </ul>
</nav>