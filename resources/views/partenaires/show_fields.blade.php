<!-- Nom Field -->
<div class="col-sm-2">
    {!! Form::label('nom', 'Nom:') !!}
    <p>{{ $partenaires->nom }}</p>
</div>

<!-- Prenom Field -->
<div class="col-sm-2">
    {!! Form::label('prenom', 'Prenom:') !!}
    <p>{{ $partenaires->prenom }}</p>
</div>

<!-- Telephone Field -->
<div class="col-sm-2">
    {!! Form::label('telephone', 'Telephone:') !!}
    <p>{{ $partenaires->telephone }}</p>
</div>

<div class="col-sm-2">
    {!! Form::label('Total', 'Total Moto:') !!}
    <p>{{ $total_moto }}</p>
</div>

<!-- Prenom Field -->
<div class="col-sm-2">
    {!! Form::label('', 'Motos Disponible:') !!}
    <p>{{ $total_disponible }}</p>
</div>

<!-- Telephone Field -->
<div class="col-sm-2">
    {!! Form::label('', 'Moto Sous Contrat:') !!}
    <p>{{ $total_contrat }}</p>
</div>

