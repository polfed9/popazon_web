$(document).ready(function(){
    var slideIndex = [1,1];
    var slideId = ["mySlides1"]
    showSlides(1, 0);
   
    console.log("p", $('.prev'));
    console.log("n", $('.next'));

    $('.prev').on("click", function(){
        var n=-1;
        var no=0;
        console.log("prev");
        showSlides(slideIndex[no] += n, no);
    });

    $('.next').on("click", function(){
        var n=1;
        var no=0;
        console.log("next");
        showSlides(slideIndex[no] += n, no);
    });

    function showSlides(n, no) {
    var i;
    var x = document.getElementsByClassName(slideId[no]);
    if (n > x.length) {slideIndex[no] = 1}    
    if (n < 1) {slideIndex[no] = x.length}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
        x[slideIndex[no]-1].style.display = "block";  
    }
});