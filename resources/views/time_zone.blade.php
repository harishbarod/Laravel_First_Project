@extends('layouts.app')
@section('content')

<div class="container">

 
    <div class="date mt-4">   
         <label for="time">Date Time :</label>
         <input style="width: 35vw" type="datetime-local" name="time" class="datetime">
</div>
    <div class="date mt-4">   
         <label for="time">TimeZone :</label>
    
       <select name="current_timezone" id="current_timezone" >
        <option>Select your timezone...</option>
        <option value="Pacific/Midway">[GMT-11] Niue Time</option>
        <option value="Pacific/Midway">[GMT-11] Samoa Standard Time</option>
        <option value="America/Adak">[GMT-9] Hawaii-Aleutian Standard Time</option>
        <option value="America/Adak">[GMT-11] Cook Island Time</option>
        <option value="Pacific/Marquesas">[GMT-9:30] Marquesas Islands Time</option>
        <option value="America/Anchorage">[GMT-9] Alaska Standard Time</option>
        <option value="America/Anchorage">[GMT-9] Gambier Island Time</option>
        <option value="America/Los_Angeles">[GMT-8] Pacific Standard Time</option>
        <option value="America/Denver">[GMT-7] Mountain Standard Time</option>
        <option value="America/Regina">[GMT-6] Central Standard Time</option>
        <option value="America/Bogota">[GMT-5] Eastern Standard Time</option>
        <option value="America/Caracas">[GMT-4:00] Venezuelan Standard Time</option>
        <option value="America/Santiago">[GMT-3] Atlantic Standard Time</option>
        <option value="America/St_Johns">[GMT-2:30] Newfoundland Standard Time</option>
        <option value="America/Buenos_Aires">[GMT-3] Amazon Standard Time</option>
        <option value="America/Buenos_Aires">[GMT-3] Central Greenland Time</option>
        <option value="America/Noronha">[GMT-2] Fernando de Noronha Time</option>
        <option value="America/Noronha">[GMT-2] South Sandwich Islands Time</option>
        <option value="Atlantic/Cape_Verde">[GMT-1] Azores Standard Time</option>
        <option value="Atlantic/Cape_Verde">[GMT-1] Cape Verde Time</option>
        <option value="Atlantic/Cape_Verde">[GMT-1] Eastern Greenland Time</option>
        <option value="Africa/Ouagadougou">[GMT]  Western European Time</option>
        <option value="Europe/London">[GMT+1]  Greenwich Mean Time</option>
     
        <option value="Africa/Johannesburg">[GMT+2] Eastern European Time</option>
        <option value="Africa/Johannesburg">[GMT+2] Central African Time</option>
        <option value="Europe/Moscow">[GMT+3] Moscow Standard Time</option>
        <option value="Europe/Moscow">[GMT+3] Eastern African Time</option>
        <option value="Asia/Tehran">[GMT+3:30] Iran Standard Time</option>
        <option value="Asia/Muscat">[GMT+4] Gulf Standard Time</option>
        <option value="Asia/Muscat">[GMT+4] Samara Standard Time</option>
        <option value="Asia/Kabul">[GMT+4:30] Afghanistan Time</option>
        <option value="Asia/Karachi">[GMT+5] Yekaterinburg Standard Time</option>
        <option value="Asia/Karachi">[GMT+5] Yekaterinburg Standard Time</option>
        <option value="Asia/Calcutta">[GMT+5:30] Indian Standard Time</option>
        <option value="Asia/Calcutta">[GMT+5:30] Sri Lanka Time</option>
        <option value="Asia/Katmandu">[GMT+5:45] Nepal Time</option>
        <option value="Asia/Dhaka">[GMT+6] Bangladesh Time</option>
        <option value="Asia/Dhaka">[GMT+6] Bhutan Time</option>
        <option value="Asia/Dhaka">[GMT+6] Novosibirsk Standard Time</option>
        <option value="Asia/Rangoon">[GMT+6:30] Cocos Islands Time</option>
        <option value="Asia/Rangoon">[GMT+6:30] Myanmar Time</option>
        <option value="Asia/Bangkok">[GMT+7] Indochina Time</option>
        <option value="Asia/Bangkok">[GMT+7] Krasnoyarsk Standard Time</option>
        <option value="Asia/Taipei">[GMT+8] Chinese Standard Time</option>
        <option value="Asia/Taipei">[GMT+8] Australian Western Standard Time</option>
        <option value="Asia/Taipei">[GMT+8] Irkutsk Standard Time</option>
        <option value="Australia/Eucla">[GMT+8:45] Southeastern Western Australian Standard Time</option>
        <option value="Asia/Tokyo">[GMT+9] Japan Standard Time</option>
        <option value="Asia/Tokyo">[GMT+9] Korea Standard Time</option>
        <option value="Asia/Tokyo">[GMT+9] Chita Standard Time</option>
        <option value="Australia/Darwin">[GMT+9:30] Australian Central Standard Time</option>
        <option value="Australia/Brisbane">[GMT+10] Australian Eastern Standard Time</option>
        <option value="Australia/Brisbane">[GMT+10] Vladivostok Standard Time</option>
        <option value="Asia Magadan">[GMT+11] Solomon Island Time</option>
        <option value="Asia Magadan">[GMT+11] Magadan Standard Time</option>
        <option value="Pacific/Norfolk">[GMT+12] Norfolk Island Time</option>
        <option value="Pacific/Auckland">[GMT+11] New Zealand Time</option>
        <option value="Pacific/Auckland">[GMT+11] Fiji Time</option>
        <option value="Pacific/Auckland">[GMT+11] Kamchatka Standard Time</option>
        <option value="Pacific/Chatham">[GMT+13:45] Chatham Islands Time</option>
        <option value="Pacific/Tongatapu">[GMT+13] Tonga Time</option>
        <option value="Pacific/Tongatapu">[GMT+13] Phoenix Islands Time</option>
        <option value="Pacific/Kiritimati">[GMT+14] Line Island Time</option>
         </select>
      
    <div class="date mt-4">   
         <label for="time">Convert TimeZone :</label>
        <select name="converted_timezone" id="converted_timezone">
            <option>Select your timezone...</option>
            <option value="Pacific/Midway">[GMT-11] Niue Time</option>
            <option value="Pacific/Midway">[GMT-11] Samoa Standard Time</option>
            <option value="America/Adak">[GMT-9] Hawaii-Aleutian Standard Time</option>
            <option value="America/Adak">[GMT-11] Cook Island Time</option>
            <option value="Pacific/Marquesas">[GMT-9:30] Marquesas Islands Time</option>
            <option value="America/Anchorage">[GMT-9] Alaska Standard Time</option>
            <option value="America/Anchorage">[GMT-9] Gambier Island Time</option>
            <option value="America/Los_Angeles">[GMT-8] Pacific Standard Time</option>
            <option value="America/Denver">[GMT-7] Mountain Standard Time</option>
            <option value="America/Regina">[GMT-6] Central Standard Time</option>
            <option value="America/Bogota">[GMT-5] Eastern Standard Time</option>
            <option value="America/Caracas">[GMT-4:00] Venezuelan Standard Time</option>
            <option value="America/Santiago">[GMT-3] Atlantic Standard Time</option>
            <option value="America/St_Johns">[GMT-2:30] Newfoundland Standard Time</option>
            <option value="America/Buenos_Aires">[GMT-3] Amazon Standard Time</option>
            <option value="America/Buenos_Aires">[GMT-3] Central Greenland Time</option>
            <option value="America/Noronha">[GMT-2] Fernando de Noronha Time</option>
            <option value="America/Noronha">[GMT-2] South Sandwich Islands Time</option>
            <option value="Atlantic/Cape_Verde">[GMT-1] Azores Standard Time</option>
            <option value="Atlantic/Cape_Verde">[GMT-1] Cape Verde Time</option>
            <option value="Atlantic/Cape_Verde">[GMT-1] Eastern Greenland Time</option>
            <option value="Africa/Ouagadougou">[GMT]  Western European Time</option>
            <option value="Europe/London">[GMT+1]  Greenwich Mean Time</option>
         
            <option value="Africa/Johannesburg">[GMT+2] Eastern European Time</option>
            <option value="Africa/Johannesburg">[GMT+2] Central African Time</option>
            <option value="Europe/Moscow">[GMT+3] Moscow Standard Time</option>
            <option value="Europe/Moscow">[GMT+3] Eastern African Time</option>
            <option value="Asia/Tehran">[GMT+3:30] Iran Standard Time</option>
            <option value="Asia/Muscat">[GMT+4] Gulf Standard Time</option>
            <option value="Asia/Muscat">[GMT+4] Samara Standard Time</option>
            <option value="Asia/Kabul">[GMT+4:30] Afghanistan Time</option>
            <option value="Asia/Karachi">[GMT+5] Yekaterinburg Standard Time</option>
            <option value="Asia/Karachi">[GMT+5] Yekaterinburg Standard Time</option>
            <option value="Asia/Calcutta">[GMT+5:30] Indian Standard Time</option>
            <option value="Asia/Calcutta">[GMT+5:30] Sri Lanka Time</option>
            <option value="Asia/Katmandu">[GMT+5:45] Nepal Time</option>
            <option value="Asia/Dhaka">[GMT+6] Bangladesh Time</option>
            <option value="Asia/Dhaka">[GMT+6] Bhutan Time</option>
            <option value="Asia/Dhaka">[GMT+6] Novosibirsk Standard Time</option>
            <option value="Asia/Rangoon">[GMT+6:30] Cocos Islands Time</option>
            <option value="Asia/Rangoon">[GMT+6:30] Myanmar Time</option>
            <option value="Asia/Bangkok">[GMT+7] Indochina Time</option>
            <option value="Asia/Bangkok">[GMT+7] Krasnoyarsk Standard Time</option>
            <option value="Asia/Taipei">[GMT+8] Chinese Standard Time</option>
            <option value="Asia/Taipei">[GMT+8] Australian Western Standard Time</option>
            <option value="Asia/Taipei">[GMT+8] Irkutsk Standard Time</option>
            <option value="Australia/Eucla">[GMT+8:45] Southeastern Western Australian Standard Time</option>
            <option value="Asia/Tokyo">[GMT+9] Japan Standard Time</option>
            <option value="Asia/Tokyo">[GMT+9] Korea Standard Time</option>
            <option value="Asia/Tokyo">[GMT+9] Chita Standard Time</option>
            <option value="Australia/Darwin">[GMT+9:30] Australian Central Standard Time</option>
            <option value="Australia/Brisbane">[GMT+10] Australian Eastern Standard Time</option>
            <option value="Australia/Brisbane">[GMT+10] Vladivostok Standard Time</option>
            <option value="Asia Magadan">[GMT+11] Solomon Island Time</option>
            <option value="Asia Magadan">[GMT+11] Magadan Standard Time</option>
            <option value="Pacific/Norfolk">[GMT+12] Norfolk Island Time</option>
            <option value="Pacific/Auckland">[GMT+11] New Zealand Time</option>
            <option value="Pacific/Auckland">[GMT+11] Fiji Time</option>
            <option value="Pacific/Auckland">[GMT+11] Kamchatka Standard Time</option>
            <option value="Pacific/Chatham">[GMT+13:45] Chatham Islands Time</option>
            <option value="Pacific/Tongatapu">[GMT+13] Tonga Time</option>
            <option value="Pacific/Tongatapu">[GMT+13] Phoenix Islands Time</option>
            <option value="Pacific/Kiritimati">[GMT+14] Line Island Time</option>
         </select> 

       
    </div>


   <button id="convert" class="btn btn-primary mt-4">Convert</button>

      <div class="display">
        <p>Converted Date : <span class="converted_date"></span> </p>
        <p>Converted time : <span class="converted_time"></span> </p>
      </div>


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script>
    $(document).on('click', '#convert', function() {

var dateTime= $('.datetime').val();
var timeZone= $('#current_timezone').find(":selected").val();
var convertedTimeZone= $('#converted_timezone').find(":selected").val();
console.log(dateTime)
console.log(timeZone)
console.log(convertedTimeZone)
$.ajax({
      url: "/convert",
      type: "POST",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      dataType: "json",
      data:{ 
        dateTime:dateTime,   
        timeZone:timeZone,   
        convertedTimeZone:convertedTimeZone,   
      },  
      success: function(data){
        console.log(data)
       var converted_time=data[0]['date'];
       var converted_date=converted_time.slice(0,10);
     

        console.log(converted_time)
                  // JavaScript function to
            // Display 12 hour format

                var date = new Date(converted_time);
                var hours = date.getHours();
                var minutes = date.getMinutes();
                
                // Check whether AM or PM
                var newformat = hours >= 12 ? 'PM' : 'AM'; 
                
                // Find current hour in AM-PM Format
                hours = hours % 12; 
                
                // To display "0" as "12"
                hours = hours ? hours : 12; 
                minutes = minutes < 10 ? '0' + minutes : minutes;
                
        
            var converted_time_formatted= hours + ':' + minutes + ' ' + newformat   ;


  
        $('.converted_date').html(converted_date);
        $('.converted_time').html(converted_time_formatted);


      



      }
    })

})


</script>

@endsection