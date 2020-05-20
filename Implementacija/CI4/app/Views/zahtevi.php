<section class="headerPic bg-fullwh" style="background-image: url('<?php echo base_url("assets/img/micro1.jpeg");?>')">
    <div class="container d-flex h-100 align-items-center">
    </div>
</section>

<div class="bg_color" style="height: 100%;">
    <div class="page_title">Zahtevi za nastupanje</div>

    <div class="container">
        <div class="row">
            <?php 
            if(!empty($zahtevi)){
            foreach($zahtevi as $zahtev):

                $slika = base_url("assets/img/register.jpeg");
                
                $cpath = base_url($controller."/zahtev?id=$zahtev->ID_Dog"); //dodati za id kako svakog iscrtavati posebno
                
                echo "<div class=\"col-12 col-md-6 col-lg-4 p-3 m-0\">
                <a href='$cpath' class=\"hover-clear\">
                    <div class=\"position-relative\">
                        <div class=\"kartica bg-fullwh kartica-velicina w-100\" style=\"background-image: url('$slika');\">
                            <div class=\"absolute-fullwh blur-bg\"></div>
                            <div class=\"absolute-fullwh\">
                                <div class=\"d-flex h-100 align-items-center justify-content-center\">
                                    <div class=\"font-fredoka font22 whiteLetterColor\">
                                        Zahtev $zahtev->ID_Dog
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>";
            endforeach;
            }
            else{
                echo("<div class=\"col-12 d-flex justify-content-center p-5 fontFredoka\" style=\"font-size:38px;\">Nazalost, trenutno nema ni jedan zahtev.</div>");
            }
            ?>
        </div>
    </div>
</div>
