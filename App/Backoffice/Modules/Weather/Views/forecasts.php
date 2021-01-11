<?php
?>

<!-- weather forecast section -->
<section class="mb-3">
	<div class="row">
		<div class="col-12">
			<h4>Prévisions du jour</h4>
			<p><?= $weather ?></p>
			<p><i class="wi <?= $iconClass ?>"></i></p>
			<p>Tmin : <?= $tmin ?> °C </p>
			<p>Tmax : <?= $tmax ?> °C </p>
		</div>
	</div>
</section>

<?php
require(BASE_URL_ROOT.'/App/Backoffice/Templates/footer.php');
