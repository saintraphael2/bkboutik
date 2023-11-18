{!! Form::open(['route' => ['motos.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <!--a href="{{ route('motos.show', $id) }}" class='btn btn-default btn-xs' title="Vidange">
        <i class="fa fa-cog"></i>
    </a-->
    <a href="{{ route('contratsAssurance',['IdMoto'=>$id])  }}" class='btn btn-default btn-xs' title="Assurance">
    <i class="fa-solid fa-file-contract"></i>
    </a>
    <a href="{{ route('motos.edit', $id) }}" class='btn btn-default btn-xs' title="Mise à jour">
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('Etes- vous sûr?').'")'

    ]) !!}
</div>
{!! Form::close() !!}
