@extends('index')  <!-- this page will extens in index.blade.php -->

@section('content')

@section('js')

<script src="https://code.jquery.com/jquery-3.2.1.min.js" charset="utf-8"></script>
<script type="text/javascript">

$(function(){
  $(".news").click(function(event) {

    var attr=$(".form1").serialize();
    var url=$(".form1").attr('action');

    $.ajax({
      url:url,
      dataType:'json',
      data:attr,
      type:'post',
      beforeSend:function(){

      },
      success:function(data){
        if(data.statues==true){
          $(".tbl tbody").append(data.result);
          $(".form1")[0].reset();//reset all fields to be empty
        }
      },

      error:function(data_error,exception){
        if(exception == "error"){
          var lidata='';

          $.each(data_error.responseJSON.errors,function(index, value) {
            lidata+="<li>"+value+"</li>";
          });
        }
        $(".alert ul").html(lidata);
        $(".alert").prepend("<h1 style='text-align:center'>"+data_error.responseJSON.message+"</h1>")
      }

    });
    return false;
  });

});
</script>

@endsection

        <div class="flex-center position-ref full-height">
          <form class="form1" action="{{url('insert/news')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" name="title" value="{{old('title')}}" placeholder="title">
            <!--value="{{old('input name')}}" to save the value after click submit-->
            <input type="text" name="description" value="{{old('description')}}" placeholder="Describtion">
            <select class="" name="statues">
              <option value="">Choose Statues</option>
              <option value="active" {{old('statues')=='active'?'selected':''}}>active</option>
              <option value="disabled" {{old('statues')=='disabled'?'selected':''}}>disabled</option>
              <option value="pending" {{old('statues')=='pending'?'selected':''}}>pending</option>
            </select>
            <input type="submit" class="news" name="" value="submit">
          </form>
          <center>
          <h1>Not Show Trached</h1>
          <form class="" action="{{url('delete/')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="_method" value="DELETE">
            <table border="1" cellpadding="1" cellspacing="1" class="tbl">
              <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Added By</th>
                <th>Statues</th>
                <th>Deleted At</th>
                <th>Action</th>
              </tr>
              <tbody>

              <?php foreach ($news as $new) { ?>
                @include('layout.row')
              <?php } ?>

            </tbody>

              </table>
              <input type="submit" name="softdelete" value="Soft Delete">
              <input type="submit" name="forcedelete" value="ForceDeleteChecked">
            </form>
            </center>
              <hr>
              <center>
              <h1>Show Trached</h1>
              <form class="" action="{{url('delete/')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="_method" value="DELETE">
                <table>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Added By</th>
                    <th>Statues</th>
                    <th>Action</th>
                  </tr>

                  <?php foreach ($trached as $trach) { ?>
                    <tr>
                      <td>{{$trach->title}}</td><?php //$trach->column name ?>
                      <td>{{$trach->description}}</td>
                      <td>{{$trach->user_id()->first()->name}}</td>
                      <td>{{$trach->statues}}</td>
                      <td>

                            <input type="checkbox" name="id[]" value="{{$trach->id}}">
                            <!--id[] must be array to delete more than one row-->
                      </td>
                    </tr>
                  <?php } ?>
                  </table>
                  <input type="submit" name="restore" value="restore">
                  <input type="submit" name="forcedelete" value="ForceDeleteChecked">
                  </form>
            </center>
        </div>

@endsection
