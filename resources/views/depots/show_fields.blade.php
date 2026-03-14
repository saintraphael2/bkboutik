<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', 'Code:') !!}
    <p>{{ $depot->code }}</p>
</div>

<!-- Montant Field -->
<div class="col-sm-12">
    {!! Form::label('montant', 'Montant:') !!}
    <p>{{ $depot->montant }}</p>
</div>

<!-- Caissier Field -->
<div class="col-sm-12">
    {!! Form::label('caissier', 'Caissier:') !!}
    <p>{{ $depot->caissier }}</p>
</div>

<!-- Client Field -->
<div class="col-sm-12">
    {!! Form::label('client', 'Client:') !!}
    <p>{{ $depot->client }}</p>
</div>

