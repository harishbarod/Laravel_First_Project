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
{{-- 
   <?php
   echo '<pre>';
   print_r($timer) ;?> --}}
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif


    <div class="container">
        <h3 class="text-center">Add Timer</h3>


        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif




        <form action="{{ url('update_mobile_no') }}" method="POST">
            @csrf
            

          
            <?php  $i=1; ?>
            @foreach ($timer as $time)
               
                <div id="row">
                    <label for="name" class="form-label mt-2">{{ $time->day }} </label> <br>
                    <div class="input-group " style="width:40vw">
                        <div class="input-group-prepend">

                            <button class="btn btn-danger" id="DeleteRow" type="button">
                                <i class="bi bi-trash"></i> - </button>
                        </div>
                        <input type="text" name="mobile[]" value="" style="width: 30vw !important" class="form-control m-input">
                        <input type="text"  value="" style="width: 30vw !important" class="form-control m-input">
                        
                    </div>
                    <div id="newinput" class="newinput{{ $i }}"></div>

                    <button id="add{{ $i }}" type="button" class="btn btn-dark mt-2 add_btn" value={{ $i }}>
                        <span class="bi bi-plus-square-dotted">
                        </span> +
                    </button>
                    
                </div>
             <?php $i++; ?>
            @endforeach
           
         
            <button type="submit" class="btn btn-primary mt-2">Update user</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <script type="text/javascript">
     
        
     
        $("body").on("click", "#DeleteRow", function() {
            $(this).parents("#row").remove();
        })

       var add_btn= document.getElementsByClassName('add_btn');
        Array.from(add_btn).forEach((e)=>{
        e.addEventListener('click',(element)=>{ 
            
           j=element.target.value;
             newRowAdd =
                '<div id="row"> <div class="mt-2 input-group "  style="width: 60vw !important;>' +
                '<div class="input-group-prepend">' +
                '<button class="btn btn-danger" id="DeleteRow" type="button">' +
                '<i class="bi bi-trash"></i> - </button> </div>' +
                '<input type="text" name="mobile[]" style="width: 40vw !important;"   class="form-control m-input"> </div> </div>'+'<input type="text"  style="width: 40vw !important"   class="form-control m-input"> </div> </div>';

            $(`.newinput${j}`).append(newRowAdd);
  

         })
         })
         
      



        // $("body").on("click", "#rowAdder", function() {
        //     newRowAdd =
        //         '<div id="row"> <div class="mt-2 input-group ">' +
        //         '<div class="input-group-prepend">' +
        //         '<button class="btn btn-danger" id="DeleteRow" type="button">' +
        //         '<i class="bi bi-trash"></i> - </button> </div>' +
        //         '<input type="text" name="mobile[]"  class="form-control m-input"> </div> </div>'+'<input type="text"   class="form-control m-input"> </div> </div>';

        //     $('#newinput').append(newRowAdd);
        // })
    </script>




@endsection