<!-- Libelle Field -->
<div class="form-group col-sm-6">
    {!! Form::label('libelle', 'Libelle:') !!}
    {!! Form::text('libelle', null, ['class' => 'form-control', 'required', 'maxlength' => 191, 'maxlength' => 191]) !!}
</div>

<!-- Nb Jours Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nb_jours', 'Nb Jours:') !!}
    {!! Form::number('nb_jours', null, ['class' => 'form-control']) !!}
</div>