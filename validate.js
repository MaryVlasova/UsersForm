$(function(){
     
     $("#form_admin").validate({
         rules: {
            first_name: {
                required: true,
                minlength: 2,
                maxlength: 30,
                        },
            last_name: {
                required: true,
                minlength: 2,
                maxlength: 30,
                        },
            middle_name: {
                maxlength: 30,
                 },                     
            status: "required",
         },
         messages:{
            last_name:{
                required: "поле должно быть заполнено",
                minlength: "в поле должно быть минимум 2 символа",
                maxlength: "в поле должно быть не более 30 символов"
            },
             first_name:{
                required: "поле должно быть заполнено",
                minlength: "в поле должно быть минимум 2 символа",
                maxlength: "в поле должно быть не более 30 символов"
            }, 
             
            middle_name:{
                maxlength: "в поле должно быть не более 30 символов"
                    },
            status:{
                required: "поле должно быть заполнено",
                },      
         },

         errorPlacement: function(error, element) {
             
             if (element.attr("name") == "last_name") error.insertAfter($("input[name=last_name]"));
             if (element.attr("name") == "middle_name") error.insertAfter($("input[name=middle_name]"));
            if (element.attr("name") == "first_name") error.insertAfter($("input[name=first_name]"));
         }	
     });

     $("#form_index").validate({
         rules: {
            first_name: {
                required: true,
                minlength: 2,
                maxlength: 30,
                        },
            last_name: {
                required: true,
                minlength: 2,
                maxlength: 30,
                        },
            middle_name: {
                maxlength: 30,
                 },                     
            status: "required",
         },
         messages:{
            last_name:{
                required: "поле должно быть заполнено",
                minlength: "в поле должно быть минимум 2 символа",
                maxlength: "в поле должно быть не более 30 символов"
            },
             first_name:{
                required: "поле должно быть заполнено",
                minlength: "в поле должно быть минимум 2 символа",
                maxlength: "в поле должно быть не более 30 символов"
            }, 
             
            middle_name:{
                maxlength: "в поле должно быть не более 30 символов"
                    },
            status:{
                required: "поле должно быть заполнено",
                },      
         },

         errorPlacement: function(error, element) {
             
             if (element.attr("name") == "last_name") error.insertAfter($("input[name=last_name]"));
             if (element.attr("name") == "middle_name") error.insertAfter($("input[name=middle_name]"));
            if (element.attr("name") == "first_name") error.insertAfter($("input[name=first_name]"));
         }	
     });


  })
 