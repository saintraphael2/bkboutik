<!-- Nom Client Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nom_client', 'Nom Client:') !!}
    {!! Form::text('nom_client', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telephone', 'Telephone:') !!}
    {!! Form::text('telephone', null, ['class' => 'form-control', 'maxlength' => 45, 'maxlength' => 45]) !!}
</div>

