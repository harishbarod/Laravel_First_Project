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
                    <button type="button" class="add_btn"> +</button>
            
                    @if (isset($data->monday))
                    <?php 
                    $i=0 ;
                    $selected_time=[];  
                    ?>
                        @foreach ($data->monday as $data1)
                        
                        <?php   array_push($selected_time,$data1->start_time)?> 
                            <div class="delete_class">
                                <select name="monday[{{ $i }}][start_time]" style="width:30vw" class="time_select monday" data_class="monday">
                                    @foreach($time_slots as $slot)
                                     <option value="{{ $slot }}" {{ $slot==$data1->start_time?"selected":"" }}> {{ $slot }} </option>
                                 
                                    @endforeach
                                </select>

                                <input  type="text" name="monday[{{ $i }}][end_time]" class="end_time mt-2"  style="width: 30vw"
                                readonly  value="{{ $data1->end_time }}">
                                <button type="button" class="delete_btn">-</button>
                            </div>
                            <?php   $i++ ;?>
                        @endforeach
                    @else
                     <?php    $selected_time= [] ;?>
                        <div class="delete_class">
                            <select name="monday[0][start_time]" style="width:30vw" class="time_select">
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
                    <button type="button" class="add_btn"> +</button>
               
                    @if (isset($data->tuesday))
                    <?php   $j=0 ;
                                 $selected_time2=[];  
                    ?>
                        @foreach ($data->tuesday as $data2)
                        <?php   array_push($selected_time2,$data2->start_time)?> 
                            <div class="delete_class">
                                <select name="tuesday[{{ $j }}][start_time]" style="width:30vw" class="time_select tuesday" data_class="tuesday">
                                    @foreach($time_slots as $slot)
                                     <option value="{{ $slot }}" {{ $slot==$data2->start_time?"selected":"" }}> {{ $slot }} </option>
                                    
                                    @endforeach
                                </select>

                                <input readonly type="text" name="tuesday[{{ $j }}][end_time]" class="end_time mt-2"  style="width: 30vw"
                                    value="{{ $data2->end_time }}">
                                <button type="button" class="delete_btn">-</button>
                            </div>
                            <?php   $j++ ;?>
                        @endforeach
                    @else
                        <div class="delete_class">
                            <select name="tuesday[0][start_time]"  style="width:30vw" class="time_select">
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
                    <button type="button" class="add_btn"> +</button>
                    @if(isset($data->wednesday))
                    <?php   $k=0 ;
                       $selected_time3=[];  ?>
                    @foreach ($data->wednesday as $data3)
                    <?php   array_push($selected_time,$data3->start_time)?> 
                        <div class="delete_class">
                            <select name="wednesday[{{ $k }}][start_time]" style="width:30vw" class="time_select wednesday"  data_class="wednesday">
                                @foreach($time_slots as $slot)
                                 <option value="{{ $slot }}" {{ $slot==$data3->start_time?"selected":"" }}> {{ $slot }} </option>
                                @endforeach
                            </select>
                         
                        <input readonly type="text"  name="wednesday[{{ $k }}][end_time]"  class="end_time mt-2"  style="width: 30vw"
                            value="{{ $data3->end_time }}">
                        <button type="button" class="delete_btn">-</button>
                    </div>
                    <?php   $k++ ;?>
                    @endforeach
                    @else
                    <div class="delete_class">
                        <select name="wednesday[0][start_time]"  style="width:30vw" class="time_select">
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
                    <button type="button" class="add_btn"> +</button>
                    @if(isset($data->thursday))
                    <?php   $l=0 ;
                      $selected_time4=[];  ?>

                    @foreach ($data->thursday as $data4)
                    <?php   array_push($selected_time4,$data4->start_time)?> 
                        <div class="delete_class">
                            <select  name="thursday[{{ $l }}][start_time]"  style="width:30vw" class="time_select thursday" data_class="thursday">
                                @foreach($time_slots as $slot)
                                 <option value="{{ $slot }}" {{ $slot==$data4->start_time?"selected":"" }}> {{ $slot }} </option>
                                @endforeach
                            </select>
                         
                        <input readonly type="text" name="thursday[{{ $l }}][end_time]"  class="end_time mt-2"  style="width: 30vw"
                            value="{{$data4->end_time }}">
                        <button type="button" class="delete_btn">-</button>
                    </div>
                    <?php   $l++ ;?>
                    @endforeach
                    @else
                    <div class="delete_class">
                        <select name="thursday[0][start_time]"  style="width:30vw" class="time_select">
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
                    <button type="button" class="add_btn"> +</button>
                    @if(isset($data->friday))
                    <?php   $m=0 ;
                     $selected_time5=[];  ?>

                    @foreach ($data->friday as $data5)
                    <?php   array_push($selected_time5,$data5->start_time)?> 
                        <div class="delete_class">
                            <select name="friday[{{ $m }}][start_time]"  style="width:30vw" class="time_select friday" data_class="friday">
                                @foreach($time_slots as $slot)
                                 <option value="{{ $slot }}" {{ $slot==$data5->start_time?"selected":"" }}> {{ $slot }} </option>
                                @endforeach
                            </select>
                         
                        <input readonly type="text" name="friday[{{ $m }}][end_time]" class="end_time mt-2"  style="width: 30vw"
                            value="{{ $data5->end_time }}">
                        <button type="button" class="delete_btn">-</button>
                    </div>
                    <?php   $m++ ;?>
                    @endforeach
                    @else
                    <div class="delete_class">
                        <select name="friday[0][start_time]"  style="width:30vw" class="time_select">
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
                    <button type="button" class="add_btn"> +</button>
                    @if(isset($data->saturday))
                    <?php   $n=0 ;
                     $selected_time7=[];  
                    ?>
                    @foreach ($data->saturday as $data7)
                     
                     
                        <div class="delete_class">
                            <select name="saturday[{{ $n }}][start_time]" style="width:30vw" class="time_select saturday" data_class="saturday">
                                @foreach($time_slots as $slot)
                                <?php   array_push($selected_time7,$data7->start_time)?> 
                                 <option value="{{ $slot }}" {{ $slot==$data7->start_time?"selected":"" }}> {{ $slot }} </option>
                                @endforeach
                            </select>
                         
                        <input readonly type="text" name="saturday[{{ $n }}][end_time]"  class="end_time mt-2"  style="width: 30vw"
                            value="{{ $data7->end_time }}">
                        <button type="button" class="delete_btn">-</button>
                    </div>
                    <?php   $n++ ;?>
                    @endforeach
                    @else
                    <div class="delete_class">
                        <select name="saturday[0][start_time]" style="width:30vw" class="time_select">
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
                    <button type="button" class="add_btn"> +</button>
                    
                    @if(isset($data->sunday))
                    <?php   $o=0 ;
                                 $selected_time6=[];  
                    ?>
                    @foreach ($data->sunday as $data6)
                    <?php   array_push($selected_time6,$data6->start_time)?> 
                     
                        <div class="delete_class">
                            <select name="sunday[{{ $o }}][start_time]" style="width:30vw" class="time_select sunday" data_class="sunday">
                                @foreach($time_slots as $slot)
                                 <option value="{{ $slot }}" {{ $slot==$data6->start_time?"selected":"" }}> {{ $slot }} </option>
                                @endforeach
                                
                                
                            </select>
                         
                        <input readonly type="text" class="end_time mt-2" name="sunday[{{ $o }}][end_time]" style="width: 30vw"
                            value="{{ $data6->end_time }}">
                        <button type="button" class="delete_btn">-</button>

                    </div>
                    <?php   $o++ ;?>
                    @endforeach
                    @else
                    <div class="delete_class">
                        <select name="sunday[0][start_time]" style="width:30vw" class="time_select">
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

        var time_slots1= ['1:00','2:00','3:00','4:00','5:00','6:00','7:00','8:00','9:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00','24:00'];


        $(document).on('click', '.time_select', function(e) {
    
      var  class_name = $(this).attr('data_class');
           myclass=class_name;
           console.log();


           if (e.target.hasAttribute("data_name")) {
            }
            else{
                changeOptions()
            }
          


       })

        // deleting div
            $(document).on('click', '.delete_btn', function() {
                // $(this).siblings('.end_time','.time_select').remove();
                $(this).prevAll('.end_time:first').remove();
                $(this).prevAll('.time_select:first').remove();
                $(this).remove();

            });

           

     

        $(document).on('click', '.add_btn', function() {
            var all_selected_data = [];
           
            var all_selected_val = $('.time_select').each(function(element) {

              all_selected_data.push($(this).find(":selected").val());
         
              
            });
           //  console.log(all_selected_data) 
          
            var start_name = $(this).siblings(".delete_class:last-child").children('.time_select:last').attr("name");
            var end_name = $(this).siblings(".delete_class").children('.end_time:last').last().attr("name");
           
       
            console.log(start_name);
            var className2 = start_name.substr(0,start_name.indexOf("["))
         
            myclass=className2;
           
            var myString = start_name.substr(start_name.indexOf("[") +1,1)

           var myString1= parseInt(myString) +1;
    
            let newStartName = start_name.replace(`[${myString}`, `[${myString1}`);
            let newEndName = end_name.replace(`[${myString}`, `[${myString1}`);
            $newArray=[];
            var newRowAdd1 =
             `<select name="${newStartName}"  class="time_select mt-3 ${className2}"  style="width:30vw;" data_name="allows" >
                    @foreach($time_slots as $slot)
                   
                    @if(!in_array($slot, $selected_time))
                     array_push($newArray,$slot);
                     <option value="{{ $slot }}"> {{ $slot }} </option>
                    @endif
                    @endforeach
            </select> 
             <input readonly type="text" name="${newEndName}" class="end_time mt-3" style="width: 30vw" readonly >
             <button type="button" class="delete_btn">-</button>`
          

            $(this).siblings(".delete_class:last").append(newRowAdd1);

            changeOptions();
        });
      
        // // appending val in right side
        $(document).on('change', '.time_select', function() {
            var start_name1 = $(this).attr("name");
            
            //.siblings(".delete_class:last-child").children('.time_select:last').attr("name");
          
            var className3 = start_name1.substr(0,start_name1.indexOf("["))
            myclass =className3
            changeOptions();

            var start_time = $(this).closest('.time_select').find(":selected").text();

            var start_time_new = moment.utc(start_time, 'HH:mm').add(1, 'hour').format('HH:mm');        
            $(this).nextAll('.end_time:first').val(start_time_new);

        });
        
       
        function changeOptions(){
            var all_selected_data1 = [];
            // $('option:selected', $(`.${myclass}`)).remove();

            $(`.${myclass}`).each(function(element) {
              all_selected_data1.push($(this).find(":selected").val());
            
            //   $('option:selected', this).remove();
              $('option', this).not(':selected').remove();
              
            }) 
              time_slots1.forEach(element => {
                if(jQuery.inArray(element, all_selected_data1 ) == -1)
                {
                    var changeOption=  `<option value="${element}"> ${element} </option> `;
                //  console.log(element)
                 
                    $(`.${myclass}`).append(changeOption);
            
                }  
             });
             

    }

    </script>
@endsection
