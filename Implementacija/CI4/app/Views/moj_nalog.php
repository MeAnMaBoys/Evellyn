<div class="bg_color" style="height: 100vh;">
    <form>
        <div class="container">
            <div class="row">
                <div class="col-sm-3 h-100">

                </div>
                <div class="col-sm-6 h-100">

                    <div class="form-group h-100" style="padding-top: 100px;">
                        <label for="exampleInputEmail1" style="padding-top: 15px; font-size:28px;">Email adresa ili username</label>
                        <input type="email" class="form-control font22" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="user@gmail.com ili user198">
                        <small id="emailHelp" class="form-text text-muted">Budite sigurno da necemo deliti vasu email adresu ni sa kim.</small>
                      </div>

                      <div class="form-group h-100">
                        <label for="exampleInputPassword1" style="font-size:28px;">Password</label>
                        <input type="password" class="form-control font22" id="exampleInputPassword1" placeholder="Password">
                      </div>

                      <div class="text-center subDugme h-100">
                         <a href="index.html">
                           <button type="button" class="btn btn-primary nalogButton">Submit</button>
                          </a><br>
                         <span class="registrujSe">
                          <a href="<?php echo base_url('Gost/registracija'); ?>"><span class="registrujSe2"><u>Registruj se</u></span></a>
                        </span>
                      </div>
                </div>
            </div>
        </div>
      </form>
</div>