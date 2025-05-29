<!-- Type Produit Field -->
<div class="col-sm-12">
    {!! Form::label('type_produit', 'Type Produit:') !!}
    <p>{{ $produit->type_produit }}</p>
</div>

<!-- Modele Field -->
<div class="col-sm-12">
    {!! Form::label('modele', 'Modele:') !!}
    <p>{{ $produit->modele }}</p>
</div>

<!-- Montant Field -->
<div class="col-sm-12">
    {!! Form::label('montant', 'Montant:') !!}
    <p>{{ $produit->montant }}</p>
</div>

