@foreach ($test as $row)
    <tr>
        <td>{{$row->id}}</td>
        <td>{{$row->name}}</td>
        <td>{{$row->last_name}}</td>
        <td>{{$row->email}}</td>
        <td>{{$row->dob}}</td>
        <td>{{$row->roll_no}}</td>
        <td>{{$row->address}}</td>
        <td>
            <a class="btn btn-danger text-white del" href="javascript:void(0)" data-id="{{ $row->id }}">Delete</a>
            <a class="btn btn-primary text-white edit" href="javascript:void(0)"
               data-id="{{ $row->id }}">Edit</a>
        </td>
    </tr>
@endforeach
