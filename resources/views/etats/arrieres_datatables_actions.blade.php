{!! Form::open(['route' => ['contrats.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
<a href="javascript:void(0);"  onclick="visualiser_conduteur('Carte','{{$conducteur}}')"  class='btn btn-default btn-xs' title="Visualiser">
        <i class="fa fa-eye"></i>
    </a>
</div>
{!! Form::close() !!}
