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

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif


    <div class="container">
        <h3 class="text-center">Add multiple no</h3>


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
            <input type="hidden" value="{{ $user[0]->id }}" name="id">

            <?php $mobiles = explode(',', $user[0]->mobile);
            $i = 1; ?>
            
            @foreach ($mobiles as $mobile)
               
                <div id="row">
                    <label for="name" class="form-label mt-2">Mobile {{ $i++ }}</label> <br>
                    <div class="input-group ">
                        <div class="input-group-prepend">

                            <button class="btn btn-danger" id="DeleteRow" type="button">
                                <i class="bi bi-trash"></i> - </button>
                        </div>
                        <input type="text" name="mobile[]" value="{{ $mobile }}" class="form-control m-input">
                    </div>
                </div>
            @endforeach
            <div id="mobilediv"></div>
            {{-- gog js --}}

            <div>
                <div class="col-lg-12">
                    <div id="row">
                        <div class="input-group ">
                            <div class="input-group-prepend">

                            </div>

                        </div>
                    </div>

                    <div id="newinput"></div>
                    <button id="rowAdder" type="button" class="btn btn-dark mt-2">
                        <span class="bi bi-plus-square-dotted">
                        </span> +
                    </button>
                </div>
            </div>
            {{-- gog js end --}}

            <button type="submit" class="btn btn-primary mt-2">Update user</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    <script type="text/javascript">
        $("#rowAdder").click(function() {
            newRowAdd =
                '<div id="row"> <div class="mt-2 input-group ">' +
                '<div class="input-group-prepend">' +
                '<button class="btn btn-danger" id="DeleteRow" type="button">' +
                '<i class="bi bi-trash"></i> - </button> </div>' +
                '<input type="text" name="mobile[]"  class="form-control m-input"> </div> </div>';

            $('#newinput').append(newRowAdd);
        });

        $("body").on("click", "#DeleteRow", function() {
            $(this).parents("#row").remove();
        })
    </script>


@endsection
