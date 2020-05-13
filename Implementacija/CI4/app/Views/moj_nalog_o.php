<div  style="height: 100vh;">
  <div class="container">
    <div class="row footFont">
      <div class="col-12 col-md-6 text-center">
        <span class="h1">Logo</span>
        <img src="<?php echo base_url("assets/uploads/organizatori/$korisnik->Korisnicko_Ime/Logo.png")?>" width="100%">
      </div>
      
      <div class="col-12 col-md-6">

          <div class="row">
            <div class="col-sm-12 text-center">
              <span class="h1 text-center"><?php echo("$organizator->Ime $organizator->Prezime")?></span><br/>
              <span>Organizator</span><br>

              <span class="heading">User Rating</span>
              <span class="fa fa-star <?php if($organizator->Prosek_Ocena>1) echo('checked')?>"></span>
              <span class="fa fa-star <?php if($organizator->Prosek_Ocena>1) echo('checked')?>"></span>
              <span class="fa fa-star <?php if($organizator->Prosek_Ocena>1) echo('checked')?>"></span>
              <span class="fa fa-star <?php if($organizator->Prosek_Ocena>1) echo('checked')?>"></span>
              <span class="fa fa-star"></span>
              <p><?php 
              if($organizator->Prosek_Ocena==0){
                  echo("No reviews.");
              }
              else{
                  echo("$organizator->Prosek_Ocena average based on $organizator->Broj_Ocena reviews.");
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
          
          <div class="row d-flex justify-content-center mt-4">
            <div class="col-6 col-md-3">
              <form action="<?php echo base_url('Organizator/kreiranje_konkursa')?>">
                <button class="btn btn-outline-success ls-1" type="submit">Napravi konkurs</button>
              </form>
            </div>
            <div class="col-6 col-md-3">
              <form action="<?php echo base_url('Organizator/kreiranje_dogadjaja')?>">
                <button class="btn btn-outline-danger ls-2" type="submit">Napravi dogadjaj</button>
              </form>
            </div>
          </div>
      </div>
      <div class="col-6 text-center">
         <form action="<?php echo base_url('Organizator/zamena_loga')?>">
            <br>
            <br>
            <button class="btn btn-success ls-2" type="submit">Zameni logo</button>
          </form>
      </div>
    </div>
  </div>
</div>