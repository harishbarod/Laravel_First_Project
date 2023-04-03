@extends('layouts.app')
 
@section('content')

<div class="container">
    <h3 class="text-center">Add Your Question  </h3>


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
  


<form  action="{{ route('question.store') }}" method="POST" enctype="multipart/form-data">

    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Question</label>
      <input type="text" class="form-control" id="question"  name="question" aria-describedby="emailHelp">
    </div>


    <div class="mb-3">
      <label for="name" class="form-label">Option 1</label>
      <input type="text" class="form-control" id="option1"  name="option1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Option 2</label>
      <input type="text" class="form-control" id="option2"  name="option2" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Option 3</label>
      <input type="text" class="form-control" id="option3"  name="option3" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Option 4</label>
      <input type="text" class="form-control" id="option4"  name="option4" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Right Answer</label>
      <input type="text" class="form-control" id="ranswer"  name="ranswer" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
      <label for="name" class="form-label">Image</label>
      <input type="file" class="form-control" id="image"  name="image" aria-describedby="emailHelp">
    </div>

    <button type="submit" class="btn btn-primary">Add Question</button>
  </form>
</div>
@endsection