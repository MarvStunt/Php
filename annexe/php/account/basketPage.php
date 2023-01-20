<?php
require_once dirname(__DIR__) . '/global.php';

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
</head>

<body>
	<header>
		<?php
		$current_page = "basketPage";
		require_once(dirname(dirname(dirname(__DIR__))) . "/menu.php");
		?>
	</header>
	<main>
		<h1>Mon panier</h1>
		<table>
			<tr>
				<th>Article</th>
				<th>Prix</th>
				<th>Quantité</th>
				<th>Total</th>
			</tr>
			<?php
			// Connexion à la base de données
			require_once dirname(__DIR__) . "/database/PDOSelect.php";
			$pdo = getPDO();

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
				echo "<tr>";
				echo "<td>" . $prod["titreProduit"] . "</td>";
				echo "<td>" . $prod["prixPublic"] . '€<a href="../pay/addOneCart.php?id=' . $key . '"><button>+</button></a>
																	<a href="../pay/delOneCart.php?id=' . $key . '"><button>-</button></a></td>';
				echo "<td>" . $value . "</td>";
				echo "<td>" . $prod["prixPublic"] * $value . "€</td>";
				echo '<td><a href="../pay/deleteFromCart.php?id=' . $key . '">
            <button>supprimer</button>
         </a></td>';
				echo "</tr>";
			}

			?>
			<tr>
				<td colspan="3">Total</td>
				<?php
				// On met à jour le prix total du panier
				$total = 0;
				foreach ($panierQuantite as $key => $value) {
					$requeteProd = $pdo->query("SELECT * FROM produit WHERE id_produit = " . $key);
					$prod = $requeteProd->fetch(PDO::FETCH_ASSOC);
					$total += $prod["prixPublic"] * $value;
				}
				echo "<td>" . $total . "€</td>";
				?>
			</tr>
		</table>
		<div>
			<script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="pk_test_51MS6goLwcdkoHZOt2KK1rotu8dEsbqiIgrN03b7OUwmunNrput0GP1T369gQXKbwp9yk3s6mFkMMkzXCe2godwnO00EwvZBKOO" data-amount=<?= $total * 100 ?> data-name="Manga-K" data-locale="auto" data-currency="eur" data-label="Commander">
			</script>
		</div>
	</main>
</body>

</html>