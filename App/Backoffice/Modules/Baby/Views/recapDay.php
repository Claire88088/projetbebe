<?php
?>

<!-- day recap section -->
<section>
    <div class="row">
        <div class="col-12">
            <h4>Récapitulatif de la journée</h4>

    <!-- feeding -->
            <h5><?= $feedingsNumber ?> biberon<?php if ($feedingsNumber > 1) echo 's' ?></h5>

<?php if ($feedingsNumber > 0) { ?>
            <table class="table">
                <thead>    
                    <tr>   
                        <th scope="col">Heure</th>
                        <th scope="col">Volume pris</th>
                    </tr>
                </thead>
                <tbody>
    <?php foreach ($feedings as $feeding) { ?> 
                    <tr>  
                        <td><?= $feeding['creationDate']->format('H\hi') ?></td>
                        <td><?= $feeding['volume'] ?> mL</td>
                    </tr>
    <?php } ?>
                </tbody>
            </table>
<?php } ?>


    <!-- change -->
            <h5><?= $babyChangesNumber ?> change<?php if ($babyChangesNumber > 1) echo 's' ?></h5>

<?php if ($babyChangesNumber > 0) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Heure</th>
                        <th scope="col">Type</th>
                    </tr>
                </thead>
                <tbody>
    <?php foreach ($babyChanges as $babyChange) { ?>        
                    <tr>
                        <td><?= $babyChange['creationDate']->format('H\hi') ?></td>
                        <td><?= $babyChange['changeType'] ?></td>
                    </tr>
    <?php } ?>
                </tbody>
            </table>

<?php } ?>


    <!-- sleep -->
            <h5><?= $sleepsNumber ?> sieste<?php if ($sleepsNumber > 1) echo 's' ?></h5>

<?php if ($sleepsNumber > 0) { ?>           
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Début</th>
                        <th scope="col">Fin</th>
                    </tr>
                </thead>
                <tbody>
    <?php foreach ($sleeps as $sleep) { ?>                   
                    <tr>
                        <td><?= $sleep['creationStartDate']->format('H\hi') ?></td>
                        <td><?php if ($sleep['isSleeping'] == 1) { 
                            echo 'Bébé dort encore';
                        } else { 
                            echo $sleep['creationEndDate']->format('H\hi'); 
                        } ?></td>                   
                    </tr>
    <?php } ?>
                </tbody>
            </table>
<?php } ?>  
        </div> 
    </div>
</section>

<?php
require(BASE_URL_ROOT.'/App/Backoffice/Templates/footer.php');



