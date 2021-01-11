<?php
?>

<!-- last informations section -->
<section class="mb-3">
    <div class="row">
        <div class="col-12 text-center">
<?php 
    if (isset($lastFeeding) OR isset($lastBabyChange) OR isset($lastSleep)) { ?>
            <h2>Dernières informations enregistrées :</h2>
<?php }
    if (isset($lastFeeding)) { ?>
            <p>Bébé a bu <?= $lastFeeding['volume'] ?> mL à <?= $lastFeeding['creationDate']->format('H\hi') ?>.</p>
<?php }
    if (isset($lastBabyChange)) { ?>
            <p>Il a été changé à <?= $lastBabyChange['creationDate']->format('H\hi') ?> (<?= $lastBabyChange['changeType'] ?>).</p>
<?php }
    if (isset($lastSleep) && $lastSleep['isSleeping'] == 1) { ?>
            <p>Et il s'est endormi à <?= $lastSleep['creationStartDate']->format('H\hi') ?>.</p>
<?php } 
    if (isset($lastSleep) && $lastSleep['isSleeping'] == 0) { ?>
            <p>Et il s'est réveillé à <?= $lastSleep['creationEndDate']->format('H\hi') ?>.</p>
<?php } ?>    
        </div>    
    </div>
</section>

<!-- add informations section -->
<section class="mb-3">
    <div class="row">
        <div class="col-12 text-center">
            <h2>Enregistrer de nouvelles infos :</h2>
            
            <div class="row">
                <!-- feeding -->
                <div class="col-12 col-md-4">
                    <div class="card card-link text-center">
                        <a href="feeding-insert.html" class="card-body">    
                                <i class="fas fa-utensils"></i>
                                <h3 class="card-title">Alimentation</h3>   
                        </a>
                    </div>     
                </div> 

                <!-- change -->
                <div class="col-12 col-md-4">
                    <div class="card card-link text-center">
                        <a href="babychange-insert.html" class="card-body">    
                            <i id="test" class="fas fa-baby"></i>
                            <h3 class="card-title">Change</h3>
                        </a>
                    </div>    
                </div>

                <!-- sleep -->
                <div class="col-12 col-md-4">
                    <div class="card card-link text-center">
                        <a href="sleep-insert.html" class="card-body">  
                            <i class="fas fa-bed"></i>
                            <h3 class="card-title">Sommeil</h3>
                        </a>
                    </div>    
                </div>

            </div>
        </div>
    </div>
</section>

<section>
    <div class="row">
        <div class="col-12 text-center">
            <h2>Informations supplémentaires :</h2>
            
            <div class="row">
                <!-- day recap  -->
                <div class="col-12 col-md-6">
                    <div class="card card-link text-center">
                        <a href="day-recap.html" class="card-body">
                            <i class="fas fa-chart-bar"></i>
                            <h3 class="card-title">Récapitulatif de la journée</h3>
                        </a>
                    </div>    
                </div>

                <!-- weather -->
                <div class="col-12 col-md-6">
                    <div class="card card-link text-center">
                        <a href="weather-index.html" class="card-body">
                            <i class="fas fa-cloud-sun"></i>
                            <h3 class="card-title">Météo</h3>
                        </a>
                    </div>    
                </div>

            </div>
        </div>
    </div>
</section>



  



  

  
 

