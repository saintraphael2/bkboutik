{!! Form::open(['route' => ['boutiques.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
<a href="{{ route('sortieMagasin.show', $id) }}" class='btn btn-default btn-xs'>
    <i class="fa fa-cogs"></i>
    </a>
   
</div>
{!! Form::close() !!}
