@extends('layouts.app')

@section('content')


 
@php $i=1;
//  echo '<pre>';
// print_r($question);die;
@endphp


<form action="{{url('answer_submit')}}" method="POST">
    @csrf
@foreach ($question as $ques)

<h3>Q.{{ $i }}  {{ $ques['question']}}</h3>

<input type="hidden" name="question_id{{ $i }}" value="{{$ques['id'] }}">
<input type="radio" id="css" name="answer{{ $i }}" value="{{$ques['option1']}}" >
<label for="answer" > <h4> (A) {{   $ques['option1'] }}</h4></label><br>

<input type="radio" id="css" name="answer{{ $i }}"  value="{{$ques['option2'] }}">
<label for="answer"> <h4> (B) {{  $ques['option2']}}</h4></label><br>

<input type="radio" id="css" name="answer{{ $i }}" value="{{$ques['option3'] }}">
<label for="answer"> <h4> (C) {{ $ques['option3'] }}</h4></label><br>
<input type="radio" id="css" name="answer{{ $i }}" value="{{$ques['option4'] }}" >
<label for="answer"> <h4> (D) {{   $ques['option4'] }}</h4></label><br>


@php $i++ @endphp

    

@endforeach

<div class="mt-4">
    {{-- {!! $question->links() !!}  --}}
</div>

<button class="btn btn-primary" type="submit"> Submit Now</button>
</form> 





@endsection