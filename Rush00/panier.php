<?php
session_start();
//print_r($_SESSION['panier']);
?>
<?PHP
session_start();
// a modifier si l'utilisateur est log
include('./connect_bdd.php');
?>

<html>
	<head>
		<title>Shop 42</title>
		<link rel="stylesheet" href="styles/style.css">
		<link rel="icon" href="images/download.png" />

	</head>
	<body>
		<div class="main">
			<?php include('./menu.php'); ?>
			<div class="center">
				<div id="left">
					<div id="left_title">Prix Total:</div>
					<ul id="categories">
						<?php
						$total = 0;
						if ($_SESSION['panier']) {
							foreach ($_SESSION['panier'] as $k => $v) {
								$query = "SELECT `price` FROM Products WHERE `id` = '$v'";
								if (!($result = mysqli_query($bdd, $query)))
									echo mysqli_error($bdd);
								$tab = mysqli_fetch_all($result, MYSQLI_ASSOC);
								foreach ($tab as $line) {
									$total += $line['price']; 
								}
							}
						}
						else
							$total = 0.00;
						echo $total." €";
						?>
					</ul>
				</div>

				<div id="products_area">
					<div>		
					</div>
					<div id="products">
						<?php
						if ($_SESSION['panier']) {
							foreach ($_SESSION['panier'] as $k => $v) {
								$query = "SELECT `id`, `name`, `price`, `image`, `description` FROM Products WHERE `id` = '$v'";
								if (!($result = mysqli_query($bdd, $query)))
									echo mysqli_error($bdd);
								$tab = mysqli_fetch_all($result, MYSQLI_ASSOC);
								foreach ($tab as $line) {
									echo '
									<div id="product_b">
										<h3>'.$line["name"].'</h3>
										<img src="'.$line["image"].'" alt="'.$line["name"].'" title="'.$line["description"].'">
										<p class="price">'.$line["price"].' €</p>
										<a href="suppr_panier.php?id_product='.$line["id"].'&key_product='.$k.'"><button type class="button">Supprimer du panier</button></a>
								</div>';
								}
							}
						}
						?>
					</div>

				</div>

				<div id="footer">© gauffret & bfruchar - 2017</div>

			</div>

		</div>
	</body>
</html>
