<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

<script>
    // deleting div
    $(document).on('click', '.delete_btn', function() {
        $(this).closest('.testing').remove();
    });

    $(document).on('click', '.add_btn', function() {
  
        var start_name = $(this).siblings(".delete_class").children('.time_select').last().attr("name");
        var end_name = $(this).siblings(".delete_class").children('.end_time:last').last().attr("name");
        
        // console.log( start_name);
        // console.log( end_name);
        var myString = start_name.substr(start_name.indexOf("[") +1,1)
        console.log(myString)
       var myString1= parseInt(myString) +1;
    //    console.log(myString1)
     


        let newStartName = start_name.replace(`[${myString}`, `[${myString1}`);
        let newEndName = end_name.replace(`[${myString}`, `[${myString1}`);
      console.log(newStartName)
      console.log(newEndName)

        var newRowAdd1 =
            ` <div class="div3 mt-3 testing">     
    <select name="${newStartName}"  class="time_select"  style="width:30vw;">
         <option value="1:00">1:00</option>
        <option value="2:00">2:00</option>
        <option value="3:00">3:00</option>
        <option value="4:00">4:00</option>
        <option value="5:00">5:00</option>
        <option value="6:00">6:00</option>
        <option value="7:00">7:00</option>
        <option value="8:00">8:00</option>
        <option value="9:00">9:00</option>
        <option value="10:00">10:00</option>
        <option value="11:00">11:00</option>
        <option value="12:00">12:00</option>
        <option value="13:00">13:00</option>
        <option value="14:00">14:00</option>
        <option value="15:00">15:00</option>
        <option value="16:00">16:00</option>
        <option value="17:00">17:00</option>
        <option value="18:00">18:00</option>
        <option value="19:00">19:00</option>
        <option value="20:00">20:00</option>
        <option value="21:00">21:00</option>
        <option value="22:00">22:00</option>
        <option value="23:00">23:00</option>
        <option value="24:00">24:00</option>
    

      </select>
    <input type="text" name="${newEndName}" class="end_time" style="width: 30vw" >
    <button type="button" class="delete_btn">-</button>
    </div>`


        $(this).parent().siblings(".div2").append(newRowAdd1);

    });

    $(document).on('click', '.delete_btn', function() {
        
        $(this).closest('.delete_class').remove();

    });


    // appending val in right side
    $(document).on('change', '.time_select', function() {
        var start_time = $(this).closest('.time_select').find(":selected").text();

        var start_time_new = moment.utc(start_time, 'HH:mm').add(1, 'hour').format('HH:mm');

        $(this).siblings('.end_time').val(start_time_new);

    });
</script>