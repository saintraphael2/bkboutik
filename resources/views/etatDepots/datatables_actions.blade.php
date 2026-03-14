{!! Form::open(['route' => ['boutiques.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
 
    <a href="javascript:void(0);"  onclick="visualiser('Reçu', '{{$code}}')"  class='btn btn-default btn-xs'>
    <i class="fa fa-print"></i>
    </a>
   
</div>
{!! Form::close() !!}
