/***********************************************
Plugin "rebond" pour le module Funy pour Xoops
Développé par Jean-Jacques DELALANDRE
***********************************************/
//----------------------------------------------------------
var funy_rebond = new Array();
//----------------------------------------------------
function funy_rebond_next(lIndex, sAction){
    switch (action){
    case "action":
        funy_rebond[lIndex].action();
        break;
        
    case "action":
        funy_rebond[lIndex].action();
        break;
        
        
    }
    
}

/*

funy_rebond_def.prototype.index;
funy_rebond_def.prototype.image;
funy_rebond_def.prototype.link;
funy_rebond_def.prototype.direction;
funy_rebond_def.prototype.offset;
funy_rebond_def.prototype.imgWidth;
funy_rebond_def.prototype.imgHeight;
funy_rebond_def.prototype.coefRebondissement;
funy_rebond_def.prototype.delai;
funy_rebond_def.prototype.tempo;
funy_rebond_def.prototype.persistance;

funy_rebond_def.prototype.coord;
funy_rebond_def.prototype.jjd;
funy_rebond_def.prototype.isruning;
funy_rebond_def.prototype.obName;
funy_rebond_def.prototype.coef;
funy_rebond_def.prototype.objet;
funy_rebond_def.prototype.obTimeOut;
*/
//==========================================================
function funy_rebond_def(newIndex){
    this.index = newIndex;
}
new funy_rebond_def(0);
//==========================================================

//----------------------------------------------------------
funy_rebond_def.prototype.init = function(){
  //alert ("funy_rebond_def = " + newIndex);
  

    this.coord = new Array();
    this.coord[0]=0;
    this.coord[1]=0;
    this.coord[2]=0;
    this.jjd = 0;
    this.isruning = true;
    this.obName = "funy_rebond_div_" + this.index;  
    //----------------------------------------------------------
    this.coef = 1 + ((100 - this.coefRebondissement)/100);

}

//----------------------------------------------------------

funy_rebond_def.prototype.createDiv = function(){
    
    var imgId = "funy_rebond_img_" + this.index;

    if (this.link == ""){
        var url1 = "";
        var url2= "";
    }else{
        var url1 = "<a href='" + this.link + "' target='_blank'>";
        var url2= "</a>";
    
    }

    var sDiv = "<div id='" + this.obName 
             + "' style='position:absolute; z-index:9999; visibility:hidden;'>"
             + url1
             + "<IMG SRC='" + this.image + "' "
             + "id='"+ imgId + "' " 
             + ((this.imgWidth  == 0) ? "" : "width='" + this.imgWidth + "px' ")             
             + ((this.imgHeight == 0) ? "" : "height='" + this.imgHeight + "px' ")
             + ">" + url2 + "</div>";
             

    document.write(sDiv);
    //alert (sDiv);

  var tailley = document.body.offsetHeight - this.imgHeight;
  var taillex = document.body.clientWidth - this.imgWidth;
  var offsety = document.body.scrollTop;
  var offsetx = document.body.scrollLeft;


    
    this.objet = document.getElementById(this.obName);
    var obImg = document.getElementById(imgId);    
    
    //alert("createDiv : " + this.direction);
    switch (this.direction){
      case 1:
        this.objet.style.left = 0 + "px";
        this.objet.style.top  = this.offset + "px";    
        break;
      
      case 2:

          if (this.offset < 0) {
            //ll = taillex + offsetx - this.imgWidth - this.offset ;    
            ll = taillex + offsetx - this.imgWidth + this.offset ;            
          }else{
            ll = this.offset + offsetx ;    
          }
        var lt = (document.body.offsetHeight - this.imgHeight) + document.body.scrollTop - this.imgHeight;
        this.objet.style.left = ll + "px";
        this.objet.style.top  = lt + "px";    
        break;
      
      case 3:
        this.objet.style.left = ((document.body.clientWidth - this.imgWidth) + document.body.scrollLeft - this.imgWidth) + "px";
        this.objet.style.top  = this.offset + "px"; 
        break;
      
      default:
        this.objet.style.left = 0 + "px";
        this.objet.style.top  = this.offset + "px";    
    }
  
    
    
    if (this.imgWidth  == 0) this.imgWidth  =  obImg.width;    
    if (this.imgHeight == 0) this.imgHeight =  obImg.height;
      
/*

    alert ("createDiv = " + this.objet.id 
           + " - taille : " + this.imgWidth 
           + " x " + this.imgHeight);
*/

}

//----------------------------------------------------------

funy_rebond_def.prototype.stopAction = function(){
    //alert("funy_rebond_stop");
    this.isruning = false;
    //this.objet.display = "none";
    //this.objet.style.top  = "-100px";
    this.objet.style.visibility = "hidden";
    
    if (this.delai_reprise > 0){
        this.next("show", this.delai_reprise * 100);
    }
}

