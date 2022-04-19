
<html>
<head><title>OTP Service</title>
<meta name="viewport" content="width=device-width">
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>

.sidenav {
  height: 10%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 1; /* Stay on top */
  top: 20; /* Stay at the top */
  left: 5;
  background-color: #e6e2d3; /* Black*/
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 60px; /* Place content 60px from the top */
  transition: 0.2s; /* 0.5 second transition effect to slide in the sidenav */
}

/* The navigation menu links */
.ff {
  padding: 8px;
  text-decoration: none;
  font-size: 20px;
  color: #4040a1;
  display: block;
  transition: 0.3s;
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
  color: #111;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
  transition: margin-left .5s;
  padding: 20px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
img {
    max-width: 100%;
}
body  {
background-color: #384353;
 #background-image: url("data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw0NDQ0NDQ0NDQ0NDQ0NDQ0NDQ8NDQ0NFREWFhURFRUYHSgsGBolGxUVITEhJSkrLi4uFx8zOD84Nyg5LjcBCgoKDQ0NFQ8PFS0dFRktKzcrKysrNysrKy0rLSstLS0rKy03KysrLSsrKysrLSsrKysrKzArLSstKys3Ky0rLf/AABEIAKgBLAMBEQACEQEDEQH/xAAbAAEBAQADAQEAAAAAAAAAAAAAAQIDBAUGB//EADEQAQEAAQIDBQcDBAMAAAAAAAABAgMRBCExMkFRcrEFEiJSYXGBM0KhkcHR4RQjgv/EABoBAQEBAQEBAQAAAAAAAAAAAAABAgUDBAb/xAAjEQEBAQABBAEEAwAAAAAAAAAAAQIRAxIxUSEEIjJBQmFx/9oADAMBAAIRAxEAPwD5N+qfnAAAAAAAAAGbnOk515b6sz8T5r2x0Na+b8RvB4XV15fVnGc+GkaTdBLQZtFcmlO99HQz/J79HP7ar3r2rOVZZYrNRm1isuO1mpWLWajFrNZYtZRm1lGLURm0GbUGbQS0GbRU3BNwTcEABAfROk5QAAAAAADWOFu+032m9LeFk5cG9y+k/l8eurrXj4j7cdHOPm/NcmGnIxI9eW1RLQS0Vm0EnPkSc3iLJzeHY6cn3ycTh9knE4S1moxalRi1hli1moxlWWWLWajGVZRx2soxaiM2sozaDNoJaKzuCbgm4JuACAAKr6J0XJAAAAAWTflAd3hvZ9y55cp4LJaWyPUnCTHTz5fsy9HpccZrM190fOaXRy46ta3VEtFZtBLUGbQcmhOt/EfR0M/Pc9ujn55clr6HuzayjFrNZYtYqM2s1lx5VmoxazWXHazUYtZGLURi1ETcVNwTcE3BAQEAAVQEB9G6LkgAAAOxw/C5Z9208VHr8JwEx7vz3vTPT9s3Tv4aUj2meHlacR+nn5MvRN/jVz+UfHad5ONHZrVqjNoM2oJaDO4O1jNpI+/Oe3Mj7M57ZwlorNrNZYtZqMWs1HHlWGWLWUcdrNRi1lli1KMWsozuCbgm4JuCAgAAoogAAPo3RckABvT08srtJv6A9LhPZ865c7/EambUt4eto6Ej3ziR53TnkbYAcfEfp5+TL0rO/wAa1n8o+LwvJxY7LVqjNoM2gzag5OHm938PV79DPOufT26Webz6di19T6GLWajFrNZYyrKMWs1ljKs1HHazUYyrKOPKsoxayjNqIzaCbggAIAAqgIAAAD6N0XJWTcHc4bgblzy5TwWS0+I9bh+EmM6PXOGLp2scZHpIxa0qLMl5OGhHHxP6ep5M/Ss7/GtY/KPiMLycWO1WrVRm1Bm0Vm0Hc0sfdxk7+t+77+nntzw+vGe3PC2qrFqUYtYrLGVZRx2s1ljKs1HHazWWLWajFrKMWojNqDO4AIAAqgIAAAAogr6zR4TPPnttPG97ouQ9TheBmPd+e9rOPaXXp38NOR7TPDztbaZUERQCUGdfL/rz8mfpU1ftq5n3R8RhXGjsloiWis2g3w+PvZfSc69Ojnu1/UenTzzr/Hbtfc+pm1moxazWXHlWUrFrKOO1ms1jKsI47WWWLUqMWsozaiMoIAAqgIAAAAoAgAr9OmlHZ7XD5ckmyoAAgACKgMa/Yz8uXomvFXPmPl5pzKc5+e9zeJXV5dfV4fKc58U/li4s8LNOta82ktB3OHw93H63nf7Pu6Oe3P8AdfV088Z/1u16V6MWsssWs1GLWajGVZrLjyrKOO1moxazWWLWUZqIxUERAUUQAAAABRABRUAfqTsuGgACKgAIADGt2M/Ll6JrxWs+Y+a0+jnx062I4tXQxz6zn4zqlzKsvDqf8PKZT92PW2eH2Zx0rdSfp7dP7tcOza+19jFZRi1moxlUqMWsVlx5VmoxazUceVZrLFRGKyjNRGagAAgAAACiACigAAqP1B13EAAQAEAFEGNbsZ+XL0TXirnzHzen0fBHTrYgDk05yfV0c8Z59vr6GeM8+01NKZfS+MelzK9uXV1dLLH6zxjyssOXXyrAxlWWWLWalceVZRi1mssVmoxWUYqIzUREEAAAAUQAABVAFQAB+nuu4gCACiACbgCsa3Yy8uXozrxVz5j53Do+GOlWhFxm9aznuvDWM92pHM+50ERBll19Xhscunw36dP6MXMqcujraWWPWcvGdHjZYcuC1ijFZrLjqIzWUYrKMVEZqIiAAAoAgAooAKAgAoCv051nEEDcE3FAQAEQY1uxl5cvRNeK1nzHz+HR8MdGtCOTTne+noZ+O59X0+fjube76EZZoiIjNSssupr8FjeePw3w/b/p56x6O552tpZYcspt4Xurx1LF5cFYRmojFZRioiVERAUAQABQFFQAAUABRUfpu7qOMAgAIigAIDGt2cvLl6JrxVz5jwMOj4Y6NakWTm8GZzeI54++TicOhJxOIVBEQRmpWUqIzURlMsZZtZLL3XnGajocT7Ol56d2vy3p+K8tY9Hd7eZraeWF2yll+ve8bOF5cVZGaiMogCACigAAqACgAKKgAD9MdRxkRQAEAABAY1ezl5cvRnXitZ8x4OHR8UdCuXTne+joZ/k+j6fPnTkfQ+lEQRlGURGRGajKIyyVGaxqaeOU2yks8KzZyjzeJ9l9+nf/ADl/avLWPTU37eZqYXG7ZSyzuvKvKxphEQABVAFQAAUBRUAAFAV+luk4yAAgAAqIAMavZy8uXol8Vc+Y8LB8UdHjl2JNuT7857ZI+/Oe3MiqqIgyyiIiMlZZqJWajKCMoygjLi1tHDUm2eMs/mfa9yWSnPDy+K9lZTnp33p8t5ZT/LyuPTU37edlLLtZZZ1lm1jDaCigIAKAAoqACgAqgj9JdFxwBFQAAAE3RWNXs5eXL0S+KufMeNoTv8Hj0M83n063Qzzrn05n1vrERGWaIiIzUZZERGazURkZqJUZoiIiCI4eI4bDUm2eO/hZyyn5SyVZbHlcV7Mzw54fHj4TtT8d/wCGLl6TcroMtCgAKKgAAoKoIAKP0h97kAAAJuigIADGr2cvLl6JfFXPmPL08dpGunntzI7/AE89ueGmlKiIiCM1KylRGURkZZRlKIyiJURBGRAAB1+J4PT1e1NsvmnLL/aWSrNWPJ4r2dqafOfHj44znPvGbl6TUrpo0AAKAoqACgAo/SN33OQm6KAgAAIigMa12xv1lbxOa+j6Xp93Ul/UedFdoGURBGUZREZoiVGWUZZKjNEREZSogiCAAAADq8VwGnqc9vdy+bHv+870samrHkcVwOpp87Pex+bHnPz4M8PSaldYaFAQUAAFAH6M+1yQAERQAAAHBrXff7V75nGXV+m6fZie66MYfaoyiIMsoiIjIyzUSs1GUEZRlBGURBEAAAAAAAdLivZunnzx+DLxk+G/eHDU3Y8nieE1NLtTl8054o9JZXAKAKACig/RH1uUAAAAgAM55bRrM5r26HT79yfpwZdL9q+ius6keL1qiIyzRERGajLIiIzWaiMjNRKjNEREQRAAAAAAAAEsB0OK9l4Zc8Pgvh+y/wCBub9vK1+Hz07tnjZ4XrL9qNyyuIVVAAH6I+tygEAAABAcepef2e/TnE5dL6Xp9uO6+a48ul+1br6o6keL1q1GURBGalZSojKIyMojLNEZREqIgjIgAAAAAAAAAAmWMsssll6yzeUHncT7Kl56d92/LeeP4vcrc37eXq6WWF2zxuN+vf8Aa949JeWFAH//2Q==");
    background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
}
.txn {
background-color: #eaeef5;
border: dotted;
border-radius: 1px;
word-wrap:break-word;
padding: 14px 20px;
  border-radius: 15px 5px 15px 5px;
}
.txn2 {
background-color: #eaeef5;
border: solid;
border-radius: 1px;
word-wrap:break-word;
padding: 5px 10px;
margin:0;  
border-radius: 5px 15px 5px 15px;
}
input[type=text], select {
  width: 75%;
    background: #FDFCFB;
    font-family: inherit;
    color: #737373;
    letter-spacing: 1px;
    text-indent: 5%;
    border-radius: 15px 5px 15px 5px;
	    padding: 10px;
    height: 44px;
    border: none;
padding: 3px 0px 3px 3px;
margin: 5px 10px 10px 0px;
  border: 2px solid #DDDDDD
}
textarea {
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}
button[type=submit] {
  
  width: auto;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.container {
  display: inline-block;
  cursor: pointer;
}

.bar1, .bar2, .bar3 {
  width: 35px;
  height: 5px;
  background-color: #333;
  margin: 6px 0;
  transition: 0.4s;
}

/* Rotate first bar */
.change .bar1 {
  -webkit-transform: rotate(-45deg) translate(-9px, 6px) ;
  transform: rotate(-45deg) translate(-9px, 6px) ;
}

/* Fade out the second bar */
.change .bar2 {
  opacity: 0;
}

/* Rotate last bar */
.change .bar3 {
  -webkit-transform: rotate(45deg) translate(-8px, -8px) ;
  transform: rotate(45deg) translate(-8px, -8px) ;
}
textarea
{
  width:90%;
}
select {
  width: 73%;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  
}

select:focus{
    outline: none;
    box-shadow: 0px 0px 5px #4CAF50;
    border-color: #4CAF50;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
.select2-selection__rendered { line-height: 45px !important; } .select2-container .select2-selection--single { height: 45px !important; } .select2-selection__arrow { height: 34px !important; }

</style>
</head>
<h2 class='txn'><center>AUTO BUY OTP SERVER 2</center></h2><center><form action="" ><input type="text" name="accessCode" placeholder="Enter Your AccessCode" >
<input type="text" id="service" name="service" placeholder="Enter Service Name">

<select  onchange=if(this.value=="custom"){document.getElementById("serb").setAttribute("name","no");document.getElementById("service").style.display="block";}else{document.getElementById("service").style.display="none";document.getElementById("service").setAttribute("name","no");} name="service" id="serb" class="select">

<option value="">Select Service

<option value="custom">Custom Service
<option value='Others'>Others [₹7]

<option value='Dealshare'>Dealshare [₹7]

<option value='Amazon'>Amazon [₹10]

<option value='Winzo'>Winzo [₹7]

<option value='Swiggy'>Swiggy [₹7]

<option value='MPL'>MPL [₹7]

<option value='OYO'>OYO [₹7]

<option value='Ludo_Ninja'>Ludo_Ninja [₹7]

<option value='Payzapp'>Payzapp [₹8]

<option value='Nobroker'>Nobroker [₹7]

<option value='Siply'>Siply [₹7]

<option value='Unacademy'>Unacademy [₹7]

<option value='Freecharge'>Freecharge [₹7]

<option value='1xbet'>1xbet [₹7]

<option value='Rummy_Gold'>Rummy_Gold [₹7]

<option value='Mega'>Mega [₹7]

<option value='Grofers'>Grofers [₹7]

<option value='Coindcx'>Coindcx [₹10]

<option value='Akudo'>Akudo [₹7]

<option value='Love_Vocal'>Love_Vocal [₹7]

<option value='Ludo-Supreme-Gold'>Ludo-Supreme-Gold [₹7]

<option value='Probo'>Probo [₹7]

<option value='Apollo'>Apollo [₹7]

<option value='Gmng'>Gmng [₹6]

<option value='Bajaj_Finance'>Bajaj_Finance [₹7]

<option value='Fiewin'>Fiewin [₹7]

<option value='Lakme'>Lakme [₹7]

<option value='Ace2Three'>Ace2Three [₹7]

<option value='Discord'>Discord [₹7]

<option value='Flam'>Flam [₹6]

<option value='Myntra'>Myntra [₹7]

<option value='IndiaPlays'>IndiaPlays [₹7]

<option value='Gamezy'>Gamezy [₹7]

<option value='Google'>Google [₹10]

<option value='BigBazaar'>BigBazaar [₹7]

<option value='SkillClash'>SkillClash [₹7]

<option value='Joymall'>Joymall [₹6]

<option value='BigCash'>BigCash [₹7]

<option value='My11Circle'>My11Circle [₹7]

<option value='PharmEasy'>PharmEasy [₹7]

<option value='My_Jar'>My_Jar [₹7]

<option value='Snakes_and_Ladder'>Snakes_and_Ladder [₹7]

<option value='Pocket52'>Pocket52 [₹7]

<option value='Tinder'>Tinder [₹7]

<option value='Royalwin'>Royalwin [₹8]

<option value='RummyCircle'>RummyCircle [₹7]

<option value='Mantrimall'>Mantrimall [₹8]

<option value='Uber'>Uber [₹7]

<option value='KhelRaja'>KhelRaja [₹7]

<option value='CoinSwitch_Kuber'>CoinSwitch_Kuber [₹7]

<option value='PhonePe'>PhonePe [₹8]

<option value='Dream11'>Dream11 [₹10]

<option value='Fiegame'>Fiegame [₹7]

<option value='PokerSaint'>PokerSaint [₹7]

<option value='TwelfthMan'>TwelfthMan [₹7]

<option value='Shoppe'>Shoppe [₹7]

<option value='MyTeam11'>MyTeam11 [₹7]

<option value='Loco'>Loco [₹7]

<option value='Rush'>Rush [₹7]

<option value='Cockfight'>Cockfight [₹7]

<option value='Meesho'>Meesho [₹7]

<option value='IRCTC'>IRCTC [₹7]

<option value='Zepto'>Zepto [₹7]

<option value='Rush'>Rush [₹7]

<option value='Cadbury_Perk'>Cadbury_Perk [₹7]

<option value='Flipkart'>Flipkart [₹8.5]

<option value='LocoGG'>LocoGG [₹7]

<option value='Adda52'>Adda52 [₹8]

<option value='Jiomart'>Jiomart [₹6]

<option value='Rummy_Wealth'>Rummy_Wealth [₹7]

<option value='JungleeRummy'>JungleeRummy [₹7]

<option value='SpartanPoker'>SpartanPoker [₹7]

<option value='Grofers'>Grofers [₹7]

<option value='Phable'>Phable [₹7]

<option value='EarnEasy'>EarnEasy [₹8]

<option value='Unocoin'>Unocoin [₹8]

<option value='Mewt'>Mewt [₹12]

<option value='Yahoo'>Yahoo [₹6]

<option value='ClassicRummy'>ClassicRummy [₹7]

<option value='LazyPay'>LazyPay [₹8]

<option value='TeenPattiJoy'>TeenPattiJoy [₹7]

<option value='Airtel'>Airtel [₹10]

<option value='MobiKwik'>MobiKwik [₹8]

<option value='BetVet'>BetVet [₹7]

<option value='Junio'>Junio [₹9.5]

<option value='Shopsy'>Shopsy [₹8.5]

<option value='RummyTime'>RummyTime [₹7]

<option value='MediBuddy'>MediBuddy [₹7.5]

<option value='SamsungShop'>SamsungShop [₹7]

<option value='Better'>Better [₹7]

<option value='PlayShip'>PlayShip [₹8]

<option value='BetVet'>BetVet [₹7]

<option value='Swacch_City_Solution'>Swacch_City_Solution [₹7]

<option value='Rummy_East'>Rummy_East [₹7]

<option value='Fampay'>Fampay [₹8]




</select><br>


<button type="submit" >Submit</button></center></form>

<script>
var towork;
var iid;
var id;

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
$("#serb").select2({
    width: '73%' // need to override the changed default
});
});
$(function(){
//alert("opemed");
if (localStorage.number && localStorage.id) {
$("#mynum").val(localStorage.number);
id=localStorage.id;
towork=0;
getotp2();


}

})


$("#service").hide();

$(function(){
$("#serb").attr("name","service");
$("#service").attr("name","service");
$("#balance").html("Welcome To our Site!");

var ss=$("#service").val();
//alert(ss);
if (ss=="custom"){
$("#service").show();

}

})
function reset(){
localStorage.clear();
window.location=window.location;

}
function ban(){
localStorage.clear();
if (typeof id==="undefined"){id="";}

if(id!=""){
towork=0;
clearInterval(iid);
var y="cancel.php?id="+id+"";
g=httpGet(y);
id="";

alert(g);
}
$("#mynum").val("Click next to get New Number");
$("#nextbtn").removeAttr("disabled");

}
function getotp2(){
//document.getElementById("towork").value=1;
$("#smsbox").val("");
//alert(towork);
if(towork==0){
//alert("donee");
towork=1;
$("#btt").hide();
$("#otpbtn").hide();
$("#smsbox").val("");

iid=setInterval(getotp, 4000);

 }
}
$("#btt").hide();
$("#otpbtn").hide();


function httpGet(theUrl) {
//start();
  let xmlHttpReq = new XMLHttpRequest();
  xmlHttpReq.open("GET", theUrl, false); 
  xmlHttpReq.send(null);
  //end();
  return xmlHttpReq.responseText;
}
var accessCode=$("#accessCode").val();
var service=$("#service").val();
$("#mynum").val("Click next to get New Number");
function getotp(){
//var id=document.getElementById("id").value;

if(towork==1){

if (id!=""){
var b=httpGet("get_otp.php?act=getotp&accessCode="+accessCode+"&id="+id+"");
 var j=JSON.parse(b);
 var sta=j["status"];
 var to=$("#secs").val()
 if (to==""){to=0;}
var  tim=parseInt(to, 10)+4;
$("#time").html("Time Passed:- " + tim + " seconds");
$("#secs").val(tim);
 if (sta==200){

var sms=j["sms"];
var bal=j["balance"];
$("#balance").innerHTML = "Balance: "+bal;
if(sms!=""){
	//alert(typeof sms);
if(isNaN(sms)==false){
$("#btt").show();
}

	$("#smsbox2").prepend("<div class='txn2'>"+sms+"<div><br>");
towork=0;
$("#otpbtn").show();
clearInterval(iid);
//alert("CLEARED INTERGAVL");
//document.getElementById("id").value = "";
}
 $("#smsbox").val(sms);
 
 
}
else{
var er=j["error"];
$("#smsbox").val(er);
}
}
}
}
function newnum(){
towork=0;
//start();
//document.getElementById("towork").value=0;
if(isNaN(id)==false){
var idr=id;
}else{
var idr="";}

$("#btt").hide();
$("#otpbtn").hide();
$("#nextbtn").attr("disabled","true");
var idst=$("#smsbox").val();
if(idst!=""){
var idr="";
}
 var b=httpGet("get_num.php?act=getnumber&accessCode="+accessCode+"&service="+service+"&old="+idr+"");
 //alert(b);
 
 var j=JSON.parse(b);
 var sta=j["status"];
 if (sta==200){
 towork=1;
var num=j["number"];
  id=j["id"];
  localStorage.setItem("number", num);
  localStorage.setItem("id", id);
 var b=num;
 var bal=j["balance"];
$("#balance").html("Balance: "+bal);

 //document.getElementById("id").value = id;
 iid=setInterval(getotp, 4000);
 
 }else{
 b=j["error"];
 }

 $("#mynum").val(b);
 //end();
 }



$("#mynum").attr("readonly",true);
$("#smsbox").attr("readonly",true);
function Hello2() {
 //document.getElementById("myText").disabled = false;
  var copyText = document.getElementById('smsbox');
  copyText.select();
  document.execCommand('copy');
  //alert('Copied Text: '+ copyText.value);
  }
function Hello() {
 //document.getElementById("myText").disabled = false;
  var copyText = document.getElementById('mynum');
  copyText.select();
  document.execCommand('copy');
  //alert('Copied Text: '+ copyText.value);
  }
  function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
function myFunction(x) {
  openNav();
}

  
  </script>
</html>
