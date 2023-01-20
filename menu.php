<div class="logo">
   <img src="/assets/img/logo.jpeg" alt="logo" class="logo">
</div>

<nav class="navBar">
   <div class="left">Manga K</div>
   <div class="center">
      <ul>
         <li><a <?php
                  if ($current_page === "productPage") {
                     echo "class=\"selection\"";
                  } ?>href="/annexe/php/productPage.php">Les produits</a></li>
         <li><a <?php
                  if ($current_page === "bestSeller") {
                     echo "class=\"selection\"";
                  } ?>href="/annexe/php/bestSellerPage.php">Meilleures ventes</a></li>
         <li><a <?php
                  if ($current_page === "homePage") {
                     echo "class=\"selection\"";
                  } ?>href="/index.php">Acceuil</a></li>
         <li><a <?php
                  if ($current_page === "New") {
                     echo "class=\"selection\"";
                  } ?>href="/annexe/php/NewPage.php">Nouvautées</a></li>
      </ul>
   </div>
   <div class="right">
      <a href="/annexe/php/loginPage.php"><img class="basket" src="/assets/img/pp.png"></a>
      <a href="/annexe/php/productPage.php"><img class="basket" src="/assets/img/basket.png"></a>
   </div>

</nav>