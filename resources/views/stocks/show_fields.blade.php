<!-- Produit Boutique Field -->
<div class="col-sm-12">
    {!! Form::label('produit_boutique', 'Produit Boutique:') !!}
    <p>{{ $stock->produit_boutique }}</p>
</div>

<!-- Date Stock Field -->
<div class="col-sm-12">
    {!! Form::label('date_stock', 'Date Stock:') !!}
    <p>{{ $stock->date_stock }}</p>
</div>

<!-- Quantite Field -->
<div class="col-sm-12">
    {!! Form::label('quantite', 'Quantite:') !!}
    <p>{{ $stock->quantite }}</p>
</div>

<!-- Prix Field -->
<div class="col-sm-12">
    {!! Form::label('prix', 'Prix:') !!}
    <p>{{ $stock->prix }}</p>
</div>

<!-- Magasinier Field -->
<div class="col-sm-12">
    {!! Form::label('magasinier', 'Magasinier:') !!}
    <p>{{ $stock->magasinier }}</p>
</div>

