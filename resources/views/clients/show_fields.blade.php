<!-- Nom Client Field -->
<div class="col-sm-3">
    {!! Form::label('nom_client', 'Nom Client:') !!}
    <p>{{ $client->nom_client }}</p>
</div>

<!-- Telephone Field -->
<div class="col-sm-3">
    {!! Form::label('telephone', 'Telephone:') !!}
    <p>{{ $client->telephone }}</p>
</div>

<!-- Solde Field -->
<div class="col-sm-3">
    {!! Form::label('solde', 'Solde:') !!}
    <p>  {{strrev(wordwrap(strrev($client->solde), 3, ' ', true)) }} </p>
</div>

