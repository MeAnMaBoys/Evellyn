<div class="bg_color" style="height: 100vh;">
    <?php echo form_open('OrganizatorController/kreiraj_konkurs',['id'=>'myform']);?>
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
                                    <input class="form-check-input" type="radio" name="Radios" id="Radios6" value="koncert">
                                    <label class="form-check-label" for="Radios6">
                                        Koncert
                                    </label>
                                </div>
                                <div class="col-4">
                                    <input class="form-check-input" type="radio" name="Radios" id="Radios7" value="drugo">
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
                        <label for="exampleInputPassword2" style="font-size:28px;">Krajnji datum za prijavu</label>
                        <?php
                            if(isset($values)&&$valid['deadline_date']==true){
                                $value=$values['deadline_date'];
                            }
                            else{
                                $value='';
                            }
                            echo("<input name=\"deadline_date\" value=\"$value\" type=\"date\" class=\"form-control font22\" required>");
                            if(isset($valid)&&$valid['deadline_date']==false){
                                echo("<small style=\"color:#AD343E; font-size:18px;\" class=\"form-text is-invalid\">Rok za prijavu mora biti pre odrzavanja dogadjaja!</small>");
                            }
                        ?>                            
                    </div>

                    <div class="form-group h-100">
                        <label name="surename" for="exampleInputEmail4" style="font-size:28px;">Vreme za prijavu</label>
                        <?php
                            if(isset($values)&&$valid['deadline_time']==true){
                                $value=$values['deadline_time'];
                            }
                            else{
                                $value='';
                            }
                            echo("<input name=\"deadline_time\" value=\"$value\" type=\"time\" class=\"form-control font22\" required>");
                            if(isset($valid)&&$valid['time']==false){
                                echo("<small style=\"color:#AD343E; font-size:18px;\" class=\"form-text is-invalid\">Vreme za prijavu na konkurs nije korektno!</small>");
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
                    
                </div>
                
                <div class="col-4">
                <input class="form-check-input" type="checkbox" name="send_mails" value="send_mails" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                        Posalji mail-ove izvodjacima
                    </label>
                </div>
                <div class="col-4">
                    
                    <div class="text-center subDugme h-100">
                        <button type="submit" class="btn btn-success nalogButton btn-lg btn-block" style="padding-bottom: -4px;">Raspiši konkurs</button>
                    </div>
                </div>
                <div class="col-4">
                    
                </div>
                
            </div>
        </div>
</form>
</div>