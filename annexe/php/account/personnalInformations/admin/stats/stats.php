<?php
require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/global.php';
require_once  dirname(dirname(dirname(dirname(__DIR__)))) . '/database/PDOSelect.php';
// On vérifie que ce soit bien le gérant du site qui est connecté
if ($_SESSION["user"]["email"] != "gerant@gmail.com") {
    header("Location: ../../../../../index.php");
    exit();
}
// Connection à la BDD
$pdo = getPDO();

// On vérifie la connection à la BDD
if (!$pdo) {
    header("Location: stats.php?error=Erreur lors de la connexion à la base de données");
    exit();
}

$recherche;
if (!empty($_POST["recherche"])) {
    $recherche = $_POST["recherche"];
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Stats prodiuts</title>
    <link rel="icon" type="image/png" href="../../../../../../assets/img/logo.png" />
    <link rel="stylesheet" type="text/css" href="../../../../../../css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../../../../../css/menu.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../../../../../../css/basket.css" media="screen" />
</head>

<body>
    <header>
        <?php
        $current_page = "stats";
        require_once(dirname(dirname(dirname(dirname(dirname(dirname(__DIR__)))))) . "/menu.php");
        ?>
    </header>
    <div class="title">
        <h1>Statistiques sur les produits</h1>
    </div>
    <?php
    if (empty($recherche)) {
        $sql = $pdo->query("SELECT id_produit, referenceProduit, prixPublic, prixAchat, titreProduit FROM produit");
        $data = $sql->fetchAll();
    } else {
        $sql = $pdo->query("SELECT id_produit, referenceProduit, prixPublic, prixAchat, titreProduit FROM produit where id_produit in (SELECT id_produit FROM produit WHERE titreProduit LIKE '%$recherche%');");
        if ($sql) {
            $data = $sql->fetchAll();
        } else {
            $data = [];
        }
    }
    ?>
    <div class="table">
        <div class="table-header">
            <div class="header__item">Titre produit</div>
            <div class="header__item">CA</div>
            <div class="header__item">Nb - Ventes</div>
            <div class="header__item">Nb - Achats</div>
            <div class="header__item">Benefice</div>
        </div>
        <form action="stats.php" method="post">
            <input type="text" name="recherche" placeholder="Rechercher un produit (titre)  ">
            <input type="submit" value="Rechercher">
        </form>
        <div class="table-content">
            <?php
            // On affiche les données
            foreach ($data as $row) {
                $produitsQuantite = [];
                $achats = [];
                $transac = $pdo->query("SELECT * FROM facturation");
                if ($transac) {
                    $transaction = $transac->fetchAll();
                } else {
                    $transaction = [];
                }
                for ($index = 0; $index < count($transaction); $index++) {
                    $panier = json_decode($transaction[$index]["listeProduit"], true);
                    foreach ($panier as $key => $value) {
                        if (array_key_exists($value["id_produit"], $produitsQuantite)) {
                            $produitsQuantite[$value["id_produit"]] += 1;
                        } else {
                            $produitsQuantite[$value["id_produit"]] = 1;
                        }
                        // echo "panier ".$index." produit ". $key ." id_prod ".$value["id_produit"] . "<br>";
                        // echo '<br>';
                    }
                }
                $CA = [];
                foreach ($produitsQuantite as $id_prod => $nb_ventes) {
                    $prixProd = $pdo->query("SELECT prixPublic FROM produit WHERE id_produit=$id_prod");
                    $prixPublic = $prixProd->fetch();
                    // Augmenter le chiffre d'affaire des produits ayant eu une facturation
                    if (array_key_exists($id_prod, $CA)) {
                        $CA[$id_prod] += $prixPublic[0] * $nb_ventes;
                    } else {
                        $CA[$id_prod] = $prixPublic[0] * $nb_ventes;
                    }
                }

                for ($index = 0; $index < count($transaction); $index++) {
                    $panier = json_decode($transaction[$index]["listeProduit"], true);
                    $cond = true;
                    // Je souhaite ajouter à $achats[$value["id_produit"]] +1 si l'id produit est déjà présent dans un panier, dés qu'il est dans un panier je sort et je prend le prochain
                    foreach ($panier as $key => $value) {

                        if (array_key_exists($value["id_produit"], $achats) && $cond == true) {
                            $achats[$value["id_produit"]] += 1;
                            $cond = false;
                        } else if ($cond = true) {
                            $achats[$value["id_produit"]] = 1;
                            $cond = false;
                        }
                        // echo "panier ".$index." produit ". $key ." id_prod ".$value["id_produit"] . "<br>";
                        // echo '<br>';
                    }
                }
            ?>
                <div class="table-row">
                    <div class="table-data"> <?= $row["titreProduit"] ?></div>
                    <div class="table-data">
                        <?php
                        if (!empty($CA[$row["id_produit"]])) {
                            echo $CA[$row["id_produit"]] . "€";
                        } else {
                            echo 0;
                        }
                        ?></div>
                    <div class="table-data">
                        <?php
                        if (!empty($produitsQuantite[$row["id_produit"]])) {
                            echo $produitsQuantite[$row["id_produit"]];
                        } else {
                            echo 0;
                        }
                        ?></div>
                    <div class="table-data">
                        <?php
                        if (!empty($achats[$row["id_produit"]])) {
                            echo $achats[$row["id_produit"]];
                        } else {
                            echo 0;
                        } ?></div>
                    <div class="table-data">
                        <?php
                        if (!empty($produitsQuantite[$row["id_produit"]]) && !empty($CA[$row["id_produit"]])) {
                            echo $CA[$row["id_produit"]] - $row["prixAchat"] * $produitsQuantite[$row["id_produit"]] . "€";
                        } else {
                            echo 0;
                        }
                        ?></div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>