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

 
 </style>

@endsection
 
@section('content')

<div class="container">
    <h3 class="text-center mt-2">Edit Question  </h3>


     
    

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
  

               
<form  action="{{ url('update_question') }}" method="post" enctype="multipart/form-data" >
    
    @csrf
    <div class="mb-3">
        <input type="hidden" value="{{ $data->id }}" name="id">
      <label for="name" class="form-label">Question</label>
      <input type="text" class="form-control" id="question"  name="question" value="{{ $data->question }}" aria-describedby="emailHelp">
    </div>


    <div class="mb-3">
      <label for="name" class="form-label">Option 1</label>
      <input type="text" class="form-control" id="option1" value="{{ $data->option1 }}"  name="option1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Option 2</label>
      <input type="text" class="form-control" id="option2" value="{{ $data->option2 }}"  name="option2" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Option 3</label>
      <input type="text" class="form-control" id="option3" value="{{ $data->option3 }}"  name="option3" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Option 4</label>
      <input type="text" class="form-control" id="option4"  value="{{ $data->option4 }}" name="option4" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Right Answer</label>
      <input type="text" class="form-control" id="ranswer" value="{{ $data->ranswer }}"  name="ranswer" aria-describedby="emailHelp">
    </div>
    
    @php $img ="1660900136.jpg"; @endphp
    <div id="question_img"> 
      <img src="{{ $data->image ?asset('images/question/'.$data->image) : asset('images/question/'.$img) }}" alt="" class="img-fluid">

     </div>
    <div class="mb-3">
      <label for="name" class="form-label">Image</label>
      <input type="file" class="form-control" id="image"  name="image" aria-describedby="emailHelp">
    </div>

    
      <input type="hidden"  value="{{ $data->image }}" name="old_image" >


    <button type="submit" class="btn btn-primary">Update Question</button>
  </form>
</div>
@endsection