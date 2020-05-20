<section class="headerPic bg-fullwh" style="background-image: url('<?php echo base_url("assets/img/micro1.jpeg");?>')">
    <div class="container d-flex h-100 align-items-center">
    </div>
</section>

<div class="bg_color" style="height: 100%;">
    <div class="page_title"> <?php echo("$dogadjaj->Naziv - zahtev za nastupanje")?></div>

    <div class="container">
    <div class="row">
            <div class="col-2"></div>
           <div class="col-4  font-fredoka font22 whiteLetterColor ">Naziv:</div>
           <div class="col-6  font-fredoka font22 whiteLetterColor"><?php echo($dogadjaj->Naziv)?></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
           <div class="col-4  font-fredoka font22 whiteLetterColor ">Tip dogadjaja:</div>
           <div class="col-6  font-fredoka font22 whiteLetterColor"><?php echo($dogadjaj->Tip)?></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
           <div class="col-4  font-fredoka font22 whiteLetterColor ">Vreme odrzavanja:</div>
           <div class="col-6  font-fredoka font22 whiteLetterColor"><?php echo($dogadjaj->Datum_Vreme)?></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
           <div class="col-4  font-fredoka font22 whiteLetterColor ">Lokacija:</div>
           <div class="col-6  font-fredoka font22 whiteLetterColor"><?php echo($dogadjaj->Lokacija)?></div>
        </div>
        <div class="row">
            <div class="col-2"></div>
           <div class="col-8  font-fredoka font22 whiteLetterColor "><?php echo($dogadjaj->Opis)?></div>
           <div class="col-2  font-fredoka font22 whiteLetterColor"></div>
        </div>
        <div class="col-12 text-center">
         <form action="<?php echo base_url("$controller/organizator?id=$dogadjaj->Organizator")?>" method="post" >
            <br>
            <br>
            <button class="btn btn-success ls-2" type="submit">Profil organizatora</button>
          </form>
      </div>
        <form action="<?php echo base_url('IzvodjacController/prihvati_zahtev')?>">
          <input type="hidden" name="id" value="<?php echo($dogadjaj->ID_Dog)?>">
          <div class="row pt-2">
              <button class="btn btn-info ls-2 mid_btn " type="submit">Prihvati zahtev</button>
          </div>
        </form>

    </div>
</div>
