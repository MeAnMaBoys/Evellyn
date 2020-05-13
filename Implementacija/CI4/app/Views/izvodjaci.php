<section class="headerPic bg-fullwh" style="background-image: url('<?php echo base_url("assets/img/micro1.jpeg");?>')">
    <div class="container d-flex h-100 align-items-center">
    </div>
</section>

<div class="bg_color" style="height: 100%;">
    <div class="page_title">IZVODJACI</div>

    <div class="container">
        <div class="row">
            <?php 
            foreach($izvodjaci as $izvodjac):

                $tipovi=explode(' ',$izvodjac->Tipovi);
                $slika = base_url("assets/img/singer4.jpeg");
                foreach($tipovi as $tip){
                    if($tip=='gitarista'){
                        $slika=base_url("assets/img/guitarist.jpg");
                        break;
                    }
                    else if($tip=='pevac'){
                        $slika=base_url("assets/img/singer.jpeg");
                        break;
                    }
                    else if($tip=='basista'){
                        $slika=base_url("assets/img/bass.jpg");
                        break;
                    }
                    
                }
                
                $cpath = base_url($controller."/izvodjac?id=$izvodjac->ID_K"); //dodati za id kako svakog iscrtavati posebno
                
                echo "<div class=\"col-12 col-md-6 col-lg-4 p-3 m-0\">
                <a href='$cpath' class=\"hover-clear\">
                    <div class=\"position-relative\">
                        <div class=\"kartica bg-fullwh kartica-velicina w-100\" style=\"background-image: url('$slika');\">
                            <div class=\"absolute-fullwh blur-bg\"></div>
                            <div class=\"absolute-fullwh\">
                                <div class=\"d-flex h-100 align-items-center justify-content-center\">
                                    <div class=\"font-fredoka font22 whiteLetterColor\">
                                        $izvodjac->Ime $izvodjac->Prezime
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>";
            endforeach;
            ?>
        </div>
    </div>
</div>
