@extends('index')  <!-- this page will extens in index.blade.php -->

@section('content')

@section('js')



@endsection

<h1>UserName: {{$new->user->name}}</h1>


<?php
 //$new->user_id()->first()->name use it if function name = column name in database
 //$new->user->name use it if function name != column name in database
 ?>


<?php
//$new is variable you send to view user_id is function i create in mode first() mean first row of this id
?>
<form class="" action="{{url('news/'.$new->id)}}" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<textarea name="comment" rows="8" cols="80" value="{{old('comment')}}"></textarea>
<input type="submit" name="submit" value="comment">
</form>

<hr>

<ul>

@foreach($new->Comments()->get() as $comment)

<li>Added By:{{ $comment->user_id()->first()->name }}</li>
<li>Comment:{{ $comment->comment }}</li>

@endforeach



</ul>

@endsection
