	/************************************************************************************************************
	(C) www.dhtmlgoodies.com, November 2005

	This is a script from www.dhtmlgoodies.com. You will find this and a lot of other scripts at our website.

	Terms of use:
	You are free to use this script as long as the copyright message is kept intact. However, you may not
	redistribute, sell or repost it without our permission.

	Thank you!

	www.dhtmlgoodies.com
	Alf Magne Kalleland
  -------------------------------------------------------------------------------------------------------------
  modified by Jean-Jacques DELALANDRE - 21/08/2006 - jjd@kiolo.com
  I wood to show the block in the center with more easly parametters
  - add of the automatique calcul of the size
  - add of constants to parametters easly
	************************************************************************************************************/
//alert("Fondu");

	var slideshow2_noFading = false;
	var slideshow2_timeBetweenSlides = $timeBetweenSlides;	// Amount of time between each image(1000 = 1 second)
	var slideshow2_fadingSpeed       = $fadingSpeed;      	// Speed of fading	(Lower value = faster)
	var slideshow2_currentOpacity    = $currentOpacity;	    // Initial opacity

	var slideshow2_galleryContainer;	// Reference to the gallery div
	var slideshow2_galleryWidth;	// Width of gallery
	var slideshow2_galleryHeight;	// Height of galery
	var slideshow2_slideIndex = -1;	// Index of current image shown
	var slideshow2_slideIndexNext = false;	// Index of next image shown
	var slideshow2_imageDivs = new Array();	// Array of image divs(Created dynamically)
	var slideshow2_imagesInGallery = false;	// Number of images in gallery
	var Opera = navigator.userAgent.indexOf('Opera')>=0?true:false;
	
	function createParentDivs(imageIndex)
	{
		if(imageIndex==slideshow2_imagesInGallery){
			showGallery();
		}else{
			var imgObj = document.getElementById('galleryImage' + imageIndex);
			if(Opera)imgObj.style.position = 'static';
			slideshow2_imageDivs[slideshow2_imageDivs.length] =  imgObj;
			imgObj.style.visibility = 'hidden';
			imageIndex++;
			createParentDivs(imageIndex);
		}
	}
//-----------------------------------------
	function showGallery()
	{
		if(slideshow2_slideIndex==-1)slideshow2_slideIndex=0; else slideshow2_slideIndex++;	// Index of next image to show
		if(slideshow2_slideIndex==slideshow2_imageDivs.length)slideshow2_slideIndex=0;
		slideshow2_slideIndexNext = slideshow2_slideIndex+1;	// Index of the next next image
		if(slideshow2_slideIndexNext==slideshow2_imageDivs.length)slideshow2_slideIndexNext = 0;

		slideshow2_currentOpacity=100;	// Reset current opacity

		// Displaying image divs
		slideshow2_imageDivs[slideshow2_slideIndex].style.visibility = 'visible';
		if(Opera)slideshow2_imageDivs[slideshow2_slideIndex].style.display = 'inline';
		if(navigator.userAgent.indexOf('Opera')<0){
			slideshow2_imageDivs[slideshow2_slideIndexNext].style.visibility = 'visible';
		}

		if(document.all){	// IE rules
			slideshow2_imageDivs[slideshow2_slideIndex].style.filter = 'alpha(opacity=100)';
			slideshow2_imageDivs[slideshow2_slideIndexNext].style.filter = 'alpha(opacity=1)';
		}else{
			slideshow2_imageDivs[slideshow2_slideIndex].style.opacity = 0.99;	// Can't use 1 and 0 because of screen flickering in FF
			slideshow2_imageDivs[slideshow2_slideIndexNext].style.opacity = 0.01;
		}


		setTimeout('revealImage()',slideshow2_timeBetweenSlides);
	}
//-----------------------------------------
	function revealImage()
	{
		if(slideshow2_noFading){
			slideshow2_imageDivs[slideshow2_slideIndex].style.visibility = 'hidden';
			if(Opera)slideshow2_imageDivs[slideshow2_slideIndex].style.display = 'none';
			showGallery();
			return;
		}
		slideshow2_currentOpacity--;
		if(document.all){
			slideshow2_imageDivs[slideshow2_slideIndex].style.filter = 'alpha(opacity='+slideshow2_currentOpacity+')';
			slideshow2_imageDivs[slideshow2_slideIndexNext].style.filter = 'alpha(opacity='+(100-slideshow2_currentOpacity)+')';
		}else{
			slideshow2_imageDivs[slideshow2_slideIndex].style.opacity = Math.max(0.01,slideshow2_currentOpacity/100);	// Can't use 1 and 0 because of screen flickering in FF
			slideshow2_imageDivs[slideshow2_slideIndexNext].style.opacity = Math.min(0.99,(1 - (slideshow2_currentOpacity/100)));
		}
		if(slideshow2_currentOpacity>0){
			setTimeout('revealImage()',slideshow2_fadingSpeed);
		}else{
			slideshow2_imageDivs[slideshow2_slideIndex].style.visibility = 'hidden';
			if(Opera)slideshow2_imageDivs[slideshow2_slideIndex].style.display = 'none';
			showGallery();
		}
	}
//-----------------------------------------
	function initImageGallery()
	{
		slideshow2_galleryContainer = document.getElementById('imageSlideshowHolder');
		slideshow2_galleryWidth = slideshow2_galleryContainer.clientWidth;
		slideshow2_galleryHeight = slideshow2_galleryContainer.clientHeight;
		galleryImgArray = slideshow2_galleryContainer.getElementsByTagName('IMG');
		for(var no=0;no<galleryImgArray.length;no++){
			galleryImgArray[no].id = 'galleryImage' + no;
		}
		slideshow2_imagesInGallery = galleryImgArray.length;
		createParentDivs(0);

	}

//-----------------------------------------
function funy_fondu_start(){
  
  alert("funy_fondu_start");
}
//-----------------------------------------
function funy_fondu_stop(){
  
  alert("funy_fondu_stop");  
}

//-----------------------------------------
initImageGallery();	// Initialize the gallery
