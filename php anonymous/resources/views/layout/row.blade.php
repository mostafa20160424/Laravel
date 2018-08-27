
  <tr>
    <td> <a href="news/{{$new->id}}">{{$new->title}}</a> </td><?php //$new->column name ?>
    <td>{{$new->description}}</td>
    <td>{{$new->user_id()->first()->name}}</td><?php // User::find($new->user_id)->name ?>
    <td>{{$new->statues}}</td>
    <td>{{!empty($new->deleted_at)?'Trashed':'Not Trashed'}}</td>
    <td>

          <input type="checkbox" name="id[]" value="{{$new->id}}">
          <!--id[] must be array to delete more than one row-->
    </td>
    <td> <a href="{{url('delete/user/'.$new->user_id)}}">Delete This User</a> </td>
  </tr>
