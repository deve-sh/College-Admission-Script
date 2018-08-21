//MARKS NOW

var tenmarks=document.getElementById('tenmarks');

var tentoal=document.getElementById('tentotal');

var tenpercent=document.getElementById('tenpercent');

var twelvemarks=document.getElementById('twelvemarks');

var twelvetotal=document.getElementById('twelvetotal');

var twelvepercent=document.getElementById('twelvepercent');

function calculate(){

var x=parseInt(tenmarks.value);

var y=parseInt(tentotal.value);
if(y!=0){
  if(tenmarks.value==""||tentotal.value==""){
  	tenpercent.value="";
  }
  if(x<=y){
  let percentage=((x/y)*100);
  percentage=percentage.toFixed(1);
  tenpercent.value=(percentage);
  }
  if(x>y||x==NaN||y==NaN){
  	tenmarks.style.border="1px solid red";
  	tenpercent.style.border="1px solid red";
  }
  else{
  	tenmarks.style.border="1px solid #999999";
  	tenpercent.style.border="1px solid #999999";
  }
}
};

function calculate1(){

var u=parseFloat(twelvemarks.value);

var v=parseFloat(twelvetotal.value);

if(v!=0){
  if(twelvemarks.value==""||twelvetotal.value==""){
  	twelvepercent.value="";
  }
  if(u<=v){
  let percentage=((u/v)*100); //LOCAL VARIABLE
  percentage=percentage.toFixed(1);
  twelvepercent.value=(percentage);
  }
  if(u>v||u==NaN||v==NaN){
  	twelvemarks.style.border="1px solid red";
  	twelvepercent.style.border="1px solid red";
  }
  else{
  	twelvemarks.style.border="1px solid #999999";
  	twelvepercent.style.border="1px solid #999999";
  }
}

};

console.log(calculate);

console.log(calculate1);