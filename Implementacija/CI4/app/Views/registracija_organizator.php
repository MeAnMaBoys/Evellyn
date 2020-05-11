<div class="bg_color" style="height: 100vh;">
    <?php echo form_open('Gost/registruj_organizator',['id'=>'myform','name'=>'organizator']);?>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 h-100">

                    <div class="form-group h-100">
                        <label style="padding-top: 15px; font-size:28px;" required>Email adresa</label>
                        <?php
                        $class="form-control font22 ";
                        $val = "";
                        
                        if(isset($email))
                        {
                            $class=$class.$email;
                            $val = $email_val;                    
                        }
                        echo "<input name='email' type='text' class=\"$class\" value=\"$val\" placeholder='user@gmail.com'>";
                        
                        if(isset($email_val)&&($enter==true))
                        {
                            echo "<small style=\"color:#AD343E; font-size:18px;\" class=\"form-text is-invalid\">Vec postoji korisnik registrovan sa zadatom email adresom!</small>";
                        }
                        ?>
                    </div>

                    <div class="form-group h-100">
                        <label style="font-size:28px;">Lozinka</label>
                        <input name="password" type="password" class="form-control font22" placeholder="Password">
                        <?php 
                        if(isset($email_val)&&($enter==true))
                        {
                            echo "<small style=\"color:#59FFA0; font-size:18px;\" class=\"form-text is-invalid\">Molim vas da ponovo unesete lozinku.</small>";
                        }
                        ?>
                    </div>

                    <div class="form-group h-100">
                        <label style="font-size:28px;">Ime</label> <! pattern="[a-zA-Z]{2,15}">
                        <?php 

                        $class="form-control font22 ";
                        $val = "";
                        if(isset($name))
                        {
                            $class=$class.$name;
                            $val=$name_val;
                        }
                        echo "<input name=\"name\" type=\"text\" class=\"$class\" value=\"$val\" id=\"exampleInputEmail3\" aria-describedby=\"emailHelp\" placeholder=\"Nikola\" title=\"Ime moze sadrzati samo mala i velika slova u opsegu 2-15!\">";
                        if(isset($email_val)&&($enter==true))
                        {
                            $txt = "Ime validno uneto!";
                            $clr = "59FFA0";
                            if($name === "is-invalid")
                            {
                                $txt="Ime nevalidno uneto!";
                                $clr = "AD343E";
                            }
                            echo "<small style=\"color:#$clr; font-size:18px;\" class=\"form-text is-invalid\">$txt</small>";
                        }
                        ?>
                    </div>

                    <div class="form-group h-100">
                        <label style="font-size:28px;">Telefon</label><! pattern="[0-9]{9,12}">
                        <?php 
                        $class="form-control font22 ";
                        $val = "";

                        if(isset($phone))
                        {
                            $class=$class.$phone;
                            $val = $phone_val;
                        }

                        echo "<input name=\"phone\" type=\"text\" class=\"$class\" value=\"$val\" id=\"exampleInputEmail5\" aria-describedby=\"emailHelp\" placeholder=\"065/3550751\">";
                        if(isset($email_val)&&($enter==true))
                        {
                            $txt = "Telefon validno unet!";
                            $clr = "59FFA0";
                            if($phone === "is-invalid")
                            {
                                $txt="Telefon nevalidno unet!";
                                $clr = "AD343E";
                            }
                            echo "<small style=\"color:#$clr; font-size:18px;\" class=\"form-text is-invalid\">$txt</small>";
                        }                              
                        ?>
                    </div>

                </div>

                <div class="col-sm-6 h-100">
                    <div class="form-group h-100">
                        <label style="padding-top:15px; font-size:28px;">Korisnicko ime</label><! pattern="[a-zA-Z0-9]{3,15}">
                        
                        <?php 
                        $class="form-control font22 ";
                        $val = "";

                        if(isset($username))
                        {
                            $class=$class.$username;
                            $val = $username_val;
                        }

                        echo "<input name=\"username\" type=\"text\" class=\"$class\" value=\"$val\" placeholder=\"rale198\">";
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
                            echo "<input name=\"password_cf\" type=\"password\" class=\"$class\" placeholder=\"Password\">";                         
                        }
                        else
                        {
                            echo "<input name=\"password_cf\" type=\"password\" class=\"$class\" placeholder=\"Password\">";                            
                            if(isset($email_val)&&($enter==true))
                            {
                                echo "<small style=\"color:#59FFA0; font-size:18px;\" class=\"form-text is-invalid\">Molim vas da ponovo unesete lozinku.</small>";
                            }
                        }                        

                        ?>
                    </div>

                    <div class="form-group h-100">
                        <label style="font-size:28px;">Prezime</label><! pattern="[a-zA-Z]{2,15}">

                        <?php 
                        $class="form-control font22 ";
                        $val = "";

                        if(isset($surename))
                        {
                            $class=$class.$surename;
                            $val = $surename_val;
                        }

                        echo "<input name=\"surename\" type=\"text\" class=\"$class\" value=\"$val\" placeholder=\"Jugovic\">";
                        if(isset($email_val)&&($enter==true))
                        {
                            $txt = "Prezime validno uneto!";
                            $clr = "59FFA0";
                            if($surename === "is-invalid")
                            {
                                $txt="Prezime nevalidno uneto!";
                                $clr = "AD343E";
                            }
                            echo "<small style=\"color:#$clr; font-size:18px;\" class=\"form-text is-invalid\">$txt</small>";
                        }                             
                        ?>
                    </div>

                    <div class="text-center subDugme h-100">
                          <button type="submit" class="btn btn-success nalogButton btn-lg btn-block" style="padding-bottom: -4px;">PROSLEDI</button>
                    </div>
                </div>
            </div>
        </div>
</form>
</div>