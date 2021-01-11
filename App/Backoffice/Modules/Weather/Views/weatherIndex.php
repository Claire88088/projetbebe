<?php
?>

<!-- weather form section -->
<section class="mb-3">
	<h2>Prévisions météo</h2>
	<form action="<?= BASE_URL ?>/admin/forecasts.html" method="post">
		<p>
			<div class="form-group">
				<label for="departement-select">Choisir le département :</label>

				<select class="form-control" name="departement" id="departement-select" autofocus>
	<?php foreach ($departements as $deptNumber => $deptString) { ?>
					<option value="<?= $deptNumber ?>"><?= $deptNumber ?> - <?= $deptString ?></option>
	<?php } ?>
				</select>
			</div>
		</p>
		<p>
			<input type="submit" class="btn btn-primary" value="Choisir" />
		</p>
	</form>
</section>

<?php
require(BASE_URL_ROOT.'/App/Backoffice/Templates/footer.php');

	
	


	


