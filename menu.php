<div class="logo">
   <a href="https://fr.wikipedia.org/wiki/Manga" target="_blank"><img src="/assets/img/logo.png" alt="logo" class="logo"></a>
</div>

<nav class="navBar">
   <div class="left">Manga K</div>
   <div class="center">
      <ul>
         <li><a <?php
                  if ($current_page === "productPage") {
                     echo "class=\"selection\"";
                  } ?>href="/annexe/php/products/productPage.php">Les produits</a></li>
         <li><a <?php
                  if ($current_page === "BestSeller") {
                     echo "class=\"selection\"";
                  } ?>href="/annexe/php/products/productPage.php?BestSeller=yes">Meilleures ventes</a></li>
         <li><a <?php
                  if ($current_page === "homePage") {
                     echo "class=\"selection\"";
                  } ?>href="/index.php">Accueil</a></li>
         <li><a <?php
                  if ($current_page === "New") {
                     echo "class=\"selection\"";
                  } ?>href="/annexe/php/products/productPage.php?New=yes">Nouveautées</a></li>
      </ul>
   </div>
   <div class="right">
      <a href="/annexe/php/account/loginPage.php"><img class="basket" src="/assets/img/pp.png"></a>
      <a href="/annexe/php/account/basketPage.php"><img class="basket" src="/assets/img/basket.png"></a>
   </div>

</nav>