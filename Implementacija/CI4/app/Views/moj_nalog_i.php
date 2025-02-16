<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<!-- Lightcase -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/css/lightcase.min.css" integrity="sha256-+bytSlt6ZKCfCCfKimCjD4CsDW9a0GpM85ZCOBDiLVI=" crossorigin="anonymous" />

<style type="text/css">
    .fit-img {
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center center;
  }

  .image-size {
      padding-bottom: 60%;
  }
</style>
<div  style="height: 100vh;">
  <div class="container">
    <div class="row footFont">
      <div class="col-12 col-md-6 text-center">
        <span class="h1">Slike i video</span>
        <div class="container">
		<div class="row">
            <?php
              $username=$korisnik->Korisnicko_Ime;
              
              $pth = $_SERVER['SCRIPT_FILENAME'];
              $rest = substr($pth,0,strlen($pth)-10);
              $root_path=$rest;
              $dir_path="$root_path/assets/uploads/izvodjaci/$korisnik->Korisnicko_Ime";
                //echo($dir_path);
                try{
                    $images=scandir($dir_path);
                
                    $burl = base_url();
                    foreach($images as $image){
                        if(strpos($image,'.')==0)
                            continue;
                        // echo($image);
                        echo(" 
                        <div class=\"col-6 col-md-4 p-2\">
                        
                        <a href='$burl/assets/uploads/izvodjaci/$username/$image' data-rel=\"lightcase:galerija\">
                            <div style=\"background-image: url('$burl/assets/uploads/izvodjaci/$username/$image');\" class=\"w-100 fit-img image-size\"></div>
                        </a>
                    </div>
                    ");
                    }
                }
                catch(Exception $e){
                    echo('<div class="col-12 p-2">Nema nikakvog sadrzaja</div>');
                }
            ?>
		</div>
	</div>
      </div>
      
      <div class="col-12 col-md-6">

          <div class="row">
            <div class="col-sm-12 text-center">
              <span class="h1 text-center"><?php echo("$tip->Ime $tip->Prezime")?></span><br/>
              <span><?php echo($tip->Tipovi)?></span><br>

              <span class="heading">User Rating</span>
              <span class="fa fa-star <?php if($tip->Prosek_Ocena>1) echo('checked')?>"></span>
              <span class="fa fa-star <?php if($tip->Prosek_Ocena>1.5) echo('checked')?>"></span>
              <span class="fa fa-star <?php if($tip->Prosek_Ocena>2.5) echo('checked')?>"></span>
              <span class="fa fa-star <?php if($tip->Prosek_Ocena>3.5) echo('checked')?>"></span>
              <span class="fa fa-star <?php if($tip->Prosek_Ocena>4.5) echo('checked')?>"></span>
              <p><?php 
              if($tip->Prosek_Ocena==0){
                  echo("No reviews.");
              }
              else{
                $br = round($tip->Prosek_Ocena ,2);
                echo("$br average based on $tip->Broj_Ocena reviews.");
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
                <div style="width: <?php $pom =sizeof($ocene)==0? 0: round($petice/sizeof($ocene)*100) ;echo ("$pom"."%") ?>;" class="bar-5"></div>
              </div>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block"><?php echo $petice;?></div>
          </div>
          <div class="row">
            <div class="col-12 col-md-3">4 star</div>
            <div class="col-12 col-md-7">
              <div class="bar-container">
                <div style="width: <?php $pom =sizeof($ocene)==0? 0: round($cetvorke/sizeof($ocene)*100) ;echo ("$pom"."%") ?>;" class="bar-5"></div>
              </div>
            </div>
              <div class="col-12 col-md-2 d-none d-md-block"><?php echo $cetvorke;?></div>
          </div>
          <div class="row">
            <div class="col-12 col-md-3">3 star</div>
            <div class="col-12 col-md-7">
              <div class="bar-container">
                <div style="width: <?php $pom =sizeof($ocene)==0? 0: round($trojke/sizeof($ocene)*100) ;echo ("$pom"."%") ?>;" class="bar-5"></div>
              </div>
            </div>
             <div class="col-12 col-md-2 d-none d-md-block"><?php echo $trojke;?></div>
          </div>
          <div class="row">
            <div class="col-12 col-md-3">2 star</div>
            <div class="col-12 col-md-7">
              <div class="bar-container">
                  <div style="width: <?php $pom =sizeof($ocene)==0? 0: round($dvojke/sizeof($ocene)*100) ;echo ("$pom"."%") ?>;" class="bar-5"></div>
              </div>
            </div>
                <div class="col-12 col-md-2 d-none d-md-block"><?php echo $dvojke;?></div>
          </div>
          <div class="row">
            <div class="col-12 col-md-3">1 star</div>
            <div class="col-12 col-md-7">
              <div class="bar-container">
                  <div style="width: <?php $pom =sizeof($ocene)==0? 0: round($jedinice/sizeof($ocene)*100) ;echo ("$pom"."%") ?>;" class="bar-5"></div>
              </div>
            </div>
              <div class="col-12 col-md-2 d-none d-md-block"><?php echo $jedinice;?></div>
          </div>
          
          <div class="row d-flex justify-content-center mt-4">
            <div class="col-6 col-md-3">
              <form action="<?php echo base_url('IzvodjacController/konkursi')?>">
                <button class="btn btn-outline-success ls-1" type="submit">Pogledaj konkurse</button>
              </form>
            </div>
            <div class="col-6 col-md-3">
              <form action="<?php echo base_url('IzvodjacController/zahtevi')?>">
                <button class="btn btn-outline-success ls-1" type="submit">Zahtevi za nastupanje</button>
              </form>
            </div>
          </div>
          
      </div>
      <div class="col-6 text-center">
        <?php 
          if(sizeof($images) <11): 
        ?>
         <form action="<?php echo base_url('IzvodjacController/kacenje_sadrzaja')?>">
            <br>
            <br>
            <button class="btn btn-success ls-2" type="submit">Okaci fotografiju ili video</button>
          </form>
        <?php endif;?>
        <?php 
          if(sizeof($images) ==11): 
        ?>
         <form action="<?php echo base_url('IzvodjacController/kacenje_sadrzaja')?>">
            <br>
            <br>
            <span class="h3 text-center">Maksimalan broj datoteka dostignut</span><br/>
          </form>
        <?php endif;?>
      </div>
    </div>
  </div>
</div>
<!-- BOOTSTRAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<!-- Lightcase -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/js/lightcase.min.js" integrity="sha256-o/dXp1WxjpjU37PeBC5vxfc1yf/CgTCjWIzYUozOQ4Q=" crossorigin="anonymous"></script>
	<script type="text/javascript">
	$(document).ready(function($) {
		$('a[data-rel^=lightcase]').lightcase();
	});
	</script>
</body>
</html>