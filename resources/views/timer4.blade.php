@extends('layouts.app')
@section('content')
    <style>
        #start_time {
            width: 30vw;
        }
        input {
            width: 30vw;
            background-color: #3e39391f;
            border: none;
            color: #6a6565;
        }
        input:focus {
    outline: 0 !important;
}
    </style>
    <div class="container">
    
 <?php 
 $time_slots= ['Select','1:00','2:00','3:00','4:00','5:00','6:00','7:00','8:00','9:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00','24:00'];


 ?>
        <h3 class="text-center">Add Timer</h3>
        <form action="{{ url('add_timer') }}" method="POST">
            @csrf

            <h4>Monday</h4>
            <div class="div1 ">
                <div class="div3">
                    <button type="button" data_class1="monday" class="add_btn"> +</button>
            
                    @if (isset($data->monday))
                    <?php 
                    $i=0 ;
                    $selected_time=[];  
                    ?>
                     <div class="delete_class" >
                        @foreach ($data->monday as $data1)
                        
                        <?php   array_push($selected_time,$data1->start_time)?> 
                           
                                <select name="monday[{{ $i }}][start_time]" style="width:30vw"  class="time_select monday" data_class="monday" >
                                    @foreach($time_slots as $slot)
                                     <option value="{{ $slot }}" {{ $slot==$data1->start_time?"selected":"" }}> {{ $slot }} </option>
                                 
                                    @endforeach
                                </select>

                                <input  type="text" name="monday[{{ $i }}][end_time]" class="end_time mt-2"  style="width: 30vw"
                                readonly  value="{{ $data1->end_time }}">
                                <button type="button" class="delete_btn">-</button>
                        
                            <?php   $i++ ;?>
                        @endforeach
                    </div>
                    @else
                     <?php    $selected_time= [] ;?>
                        <div class="delete_class">
                            <select name="monday[0][start_time]" style="width:30vw" class="time_select monday" data_name="allows" data_first="allow">
                                @foreach($time_slots as $slot)
                                 <option value="{{ $slot }}"> {{ $slot }} </option>
                                @endforeach
                            </select>
                            <input readonly type="text" name="monday[0][end_time]" class="end_time mt-2"  style="width: 30vw">
                            <button type="button" class="delete_btn">-</button>
                        </div>
                    @endif

                </div>

            </div>

           <h4>Tuesday</h4>
            <div class="div1 ">
                <div class="div3">
                    <button type="button" data_class1="tuesday" class="add_btn"> +</button>
               
                    @if (isset($data->tuesday))
                    <?php   $j=0 ;
                                 $selected_time2=[];  
                    ?>
                    <div class="delete_class">
                        @foreach ($data->tuesday as $data2)
                        <?php   array_push($selected_time2,$data2->start_time)?> 
                            
                                <select name="tuesday[{{ $j }}][start_time]" style="width:30vw" class="time_select tuesday" data_class="tuesday">
                                    @foreach($time_slots as $slot)
                                     <option value="{{ $slot }}" {{ $slot==$data2->start_time?"selected":"" }}> {{ $slot }} </option>
                                    
                                    @endforeach
                                </select>

                                <input readonly type="text" name="tuesday[{{ $j }}][end_time]" class="end_time mt-2"  style="width: 30vw"
                                    value="{{ $data2->end_time }}">
                                <button type="button" class="delete_btn">-</button>
                           
                            <?php   $j++ ;?>
                        @endforeach
                    </div>
                    @else
                        <div class="delete_class">
                            <select name="tuesday[0][start_time]"   style="width:30vw" class="time_select tuesday"  data_name="allows">
                                @foreach($time_slots as $slot)
                                 <option value="{{ $slot }}"> {{ $slot }} </option>
                                @endforeach
                            </select>
                            <input readonly type="text" name="tuesday[0][end_time]"  class="end_time mt-2"  style="width: 30vw">
                            <button type="button" class="delete_btn">-</button>
                        </div>
                    @endif

                </div>

                
            </div>
 

            <h4>Wednesday</h4>
            <div class="div1 ">
                <div class="div3">
                    <button type="button" data_class1="wednesday" class="add_btn"> +</button>
                    @if(isset($data->wednesday))
                    <?php   $k=0 ;
                       $selected_time3=[];  ?>
                      <div class="delete_class">
                    @foreach ($data->wednesday as $data3)
                    <?php   array_push($selected_time,$data3->start_time)?> 
               
                            <select name="wednesday[{{ $k }}][start_time]" style="width:30vw" class="time_select wednesday"  data_class="wednesday">
                                @foreach($time_slots as $slot)
                                 <option value="{{ $slot }}" {{ $slot==$data3->start_time?"selected":"" }}> {{ $slot }} </option>
                                @endforeach
                            </select>
                         
                        <input readonly type="text"  name="wednesday[{{ $k }}][end_time]"  class="end_time mt-2"  style="width: 30vw"
                            value="{{ $data3->end_time }}">
                        <button type="button" class="delete_btn">-</button>
                    
                    <?php   $k++ ;?>
                    @endforeach
                </div>
                    @else
                    <div class="delete_class">
                        <select name="wednesday[0][start_time]" data_name="allows"  style="width:30vw" class="time_select wednesday">
                            @foreach($time_slots as $slot)
                             <option value="{{ $slot }}"> {{ $slot }} </option>
                            @endforeach
                        </select>
                        <input readonly type="text"  name="wednesday[0][end_time]"  class="end_time mt-2"  style="width: 30vw"
                           >
                        <button type="button" class="delete_btn">-</button>
                    </div>
                    @endif
                </div>

                
            </div>
           <h4>Thursday</h4>
            <div class="div1 ">
                <div class="div3">
                    <button type="button" data_class1="thursday" class="add_btn"> +</button>
                    @if(isset($data->thursday))
                    <?php   $l=0 ;
                      $selected_time4=[];  ?>
                   <div class="delete_class">
                    @foreach ($data->thursday as $data4)
                    <?php   array_push($selected_time4,$data4->start_time)?> 
                 
                            <select  name="thursday[{{ $l }}][start_time]"  style="width:30vw" class="time_select thursday" data_class="thursday">
                                @foreach($time_slots as $slot)
                                 <option value="{{ $slot }}" {{ $slot==$data4->start_time?"selected":"" }}> {{ $slot }} </option>
                                @endforeach
                            </select>
                         
                        <input readonly type="text" name="thursday[{{ $l }}][end_time]"  class="end_time mt-2"  style="width: 30vw"
                            value="{{$data4->end_time }}">
                        <button type="button" class="delete_btn">-</button>
                 
                    <?php   $l++ ;?>
                    @endforeach
                </div>
                    @else
                    <div class="delete_class">
                        <select name="thursday[0][start_time]"  data_name="allows" style="width:30vw" class="time_select thursday">
                            @foreach($time_slots as $slot)
                             <option value="{{ $slot }}" > {{ $slot }} </option>
                            @endforeach
                        </select>
                        <input readonly type="text" name="thursday[0][end_time]"  class="end_time mt-2"  style="width: 30vw"
                       >
                        <button type="button" class="delete_btn">-</button>
                    </div>
                    @endif

                </div>

                
            </div>



            <h4>Friday</h4>
            <div class="div1 ">
                <div class="div3">
                    <button type="button" class="add_btn" data_class1="friday"> +</button>
                    @if(isset($data->friday))
                    <?php   $m=0 ;
                   $selected_time5=[];  ?>
                   <div class="delete_class"> 
                    @foreach ($data->friday as $data5)
                    <?php   array_push($selected_time5,$data5->start_time)?> 
                       
                            <select name="friday[{{ $m }}][start_time]"  style="width:30vw" class="time_select friday" data_class="friday">
                                @foreach($time_slots as $slot)
                                 <option value="{{$slot}}" {{ $slot==$data5->start_time?"selected":"" }}> {{ $slot }} </option>
                                @endforeach
                            </select>
                         
                        <input readonly type="text" name="friday[{{ $m }}][end_time]" class="end_time mt-2"  style="width: 30vw" value="{{$data5->end_time}}">
                        <button type="button" class="delete_btn">-</button>
                  
                    <?php   $m++ ;?>
                    @endforeach
                </div>
                    @else
                    <div class="delete_class">
                        <select name="friday[0][start_time]" data_name="allows" style="width:30vw" class="time_select friday">
                            @foreach($time_slots as $slot)
                             <option value="{{ $slot }}"> {{ $slot }} </option>
                            @endforeach
                        </select>
                        <input readonly type="text" name="friday[0][end_time]"  class="end_time mt-2"  style="width:30vw" >
                        <button type="button" class="delete_btn">-</button>
                    </div>
                    @endif

                </div>

            </div>



            <h4>Saturday</h4>
            <div class="div1 ">
                <div class="div3">
                    <button type="button" data_class1="saturday" class="add_btn"> +</button>
                    @if(isset($data->saturday))
                    <?php   $n=0 ;
                     $selected_time7=[];  
                    ?>
                     <div class="delete_class">
                    @foreach ($data->saturday as $data7)
                     
                            <select name="saturday[{{ $n }}][start_time]" style="width:30vw" class="time_select saturday" data_class="saturday">
                                @foreach($time_slots as $slot)
                                <?php   array_push($selected_time7,$data7->start_time)?> 
                                 <option value="{{ $slot }}" {{ $slot==$data7->start_time?"selected":"" }}> {{ $slot }} </option>
                                @endforeach
                            </select>
                         
                        <input readonly type="text" name="saturday[{{ $n }}][end_time]"  class="end_time mt-2"  style="width: 30vw"
                            value="{{ $data7->end_time }}">
                        <button type="button" class="delete_btn">-</button>
                    <?php   $n++ ;?>
                    @endforeach
                </div>
                    @else
                    <div class="delete_class">
                        <select name="saturday[0][start_time]" style="width:30vw" data_name="allows" class="time_select saturday">
                            @foreach($time_slots as $slot)
                             <option value="{{ $slot }}"> {{ $slot }} </option>
                            @endforeach
                        </select>
                        <input readonly type="text" name="saturday[0][end_time]" class="end_time mt-2"  style="width:30vw" >
                        <button type="button" class="delete_btn">-</button>
                    </div>
                    @endif
                </div>
      
            </div>
            <h4>Sunday</h4>
            <div class="div1 ">
                <div class="div3">
                    <button type="button" data_class1="sunday" class="add_btn"> +</button>
                    
                    @if(isset($data->sunday))
                    <?php   $o=0 ;
                                 $selected_time6=[];  
                    ?> 
                      <div class="delete_class">
                    @foreach ($data->sunday as $data6)
                    <?php   array_push($selected_time6,$data6->start_time)?> 
                            <select name="sunday[{{ $o }}][start_time]" style="width:30vw" class="time_select sunday" data_class="sunday">
                                @foreach($time_slots as $slot)
                                 <option value="{{ $slot }}" {{ $slot==$data6->start_time?"selected":"" }}> {{ $slot }} </option>
                                @endforeach
                            </select>
                         
                        <input readonly type="text" class="end_time mt-2" name="sunday[{{ $o }}][end_time]" style="width: 30vw"
                            value="{{ $data6->end_time }}">
                        <button type="button" class="delete_btn">-</button>

                    <?php   $o++ ;?>
                    @endforeach
                </div>
                    @else
                    <div class="delete_class">
                        <select name="sunday[0][start_time]"  style="width:30vw" class="time_select sunday" data_name="allows">
                            @foreach($time_slots as $slot)
                             <option value="{{ $slot }}"> {{ $slot }} </option>
                            @endforeach
                        </select>
                        <input readonly type="text" name="sunday[0][end_time]" class="end_time mt-2"  style="width:30vw" >
                        <button type="button" class="delete_btn">-</button>
                    </div>
                    @endif
                </div>

                
            </div> 

            <button class="btn-primary btn mt-3" type="submit">Add</button>
        </form>

    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

    <script>

       var myclass="";

        var time_slots1= ['Select','1:00','2:00','3:00','4:00','5:00','6:00','7:00','8:00','9:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00','24:00'];

        //  change options when click in select tag
        var changeOptions_data=[];
        $(document).on('click', '.time_select', function(e) {
         
            if(e.target.hasAttribute("data_first")){
                changeOptions();
            }
           var  class_name = $(this).attr('data_class');
           myclass=class_name;
            if (e.target.hasAttribute("data_name")==false) {    
                 changeOptions();
            } 
          
            var selected_option=$(this).find(":selected").val();
            changeOptions_data.push(selected_option);
            var optionsArray= [];
           
              changeOptions_data.forEach(element => {
                const removingLastCharacter= element.slice(0, -3);
                optionsArray.push(removingLastCharacter);
                
            });
            //   empty all options
            $('option', this).remove();
            optionsArray.sort(function(a, b) {
            return a - b;
            });

              var AddCharacter =[];
              optionsArray.forEach(element => {
                var AddCharacterData= element.concat(':00')
                AddCharacter.push(AddCharacterData)
               
                var index = AddCharacter.indexOf('Sel:00');

                    if (index !== -1) {
                        AddCharacter[index] = 'Select';
                    }

                });           
    
             var indexOfselect= AddCharacter.length;
             var indexOfselected= indexOfselect-1;
           
             if(AddCharacter[indexOfselected]!='Select'){
                var select=  AddCharacter.lastIndexOf('Select');
                var newArray= AddCharacter.slice(select);
                AddCharacter=newArray
             }
            else{
                AddCharacter
            }
                
                AddCharacter.forEach(element => {
                    var changeOptionData=  `<option value="${element}"`+ (element==selected_option ? "selected":"") +`> ${element} </option> `;
                    $(e.target).append(changeOptionData);
                });
                changeOptions_data.length=0;
               
           
       })

             // deleting select tag
            $(document).on('click', '.delete_btn', function() {
                $(this).prevAll('.end_time:first').remove();
                $(this).prevAll('.time_select:first').remove();
                $(this).remove();
            });
           var all_selected_data = [];
           $(document).on('click', '.add_btn', function() {
           $('.time_select').each(function(element) {
              all_selected_data.push($(this).find(":selected").val());
            });
          
            var start_name = $(this).siblings(".delete_class:last-child").children('.time_select:last').attr("name");
            var end_name = $(this).siblings(".delete_class").children('.end_time:last').attr("name");
        
          if(start_name!=null){
            var className2 = start_name.substr(0,start_name.indexOf("["))
            myclass=className2;
            var myString = start_name.substr(start_name.indexOf("[") +1,1)
            var myString1= parseInt(myString) +1;
    
            let newStartName = start_name.replace(`[${myString}`, `[${myString1}`);
            let newEndName = end_name.replace(`[${myString}`, `[${myString1}`);
         
            var newRowAdd1 =
             `<select name="${newStartName}"  class="time_select mt-3 ${className2}"  style="width:30vw;" data_name="allows" >
                    @foreach($time_slots as $slot)
                    @if(!in_array($slot, $selected_time))
                     <option value="{{ $slot }}"> {{ $slot }} </option>
                    @endif
                    @endforeach
            </select> 
             <input readonly type="text" name="${newEndName}" class="end_time mt-3" style="width: 30vw" readonly >
             <button type="button" class="delete_btn">-</button>`
        }
        else{
           var day= $(this).attr('data_class1');
           myclass = day;
         
            var newRowAdd1 =
             `<select name="${day}[0]['start_time']"  class="time_select mt-3 ${myclass}"  style="width:30vw;" data_name="allows" >
                    @foreach($time_slots as $slot)
                    @if(!in_array($slot, $selected_time))
                     <option value="{{ $slot }}"> {{ $slot }} </option>
                    @endif
                    @endforeach
            </select> 
             <input readonly type="text" name="${day}[0]['end_time']" class="end_time mt-3" style="width: 30vw" readonly >
             <button type="button" class="delete_btn">-</button>`

        }
            $(this).siblings(".delete_class:last").append(newRowAdd1);

            changeOptions_data.length=0;
            changeOptions();

            
        });
      
        // // appending val in right side
        $(document).on('change', '.time_select', function() {
            var start_name1 = $(this).attr("name");
            var className3 = start_name1.substr(0,start_name1.indexOf("["))
            myclass =className3
        
            changeOptions();
            var start_time = $(this).closest('.time_select').find(":selected").text();
            var start_time_new = moment.utc(start_time, 'HH:mm').add(1, 'hour').format('HH:mm');        
            $(this).nextAll('.end_time:first').val(start_time_new);

             all_selected_data.length = 0;
           

             
        });

        function changeOptions(){
            var all_selected_data = [];
            $(`.${myclass}`).each(function(element) {
              all_selected_data.push($(this).find(":selected").val());
            //   $('option', this).not(':selected').remove();
            }) 
    
            time_slots1.forEach(element => {
                if(jQuery.inArray(element, all_selected_data ) == -1)
                {
                    changeOptions_data.push(element);
                }      
             }); 
    }

  
    </script>
@endsection
