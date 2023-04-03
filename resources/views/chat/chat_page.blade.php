@extends('layouts.app')
@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />


<div class="container container2    ">
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card chat-app">
            <div id="plist" class="people-list">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" id="search_input" class="form-control" placeholder="Search...">
                </div>

                <div class="scroll">
                <ul class="list-unstyled chat-list mt-4 mb-5 " >
                        @php $i=1;
                        $img ="1660827737.jpg"; 
                        @endphp
                        @foreach ($users as $user)
                        <li  class="chat_user" >
                        <img   class="user_image_chat" src="{{  $user['image'] ?asset('images/'.$user['image']) : asset('images/'.$img) }}" alt="avatar">

                        <input type="hidden"   value="{{ $user['id'] }}">
                            <span class="chat_user_id">{{ $user['name'] }}</span> <br>
                            <span class="last_seen">
                                 <i class="fa fa-circle offline"></i>last seen 
                                 {{ last_seen($user['id']) }} </span>                                            
                       
                        </li>  

                        @php $i++; 
                   @endphp
                        @endforeach                       
                </ul>
            </div>
            </div>
            <div class="chat">
                <div class="chat-header clearfix">
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                <img id="user_image" src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                
                            </a>

                            <div class="chat-about">
                                <h6 id="user_name" class="m-b-0"></h6>
                            
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="chat-history">
                    <ul id="chat_page" class="m-b-0">
                        <li class="clearfix">
                            <div class="message-data text-right">
                                 {{-- <span class="message-data-time">10:10 AM, Today</span> --}}
                                {{-- <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar"> --}}
                            </div>
                            <li id="user_message">  </li>
                         
                            
                        </li>
                        <li class="clearfix">
                            <div class="message-data">
                                {{-- <span class="message-data-time">10:12 AM, Today</span> --}}
                            </div>

                          <div  class="sender_message">
                                     
                            </div>                           
                        </li>                               
                        <li class="clearfix">
                            <div class="message-data">
                                {{-- <span class="message-data-time">10:15 AM, Today</span> --}}
                            </div>
                            {{-- class=" message my-message" --}}
                            <span id="mymessage" ></span>
                        </li>
                    </ul>
                </div>
                <div class="chat-message clearfix">
                    <div class="input-group mb-0">           
                        <textarea type="text" id="form_input" class="form-control" placeholder="Enter text here...
                        ">            </textarea>                        
                        <div class="input-group-prepend">
                            <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                            <input type="hidden" id="user_id" name="user_id" value={{ Auth::user()->id }}>
                            <input type="hidden" id="sender_id_data" name="sender_id"  value="1">
                            <button type="submit" id="form_button" class="input-group-text"><i class="fa fa-send send_message"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script src="https://cdn.socket.io/4.5.0/socket.io.min.js" integrity="sha384-7EyYLQZgWBi67fBtVxw60/OWl1kjsfrPFcaU0pp0nAh+i8FD068QogUvg85Ewy1k" crossorigin="anonymous"></script>

<script src="{{ asset('js/chat.js') }}" defer></script>
@endsection