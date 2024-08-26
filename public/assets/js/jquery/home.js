$( document ).ready(function() {

 
     // on change update about
     $('#cover').change(function(event){
         var file = event.target.files[0];
         if(file){
             var reader = new FileReader();
             reader.onload = function(e){
                 $('.cover-preview').attr('src', e.target.result).show();
             }
             reader.readAsDataURL(file);
         }
     });


     $('.overlay').on('click',function(){
        var id = $(this).data('id');
        $('.comments-container[data-id='+id+']').toggle();
    });
    $('.comments-container-close-btn').on('click',function(){
        var id = $(this).data('id');
        $('.comments-container[data-id='+id+']').toggle();
    });

 });
 