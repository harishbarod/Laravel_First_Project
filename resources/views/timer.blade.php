@extends('layouts.app')
@section('question_css')

    <style>
        #question_img {
            width: 50px;
            height: 50px;
        }

        #question_img img {
            width: 50px;
            height: 50px;
        }
    </style>
@endsection
@section('content')

{{-- <?php
echo '<pre>';
print_r($timer);
?> --}}

    <div class="container">
        <h3 class="text-center">Add Timer</h3>

        <form action="{{ url('add_timer') }}" method="POST">
            @csrf
                <div id="row">
                    <label for="name" class="form-label mt-2"> Monday</label> <br>
                    <div class="input-group " style="width:40vw">
                        <div class="input-group-prepend">

                            <button class="btn btn-danger DeleteRow" type="button">
                                <i class="bi bi-trash"></i> - </button>
                        </div>
                      
                        <?php $times = explode(',', $timer[0]->time);
                        $i = 1; ?>
                        
                     @foreach ($times as $time1)
                        <input type="text" name="monday[]" value="{{ $time1 }}" style="width: 30vw !important" class="form-control m-input">
                        <input type="text"  value="{{ !empty($time1)?$time1+1 :"" }}" style="width: 30vw !important" class="form-control m-input mb-4">
                     @endforeach
                        
                    </div>
                    <div id="newinput" class="newinput1"></div>

                    <button  type="button" class="btn btn-dark mt-2 add_btn1">
                        <span class="bi bi-plus-square-dotted">
                        </span> +
                    </button>                
                </div>
            

                <div id="row">
                    <label for="name" class="form-label mt-2"> Tuesday</label> <br>
                    <div class="input-group " style="width:40vw">
                        <div class="input-group-prepend">

                            <button class="btn btn-danger DeleteRow"  type="button">
                                <i class="bi bi-trash"></i> - </button>
                        </div>

                        <?php $times2 = explode(',', $timer[1]->time);
                        $i = 1; ?>
                        
                        @foreach ($times2 as $time2)
                        <input type="text" name="tuesday[]" value="{{ $time2 }}" style="width: 30vw !important" class="form-control m-input">
                        <input type="text"  value="{{ !empty($time2)?$time2+1 :"" }}" style="width:30vw !important" class="mb-4 form-control m-input">
                        @endforeach
                    </div>
                    <div id="newinput" class="newinput2"></div>

                    <button id="add" type="button" class="btn btn-dark mt-2 add_btn2" >
                        <span class="bi bi-plus-square-dotted">
                        </span> +
                    </button>
                    
                </div>
         
            <button type="submit" class="btn btn-primary mt-2">Update user</button>
        </form>
    </div>


    <script type="text/javascript">

var delete_btn= document.getElementsByClassName('DeleteRow');

        Array.from(delete_btn).forEach((e)=>{
            console.log(e)
        e.addEventListener('click',(element)=>{  
            element.target.parentNode.parentNode
        console.log(element.target)

       var remove_input= element.target.parentNode.parentNode
       remove_input.remove();
        })
        })

       // $("body").on("click", "#DeleteRow", function() {
        //     $(this).parents("#row").remove();
        // })

        



     var add_btn= document.getElementsByClassName('add_btn1');
        Array.from(add_btn).forEach((e)=>{
        e.addEventListener('click',(element)=>{        
             newRowAdd =
                '<div id="row"> <div class="mt-2 input-group "  style="width: 60vw !important;>' +
                '<div class="input-group-prepend">' +
                '<button class="btn btn-danger DeleteRow" type="button">' +
                '<i class="bi bi-trash"></i> - </button> </div>' +
                '<input type="text" name="monday[]" style="width: 40vw !important;"   class="form-control m-input"> </div> </div>'+'<input type="text"  style="width: 40vw !important"   class="form-control m-input"> </div> </div>';

            $(`.newinput1`).append(newRowAdd);
  

         })
         })

       var add_btn= document.getElementsByClassName('add_btn2');
        Array.from(add_btn).forEach((e)=>{
        e.addEventListener('click',(element)=>{ 
            
          
             newRowAdd =
                '<div id="row"> <div class="mt-2 input-group "  style="width: 60vw !important;">' +
                '<div class="input-group-prepend">' +
                '<button class="btn btn-danger DeleteRow" type="button">' +
                '<i class="bi bi-trash"></i> - </button> </div>' +
                '<input type="text" name="tuesday[]" style="width: 40vw !important;"   class="form-control m-input"> </div> </div>'+'<input type="text"  style="width: 40vw !important"   class="form-control m-input"> </div> </div>';

            $(`.newinput2`).append(newRowAdd);
  

         })
         })
         
      



    </script>




@endsection