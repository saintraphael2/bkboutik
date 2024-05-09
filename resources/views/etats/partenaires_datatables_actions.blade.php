{!! Form::open(['route' => ['contrats.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>

    <a href="{{ route('partenaires.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
   
</div>
{!! Form::close() !!}
