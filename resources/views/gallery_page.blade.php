@extends('layouts.app')
@section('content')


  <link href="{{ asset('css/gallery.css') }}" rel="stylesheet"> 

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ $message }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
</div>
@endif

<div>
    <a href="{{ url('add-image') }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add image</a>
</div>

  <!-- Modal for adding image -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Image</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
            <form  action="{{ url('add_image') }}" method="POST" enctype="multipart/form-data">
                @csrf
                  <div class="mb-3">
                    <label for="name" class="form-label">Image</label>
                    <input type="file"  name="images[]" id="inputImage" multiple class="form-control @error('images') is-invalid @enderror">
                    @error('images')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                  </div>

                <button type="submit" class="btn btn-primary">Add Image</button>
              </form>
        </div>
      </div>
    </div>
  </div>

        <h2 class="text-center">Gallery</h2>
   
       <h4 class="text-center mt-5"> @if(empty($images[0]->image))  No Image found    @endif </h4>
</h3>
        @foreach ($images as $image)
        <div class="responsive mt-5">
      <div class="gallery">
           
     <a target="_blank" href="{{ url('images/gallery').'/'.$image->image }}">
          <img src="{{ url('images/gallery').'/'.$image->image }}" alt="Cinque Terre" width="600" height="400">
        </a>
        <form action="{{ url('delete_image') }}" method="post" enctype="multipart/form-data">
            @csrf
        <input type="hidden"  name="image_name" value="{{ $image->image }}">
        <button class="btn show_confirm" data-toggle="tooltip" title='Delete'>X  </button>
    </form>
        {{-- <div class="desc">Add a description of the image here</div> --}}
      </div>
    </div>
      @endforeach
   
    
    <div class="clearfix"></div>
  

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