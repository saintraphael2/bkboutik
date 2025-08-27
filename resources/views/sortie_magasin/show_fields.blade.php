<!-- Produit Boutique Field -->
<div class="col-sm-3">
    {!! Form::label('code', 'Réference:') !!}
    <p>{{ $boutique->code }}</p>
</div>


<!-- Ttc Field -->
<div class="col-sm-3">
    {!! Form::label('ttc', 'Ttc:') !!}
    <p>{{ $boutique->ttc }}</p>
</div>

<!-- Caissier Field -->
<div class="col-sm-3">
    {!! Form::label('created_at', 'Date Achat:') !!}
    <p>{{ $boutique->created_at->format('d-m-Y') }}</p>
</div>

