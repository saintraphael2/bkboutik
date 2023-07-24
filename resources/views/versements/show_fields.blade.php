<!-- Contrat Field -->
<div class="col-sm-12">
    {!! Form::label('contrat', 'Contrat:') !!}
    <p>{{ $versement->contrat }}</p>
</div>

<!-- Numero Recu Field -->
<div class="col-sm-12">
    {!! Form::label('numero_recu', 'Numero Recu:') !!}
    <p>{{ $versement->numero_recu }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', 'Date:') !!}
    <p>{{ $versement->date }}</p>
</div>

<!-- Montant Field -->
<div class="col-sm-12">
    {!! Form::label('montant', 'Montant:') !!}
    <p>{{ $versement->montant }}</p>
</div>

<!-- Reste Payer Field -->
<div class="col-sm-12">
    {!! Form::label('reste_payer', 'Reste Payer:') !!}
    <p>{{ $versement->reste_payer }}</p>
</div>

