var pass1=document.getElementById('password1');
var pass2=document.getElementById('password2');

function check1(){
   if(pass1.value.length>=8){
     pass1.style.border="1px solid #42b029";
   }
   else{
     pass1.style.border="1px solid #f22409";
   }
};
function onload(){
	document.getElementById('submit').style.display="none";
}
function check(){
   if(pass2.value==pass1.value && pass2.value.length>0){
   	pass2.style.border="1px solid #42b029";
   	document.getElementById('submit').style.display="block";
   }
   else{
   	pass2.style.border="1px solid #f22409";
   	document.getElementById('submit').style.display="none";
   }
};

console.log(check1);

console.log(check);
