<!-- Contrat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contrat', 'Contrat:') !!}
    {!! Form::number('contrat', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Numero Recu Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero_recu', 'Numero Recu:') !!}
    {!! Form::text('numero_recu', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::text('date', null, ['class' => 'form-control','id'=>'date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date').datepicker()
    </script>
@endpush

<!-- Montant Field -->
<div class="form-group col-sm-6">
    {!! Form::label('montant', 'Montant:') !!}
    {!! Form::number('montant', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Reste Payer Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reste_payer', 'Reste Payer:') !!}
    {!! Form::number('reste_payer', null, ['class' => 'form-control']) !!}
</div>