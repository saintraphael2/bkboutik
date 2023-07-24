<!-- Typecontrat Field -->
<div class="col-sm-12">
    {!! Form::label('typecontrat', 'Typecontrat:') !!}
    <p>{{ $contrat->typecontrat }}</p>
</div>

<!-- Numero Field -->
<div class="col-sm-12">
    {!! Form::label('numero', 'Numero:') !!}
    <p>{{ $contrat->numero }}</p>
</div>

<!-- Moto Field -->
<div class="col-sm-12">
    {!! Form::label('moto', 'Moto:') !!}
    <p>{{ $contrat->moto }}</p>
</div>

<!-- Conducteur Field -->
<div class="col-sm-12">
    {!! Form::label('conducteur', 'Conducteur:') !!}
    <p>{{ $contrat->conducteur }}</p>
</div>

<!-- Bdeposit Field -->
<div class="col-sm-12">
    {!! Form::label('bdeposit', 'Bdeposit:') !!}
    <p>{{ $contrat->bdeposit }}</p>
</div>

<!-- Deposit Field -->
<div class="col-sm-12">
    {!! Form::label('deposit', 'Deposit:') !!}
    <p>{{ $contrat->deposit }}</p>
</div>

<!-- Montant Total Field -->
<div class="col-sm-12">
    {!! Form::label('montant_total', 'Montant Total:') !!}
    <p>{{ $contrat->montant_total }}</p>
</div>

<!-- Montant Total Field -->
<div class="col-sm-12">
    {!! Form::label('solde', 'Reste à Payer:') !!}
    <p>{{ $contrat->solde }}</p>
</div>

<!-- Montant Total Field -->
<div class="col-sm-12">
    {!! Form::label('journalier', 'Mode de Paiement:') !!}
    <p>{{ ($contrat->journalier)?"JOURNALIER":"HEBDOMADAIRE" }}</p>
</div>
<!-- Date Signature Field -->
<div class="col-sm-12">
    {!! Form::label('date_signature', 'Date Signature:') !!}
    <p>{{ $contrat->date_signature }}</p>
</div>

<!-- Date Debut Field -->
<div class="col-sm-12">
    {!! Form::label('date_debut', 'Date Debut:') !!}
    <p>{{ $contrat->date_debut }}</p>
</div>

<!-- Date Fin Field -->
<div class="col-sm-12">
    {!! Form::label('date_fin', 'Date Fin:') !!}
    <p>{{ $contrat->date_fin }}</p>
</div>

<!-- Datprm Field -->
<div class="col-sm-12">
    {!! Form::label('datprm', 'Datprm:') !!}
    <p>{{ $contrat->datprm }}</p>
</div>

<!-- Observation Field -->
<div class="col-sm-12">
    {!! Form::label('observation', 'Observation:') !!}
    <p>{{ $contrat->observation }}</p>
</div>

