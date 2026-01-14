<!-- Code Field -->
<div class="col-sm-3">
    {!! Form::label('code', 'Code:') !!}
    <p>{{ $produitBoutique->code }}</p>
</div>

<!-- Libelle Field -->
<div class="col-sm-3">
    {!! Form::label('libelle', 'Libelle:') !!}
    <p>{{ $produitBoutique->libelle }}</p>
</div>

<!-- Quantite Field -->
<div class="col-sm-2">
    {!! Form::label('quantite', 'Quantite Disponible:') !!}
    <p>{{ $produitBoutique->stocks->quantite }}</p>
</div>
<!-- Quantite Field -->
<div class="col-sm-2">
    {!! Form::label('quantite', 'Quantite Vendue:') !!}
    <p>{{ $vendu }}</p>
</div>
<!-- Prix Field -->
<div class="col-sm-2">
    {!! Form::label('prix', 'Prix:') !!}
    <p>{{ $produitBoutique->stocks->prix }}</p>
</div>


