@extends('layouts.app')
@section('content')

@php if(isset($_GET['page'])) {
$i=$_GET['page'];
}
else{
    $i=1;
}
  if(count($user_selected_options)>0){
  $selected_answer=$user_selected_options[0]->user_answer;
  }
  else{
    $selected_answer="";
  }

@endphp


<form action="{{route('Answer_submit')}}" method="POST">
    @csrf
@foreach ($question as $ques)

<h3>Q.{{ $i }}  {{ $ques['question']}}</h3>

<input type="hidden" id="question_id" name="question_id{{ $i }}" value="{{$ques['id'] }}">
<input type="radio" class="user_answer"  name="answer{{ $i }}" value="{{$ques['option1']}}" @if(  $selected_answer==$ques['option1'])   checked   @endif >
<label for="answer" > <h4> (A) {{   $ques['option1'] }}</h4></label><br>

<input type="radio" class="user_answer"  name="answer{{ $i }}"  value="{{$ques['option2'] }}" @if(  $selected_answer==$ques['option2'])   checked   @endif>
<label for="answer"> <h4> (B) {{  $ques['option2']}}</h4></label><br>

<input type="radio" class="user_answer" name="answer{{ $i }}" value="{{$ques['option3'] }}"  @if(  $selected_answer==$ques['option3'])   checked   @endif>
<label for="answer"> <h4> (C) {{ $ques['option3'] }}</h4></label><br>
<input type="radio" class="user_answer"   name="answer{{ $i }}" value="{{$ques['option4'] }}" @if(  $selected_answer==$ques['option4'])   checked   @endif>
<label for="answer"> <h4> (D) {{   $ques['option4'] }}</h4></label><br>


@php $i++ @endphp

    

@endforeach

<div class="mt-4">
    {{-- {!! $question->links() !!}  --}}
</div>

{{-- <button class="btn btn-primary" type="submit"> Submit Now</button> --}}
{{ $question->links() }}

</form> 



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>



let searchParams = new URLSearchParams(window.location.search)
var pageNo=searchParams.get('page');
if(pageNo==null){
    pageNo=1;
}
if(pageNo==10){
  
    $('.pagination li:last').html(`<button class="btn btn-primary" type="submit" >Submit</button>`);
}

// saving every question answer

$(document).ready(function() {
    var pageNumber= parseInt(pageNo)+1;

    $('.pagination li:last-child').on('click', function(event) {
        event.preventDefault() 
        console.log('ok')
     var question_id = $('#question_id').val();
     var user_answer = $('.user_answer:checked').val();
        

         $.ajax({
             url: "/Answer_submit",
             type: "POST",
             data: {
                 _token:  $("input[name='_token']").val(),
                   user_answer:user_answer,
                   question_id:question_id
             },  
             success: function(dataResult){
                if(dataResult=='success')
                if(pageNo==10){
                    console.log(10);
                    window.location.replace('{{ route("quiz_result") }}')
                }
                else{
                    window.location.replace(`http://127.0.0.1:8000/Test?page=${pageNumber}`);
                }

             }
         });
 
 });
});




</script>



@endsection