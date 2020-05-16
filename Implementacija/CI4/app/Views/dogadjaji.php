<section class="headerPic bg-fullwh" style="background-image: url('<?php echo base_url("assets/img/micro1.jpeg");?>')">
    <div class="container d-flex h-100 align-items-center">
    </div>
</section>

<div class="bg_color" style="height: 100%;">
    <div class="page_title">Dogadjaji</div>

    <div class="container">
        <div class="row">
            <?php 
            foreach($dogadjaji as $dogadjaj):
                $slika = base_url("assets/img/event.jpg");
                
                $cpath = base_url("$controller/dogadjaj?id=$dogadjaj->ID_Dog");
                
                echo "<div class=\"col-12 col-md-6 col-lg-4 p-3 m-0\">
                <a href='$cpath' class=\"hover-clear\">
                    <div class=\"position-relative\">
                        <div class=\"kartica bg-fullwh kartica-velicina w-100\" style=\"background-image: url('$slika');\">
                            <div class=\"absolute-fullwh blur-bg\"></div>
                            <div class=\"absolute-fullwh\">
                                <div class=\"d-flex h-100 align-items-center justify-content-center\">
                                    <div class=\"font-fredoka font22 whiteLetterColor\">
                                         $dogadjaj->Naziv
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
