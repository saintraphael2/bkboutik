{!! Form::open(['route' => ['conducteurs.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
     
    <a href="{{ route('contrats.create',[ 'conducteur' => $id]) }}" class='btn btn-default btn-xs' title="créer un contrat">
        <i class="fa fa-file-signature"></i>
    </a>

    <a href="{{ route('conducteurs.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    <a href="javascript:void(0);"  onclick="visualiser_conduteur('Carte','{{$id}}')"  class='btn btn-default btn-xs' title="Visualiser">
        <i class="fa fa-eye"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('Etes- vous sûr?').'")'

    ]) !!}
</div>
{!! Form::close() !!}
