@extends('admin.index')
@section('content')
  <div class="box">

    <div class="box-header">

    <h3 class="box-title">Edit</h3>

    </div>

    <div class="box-body">
      <form class="delete-from" action="{{aurl('shippings')."/".$shipping->id}}" method="post">
        <?php
        //can but action="{{route('admin.update',$admin->id)}}" route take preifx.name in routelist
        //can but action="{{route('path in route list',route parameter)}}" route take preifx.name in routelist
         ?>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
          <label for="name_ar">name_ar</label>
          <input type="text" name="name_ar" value="{{$shipping->name_ar}}" class="form-control">
        </div>
        <div class="form-group">
          <label for="name_en">name_en</label>
          <input type="text" name="name_en" value="{{$shipping->name_en}}" class="form-control">
        </div>
        <div class="form-group">
          {!! Form::label('user_id',"Company") !!}
          {!! Form::select('user_id',App\User::where('level','company')->pluck('name','id'),$shipping->user_id,['class'=>"form-control"]) !!}
      </div>
        <div class="form-group">
          {!! Form::label('logo',"Logo:") !!}
          {!! Form::file('logo',['class'=>"form-control"]) !!}
          @if(!empty($shipping->logo))
            <img src="{{ Storage::url($shipping->logo) }}" alt="" style="width: 100px;height: 100px;">
          @endif
        </div>
        <input type="submit" name="submit" value="submit">
      </form>
    </div>
  </div>




@endsection
