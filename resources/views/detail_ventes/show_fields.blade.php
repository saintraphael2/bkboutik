<!-- Produit Boutique Field -->
<div class="col-sm-12">
    {!! Form::label('produit_boutique', 'Produit Boutique:') !!}
    <p>{{ $detailVente->produit_boutique }}</p>
</div>

<!-- Stock Field -->
<div class="col-sm-12">
    {!! Form::label('stock', 'Stock:') !!}
    <p>{{ $detailVente->stock }}</p>
</div>

<!-- Quantite Field -->
<div class="col-sm-12">
    {!! Form::label('quantite', 'Quantite:') !!}
    <p>{{ $detailVente->quantite }}</p>
</div>

<!-- Prix Field -->
<div class="col-sm-12">
    {!! Form::label('prix', 'Prix:') !!}
    <p>{{ $detailVente->prix }}</p>
</div>

<!-- Ttc Field -->
<div class="col-sm-12">
    {!! Form::label('ttc', 'Ttc:') !!}
    <p>{{ $detailVente->ttc }}</p>
</div>

<!-- Vente Field -->
<div class="col-sm-12">
    {!! Form::label('vente', 'Vente:') !!}
    <p>{{ $detailVente->vente }}</p>
</div>

