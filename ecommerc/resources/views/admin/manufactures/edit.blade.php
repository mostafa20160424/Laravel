@extends('admin.index')
@section('content')
  <div class="box">

    <div class="box-header">

    <h3 class="box-title">Edit</h3>

    </div>

    <div class="box-body">
      <form class="delete-from" action="{{aurl('manufactures')."/".$manufacture->id}}" method="post">
        <?php
        //can but action="{{route('admin.update',$admin->id)}}" route take preifx.name in routelist
        //can but action="{{route('path in route list',route parameter)}}" route take preifx.name in routelist
         ?>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
          <label for="manufacture_name_ar">manufacture_name_ar</label>
          <input type="text" name="manufacture_name_ar" value="{{$manufacture->manufacture_name_ar}}" class="form-control">
        </div>
        <div class="form-group">
          <label for="manufacture_name_en">manufacture_name_en</label>
          <input type="text" name="manufacture_name_en" value="{{$manufacture->manufacture_name_en}}" class="form-control">
        </div>
        <div class="form-group">
          {!! Form::label('logo',"Logo:") !!}
          {!! Form::file('logo',['class'=>"form-control"]) !!}
          @if(!empty($manufacture->logo))
            <img src="{{ Storage::url($manufacture->logo) }}" alt="" style="width: 100px;height: 100px;">
          @endif
        </div>
        <input type="submit" name="submit" value="submit">
      </form>
    </div>
  </div>




@endsection
