<style type="text/css">
	#funy_transition_holder{
	border: 2px;
		margin:5px;	
		position:relative;	
	}

	#funy_transition_holder img{
		position:absolute;
		left:0px;
		top:0px;
	}
</style>



<script type="text/javascript">

    if (funy_transition_bgColor == "COLOR") funy_transition_bgColor = "";
    var styleBG = "";
    if (funy_transition_bgColor != "") styleBG = "style='background-color:#" + funy_transition_bgColor + ";'";  
    document.write("<div align='center' " + styleBG + ">");
    if (funy_transition_legendTop != ""){
        document.write("<center>" + funy_transition_legendTop + "</center>");    
    }
        document.write("<div id='funy_transition_holder'  " 
                     + "style='width: " + funy_transition_width 
                     +     "; height: " + funy_transition_height 
                     + ";'>");
                     
                     
    //for (var h = 0; h < 2; h++){                     

    if (funy_transition_alea){
        newIndex = ((Math.random()*1000).toFixed(0)) % (funy_transition_Files.length);
    
    }else{
        newIndex = 0;
    }

    funy_transition_index = Math.abs(newIndex); ;    
    
    
    for (var h = 0; h < 2; h++){
        //alert ("f = " + funy_transition_Files[h]);          
        document.write("<img id='funy_img" + h 
           + "' src='" + funy_site + funy_transition_Files[funy_transition_index] + "'></ br>");
    }
    document.write("</div>");
    if (funy_transition_legendBotom != ""){
        document.write("<center>" + funy_transition_legendBotom + "</center>");    
    }
    document.write("</div>");

    //---------------------------------------------------
    funy_transition_obImg1 = document.getElementById("funy_img0");
    funy_transition_obImg2 = document.getElementById("funy_img1");

    funy_transition_width  = funy_transition_obImg1.width;
    funy_transition_height = funy_transition_obImg1.height;
//alert ("w=" + funy_transition_width + "-h=" + funy_transition_height);

    //funy_transition_mode = 2;

    funy_transition_init();	// Initialize the gallery

</script>
