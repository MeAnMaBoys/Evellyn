<div class="bg_color" style="height: 100vh;">
    <?php echo form_open('Gost/registruj',['id'=>'myform']);?>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 h-100">

                    <div class="form-group h-100">
                        <label for="exampleInputEmail1" style="padding-top: 15px; font-size:28px;">Email adresa</label>
                        <input name="email" type="email" class="form-control font22" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="user@gmail.com">
                    </div>

                    <div class="form-group h-100">
                        <label for="exampleInputPassword1" style="font-size:28px;">Lozinka</label>
                        <input name="password" type="password" class="form-control font22" id="exampleInputPassword1" placeholder="Password">
                    </div>

                    <div class="form-group h-100">
                        <label for="exampleInputEmail3" style="font-size:28px;">Ime</label>
                        <input name="name" type="text" class="form-control font22" id="exampleInputEmail3" aria-describedby="emailHelp" placeholder="Nikola">
                    </div>

                    <div class="form-group h-100">
                        <label for="exampleInputEmail5" style="font-size:28px;">Telefon</label>
                        <input name="phone" type="text" class="form-control font22" id="exampleInputEmail5" aria-describedby="emailHelp" placeholder="063/09041998">
                    </div>

                </div>

                <div class="col-sm-6 h-100">
                    <div class="form-group h-100">
                        <label for="exampleInputEmail2" style="padding-top:15px; font-size:28px;">Korisnicko ime</label>
                        <input name="username" type="text" class="form-control font22" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="rale198">
                    </div>

                    <div class="form-group h-100">
                        <label for="exampleInputPassword2" style="font-size:28px;">Potvrda lozinke</label>
                        <input name="password_cf" type="password" class="form-control font22" id="exampleInputPassword2" placeholder="Password">
                    </div>

                    <div class="form-group h-100">
                        <label name="surename" for="exampleInputEmail4" style="font-size:28px;">Prezime</label>
                        <input type="text" class="form-control font22" id="exampleInputEmail4" aria-describedby="emailHelp" placeholder="Jugovic">
                    </div>

                    <div class="text-center subDugme h-100">
                          <button type="submit" class="btn btn-success nalogButton btn-lg btn-block" style="padding-bottom: -4px;">Submit</button>
                    </div>
                </div>
            </div>
        </div>
</form>
</div>