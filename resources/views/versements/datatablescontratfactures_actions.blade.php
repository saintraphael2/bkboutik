{!! Form::open(['route' => ['versements.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    
   
    <a href="{{ route('listeVersement', ['IdContrat'=>$id,'IdVersement'=>0]) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-list"></i>
    </a>
   <a href="{{ route('motos.show', $moto) }}" class='btn btn-default btn-xs' title="Vidange">
        <i class="fa fa-cog"></i>
    </a>
</div>
{!! Form::close() !!}
