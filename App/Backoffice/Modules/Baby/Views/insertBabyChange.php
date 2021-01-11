<?php
?>

<section class="mb-3">
  <h2>Ajouter un change</h2>
  <form action="#" method="post">
    <p>Type de change :</p>
    <?= $form ?>
    <input type="submit" class="btn btn-primary" value="Ajouter" />
  </form>
</section>

<?php
require(BASE_URL_ROOT.'/App/Backoffice/Templates/footer.php');
