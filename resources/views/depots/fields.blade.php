<!-- Client Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client', 'Client:') !!}
     {!! Form::select('client',$clients, null, ['class' => 'form-control']) !!}
</div>
<!-- Montant Field -->
<div class="form-group col-sm-6">
    {!! Form::label('montant', 'Montant:') !!}
    {!! Form::number('montant', null, ['class' => 'form-control', 'required']) !!}
</div>