//----------------------------------------------------------

funy_rebond_def.prototype.startAction = function(){
    if (!this.isruning){
      this.isruning = true;
      //this.init();
      //this.next("action", 10);
      this.action();
    }
}


//----------------------------------------------------------

funy_rebond_def.prototype.next = function(sAction, lDelai){
    var sFnc = "funy_rebond[" + this.index + "]." + sAction + "()"
    //var sFnc = "funy_rebond[" + this.index + "]." + sAction + "()"    
    
    //alert ("nex : " + sFnc + " - delai : " + lDelai);
    setTimeout(sFnc, lDelai * 1);
    //var obTimeOut = setTimeout("funy_rebond[" + this.index + "]." + sAction + "()", lDelai * 1);    
    //return obTimeOut;
}

//---------------------------------------------------
funy_rebond_def.prototype.show = function(){
    this.init();
    this.objet.style.visibility = "visible";
    this.action()
}
//---------------------------------------------------
funy_rebond_def.prototype.action = function(){
  
    switch (this.direction){
    case 1:
      this.action_horizontal(0);
      break;
    
    case 2:
      this.action_vertical(1);
      break;
    
    case 3:
      this.action_horizontal(1);
      break;
    
    default:
      this.action_vertical(0);       
    }

}

//---------------------------------------------------
funy_rebond_def.prototype.action_vertical = function(sens){
  var tailley = document.body.offsetHeight - this.imgHeight;
  var taillex = document.body.clientWidth - this.imgWidth;
  var offsety = document.body.scrollTop;
  var offsetx = document.body.scrollLeft;

  var maxi = tailley + offsety - this.imgHeight;
  
  if (this.offset < 0) {
    this.coord[0] = taillex + offsetx - this.imgWidth + this.offset ;    
  }else{
    this.coord[0] = this.offset + offsetx ;    
  }
  

  this.coord[1] += this.coord[2];

 
  if (this.coord[1] > maxi) {
    this.coord[1] = maxi;
    this.coord[2] = -this.coord[2] / this.coef;
    this.jjd ++;    
  }
  var old =  this.objet.style.top; 
  this.objet.style.left = this.coord[0] + "px";
  
  if (sens == 1){
    var lt = (maxi-this.coord[1]);    
  }else{
    var lt = this.coord[1];    
  }
  this.objet.style.top  = lt.toFixed(0)   + "px";
    
    
  this.coord[2]+=1;
  //this.jjd++;
  
  
  if (( this.jjd < 100) & (this.isruning) ){
    //obTimeOut = this.next("action", this.tempo); //a revoir 
    this.next("action", this.tempo); //a revoir     
  }else{
    if (!this.isruning){
      //this.objet.style.top  = "-100px";     
      this.objet.style.visibility = "hidden";
    }
   
    this.next("stopAction", this.persistance * 100);    
  }

}
//---------------------------------------------------
funy_rebond_def.prototype.action_horizontal = function(sens){
  var tailley = document.body.offsetHeight - this.imgHeight;
  var taillex = document.body.clientWidth - this.imgWidth;
  var offsety = document.body.scrollTop;
  var offsetx = document.body.scrollLeft;

  var maxi = taillex + offsetx - this.imgWidth;
  
  if (this.offset < 0) {
    this.coord[0] = tailley + offsety - this.imgHeight - this.offset ;    
  }else{
    this.coord[0] = this.posY + offsety ;    
  }
  

  this.coord[1] += this.coord[2];

 
  if (this.coord[1] > maxi) {
    this.coord[1] = maxi;
    this.coord[2] = -this.coord[2] / this.coef;
    //alert (this.objet.id + " : " + this.jjd);
    this.jjd ++;
  }

  var old =  this.objet.style.left; 
  this.objet.style.top = this.coord[0].toFixed(0) + "px";
  
  if (sens == 1){
    this.objet.style.left  = (maxi-this.coord[1])  + "px";    
  }else{
    this.objet.style.left  = this.coord[1]  + "px";    
  }

  this.coord[2]+=1;
  //this.jjd++;
  
  if (this.jjd < 100 & (this.isruning) ){  
  //if ((this.objet.style.left != old | this.jjd < 100) & (this.isruning) ){
    //this.obTimeOut = this.next("action", this.tempo); //a revoir 
    this.next("action", this.tempo); //a revoir    
    
    //this.jjd ++;     
  }else{
    if (!this.isruning){
      //this.objet.style.top  = "-100px";     
      this.objet.style.visibility = "hidden";
    }else{
    
    }
   
    this.next("stopAction", this.persistance);    
  }

}
//---------------------------------------------------
funy_rebond_def.prototype.run = function(){
    //alert ("funy_rebond_def.prototype.run ");
    this.init();
    this.createDiv();
    //this.action();    
    this.next("show", this.delai * 100);
    //this.action();
}

//---------------------------------------------------

//=============================================================



