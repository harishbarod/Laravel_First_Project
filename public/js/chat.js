
// never forget to start npm server using npm start for access chat functionality
$('#form_input').attr('disabled','disabled');
$('#form_button').attr('disabled','disabled');


user_chat= document.getElementsByClassName('chat_user');
user_image= document.getElementById('user_image');
user_name= document.getElementsByClassName('user_name');
chat_user_id= document.getElementsByClassName('chat_user_id');


Array.from(user_chat).forEach((e)=>{
    e.addEventListener('click',(element)=>{  

      user_image1 = e.getElementsByClassName('chat_user_id')[0].innerHTML
    
       $('#user_message').html('');
       $("#form_input").removeAttr('disabled');
       $("#form_button").removeAttr('disabled');
         
       user_image.src = e.children[0].src;  
     
       user_name= document.getElementById('user_name');
       sender_id= document.getElementById('sender_id_data');
     
       sender_id.value= e.children[1].value;
       user_name.innerHTML= user_image1;
    })
})




$(document).ready(function() {
   
    $('#form_button').on('click', function() {
      var chat = $('#form_input').val();
      var user_id = $('#user_id').val();
      var sender_id = $('#sender_id_data').val();
     
      if(chat!=""){
          $.ajax({
              url: "/chat_message_send",
              type: "POST",
              data: {
                  _token: $("#csrf").val(),
                  type: 1,
                  user_id: user_id,
                  sender_id:sender_id,
                  message: chat
              },
              cache: false,
              success: function(dataResult){
           
                  var dataResult = JSON.parse(dataResult);
                  if(dataResult.statusCode==200){
                    $("#form_input").val('');
                  }
                  else if(dataResult.statusCode==201){
                     alert("Error occured !");
                  }
                  
              }
          });
      }   
  });
});

$(document).ready(function() {
  $('.chat_user').on('click', function() {
    var user_id = $('#user_id').val();
    var sender_id=  $('#sender_id_data').val()

  $.ajax({
      url: "/chat_data",
      type: "POST",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data:{ 
           user_id:user_id,
           sender_id:sender_id,   
      },  
      success: function(chat_data){

        result = JSON.parse(chat_data);
        data= result.data;
        data1="";
        data2="";
        data.forEach(function (item) {
          $time = item.created_at;
         time_chat =$time.substr(11,5);

         $hour= $time.substring(11,13);
         $minute= $time.substring(13,16);
        
         $AmPm = $hour>= 12? ' PM':' AM';
         $convert_time = $hour>12? $hour -12 : $hour;

         last_seen =$convert_time+$minute +$AmPm;
        
          if(user_id==item.user_id)
          {
            data1= ' <span class="message-data-time float-right">'+last_seen +' &nbsp;</span><br>'+
            '<div id="bodyData" class="float-right">'  +'&nbsp; &nbsp;'  +item.message+  '&nbsp; &nbsp;</div> <br>'
            $("#user_message").append(data1);
            // $("#user_message").replaceWith(data1);
          }
          else{
            data1= ' <span class=" float-right">&nbsp;&nbsp;'+last_seen +' &nbsp; </span><br>'+ ' <div id="bodyData1" class="float-left">'+item.message+  '&nbsp; &nbsp;'+'&nbsp; &nbsp;</div> <br>'
            $("#user_message").append(data1);
          }         
           });
        
      }  
  });


});
});



  $(document).ready(function() {
    $('#form_button').on('click', function() {
      var user_id = $('#user_id').val();
      var sender_id=  $('#sender_id_data').val()
    $.ajax({
        url: "/chat_last_data",
        type: "POST",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:{ 
             user_id:user_id,
             sender_id:sender_id,   
        },
        success: function(chat_data){
          result = JSON.parse(chat_data);
          data= result.data;
          data1="";
          data2="";
          data.forEach(function (item) {
            time = item.created_at;
           time_chat =time.substr(11,5);

           $hour= time.substring(11,13);
           $minute= time.substring(13,16);
          
           $AmPm = $hour>= 12? ' PM':' AM';
           $convert_time = $hour>12? $hour-12 : $hour;
  
           last_seen =$convert_time+$minute +$AmPm;
          


            if(user_id==item.user_id)
            {
              data2+= '<span class=" float-right">&nbsp;&nbsp;'+last_seen +' &nbsp; </span><br><div id="bodyData" class="float-right "> '  +'&nbsp; &nbsp;'  +item.message+  '&nbsp; &nbsp; </div> <br>'
              
               $("#user_message").append(data2);
            }
            else{
              data2+= ' <span style="float:right !important;" class=" float-right">&nbsp;&nbsp;'+last_seen +' &nbsp; </span><br><div id="bodyData1" class="float-left ">'+item.message  + '&nbsp; &nbsp; </div> <br>'
              $("#user_message").append(data2);
            }
               
             });
          
        }  
    });
  });
});



// socket. io setup


$(function(){
    let ip_address= '127.0.0.1';
    let socket_port = '3000';
    let socket = io(ip_address + ':' + socket_port);

    let chatInput = $('#form_input');
      $('#form_button').on('click', function() {
        let message= $('#form_input').val();

            socket.emit('sendChatToServer',message); 
            return false;         
    })
    socket.on('sendChatToClient',(message)=>{
        $('#user_message').append(' <div id="bodyData1" class="float-left">'+message+  ' &nbsp; &nbsp; </div> <br>');
    });

});



// search functionality 

$(document).ready(function() {
  $('#search_input').on('keypress', function() {
    var search = $('#search_input').val();
    console.log(search);
  $.ajax({
      url: "/searched_user",
      type: "POST",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data:{ 
           user_name:search
      },  
      success: function(chat_data){
           
        // result = JSON.parse(chat_data);
        // data= result.data;
        // data1="";
        // data2="";
        // data.forEach(function (item) {
        //  time_chat =$time.substr(11,5);

        //  $hour= $time.substring(11,13);
        //  $minute= $time.substring(13,16);
        
        //  $AmPm = $hour>= 12? ' PM':' AM';
        //  $convert_time = $hour>12? $hour -12 : $hour;

        //  last_seen =$convert_time+$minute +$AmPm;
        
          //  });
        
      }  
  });


});
});
  
  
  



  



















