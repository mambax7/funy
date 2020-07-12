function funy_richText_build(idEvent){
//alert("idEvent : " + idEvent);

  funy_richText_HTML[idEvent] = funy_parseBonus(funy_richText_HTML[idEvent], funy_url);
  
  id = "funy_richText_" + idEvent;
  if (funy_richText_bgColor[idEvent] == "COLOR") funy_richText_bgColor[idEvent] = "";
  

  balise  = "<div ID='" + id + "'";
  
  if (funy_richText_width[idEvent]     != "0")  balise += " width='"     + funy_richText_width[idEvent] + "px'";
  if (funy_richText_height[idEvent]    != "0")  balise += " height='"    + funy_richText_height[idEvent] + "px'";
  //if (funy_richText_bgColor[idEvent]    != "0")  balise += " bgColor='#"    + funy_richText_bgColor[idEvent] + "'";
  if (funy_richText_bgColor[idEvent]    != "")  balise += " 'style='background-color:#" + funy_richText_bgColor[idEvent]  + ";'" ;  
   
  balise += ">" + funy_richText_HTML[idEvent] + "</div>";

  
  //----------------------------------------------
  document.write(balise);


  return true;
}

//alert ("balise");
