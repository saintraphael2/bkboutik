<!-- Nom Field -->
<div class="form-group col-sm-4">
    {!! Form::label('nom', 'Nom:') !!}
    {!! Form::text('nom', null, ['class' => 'form-control', 'maxlength' => 30, 'maxlength' => 30]) !!}
</div>

<!-- Prenom Field -->
<div class="form-group col-sm-4">
    {!! Form::label('prenom', 'Prénom:') !!}
    {!! Form::text('prenom', null, ['class' => 'form-control', 'maxlength' => 30, 'maxlength' => 30]) !!}
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-4">
    {!! Form::label('telephone', 'Téléphone:') !!}
    {!! Form::text('telephone', null, ['class' => 'form-control', 'maxlength' => 20, 'maxlength' => 20]) !!}
</div>