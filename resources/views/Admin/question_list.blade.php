
@extends('layouts.app')
@section('question_css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

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
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center mt-3">List of Questions</h2>
            </div>

            {{-- <div class="pull-left">
                <a class="btn btn-success m-5" href="{{ url('products') }}"> Buy Books at 30% OFF </a>
            </div> --}}
            <div class="pull-right">
                <a class="btn btn-success m-5" href="{{ route('question.create') }}"> Add new </a>
            </div>
        
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Questions</th>
            <th> Option1</th>
            <th> Option2</th>
            <th> Option3</th>
            <th> Option4</th>
            <th> Right answer</th>
            <th> Image</th>
           
            <th width="280px">Action</th>
        </tr>
       @php $i=1;
       if(isset($_GET['page'])){
        
         $page_no= $_GET['page'];
       }
       else{
        $page_no=1;
       }
      
       @endphp
        @foreach ($questions as $question)
        <tr>
            <td>{{  5*$page_no-5 + $i++ }}</td>
            <td>{{ $question->question }}</td>
            <td>{{ $question->option1 }}</td>
            <td>{{ $question->option2}}</td>
            <td>{{ $question->option3 }}</td>
            <td>{{ $question->option4 }}</td>
            <td>{{ $question->ranswer }}</td>
          
                @php $img ="1660900136.jpg"; @endphp
            <td>
                <div id="question_img"> 
                <img src="{{ $question->image ?asset('images/question/'.$question->image) : asset('images/question/'.$img) }}" alt="" class="img-fluid">

               </div>
            </td>
            <td>
                <form action="{{ route('question.destroy',$question->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('question.edit',$question->id) }}"><i class="fas fa-edit"></i></a>
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="show_confirm btn btn-danger"data-toggle="tooltip" title='Delete'><i class="fa fa-trash" aria-hidden="true"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $questions->links() !!}
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script type="text/javascript">

   $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete this record?`,           
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
          }
        });
    });

</script>

      
@endsection