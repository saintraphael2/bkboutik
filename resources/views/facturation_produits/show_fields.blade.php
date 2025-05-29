<!-- Souscription Field -->
<div class="col-sm-12">
    {!! Form::label('souscription', 'Souscription:') !!}
    <p>{{ $facturationProduit->souscription }}</p>
</div>

<!-- Montant A Payer Field -->
<div class="col-sm-12">
    {!! Form::label('montant_a_payer', 'Montant A Payer:') !!}
    <p>{{ $facturationProduit->montant_a_payer }}</p>
</div>

<!-- Montant Paye Field -->
<div class="col-sm-12">
    {!! Form::label('montant_paye', 'Montant Paye:') !!}
    <p>{{ $facturationProduit->montant_paye }}</p>
</div>

<!-- Reste Paye Field -->
<div class="col-sm-12">
    {!! Form::label('reste_paye', 'Reste Paye:') !!}
    <p>{{ $facturationProduit->reste_paye }}</p>
</div>

<!-- Caissier Field -->
<div class="col-sm-12">
    {!! Form::label('caissier', 'Caissier:') !!}
    <p>{{ $facturationProduit->caissier }}</p>
</div>

