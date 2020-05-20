<div class="bg_color" style="height: 100vh;">
    <?php echo form_open('OrganizatorController/kreiraj_konkurs',['id'=>'myform']);?>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 h-100">

                     <div class="form-group h-100">
                        <label for="exampleInputEmail5" style="padding-top:15px; font-size:28px;">Naziv dogadjaja</label>
                        <input name="naziv" type="text" class="form-control font22" id="exampleInputEmail5" aria-describedby="emailHelp" placeholder="Naziv" required>
                    </div>
                    <div class="form-group h-100">
                        <label for="exampleInputEmail1" style="padding-top: 15px; font-size:28px;">Datum održavanja</label>
                        <input class="form-control font22" type="date"  id="example-date-input " name='date' >
                    </div>

                    <div class="form-group h-100">
                        <label for="exampleInputPassword1" style="font-size:28px;">Vreme održavanja</label>
                        <input class="form-control" type="time"  id="example-time-input" name='time' required>
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
                        
                    </div>

                    

                </div>

                <div class="col-sm-6 h-100">

                    <div class="form-group h-100">
                        <label for="exampleInputEmail5" style="padding-top:15px; font-size:28px;">Lokacija</label>
                        <input name="location" type="text" class="form-control font22" id="exampleInputEmail5" aria-describedby="emailHelp" placeholder="Beograd Mije Kovačevića 7a" required>
                    </div>

                    <div class="form-group h-100">
                        <label for="exampleInputPassword2" style="font-size:28px;">Krajnji datum za prijavu</label>
                        <input class="form-control font22" type="date"  id="example-date-input " name='deadline_date' required>
                    </div>

                    <div class="form-group h-100">
                        <label name="surename" for="exampleInputEmail4" style="font-size:28px;">Vreme za prijavu</label>
                        <input class="form-control" type="time"  id="example-time-input" name='deadline_time' required> 
                    </div>
                    <div class="form-group h-100">
                        <label for="exampleInputEmail5" style="padding-top:15px; font-size:28px;">Opis</label>
                        <textarea class="form-control" name="opis"></textarea>
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