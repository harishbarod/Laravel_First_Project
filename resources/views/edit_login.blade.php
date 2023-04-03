@extends('layouts.app')
@section('question_css')
<style>
#question_img {
   width: 50px;
   height: 50px;
}
#question_img img{
   width: 50px;
   height: 50px;
}

#loader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url('https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif') no-repeat center center;
  background-size: 50px 50px;
  z-index: 10000;
}
/* .loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
/* @-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
} */ */


 
 </style>

@endsection

@section('content')

@if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif


<div class="container">
    <h3 class="text-center">Edit login</h3>


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





<form  action="{{ url('update_user') }}" method="POST" enctype="multipart/form-data" id="form_id">

    @csrf

    <input type="hidden" value="{{ $user->id }}" name="id" >
      <a href="{{route('profile/add-multiple-mobile_no',['id'=>$user->id ]) }}" class="btn-primary btn">Mobile no</a>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="email"  name="name" value="{{ $user->name }}" aria-describedby="emailHelp">
      </div>
    <div class="mb-3">
      <label for="name" class="form-label">Email</label>
      <input type="text" class="form-control" id="email"  name="email" value="{{ $user->email }}" aria-describedby="emailHelp">
    </div>
     
     <div class="mb-3">
        <label for="name" class="form-label">Mobile </label>
        <input type="text" class="form-control mobile_no" id="mobile"  name="mobile" value="{{ $user->mobile }}" aria-describedby="emailHelp">
      </div>

      <div class="mb-3">
        <label for="name" class="form-label">Age</label>
        <input type="text" class="form-control" id="age"  name="age" value="{{ $user->age }}"aria-describedby="emailHelp">
      </div>
      
      <div class="mb-3">
        <label for="name" class="form-label">Address</label>
        <input type="text" class="form-control" id="address"  name="address" value="{{ $user->address }}"aria-describedby="emailHelp">
      </div>
      
        <?php  $img = '1660900136.jpg' ; ?>
      <div id="question_img" > 
        <img src="{{ Auth::user()->image ?asset('images/'.Auth::user()->image) : asset('images/question/'.$img) }}" alt="" class="img-fluid" style="width:60vw ;">
       </div>
      <div class="mb-3">
        <label for="name" class="form-label">Image</label>
        <input type="file" class="form-control" id="image"  name="image" aria-describedby="emailHelp">
      </div>
    

    <button type="submit" class="btn btn-primary">Update user</button>
  </form>
</div>
{{-- <div id="loader"></div> --}}



{{-- 
<script>

$(document).on('submit', '#form_id', function(e) {
              e.preventDefault();
              var spinner = $('#loader');

              console.log('ok')
              spinner.show();
                $.ajax({
                    url: "/submit_form",
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(dataResult) {
                     if(dataResult=='success'){
                      console.log('returned')
                      spinner.hide();
                   
                     }
                    }


                });
            })
</script> --}}

@endsection

