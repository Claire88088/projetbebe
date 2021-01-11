<!DOCTYPE HTML>

<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
		
		<link rel="icon" href="<?= BASE_URL ?>/images/baby.png" />
		
		<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css" />

		<title><?= isset($title) ? $title : 'Appli bébé' ?></title>
		
		<script src="https://kit.fontawesome.com/5d3855a09d.js" crossorigin="anonymous"></script>
	</head>

	<body>
		<!-- header -->
		<header class="container-fluid">
			<div class="row jumbotron text-center">
				<div class="col">
					<h1><a href="<?= BASE_URL ?>/">Appli Bébé</a></h1>
					<p>Tout pour suivre votre bébé</p>
				</div>	
			</div>
		</header>

		<!-- content -->
		<div class="container">	

<?php if ($user->hasFlash()) { ?>
			<p class="alert alert-dark" role="alert"><?= $user->getFlash() ?></p>
<?php } ?>
				<?= $content ?>
		</div>

		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="<?= BASE_URL ?>/assets/js/rgbToHex.js"></script>
		<script src="<?= BASE_URL ?>/assets/js/main.js"></script>
	</body>
</html>