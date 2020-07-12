
<script language="Javascript1.2">

var funy_nav = 0;

var funy_nav_ff  = 0;
var funy_nav_ie  = 1;
var funy_nav_ns4 = 2;

if (document.layers) {
  funy_nav = funy_nav_ns4;
}else if(document.all) {
  funy_nav = funy_nav_ie;
}else{
  funy_nav = funy_nav_ff;
}


alert("funy_nav = " + funy_nav);

</script>

