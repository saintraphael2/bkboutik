<!-- Nom Field -->
<div class="col-sm-12">
    {!! Form::label('nom', 'Nom:') !!}
    <p>{{ $offre->nom }}</p>
</div>

<!-- Tarif Journalier Field -->
<div class="col-sm-12">
    {!! Form::label('tarif_journalier', 'Tarif Journalier:') !!}
    <p>{{ $offre->tarif_journalier }}</p>
</div>

<!-- Tarif Hebdomadaire Field -->
<div class="col-sm-12">
    {!! Form::label('tarif_hebdomadaire', 'Tarif Hebdomadaire:') !!}
    <p>{{ $offre->tarif_hebdomadaire }}</p>
</div>

<!-- Tarif Mensuel Field -->
<div class="col-sm-12">
    {!! Form::label('tarif_mensuel', 'Tarif Mensuel:') !!}
    <p>{{ $offre->tarif_mensuel }}</p>
</div>

