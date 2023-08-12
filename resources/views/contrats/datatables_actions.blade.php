{!! Form::open(['route' => ['contrats.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('tableau_armortissements.index', ['contrat' => $id]) }}" title="Afficher le tableau d'amortissement" class='btn btn-default btn-xs'>
        <i class="fa fa-table"></i>
    </a>
    <a href="{{ route('versements.create', ['contrat' => $id]) }}" title="Facturation" class='btn btn-default btn-xs'>
        <i class="fa fa-file-invoice-dollar"></i>
    </a>
    @if($montant_total ==$solde) 
    <a href="{{ route('contrats.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('Etes- vous sûr de supprimer ?').'")'

    ]) !!}
    @endif
    @if($actif)
    <a href="{{ route('contrats.state', $id) }}" class='btn btn-warning btn-xs' onclick="return confirm('Etes- vous sûr de désactiver ?')">
        <i class="fa fa-ban"></i>
    </a>
    @endif
</div>
{!! Form::close() !!}
