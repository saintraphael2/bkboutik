{!! Form::open(['route' => ['compagnieassurances.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    
    <a href="{{ route('compagnieassurances.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('Etes- vous sûr?').'")'

    ]) !!}
</div>
{!! Form::close() !!}
