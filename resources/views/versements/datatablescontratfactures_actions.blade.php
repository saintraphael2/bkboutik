{!! Form::open(['route' => ['versements.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    
   
    <a href="{{ route('listeVersement', ['IdContrat'=>$id,'IdVersement'=>0]) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-list"></i>
    </a>
   
</div>
{!! Form::close() !!}
