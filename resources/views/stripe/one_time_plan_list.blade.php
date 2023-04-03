@extends('layouts.app')
@section('content')

@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
<h2 class="text-center">Plan list</h2>

<a class="btn btn-primary mt-4 mb-4"  data-bs-toggle="modal" data-bs-target="#exampleModal1">Add one time plan</a>
<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Price</th>
        <th>Plan type</th>
        <th width="280px">Action</th>
    </tr>
   <?php $i =0; ?>  
    @foreach ($plans as $plan)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $plan->name }}</td>
        <td>$ {{ $plan->price }} </td>
        <td>{{ $plan->duration }}ly </td>
        <td>
            <form action="{{ url('delete_one_time_plan') }}" method="POST">

                <a class="btn btn-primary" href="{{url('edit_one_time_plan/'.$plan->id)  }}"><i class="fa fa-edit"></i></a>
                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                @csrf
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
            </form>
        </td>
    </tr>
    @endforeach
</table>








<!-- Modal for chat one time plan-->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModal1Label">Plan list</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        
            <form action="{{ url('add_one_time_plan') }}" method="POST">
                <div class="mb-3">
                   @csrf
                  <label for="name" class="form-label"> Name</label>
                  <input type="text" name="name" class="form-control"  >
                  <small>@error('name')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror</small>
                </div>
              
                <div class="mb-3">
                  <label for="price" class="form-label"> Price</label>
                  <input type="number" name="price" class="form-control"  >
                  <small>@error('price')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror</small>
                </div> 
               <div class="mb-3">
                  <label for="price" class="form-label"> Plan type</label>
                  <select name="duration" class="form-select"  id="duration">
                      <option value="month">1 Month</option>
                     
                  </select>
                  <small>@error('duration')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror</small>
                </div>
                
                <div class="mb-3">
                 <button class="btn btn-primary">Add Plan</button>
                </div>
              
              </form>
            </div>
      </div>
    </div>
  </div>
  {{-- end modal for plan --}}

@endsection