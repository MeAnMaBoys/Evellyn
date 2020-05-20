<div class="bg_color" style="height: 100vh;">
    <?php echo form_open('OrganizatorController/prihvati_zahteve',['id'=>'myform']);?>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group h-100">
                        <input type="hidden" name="id_dog" value="<?php echo($id_dog)?>">
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
    </form>
</div>