<?php

$array1=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
// SMALL LETTERS

$array2=array();                                                     //CAPITAL LETTERS

for($i=0;$i<sizeof($array1);$i++){
	$array2[$i]=strtoupper($array1[$i]);  //CONVERSION OF array1 elements to uppercase and assignment to array2!
}

$array3=array('/','*','&','!','$','%','^','*',',','?','[',']','_');     //ARRAY OF SPECIAL CHARACTERS

$array4=array('1','2','3','4','5','6','7','8','9','0');

//NOW GENERATION OF RANDOM SALT OF LENGTH 7

$combinedarray=array_merge($array1,$array2,$array3,$array4);   //ARRAY OF CHARACTERS,NUMBERS AND SPECIAL CHARS

$chararray=array_merge($array1,$array2);  //ARRAY OF LOWERCASE AND UPPERCASE ALPHABETS

$salt="";

$x=0;

//SALT GENERATOR - LENGTH 22

while ($x<=22) {
    $randomnum=rand(0,sizeof($combinedarray)-1);
    if($x<1){
    	$rand2=rand(0,sizeof($array3)-1);
        $salt=$salt.$array3[$rand2];
    }
    else{
        $salt=$salt.$combinedarray[$randomnum];
    }
    $x=$x+1;
}

//RANDOM PASSWORD GENERATOR  -  LENGTH 17

$l=0;

$randpass="";

while ($l<= 16) {
     $randomnum=rand(0,sizeof($combinedarray)-1);
    if($l<1){
        $rand2=rand(0,sizeof($array3)-1);
        $randpass=$randpass.$array3[$rand2];
    }
    else{
        $randpass=$randpass.$combinedarray[$randomnum];
    }
    $l=$l+1;       
}

//SIMPLE PASSWORD FOR MEMBERS - LENGTH 8

$p=0;
$simppass="";

while($p<8){
    $randomnum=rand(0,sizeof($chararray)-1);
    $simppass=$simppass.$chararray[$randomnum];
    $p=$p+1;
}

?>
