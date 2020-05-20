<div  style="height: 100vh;">
  <div class="container">
    <div class="row footFont">
      <div class="col-12 col-md-6 text-center">
        <span class="h1">Logo</span>
        <br>
        <img src="<?php echo base_url("assets/uploads/organizatori/$korisnik_prikaz->Korisnicko_Ime/Logo.png")?>" alt="No logo :(" width="100%">
      </div>
      
      <div class="col-12 col-md-6">

          <div class="row">
            <div class="col-sm-12 text-center">
              <span class="h1 text-center"><?php echo("$organizator->Ime $organizator->Prezime")?></span><br/>
              <span>Organizator</span><br>

              <span class="heading">User Rating</span>
              <span class="fa fa-star <?php if($organizator->Prosek_Ocena>1) echo('checked')?>"></span>
              <span class="fa fa-star <?php if($organizator->Prosek_Ocena>1.5) echo('checked')?>"></span>
              <span class="fa fa-star <?php if($organizator->Prosek_Ocena>2.5) echo('checked')?>"></span>
              <span class="fa fa-star <?php if($organizator->Prosek_Ocena>3.5) echo('checked')?>"></span>
              <span class="fa fa-star <?php if($organizator->Prosek_Ocena>4.5) echo('checked')?>"></span>
              <p><?php 
              if($organizator->Prosek_Ocena==0){
                  echo("No reviews.");
              }
              else{
                  echo("$organizator->Prosek_Ocena average based on $organizator->Broj_Ocena reviews.");
              }
              $jedinice = 0;
              $dvojke = 0;
              $trojke = 0;
              $cetvorke = 0;
              $petice = 0;
              foreach($ocene as $oc){
                  switch($oc->Ocena){
                      case 1: $jedinice++; break;
                      case 2: $dvojke++; break;
                      case 3: $trojke ++; break;
                      case 4: $cetvorke++; break;
                      case 5: $petice++; break;
                  }
              }
                ?></p>
              <hr style="border:3px solid #f1f1f1">
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-md-3">5 star</div>
            <div class="col-12 col-md-7">
              <div class="bar-container">
                  <div style="width: <?php $pom = round($petice/sizeof($ocene)*100) ;echo ("$pom"."%") ?>;" class="bar-5"></div>
              </div>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block"> <?php echo $petice ?></div>
          </div>
          <div class="row">
            <div class="col-12 col-md-3">4 star</div>
            <div class="col-12 col-md-7">
              <div class="bar-container">
                <div style="width:<?php $pom = round($cetvorke/sizeof($ocene)*100) ;echo ("$pom"."%") ?>;" class="bar-4"></div>
              </div>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block"><?php echo $cetvorke ?></div>
          </div>
          <div class="row">
            <div class="col-12 col-md-3">3 star</div>
            <div class="col-12 col-md-7">
              <div class="bar-container">
                <div style="width: <?php $pom = round($trojke/sizeof($ocene)*100) ;echo ("$pom"."%") ?>;" class="bar-3"></div>
              </div>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block"><?php echo $trojke ?></div>
          </div>
          <div class="row">
            <div class="col-12 col-md-3">2 star</div>
            <div class="col-12 col-md-7">
              <div class="bar-container">
                <div style="width: <?php $pom = round($dvojke/sizeof($ocene)*100) ;echo ("$pom"."%") ?>;" class="bar-2"></div>
              </div>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block"><?php echo $dvojke ?></div>
          </div>
          <div class="row">
            <div class="col-12 col-md-3">1 star</div>
            <div class="col-12 col-md-7">
              <div class="bar-container">
                <div style="width: <?php $pom = round($jedinice/sizeof($ocene)*100) ;echo ("$pom"."%") ?>;" class="bar-1"></div>
              </div>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block"><?php echo $jedinice ?></div>
          </div>
                     <div class="row d-flex justify-content-center mt-4">
            <?php if($controller == 'PosetilacController'): ?>
            <div class="col-12 col-md-6">
              <form action="<?php echo base_url("$controller/pretplacivanje_organizator")?>">
                  <input type="hidden" name="id" value="<?php echo($organizator->ID_K)?>">
                  <?php
                  if(!$pretplacen){
                    echo("<button class=\"btn btn-info ls-2\" type=\"submit\">Pretplati se na organizatora</button>");
                  }
                  else{
                    echo("<div class=\"font-fredoka font22\">Pretplaceni ste</div>");
                  }?>
              </form>
            </div>
              <?php endif; ?>
          </div>
      </div>
    </div>
  </div>
</div>