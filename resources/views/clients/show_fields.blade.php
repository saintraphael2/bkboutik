<!-- Raison Sociale Field -->
<div class="col-sm-12">
    {!! Form::label('raison_sociale', 'Raison Sociale:') !!}
    <p>{{ $client->raison_sociale }}</p>
</div>

<!-- Responsable Field -->
<div class="col-sm-12">
    {!! Form::label('responsable', 'Responsable:') !!}
    <p>{{ $client->responsable }}</p>
</div>

<!-- Contact Field -->
<div class="col-sm-12">
    {!! Form::label('contact', 'Contact:') !!}
    <p>{{ $client->contact }}</p>
</div>

<!-- Adresse Field -->
<div class="col-sm-12">
    {!! Form::label('adresse', 'Adresse:') !!}
    <p>{{ $client->adresse }}</p>
</div>

