 // Get the modal
 var modal = document.getElementById("myModal");
        
 // Get the image and insert it inside the modal - use its "alt" text as a caption
 var images = document.getElementsByClassName('myImages');
 var modalImg = document.getElementById("img01");
 var captionText = document.getElementById("caption");
 var mybutton = document.getElementById("myBtn");
 var projectAnchors = document.getElementById("projectAnchors");
 // Go through all of the images with our custom class
 for (var i = 0; i < images.length; i++) {
 var img = images[i];
 // and attach our click listener for this image.
 img.onclick = function(evt) {
     console.log(evt);
     modal.style.display = "block";
     modalImg.src = this.src;
     captionText.innerHTML = this.alt;
     mybutton.style.display = "none";
     projectAnchors.style.top = "-500px";
     $('header').removeClass('header-down').addClass('header-up');
     $('body').css({'overflow':'hidden'});
     $(document).bind('scroll',function () { 
          window.scrollTo(0,0); 
     });
 }
 }
 

 var span = document.getElementsByClassName("close")[0];

 span.onclick = function() {
 modal.style.display = "none";
 $(document).unbind('scroll'); 
  $('body').css({'overflow':'visible'});
  projectAnchors.style.top = "0px";
         
     // Get the <span> element that closes the modal
     var span = document.getElementsByClassName("close")[0];
     
     // When the user clicks on <span> (x), close the modal
     span.onclick = function() { 
     modal.style.display = "none";
     mybutton.style.display = "block";
     projectAnchors.style.top = "0px";
     $(document).unbind('scroll'); 
     $('body').css({'overflow':'visible'});
     }
 }


 
 