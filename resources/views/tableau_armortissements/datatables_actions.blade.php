
{!! Form::open(['route' => ['tableau_armortissements.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @if(\Carbon\Carbon::parse($datprev)->lte(\Carbon\Carbon::now()))
    <div class="icheck-success d-inline arrieres">
    @else
    <div class="icheck-success d-inline">
    @endif
  
        <input type="checkbox" id="amortissement_{{$id}}" name="amortissements[{{ $id }}]" data-id="{{$id}}" data-montant="{{$montant}}" value="{{$montant}}" class="amortissement" onclick="validateAmortissement('{{$id}}', '{{$montant}}','{{$solde}}')">
        <!-- <input type="checkbox" id="amortissement{{$id}}" name="amortissement" data-id="{{$id}}" data-montant="{{$montant}}" class="amortissement"> -->
        <label for="amortissement_{{$id}}">
            À Payer
        </label>
    </div>

    <!-- <a href="{{ route('tableau_armortissements.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('Etes- vous sûr?').'")'

    ]) !!} -->
</div>
{!! Form::close() !!}
