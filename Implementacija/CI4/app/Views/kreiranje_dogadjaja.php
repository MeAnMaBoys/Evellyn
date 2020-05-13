<div class="bg_color" style="height: 100vh;">
    <?php echo form_open('Organizator/kreiraj_dogadjaj',['id'=>'myform']);?>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 h-100">

                    <div class="form-group h-100">
                        <label for="exampleInputEmail1" style="padding-top: 15px; font-size:28px;">Datum održavanja</label>
                        <input class="form-control font22" type="date"  id="example-date-input " name='date' required>
                    </div>

                    <div class="form-group h-100">
                        <label for="exampleInputPassword1" style="font-size:28px;">Vreme održavanja</label>
                        <input class="form-control" type="time"  id="example-time-input" name='time' required>
                    </div>

                    

                    

                </div>

                <div class="col-sm-6 h-100">

                    <div class="form-group h-100">
                        <label for="exampleInputEmail5" style="padding-top:15px; font-size:28px;">Lokacija</label>
                        <input name="location" type="text" class="form-control font22" id="exampleInputEmail5" aria-describedby="emailHelp" placeholder="Beograd Mije Kovačevića 7a" required>
                    </div>

                    <div class="form-group h-100">
                        <label for="exampleInputEmail3" style="font-size:28px;">Tip događaja</label>
                        <input name="type" type="text" class="form-control font22" id="exampleInputEmail3" aria-describedby="emailHelp" placeholder="Koncert" required>
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