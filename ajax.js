$(function(){
 
// ПОЛУЧЕНИЕ ШАПКИ ТАБЛИЦЫ
    $.ajax({
      url: "/select.php",
      type: "POST",              
      data: {get_header : "has_data"},
      dataType: "html",    
      success: function(answer){

        $('.result').prepend(answer);

        var arrow = $("tr button");      
        var arrowActive, arrowId;
        

        var links = $('.change a');        
        open_popup_change(links);
        
        
        arrow.each(function() {

            arrow.on('click', function(e){

              e.preventDefault();
             
              if($(this).hasClass("active")) {
                  return;                  
              } else {
                  if (arrowActive) {
                    arrowActive.removeClass("active");
                  } 

                  $(this).addClass("active");                  
                  arrowActive = $(this);
                  arrowId = arrowActive.attr("id");
                  
                // ПОЛУЧЕГИЕ ТЕЛА ТАБЛИЦЫ

                    $.ajax({
                      url: "/select.php",
                      type: "POST",                                  
                      data:{ select : arrowId},
                      success: function(answer){
                       
                        $('.change').remove();                     
                        $('tbody').append(answer);                      
                        var links = $('.change a');     
                        open_popup_change(links);
                      }
                    }); 
                        
              };
            });

        })

    function open_popup_change(links) {

      links.each(function(indx) {
      
          $(this).click(function(e){
              e.preventDefault();
      
              var popup = $("#popup");
              popup.css("display", "block");
              
              var change_data   = $(this).parentsUntil('tbody');      
              var td_data       =  change_data.find('td');
                          
              var p_last_name   = td_data.eq(0).text();
              var p_first_name  = td_data.eq(1).text();
              var p_middle_name = td_data.eq(2).text();
              var p_status      = td_data.eq(3).text();

              popup.find("[name='last_name']").val(td_data.eq(0).text());
              popup.find("[name='first_name']").val(td_data.eq(1).text());
              popup.find("[name='middle_name']").val(td_data.eq(2).text());
              popup.find("[name='status']").val(td_data.eq(3).text());
              
              var msg = '';

                // ОТПРАВЛЯЕМ СТАРЫЕ ДАННЫЕ ОДНОЙ СТРОКИ  ДЛЯ ПОЛУЧЕНИЯ ID            
      
              $.ajax({
                  url: "/update.php",
                  type: "POST",
                  cache: false,                                                 
                  data:{ 
                      past_last_name    : p_last_name,
                      past_first_name   : p_first_name,
                      past_middle_name  : p_middle_name,
                      past_status       : p_status, 
                      action            : 'get_id',                     
                  
                  },
                  success: function(answer){
                                    
                    var user_id = answer;                    

                  // ОБРАБОТКА ИЗМЕНЕНИЯ ЗАПИСИ

                    $('#change_record').on('click', function(){                    

                      $.ajax({
                          url: "/update.php",
                          type: "POST",
                          cache: false,                                  
                          data:{ 
                              last_name   : popup.find("[name='last_name']").val(),
                              first_name  : popup.find("[name='first_name']").val(),
                              middle_name : popup.find("[name='middle_name']").val(),
                              status      : popup.find("[name='status']").val(),
                              user_id     : user_id,
                              action      : 'change',                        
                          
                          },
                          success: function(answer){                          
                                                                                
                            change_data.after(answer);                           
                            var temp = change_data.next();                            
                            change_data.remove();
                            change_data = temp;
                            
                            if(answer == '') {
                              msg = "Не удалось изменить";
                              $('.msg').text(msg);
                            } else {
                              msg = "Успешно изменено";
                               $('.msg').text(msg);
                            } 

                          },
                          error: function () {
                            alert("error");

                          }
                          
                      });                 
                    });
                    
                    // ОБРАБОТКА УДАЛЕНИЯ ЗАПИСИ

                    $('#delete_record').on('click', function(){                      
                    
                    $.ajax({
                        url: "/update.php",
                        cache: false,
                        type: "POST",                                  
                        data:{                          
                            user_id : user_id,                        
                            action  : 'delete',
                        },
                        success: function(answer){
                          msg = answer;
                          $('.msg').text(msg);                                                  
                          change_data.remove();        
                        },
                        error: function() { 
                          alert("error"); }
                    })                 
                  })                 

                  },

              });
           

             $('form a').click(function(){
                $('#change_record').off('click');
                $('#delete_record').off('click');
                $('.msg').empty();
             })   

     
        })
      })

    }


    }
  }); 

})