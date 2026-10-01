function addCatS(cat){
    $("#catS").append('<option value="" disabled selected>Choose option</option>' );
    cat.forEach(element => {
      $("#catS").append('<option value="'+element["titolo"]+'">'+element["titolo"]+'</option>' );
    });    
}

function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('img').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
  
  
$(document).ready(function(){
    const catP = document.getElementById("catP");
    catP.addEventListener("change", ()=>{
        $('#catS').html('');
        let text = catP.options[catP.selectedIndex].text;
        $.ajax({
            url: 'api-catS.php', //This is the current doc
            type: "POST",
            data: {"catP":text},
            success: function(result){
                addCatS(result);
            }
        }); 
    });

    $("input#img").change(function() {
        readURL(this);
      });
});