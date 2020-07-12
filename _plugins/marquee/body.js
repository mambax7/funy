function funy_marquee_build(idEvent){
//alert("idEvent : " + idEvent);

  funy_marquee_HTML[idEvent] = funy_parseBonus(funy_marquee_HTML[idEvent], funy_url);
  
  id = "funy_texe_marque_" + idEvent;
  if (funy_marquee_bgColor[idEvent] == "COLOR") funy_marquee_bgColor[idEvent] = "";
  
  balise = "<marquee ID='" + id + "'";
  //balise = "<marquee '";  
  
  if (funy_marquee_behavior[idEvent]  != "")   balise += " behavior='"  + funy_marquee_behavior[idEvent] + "'";
  if (funy_marquee_direction[idEvent] != "")   balise += " direction='" + funy_marquee_direction[idEvent] + "'";
  if (funy_marquee_width[idEvent]     != "0")  balise += " width='"     + funy_marquee_width[idEvent] + "px'";
  if (funy_marquee_height[idEvent]    != "0")  balise += " height='"    + funy_marquee_height[idEvent] + "px'";
  if (funy_marquee_align[idEvent]     != "")   balise += " align='"     + funy_marquee_align[idEvent] + "'";  
  if (funy_marquee_bgColor[idEvent]   != "")   balise += " bgColor='#"  + funy_marquee_bgColor[idEvent] + "'";  
  
  balise += " loop='" + funy_marquee_loop[idEvent] + "'";
  balise += " scrollamount='" + funy_marquee_scrollamount[idEvent] + "'";  
  balise += " scrolldelay='" + funy_marquee_scrolldelay[idEvent] + "'";  
  balise += " hspace='" + funy_marquee_hspace[idEvent] + "'";  
  balise += " funy_marquee_vspace='" + funy_marquee_vspace[idEvent] + "'";  

  balise += " onmouseover='this.stop()' onmouseout='this.start()' ";

  
  balise += ">";  
  balise += funy_marquee_HTML[idEvent];
  balise += "</marquee>";  
  
  //----------------------------------------------
  document.write(balise);

//alert (balise);
  return true;
}


