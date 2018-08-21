<?php
    $fileone=fopen("confirm.txt","r+"); //CONFIRMATION FILE 1

	$y=fread($fileone,filesize("confirm.txt"));

	$filetwo=fopen("../confirm1.txt","r+");   //CONFIRMATION FILE 2

	$z=fread($filetwo,filesize("../confirm1.txt"));

    $filethree=fopen("../inc/config.php","r+");  //CONFIGURATION FILE

    $w=fread($filethree,filesize("../inc/config.php"));
?>