<div class="logo">
   <img src="/assets/img/logo.jpeg" alt="logo" class="logo">
</div>

<nav>
   <ul>
      <li><a <?php
               if ($current_page === "productPage") {
                  echo "class=\"selection\"";
               } ?>href="/annexe/php/productPage.php">Les produits</a></li>
      <li><a <?php
               if ($current_page === "basketPage") {
                  echo "class=\"selection\"";
               } ?>href="/annexe/php/basketPage.php">Mon panier</a></li>
      <li><a <?php
               if ($current_page === "homePage") {
                  echo "class=\"selection\"";
               } ?>href="/index.php">Accueil</a></li>
      <li><a <?php
               if ($current_page === "accountPage") {
                  echo "class=\"selection\"";
               } ?>href="#">Mon compte</a></li>
      <li><a <?php
               if ($current_page === "loginPage") {
                  echo "class=\"selection\"";
               } ?>href="/annexe/php/loginPage.php">Se connecter</a></li>
   </ul>
</nav>