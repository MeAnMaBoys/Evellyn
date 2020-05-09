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

                        echo "<input name=\"username\" type=\"text\" class=\"$class\" value=\"$val\" placeholder=\"rale198\">";
                        if(isset($email_val)&&strcmp($email_val,"")!=0)
                        {
                            echo '<small style="padding-bottom:18px;"><small>';
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
                        }
                            echo "<input name=\"password_cf\" type=\"password\" class=\"$class\" placeholder=\"Password\">";                        
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center subDugme h-100">
                          <button type="submit" class="btn btn-success nalogButton btn-lg btn-block" style="padding-bottom: -4px;">Submit</button>
                    </div>
                </div>
            </div>
        </div>
</div>