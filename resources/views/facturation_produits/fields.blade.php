<!-- Souscription Field -->
<div class="form-group col-sm-3">
    {!! Form::label('souscription', 'Immatriculation:') !!}
    {!! Form::hidden('souscription', null, ['class' => 'form-control',
        'id' => 'souscription']) !!}
    {!! Form::text('souscriptionInfo', null, [
            'class' => 'form-control',
            'id' => 'souscriptionInfo',
            'required',
            'maxlength' => 255,
            'autocomplete' => 'off'
           
        ]) !!}
</div>
<div class="form-group col-sm-3">
    {!! Form::label('conducteur', 'Conducteur:') !!}
    {!! Form::text('conducteur', null, ['class' => 'form-control','id'=>'conducteur']) !!}
</div>
<div class="form-group col-sm-3">
    {!! Form::label('produit', 'Produit:') !!}
    {!! Form::text('produit', null, ['class' => 'form-control','id'=>'produit']) !!}
</div>
<!-- Montant A Payer Field -->
<div class="form-group col-sm-3">
    {!! Form::label('montant_a_payer', 'Montant A Payer:') !!}
    {!! Form::number('montant_a_payer', null, ['class' => 'form-control','id'=>'montant_a_payer']) !!}
</div>

<!-- Montant Paye Field -->
<div class="form-group col-sm-4">
    {!! Form::label('montant_paye', 'Montant Paye:') !!}
    {!! Form::number('montant_paye', null, ['class' => 'form-control', 'required','id'=>'montant_paye']) !!}
</div>
<div class="form-group col-sm-4">
    {!! Form::label('date_souscription', 'Prochain Payement:') !!}
    {!! Form::text('date_souscription', null, ['class' => 'form-control', 'required','id'=>'date_souscription']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_souscription').datepicker()
    </script>
@endpush

<!-- Reste Paye Field -->
<div class="form-group col-sm-4">
    {!! Form::label('reste_paye', 'Reste Paye:') !!}
    {!! Form::number('reste_paye', null, ['class' => 'form-control', 'readonly','id'=>'reste_paye']) !!}
</div>

<!-- Caissier Field 
<div class="form-group col-sm-6">
    {!! Form::label('caissier', 'Caissier:') !!}
    {!! Form::number('caissier', null, ['class' => 'form-control']) !!}
</div>-->