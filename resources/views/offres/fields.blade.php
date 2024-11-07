<!-- Nom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nom', 'Désignation:') !!}
    {!! Form::text('nom', null, ['class' => 'form-control', 'maxlength' => 191, 'maxlength' => 191]) !!}
</div>

<!-- Tarif Journalier Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tarif_journalier', 'Tarif Journalier:') !!}
    {!! Form::number('tarif_journalier', null, ['class' => 'form-control']) !!}
</div>

<!-- Tarif Hebdomadaire Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tarif_hebdomadaire', 'Tarif Hebdomadaire:') !!}
    {!! Form::number('tarif_hebdomadaire', null, ['class' => 'form-control']) !!}
</div>

<!-- Tarif Mensuel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tarif_mensuel', 'Tarif Mensuel:') !!}
    {!! Form::number('tarif_mensuel', null, ['class' => 'form-control']) !!}
</div>