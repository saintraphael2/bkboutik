<!-- Client Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client', 'Client:') !!}
    {!! Form::select('client',$clients, null, ['class' => 'form-control']) !!}
</div>

<!-- Ttc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ttc', 'Ttc:') !!}
    {!! Form::number('ttc', null, ['class' => 'form-control', 'disabled'=>'true']) !!}
</div>

 