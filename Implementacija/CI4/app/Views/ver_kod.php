<div class="bg_color" style="height: 100%;">
   <?php echo form_open('Gost/ver_kod',[]);?>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-4 pt-4">
                <span class="big font-fredoka whiteLetterColor">VERIFIKACIONI KOD</span>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center text-center">
                <span class="font-fredoka whiteLetterColor">MOLIMO VAS DA UNESETE KOD KOJI SMO VAM PROSLEDILI PUTEM EMAILA!</span>
            </div>
        </div>
        <div class="row d-flex justify-content-center text-center mt-4 pt-4">
            <div class="col-1">
                <div class="form-group">
                    <select class="form-control font22" name="first">
                      <option>0</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>7</option>
                      <option>8</option>
                      <option>9</option>
                    </select>
                  </div>
            </div><div class="col-1">
                <div class="form-group">
                    <select class="form-control font22" name="second">
                      <option>0</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>7</option>
                      <option>8</option>
                      <option>9</option>
                    </select>
                  </div>
            </div><div class="col-1">
                <div class="form-group">
                    <select class="form-control font22" name="third">
                      <option>0</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>7</option>
                      <option>8</option>
                      <option>9</option>
                    </select>
                  </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <select class="form-control font22" name="fourth">
                      <option>0</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>7</option>
                      <option>8</option>
                      <option>9</option>
                    </select>
                  </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <select class="form-control font22" name="fifth">
                      <option>0</option>
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                      <option>6</option>
                      <option>7</option>
                      <option>8</option>
                      <option>9</option>
                    </select>
                  </div>
            </div>
        </div>
        <?php 
        if(isset($opis))
        {
          echo "<div class=\"row\">
          <div class=\"col-12 d-flex justify-content-center text-center\">
              <span class=\"font-fredoka whiteLetterColor\" style=\"color:#BA2D0B;\">$opis</span>
          </div></div>";
        }
        ?>
        <div class="row d-flex justify-content-center">
            
                <?php 
                if(isset($flag))
                {
                  echo "<div class=\"col-lg-12 col-12 d-flex justify-content-center text-center\">";
                  echo "<span class=\"big font-fredoka whiteLetterColor\" style=\"color:#59FFA0;\">USPESNO STE VERIFIKOVALI VAS NALOG!</span></div>";
                }
                else
                {
                  echo "<div class=\"col-lg-2 col-3 \">";
                  echo "<button type=\"submit\" class=\"btn btn-success nalogButton btn-block mt-5\">Posalji</button></div>";
                }
                ?>
        </div>
    </div>
</div>
