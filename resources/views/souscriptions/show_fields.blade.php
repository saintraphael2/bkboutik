<!-- Produit Field -->
<div class="col-sm-12">
    {!! Form::label('produit', 'Produit:') !!}
    <p>{{ $souscription->produit }}</p>
</div>

<!-- Date Souscription Field -->
<div class="col-sm-12">
    {!! Form::label('date_souscription', 'Date Souscription:') !!}
    <p>{{ $souscription->date_souscription }}</p>
</div>

<!-- Client Field -->
<div class="col-sm-12">
    {!! Form::label('client', 'Client:') !!}
    <p>{{ $souscription->client }}</p>
</div>

<!-- Identification Field -->
<div class="col-sm-12">
    {!! Form::label('identification', 'Identification:') !!}
    <p>{{ $souscription->identification }}</p>
</div>

<!-- Autre Info Field -->
<div class="col-sm-12">
    {!! Form::label('autre_info', 'Autre Info:') !!}
    <p>{{ $souscription->autre_info }}</p>
</div>

<!-- Montant Initial Field -->
<div class="col-sm-12">
    {!! Form::label('montant_initial', 'Montant Initial:') !!}
    <p>{{ $souscription->montant_initial }}</p>
</div>

<!-- Solde Field -->
<div class="col-sm-12">
    {!! Form::label('solde', 'Solde:') !!}
    <p>{{ $souscription->solde }}</p>
</div>

<!-- Souscripteur Field -->
<div class="col-sm-12">
    {!! Form::label('souscripteur', 'Souscripteur:') !!}
    <p>{{ $souscription->souscripteur }}</p>
</div>

