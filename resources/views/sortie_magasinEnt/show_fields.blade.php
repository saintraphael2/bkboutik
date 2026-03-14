<!-- Produit Boutique Field -->
<div class="col-sm-3">
    {!! Form::label('code', 'Réference:') !!}
    <p>{{ $vente->code }}</p>
</div>


<!-- Ttc Field -->
<div class="col-sm-3">
    {!! Form::label('ttc', 'Ttc:') !!}
    <p>{{ $vente->ttc }}</p>
</div>

<!-- Caissier Field -->
<div class="col-sm-3">
    {!! Form::label('created_at', 'Date Achat:') !!}
    <p>{{ $vente->created_at->format('d-m-Y') }}</p>
</div>

