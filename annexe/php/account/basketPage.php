<?php
require_once dirname(__DIR__) . '/global.php';
require_once dirname(__DIR__) . '/database/PDOSelect.php';

$pdo = getPDO();

// Vérification de la connexion à la BDD
if ($pdo == null) {
	header("Location: ../../../index.php?error=Erreur de connexion à la base de données");
	exit();
}


if (!isLoggedIn()) {
	header("Location: loginPage.php?error=Veuillez vous connecter pour accéder à votre panier");
	exit();
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Mon panier</title>
	<link rel="stylesheet" type="text/css" href="../../../css/style.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../../../css/menu.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../../../css/basket.css" media="screen" />
</head>

<body>
	<header>
		<?php
		$current_page = "basketPage";
		require_once(dirname(dirname(dirname(__DIR__))) . "/menu.php");
		?>
	</header>
	<main>
		<div class="title">
			<h1>Mon panier</h1>
		</div>

		<div class="table">
			<div class="table-header">
				<div class="header__item">Article</div>
				<div class="header__item">Prix</div>
				<div class="header__item">Quantite</div>
				<div class="header__item"><img class="trash" src="../../../assets/img/trash.png" alt="poubelle"></div>
			</div>
			<div class="table-content">
				<?php
				// Connexion à la base de données
				require_once dirname(__DIR__) . "/database/PDOSelect.php";

				// Récupération du panier du client si il en a un
				$requetePanier = $pdo->query("SELECT produits FROM panier WHERE id_client = " . $_SESSION["user"]["id_client"]);
				$panier = $requetePanier->fetch(PDO::FETCH_ASSOC);

				// Transformer le JSON object en tableau php pour le manipuler si il existe
				if ($panier["produits"] != null) {
					$panier = json_decode($panier["produits"], true);
				} else {
					$panier = [];
				}

				// On créer un tableau associatif avec l'id du produit en clé et la quantité en valeur
				$panierQuantite = [];
				foreach ($panier as $key => $value) {
					if (array_key_exists($value["id_produit"], $panierQuantite)) {
						$panierQuantite[$value["id_produit"]] += 1;
					} else {
						$panierQuantite[$value["id_produit"]] = 1;
					}
				}

				// On affiche les produits du panier
				foreach ($panierQuantite as $key => $value) {
					$requeteProd = $pdo->query("SELECT * FROM produit WHERE id_produit = " . $key);
					$prod = $requeteProd->fetch(PDO::FETCH_ASSOC);

				?>
					<div class="table-row">
						<div class="table-data"><img class="article" src="../../../assets/img/<?= $prod["image"] ?>.png">
							<div class="desc"><?= $prod["referenceProduit"] . ' - ' . $prod["titreProduit"] ?></div>
						</div>
						<div class="table-data"><?= $prod["prixPublic"] * $value ?></div>
						<div class="table-data"><?= $value ?>
							<div class="changeQuantity">
								<button class="quantityPlus" onclick="window.location.href='addOneCart.php?id=<?= $key ?>'">+</button>
								<button class="quantityMinus" onclick="window.location.href='delOneCart.php?id=<?= $key ?>'">-</button>
							</div>
						</div>
						<div class="table-data">
							<button class="delete" onclick="window.location.href='deleteFromCart.php?id=<?= $key ?>'">
								<img class="trash" src="../../../assets/img/trash.png" alt="poubelle"></button>
						</div>
					</div>



				<?php
				}
				// On met à jour le prix total du panier
				$total = 0;
				foreach ($panierQuantite as $key => $value) {
					$requeteProd = $pdo->query("SELECT * FROM produit WHERE id_produit = " . $key);
					$prod = $requeteProd->fetch(PDO::FETCH_ASSOC);
					$total += $prod["prixPublic"] * $value;
				}
				?>
			</div>
		</div>

		<div class="final">
			<div class="total">Prix total : <?= $total ?>€</div>
			<button class="buy" onclick="window.location.href='../pay/pay.php?=pay'">Commander</button>
		</div>
	</main>
</body>

</html>