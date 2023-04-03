@extends('layouts.app')
@section('content')


<h2 class="text-center">Thank you for Participating in this Test</h2>
{{-- <div><a href="{{url('chat_page')}}" class="btn btn-primary">Chat with Users</a></div>
<br> --}}
<div class="row mt-5">

    <h2 class="text-center col-md-4">Results :</h2>
    
    <h1 class="text-left col-md-4">  <b> ({{ $result['points'] }} /100) </b>
    </h1>
</div>

 
@endsection