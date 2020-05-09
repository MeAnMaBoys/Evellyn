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
                        ?>
                    </div>

                    <div class="text-center subDugme h-100">
                          <button type="submit" class="btn btn-success nalogButton btn-lg btn-block" style="padding-bottom: -4px;">Submit</button>
                    </div>
                </div>
            </div>
        </div>
</form>
</div>