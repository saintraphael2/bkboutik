{!! Form::open(['route' => ['contrats.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>

    <a href="{{ route('motar', ['IdContrat'=>$id]) }}" class='btn btn-default btn-xs' title="Motif arriéré">
        <i class="fa fa-money-bill"></i></a>
    @if($comptable ==1) 
    <a href="{{ route('majtam', ['IdContrat'=>$id]) }}" class='btn btn-default btn-xs' title="Mise à jour Echéancier">
        <i class="fa fa-newspaper"></i>
    </a>
    @endif
</div>
{!! Form::close() !!}
