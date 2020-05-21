<div class="bg_color" style="height: 100vh;">
    <?php echo form_open('OrganizatorController/kreiraj_dogadjaj',['id'=>'myform']);?>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 h-100">

                     <div class="form-group h-100">
                        <label for="exampleInputEmail5" style="padding-top:15px; font-size:28px;">Naziv dogadjaja</label>
                        <?php
                            if(isset($values)&&$valid['name']==true){
                                $value=$values['name'];
                            }
                            else{
                                $value='';
                            }
                            echo("<input name=\"naziv\" value=\"$value\" type=\"text\" class=\"form-control font22\" placeholder=\"Naziv\" required>");
                            if(isset($valid)&&$valid['name']==false){
                                echo("<small style=\"color:#AD343E; font-size:18px;\" class=\"form-text is-invalid\">Neispravan unos imena!</small>");
                            }
                        ?>
                    </div>
                    <div class="form-group h-100">
                        <label for="exampleInputEmail1" style="padding-top: 15px; font-size:28px;">Datum održavanja</label>
                        <?php
                            if(isset($values)&&$valid['date']==true){
                                $value=$values['date'];
                            }
                            else{
                                $value='';
                            }
                            echo("<input name=\"date\" value=\"$value\" type=\"date\" class=\"form-control font22\" required>");
                            if(isset($valid)&&$valid['date']==false){
                                echo("<small style=\"color:#AD343E; font-size:18px;\" class=\"form-text is-invalid\">Datum odrzavanja dogadjaja mora biti u buducnosti!</small>");
                            }
                        ?>
                    </div>

                    <div class="form-group h-100">
                        <label for="exampleInputPassword1" style="font-size:28px;">Vreme održavanja</label>
                        <?php
                            if(isset($values)&&$valid['time']==true){
                                $value=$values['time'];
                            }
                            else{
                                $value='';
                            }
                            echo("<input name=\"time\" value=\"$value\" type=\"time\" class=\"form-control font22\" required>");
                            if(isset($valid)&&$valid['time']==false){
                                echo("<small style=\"color:#AD343E; font-size:18px;\" class=\"form-text is-invalid\">Vreme odrzavanja nije korektno!</small>");
                            }
                        ?>
                    </div>

                    <div class="form-group h-100">
                        <label for="exampleInputEmail3" style="font-size:28px;">Tip događaja</label>
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                    <input class="form-check-input" type="radio" name="Radios" id="Radios4" value="zurka">
                                    <label class="form-check-label" for="Radios4">
                                        Zurka
                                    </label>
                                </div>
                                <div class="col-4">
                                    <input class="form-check-input" type="radio" name="Radios" id="Radios5" value="nastup">
                                    <label class="form-check-label" for="Radios5">
                                        Nastup
                                    </label>
                                </div>
                                <div class="col-4">
                                    <input class="form-check-input" type="radio" name="Radios" id="Radios6" value="Koncert">
                                    <label class="form-check-label" for="Radios6">
                                        Koncert
                                    </label>
                                </div>
                                <div class="col-4">
                                    <input class="form-check-input" type="radio" name="Radios" id="Radios7" value="Drugo">
                                    <label class="form-check-label" for="Radios7">
                                       Drugo
                                    </label>
                                </div>
                            </div>
                        </div>
                        <?php
                        if(isset($valid)&&$valid['type']==false){
                                echo("<small style=\"color:#AD343E; font-size:18px;\" class=\"form-text is-invalid\">Morate odabrati tip dogadjaja!</small>");
                        }
                        ?>
                    </div>

                    

                </div>

                <div class="col-sm-6 h-100">

                    <div class="form-group h-100">
                        <label for="exampleInputEmail5" style="padding-top:15px; font-size:28px;">Lokacija</label>
                        <?php
                            if(isset($values)&&$valid['location']==true){
                                $value=$values['location'];
                            }
                            else{
                                $value='';
                            }
                            echo("<input name=\"location\" value=\"$value\" type=\"text\" class=\"form-control font22\" placeholder=\"Beograd Mije Kovačevića 7a\" required>");
                            if(isset($valid)&&$valid['location']==false){
                                echo("<small style=\"color:#AD343E; font-size:18px;\" class=\"form-text is-invalid\">Neispravna lokacija!</small>");
                            }
                        ?>
                    </div>

                    <div class="form-group h-100">
                        <label for="exampleInputEmail5" style="padding-top:15px; font-size:28px;">Opis</label>
                        <textarea class="form-control" <?php if(isset($valid)&&$valid['desc']==true) echo("value=\"".$values['desc']."\" ")?>name="opis"></textarea>
                        <?php
                            if(isset($valid)&&$valid['desc']==false){
                                echo("<small style=\"color:#AD343E; font-size:18px;\" class=\"form-text is-invalid\">Neispravan opis!</small>");
                            }  
                        ?>
                    </div>
                    <div class="form-group h-100">
                    <label style="padding-top:15px; font-size:28px;">Odaberite Izvodjace</label>
                    <select multiple class = "form-control" name="izvodjaci[]">
                        <?php 
                            foreach($izvodjaci as $izvodjac){
                                echo("<option value='$izvodjac->ID_K'>$izvodjac->Ime $izvodjac->Prezime</option>");
                            }
                        ?>
                    </select>
                    </div>
                </div>
                
                <div class="col-4">
                </div>
                <div class="col-4">
                    
                    <div class="text-center subDugme h-100">
                        <button type="submit" class="btn btn-success nalogButton btn-lg btn-block" style="padding-bottom: -4px;">Objavi dogadjaj</button>
                    </div>
                </div>
                <div class="col-4">
                    
                </div>
                
            </div>
        </div> 
    </form>
</div>