<div class="bg_color" style="height: 100vh;">
<form action="<?php echo base_url("$controller/okaci_sadrzaj");?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 h-100">
                    <br>
                    <input type="file" name="file" id="file">
                    <br>
                    <br>
                    <?php
                        if(isset($poruka)){
                            echo("<div class=\"font-fredoka\">$poruka</div>");
                        }
                    ?>
                    <br>
                    <br>
                </div>
                <div class="col-4"></div>
                <div class="col-4">
                
                    <button type="submit" class="btn btn-success nalogButton btn-lg btn-block" style="padding-bottom: -4px;">Okaci sadrzaj</button>

                </div>
                <div class="col-4"></div>
            </div>

        </div>
    </form>
</div>