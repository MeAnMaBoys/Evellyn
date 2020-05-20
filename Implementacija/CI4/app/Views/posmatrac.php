
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
                $username=$korisnik_prikaz->Korisnicko_Ime;
                $root_path=$_SERVER['DOCUMENT_ROOT'];
                $dir_path="$root_path\assets\uploads\izvodjaci\\$username";
                //echo($dir_path);
                try{
                    $images=scandir($dir_path);
                
                    foreach($images as $image){
                        if($image=='.'||$image=='..')
                            continue;
                        // echo($image);
                        echo(" 
                        <div class=\"col-6 col-md-4 p-2\">
                        
                        <a href='http://localhost:8080/assets/uploads/izvodjaci/$username/$image' data-rel=\"lightcase:galerija\">
                            <div style=\"background-image: url('http://localhost:8080/assets/uploads/izvodjaci/$username/$image');\" class=\"w-100 fit-img image-size\"></div>
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
              <span class="h1 text-center"><?php echo("$izvodjac_prikaz->Ime $izvodjac_prikaz->Prezime")?></span><br/>
              <span><?php echo($izvodjac_prikaz->Tipovi)?></span><br>

              <span class="heading">User Rating</span>
              <span class="fa fa-star <?php if($izvodjac_prikaz->Prosek_Ocena>1) echo('checked')?>"></span>
              <span class="fa fa-star <?php if($izvodjac_prikaz->Prosek_Ocena>1) echo('checked')?>"></span>
              <span class="fa fa-star <?php if($izvodjac_prikaz->Prosek_Ocena>1) echo('checked')?>"></span>
              <span class="fa fa-star <?php if($izvodjac_prikaz->Prosek_Ocena>1) echo('checked')?>"></span>
              <span class="fa fa-star"></span>
              <p><?php 
              if($izvodjac_prikaz->Prosek_Ocena==0){
                  echo("No reviews.");
              }
              else{
                  echo("$izvodjac_prikaz->Prosek_Ocena average based on $izvodjac_prikaz->Broj_Ocena reviews.");
              }
                ?></p>
              <hr style="border:3px solid #f1f1f1">
            </div>
          </div>

          <div class="row">
            <div class="col-12 col-md-3">5 star</div>
            <div class="col-12 col-md-7">
              <div class="bar-container">
                <div style="width: 40%;" class="bar-5"></div>
              </div>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block">151</div>
          </div>
          <div class="row">
            <div class="col-12 col-md-3">4 star</div>
            <div class="col-12 col-md-7">
              <div class="bar-container">
                <div style="width: 60%;" class="bar-4"></div>
              </div>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block">151</div>
          </div>
          <div class="row">
            <div class="col-12 col-md-3">3 star</div>
            <div class="col-12 col-md-7">
              <div class="bar-container">
                <div style="width: 30%;" class="bar-3"></div>
              </div>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block">151</div>
          </div>
          <div class="row">
            <div class="col-12 col-md-3">2 star</div>
            <div class="col-12 col-md-7">
              <div class="bar-container">
                <div style="width: 20%;" class="bar-2"></div>
              </div>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block">151</div>
          </div>
          <div class="row">
            <div class="col-12 col-md-3">1 star</div>
            <div class="col-12 col-md-7">
              <div class="bar-container">
                <div style="width: 5%;" class="bar-1"></div>
              </div>
            </div>
            <div class="col-12 col-md-2 d-none d-md-block">10</div>
          </div>
          <form action="<?php echo base_url('PosetilacController/ocenjivanje_i')?>">
          <div class="row">
            <div class="slidecontainer pt-4" >
                <input type="range" min="1" max="5" value="5" step="1" class="slider" id="myRange" name="ocena">
            </div>
              <div class="marks">
                  <span class="sigle-mark font-fredoka font22">1</span>
                  <span class="sigle-mark font-fredoka font22">2</span>
                  <span class="sigle-mark font-fredoka font22">3</span>
                  <span class="sigle-mark font-fredoka font22">4</span>
                  <span class="sigle-mark font-fredoka font22">5</span>
              </div>
                 
          </div>
          <input type="hidden" name="id" value="<?php echo($korisnik_prikaz->ID_K)?>">
          <div class="row pt-2">
              <button class="btn btn-info ls-2 mid_btn " type="submit">Oceni</button>
          </div>
          </form>
      </div>
        <div class="col-6 text-center">
            <form action="<?php echo base_url('PosetilacController/pretplacivanje')?>">
                <br>
                <br>
                <input type="hidden" name="id" value="<?php echo($korisnik_prikaz->ID_K)?>">
                <?php
                  if(!$pretplacen){
                    echo("<button class=\"btn btn-info ls-2\" type=\"submit\">Pretplati se</button>");
                  }
                  else{
                    echo("<div class=\"font-fredoka font22\">Pretplaceni ste</div>");
                  }
                ?>
            </form>
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

