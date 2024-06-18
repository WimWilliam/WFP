@extends('layout.conquer2')
@section('content')

<div class="page-content">
    <h3 class="page-title">Upload Foto untuk hotel {{$hotel_name}}</h3>
   <div class="container">
      <form method="POST" enctype="multipart/form-data" action="{{url('hotels/simpanPhoto')}}">
          @csrf
          <div class="form-group">
             <label for="exampleInputType">Pilih Foto</label>
             <input type="file" class="form-control" name="file_photo"/>
             <input type="hidden" name='hotel_id' value="{{$hotel->id}}"/>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
   </div>
</div>
@endsection
