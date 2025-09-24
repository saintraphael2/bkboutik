<!-- Produit Boutique Field -->
<div class="col-sm-12">
    {!! Form::label('produit_boutique', 'Produit Boutique:') !!}
    <p>{{ $boutique->produit_boutique }}</p>
</div>

<!-- Stock Field -->
<div class="col-sm-12">
    {!! Form::label('stock', 'Stock:') !!}
    <p>{{ $boutique->stock }}</p>
</div>

<!-- Quantite Field -->
<div class="col-sm-12">
    {!! Form::label('quantite', 'Quantite:') !!}
    <p>{{ $boutique->quantite }}</p>
</div>

<!-- Prix Field -->
<div class="col-sm-12">
    {!! Form::label('prix', 'Prix:') !!}
    <p>{{ $boutique->prix }}</p>
</div>

<!-- Ttc Field -->
<div class="col-sm-12">
    {!! Form::label('ttc', 'Ttc:') !!}
    <p>{{ $boutique->ttc }}</p>
</div>

<!-- Caissier Field -->
<div class="col-sm-12">
    {!! Form::label('caissier', 'Caissier:') !!}
    <p>{{ $boutique->caissier }}</p>
</div>

