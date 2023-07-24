<!-- Numero Field -->
<div class="form-group col-sm-2">
    {!! Form::label('numero', 'Numero:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100,'readonly']) !!}
</div>

<!-- Typecontrat Field -->
<div class="form-group col-sm-2">
<a href="{{ route('typeContrats.edit', $typecontrat) }}" class='btn btn-default btn-xs' target="_blank"> <i class="fa fa-edit"></i> </a>
    {!! Form::label('typecontrat', 'Type de Contrat') !!}
    {!! Form::select('typecontrat', $typecontrats, $typecontrat, ['class' => 'form-control']) !!}
</div>



<!-- Moto Field -->
<div class="form-group col-sm-2">
<a href="{{ route('motos.edit', $moto) }}" class='btn btn-default btn-xs' target="_blank"> <i class="fa fa-edit"></i> </a>
    {!! Form::label('moto', 'Moto:') !!}
    {!! Form::select('moto', $motos, $moto, ['class' => 'form-control']) !!}
</div>

<!-- Conducteur Field -->
<div class="form-group col-sm-2">
<a href="{{ route('conducteurs.edit', $conducteur) }}" class='btn btn-default btn-xs' target="_blank"><i class="fa fa-edit"></i></a>
    {!! Form::label('conducteur', 'Conducteur:') !!}
    {!! Form::select('conducteur', $conducteurs, $conducteur, ['class' => 'form-control']) !!}
</div>

<!-- Bdeposit Field -->
<div class="form-group col-sm-2">
    <div class="form-check">
        {!! Form::hidden('bdeposit', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('bdeposit', '1', null, ['class' => 'form-check-input','id'=>'bdeposit']) !!}
        {!! Form::label('bdeposit', 'Bdeposit', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Deposit Field -->
<div class="form-group col-sm-2">
    {!! Form::label('deposit', 'Deposit:') !!}
    {!! Form::number('deposit', null, ['class' => 'form-control', 'required','id'=>'deposit']) !!}
</div>
<!-- Deposit Field -->
<!-- <div class="form-group col-sm-2">
    {!! Form::label('deposit', 'Frais de dossier:') !!}
    <select class="select2 form-control deposit" name="deposit" id="deposit" disabled>
        <option value="0">Non défini</option>
        @for($i = 5000; $i <= 20000; ($i+=5000))
            
            <option value="{{ $i }}">{{ $i }}</option>
            
        @endfor
    </select>
    <span class="text-danger font-size-xsmall error_deposit"></span>
</div> -->

<!-- Montant Total Field -->
<div class="form-group col-sm-2">
    {!! Form::label('montant_total', 'Montant Total:') !!}
    {!! Form::number('montant_total', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Date Signature Field -->
<div class="form-group col-sm-2">
    {!! Form::label('date_signature', 'Date Signature:') !!}
    {!! Form::text('date_signature', $date_signature_fr, ['class' => 'form-control','id'=>'date_signature']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_signature').datepicker()
    </script>
@endpush

<!-- Date Debut Field -->
<div class="form-group col-sm-2">
    {!! Form::label('date_debut', 'Date de Début:') !!}
    {!! Form::text('date_debut', $date_debut_fr, ['class' => 'form-control','id'=>'date_debut']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_debut').datepicker()
    </script>
@endpush

<!-- Date Fin Field -->
<div class="form-group col-sm-2">
    {!! Form::label('date_fin', 'Date Fin Contrat:') !!}
    {!! Form::text('date_fin', $date_fin_fr, ['class' => 'form-control','id'=>'date_fin']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_fin').datepicker()
    </script>
@endpush

<!-- Datprm Field -->
<div class="form-group col-sm-2">
    {!! Form::label('datprm', 'Date du Premier Paiement:') !!}
    {!! Form::text('datprm', $datprm_fr, ['class' => 'form-control','id'=>'datprm']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#datprm').datepicker()
    </script>
@endpush
<!-- journalier Field -->
<div class="form-group col-sm-2">
    <div class="form-check">
        {!! Form::hidden('journalier', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('journalier', '1', null, ['class' => 'form-check-input','id'=>'journalier']) !!}
        {!! Form::label('journalier', 'journalier', ['class' => 'form-check-label']) !!}
    </div>
</div>
<!-- journalier Field -->
<!-- <div class="form-group col-sm-2" style="margin-top: 2rem;">
    <div class="icheck-success d-inline">
        <input type="checkbox" id="journalier" name="journalier" class="journalier" checked>
        <label for="journalier">
            Effectuer un paiement journalier
        </label>
    </div>
    <span class="text-danger font-size-xsmall error_journalier"></span>
</div> -->

<!-- Observation Field -->
<div class="form-group col-sm-1 col-lg-12">
    {!! Form::label('observation', 'Observation:') !!}
    {!! Form::textarea('observation', null, ['class' => 'form-control', 'required', 'maxlength' => 16777215, 'maxlength' => 16777215]) !!}
</div>

<script>
    
        $("#bdeposit").change(function() {
      
        if( $('#bdeposit').is(':checked') ){
           $('#deposit').val('20000');
        } else {
            $('#deposit').val('0');
        }
});

    
   
</script>