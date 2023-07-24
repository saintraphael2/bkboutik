{!! Form::open(['route' => ['versements.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <?php $lib = $contrats['numero']?>
    <a href="javascript:void(0);"  onclick="visualiser('Reçu','{{ $lib}}','{{$numero_recu}}')"  class='btn btn-default btn-xs' title="Imprimer la facture" >
        <i class="fa fa-print"></i>
    </a>
    
</div>
{!! Form::close() !!}
