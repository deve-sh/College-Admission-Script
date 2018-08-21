var passfield=document.getElementById('password');
function show(){
   if(passfield.type=="text"){
   	passfield.type="password";
   }
   else{
   	passfield.type="text";
   }
};
console.log(passfield);
console.log(show);