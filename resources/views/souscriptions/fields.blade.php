<!-- Client Field -->
<div class="form-group col-sm-1">
    {!! Form::label('client', 'Client:') !!}
    {!! Form::hidden('client', null, ['class' => 'form-control','id' => 'client']) !!}
   
    {!! Form::text('clientContrat', null, [
            'class' => 'form-control',
            'id' => 'clientContrat',
            'required',
            'maxlength' => 255,
            'autocomplete' => 'off'
           
        ]) !!}
</div>
<div class="form-group col-sm-3">
    {!! Form::label('nom', 'Conducteur:') !!}
    {!! Form::text('nom', null, ['class' => 'form-control','id' => 'conducteur','readonly']) !!}
</div>
<!-- Produit Field -->
<div class="form-group col-sm-4">
    {!! Form::label('produit', 'Produit:') !!}
    {!! Form::hidden('produit', null, ['class' => 'form-control','id' => 'produit']) !!}
    {!! Form::text('modeleProduit', null, [
            'class' => 'form-control',
            'id' => 'modeleProduit',
            'required',
            'maxlength' => 255,
            'autocomplete' => 'off'
           
        ]) !!}
</div>

<!-- Date Souscription Field -->
<div class="form-group col-sm-4">
    {!! Form::label('date_souscription', 'Date Souscription:') !!}
    {!! Form::text('date_souscription', null, ['class' => 'form-control','id'=>'date_souscription']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_souscription').datepicker()
    </script>
@endpush



<!-- Identification Field -->
<div class="form-group col-sm-4">
    {!! Form::label('identification', 'Identification:') !!}
    {!! Form::text('identification', null, ['class' => 'form-control', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Autre Info Field -->
<div class="form-group col-sm-4">
    {!! Form::label('autre_info', 'Autre Info:') !!}
    {!! Form::text('autre_info', null, ['class' => 'form-control', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Montant Initial Field -->
<div class="form-group col-sm-4">
    {!! Form::label('montant_initial', 'Montant Initial:') !!}
    {!! Form::number('montant_initial', null, ['class' => 'form-control','id'=>'montant']) !!}
</div>

<!-- Solde Field 
<div class="form-group col-sm-4">
    {!! Form::label('solde', 'Solde:') !!}
    {!! Form::number('solde', null, ['class' => 'form-control']) !!}
</div>-->

<!-- Souscripteur Field 
<div class="form-group col-sm-4">
    {!! Form::label('souscripteur', 'Souscripteur:') !!}
    {!! Form::number('souscripteur', null, ['class' => 'form-control']) !!}
</div>-->