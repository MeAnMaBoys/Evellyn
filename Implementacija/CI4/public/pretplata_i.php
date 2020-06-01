<?php
use App\Models\PretplateIzvodjaciModel;

$id=$_REQUEST['id'];
echo $id;
$idp = $_REQUEST['idp'];
$pretplate = new PretplateIzvodjaciModel();
$pretplata=$pretplate->where('Izvodjac',$id)->where('Posmatrac',$idp)->findAll();
if(empty($pretplata)){
    $data = ['Izvodjac'=>$id, 'Posmatrac'=>$idp];
    $pretplate->insert($data);
    echo 'pretplacen';
}
else{
    $pretplate->where('Izvodjac',$id)->where('Posmatrac',$idp)->delete();
    echo 'odjavljen';
}


