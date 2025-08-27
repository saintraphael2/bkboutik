{!! Form::open(['route' => ['livraisons.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('livraisons.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="{{ route('livraisons.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
   
</div>
{!! Form::close() !!}
