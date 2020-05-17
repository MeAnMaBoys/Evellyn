<div class="bg_color" style="height: 100vh;">
    <?php echo form_open('Gost/registruj_posetilac',['id'=>'myform','name'=>'posetilac']);?>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 h-100">

                    <div class="form-group h-100">
                        <label style="padding-top: 15px; font-size:28px;">Email adresa</label>
                        <?php
                        $class="form-control font22 ";
                        $val = "";
                        
                        if(isset($email))
                        {
                            $class=$class.$email;
                            $val = $email_val;                    
                        }
                        echo "<input name='email' type='email' class=\"$class\" value=\"$val\" placeholder='user@gmail.com'>";
                        
                        if(isset($email_val)&&($enter==true))
                        {
                            echo "<small style=\"color:#AD343E; font-size:18px;\" class=\"form-text is-invalid\">Vec postoji korisnik registrovan sa zadatom email adresom!</small>";
                        }
                        ?>
                    </div>

                    <div class="form-group h-100">
                        <label style="font-size:28px;">Lozinka</label>
                        <input name="password" type="password" class="form-control font22" placeholder="Password" pattern=".{3,20}" title="lozinka mora biti izmedju 3 i 20 karaktera bilo kog tipa!" required>
                        <?php 
                        if(isset($email_val)&&($enter==true))
                        {
                            echo "<small style=\"color:#59FFA0; font-size:18px;\" class=\"form-text is-invalid\">Molim vas da ponovo unesete lozinku.</small>";
                        }
                        ?>
                    </div>


                </div>

                <div class="col-sm-6 h-100">
                    <div class="form-group h-100">
                        <label  style="padding-top:15px; font-size:28px;">Korisnicko ime</label>
                        <?php 
                        $class="form-control font22 ";
                        $val = "";

                        if(isset($username))
                        {
                            $class=$class.$username;
                            $val = $username_val;
                        }

                        echo "<input name=\"username\" type=\"text\" class=\"$class\" value=\"$val\" pattern=\"[a-zA-Z0-9]{3,15}\" placeholder=\"rale198\" title=\"Slova i brojevi u opsegu od 3 do 15\" required>";
                        if(isset($email_val)&&($enter==true))
                        {
                            $txt = "Korisnicko ime validno uneto!";
                            $clr = "59FFA0";
                            if($username === "is-invalid")
                            {
                                $txt="Korisnicko ime nevalidno uneto!";
                                $clr = "AD343E";
                            }
                            echo "<small style=\"color:#$clr; font-size:18px;\" class=\"form-text is-invalid\">$txt</small>";
                        }                        
                        ?>
                    </div>

                    <div class="form-group h-100">
                        <label style="font-size:28px;">Potvrda lozinke</label>
                        <?php 
                        $class="form-control font22 ";
                        if(isset($password_cf))
                        {
                            $class=$class.$password_cf;
                            echo "<input name=\"password_cf\" type=\"password\" class=\"$class\" placeholder=\"Password\" pattern=\".{3,20}\" title=\"lozinka mora biti izmedju 3 i 20 karaktera bilo kog tipa!\" required>";                         
                        }
                        else
                        {
                            echo "<input name=\"password_cf\" type=\"password\" class=\"$class\" placeholder=\"Password\" pattern=\".{3,20}\" title=\"lozinka mora biti izmedju 3 i 20 karaktera bilo kog tipa!\" required>";                            
                            if(isset($email_val)&&($enter==true))
                            {
                                echo "<small style=\"color:#59FFA0; font-size:18px;\" class=\"form-text is-invalid\">Molim vas da ponovo unesete lozinku.</small>";
                            }
                        }                           
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center subDugme h-100">
                          <button type="submit" class="btn btn-success nalogButton btn-lg btn-block" style="padding-bottom: -4px;">PROSLEDI</button>
                    </div>
                </div>
            </div>
        </div>
</div>