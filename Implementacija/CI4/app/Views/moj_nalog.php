<div class="bg_color" style="height: 100vh;">
<?php echo form_open('Gost/loginSubmit',['id'=>'myform']);?>
        <div class="container">
            <div class="row">
                <div class="col-sm-3 h-100">

                </div>
                <div class="col-sm-6 h-100">

                    <div class="form-group h-100" style="padding-top: 100px;">
                        <label style="padding-top: 15px; font-size:28px;">Email adresa ili username</label>
                        <?php 
                        $class="form-control font22 ";
                        $val = "";
                        if(isset($usr))
                        {
                          $class=$class.$usr;
                          $val=$user_val;
                        }
                        echo "<input name=\"user\" type=\"text\" class=\"$class\" value=\"$val\" placeholder=\"user@gmail.com ili user198\">";
                        if(isset($user_msg))
                        {
                          echo "<small style=\"color:#AD343E; font-size:18px;\" class=\"form-text is-invalid\">$user_msg</small>";
                        }
                        else
                        echo "<small id=\"emailHelp\" class=\"form-text text-muted\">Budite sigurno da necemo deliti vasu email adresu ni sa kim.</small>";
                        ?>
                      </div>

                      <div class="form-group h-100">
                        <label style="font-size:28px;">Password</label>
                        <?php 
                        if(isset($password_msg))
                        {
                          echo "<input name=\"password\" type=\"password\" class=\"form-control font22 is-invalid\" placeholder=\"Password\">";
                          echo "<small style=\"color:#AD343E; font-size:18px;\" class=\"form-text is-invalid\">Uneli ste pogresnu lozinku!</small>";
                        }
                        else
                        {
                          echo "<input name=\"password\" type=\"password\" class=\"form-control font22\" placeholder=\"Password\">";
                        }
                        ?>
                      </div>

                      <div class="text-center subDugme h-100">
                           <button type="submit" class="btn btn-primary nalogButton">Prijavi se</button>
                          <br>
                          <span class="registrujSe">
                          <a href="<?php echo base_url('Gost/registracija'); ?>"><span class="registrujSe2"><u>Registruj se</u></span></a>
                        </span>
                      </div>
                </div>
            </div>
        </div>
</div>