<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evelynn</title>

    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Jost:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text&family=Dosis&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@1&family=Pangolin&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/css/lightcase.min.css" integrity="sha256-+bytSlt6ZKCfCCfKimCjD4CsDW9a0GpM85ZCOBDiLVI=" crossorigin="anonymous" />

    <link rel="stylesheet" href=<?php echo base_url('assets/Style/style.css')?>>

    
</head>
<body>
    <header class="headerColor headerFont">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <a href="<?php echo base_url()?>" style="color:#FFF9EC">Evelynn</a>
                </div>
                <div class="col-12 col-lg-6 fontDec">
                    <a href="<?php echo base_url();?>" style="color:#FFF9EC">Početna</a>
                    <a href="<?php echo base_url((isset($controller)?$controller:'Gost').'/o_nama');?>" style="color:#FFF9EC">O nama</a>
                    <a href="<?php echo base_url('Gost/moj_nalog');?>" style="color:#FFF9EC">Moj nalog</a>
                </div>
            </div>
        </div>
    </header>