<!DOCTYPE html>
<html>

<head>
	<title>Mon panier</title>
	<link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen" />
</head>

<body>
	<header>
		<?php
		$current_page = "basketPage";
		require_once(dirname(dirname(__DIR__)) . "/menu.php");
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
			<tr>
				<td>
					<img src="image1.jpg" alt="Nom de l'article 1" width="50">
					<span>Nom de l'article 1</span>
				</td>
				<td>10€</td>
				<td>
					<input type="number" value="1" min="1">
				</td>
				<td>10€</td>
			</tr>
			<tr>
				<td>
					<img src="image2.jpg" alt="Nom de l'article 2" width="50">
					<span>Nom de l'article 2</span>
				</td>
				<td>20€</td>
				<td>
					<input type="number" value="2" min="1">
				</td>
				<td>40€</td>
			</tr>
			<!-- etc. -->
			<tr>
				<td colspan="3">Total</td>
				<td>90€</td>
			</tr>
		</table>
		<div>
			<button>Commander</button>
		</div>
	</main>
</body>

</html>