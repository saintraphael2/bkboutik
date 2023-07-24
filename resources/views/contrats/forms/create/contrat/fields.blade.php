<!-- Typecontrat Field -->
<div class="form-group col-sm-2">
    {!! Form::label('typecontrat', 'Type contrat:') !!}
    <select class="select2 form-control" name="typecontrat" id="typecontrat", required=required>
        @foreach ($typecontrats as $typecontrat)
            <option value="{{ $typecontrat->id }}">{{ $typecontrat->libelle }}</option>
        @endforeach
    </select>
    <span class="text-danger font-size-xsmall error_typecontrat"></span>
</div>

<!-- Numero Field -->
<!-- <div class="form-group col-sm-4">
    {!! Form::label('numero', 'Numero:') !!}
    {!! Form::text('numero', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
    <span class="text-danger font-size-xsmall error_numero"></span>
</div> -->

<!-- Moto Field -->
<div class="form-group col-sm-2">
    {!! Form::label('moto', 'Moto:') !!}
    <select class="select2 form-control" name="moto" id="moto", required=required>
        @foreach ($motos as $moto)
            <option value="{{ $moto->id }}">{{ $moto->immatriculation }}</option>
        @endforeach
    </select>
    <span class="text-danger font-size-xsmall error_moto"></span>
</div>

<!-- Conducteur Field -->
<!-- <div class="form-group col-sm-3">
    {!! Form::label('conducteur', 'Conducteur:') !!}
    {!! Form::number('conducteur', null, ['class' => 'form-control', 'required']) !!}
</div> -->

<!-- journalier Field -->
<div class="form-group col-sm-2" style="margin-top: 2rem;">
    <div class="icheck-success d-inline">
        <input type="checkbox" id="journalier" name="journalier" class="journalier" checked>
        <label for="journalier">
            Effectuer un paiement journalier
        </label>
    </div>
    <span class="text-danger font-size-xsmall error_journalier"></span>
</div>


<!-- Bdeposit Field -->
<div class="form-group col-sm-2" style="margin-top: 2rem;">
    <!-- <div class="form-check">
        {!! Form::hidden('bdeposit', 0, ['class' => 'bdeposit form-check-input']) !!}
        {!! Form::checkbox('bdeposit', '1', null, ['class' => 'bdeposit form-check-input']) !!}
        {!! Form::label('bdeposit', 'Confirmer les frais de dossier ', ['class' => 'form-check-label']) !!}
    </div> -->
    <div class="icheck-success d-inline">
        <input type="checkbox" id="bdeposit" name="bdeposit" class="bdeposit">
        <label for="bdeposit">
            Confirmer les frais de dossier (Optionnel)
        </label>
    </div>
    <span class="text-danger font-size-xsmall error_bdeposit"></span>
</div>


<!-- Deposit Field -->
<div class="form-group col-sm-2">
    {!! Form::label('deposit', 'Frais de dossier:') !!}
    <!-- {!! Form::number('deposit', null, ['class' => 'form-control', 'required', 'disabled']) !!} -->
    <select class="select2 form-control deposit" name="deposit" id="deposit" disabled>
        <option value="0">Non défini</option>
        @for($i = 5000; $i <= 20000; ($i+=5000))
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
    <span class="text-danger font-size-xsmall error_deposit"></span>
</div>

<!-- Montant Field -->
<!-- <div class="form-group col-sm-3">
    {!! Form::label('montant', 'Montant :') !!}
    {!! Form::number('montant', null, ['class' => 'form-control', 'required']) !!}
    <span class="text-danger font-size-xsmall error_montant"></span>
</div> -->

<!-- Montant Total Field -->
<div class="form-group col-sm-2">
    {!! Form::label('montant_total', 'Montant Total:') !!}
    {!! Form::number('montant_total', null, ['class' => 'form-control', 'required']) !!}
    <span class="text-danger font-size-xsmall error_montant_total"></span>
</div>

<!-- <div class="form-group col-sm-4"></div> -->

<!-- Date Signature Field -->
<div class="form-group col-sm-3">
    {!! Form::label('date_signature', 'Date Signature (jj-mm-aaaa) :') !!}
    {!! Form::text('date_signature', null, ['class' => 'form-control','id'=>'date_signature']) !!}
    <span class="text-danger font-size-xsmall error_date_signature"></span>
</div>


<!-- Date Debut Field -->
<div class="form-group col-sm-3">
    {!! Form::label('date_debut', 'Date Debut (jj-mm-aaaa) :') !!}
    {!! Form::text('date_debut', null, ['class' => 'form-control','id'=>'date_debut']) !!}
    <span class="text-danger font-size-xsmall error_date_debut"></span>
</div>


<!-- Date Fin Field -->
<div class="form-group col-sm-3">
    {!! Form::label('date_fin', 'Date Fin (jj-mm-aaaa) :') !!}
    {!! Form::text('date_fin', null, ['class' => 'form-control','id'=>'date_fin']) !!}
    <span class="text-danger font-size-xsmall error_date_fin"></span>
</div>


<!-- Datprm Field -->
<div class="form-group col-sm-3">
    {!! Form::label('datprm', 'Date Premier Paiement (jj-mm-aaaa) : ') !!}
    {!! Form::text('datprm', null, ['class' => 'form-control','id'=>'datprm']) !!}
    <span class="text-danger font-size-xsmall error_datprm"></span>
</div>

<!-- Observation Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('observation', 'Observation:') !!}
    {!! Form::textarea('observation', null, ['class' => 'form-control', 'required', 'maxlength' => 16777215, 'rows' => 3]) !!}
    <span class="text-danger font-size-xsmall error_observation"></span>
</div>


@push('page_scripts')
    <script type="text/javascript">
        let deposit_default_value = 20000

        function updateMontantTotal() {
            let montant = parseInt($('#montant').val()) ? parseInt($('#montant').val()) : 0
            let deposit = parseInt($('#deposit').val()) ? parseInt($('#deposit').val()) : 0
            let total = montant + deposit
            $('#montant_total').val((total) ? total : null)
        }

        //................................................
            
        $('#date_signature').datepicker()
        $('#date_debut').datepicker()
        $('#date_fin').datepicker()
        $('#datprm').datepicker()

        $('#date_signature').change(function(){
            $('#date_debut').val($('#date_signature').val())
            $('#date_fin').val(prochaineDate($('#date_signature').val(), 549))
            $('#datprm').val($('#date_signature').val())
        })

        $('#bdeposit').click(function () {
            //console.log("click on checkbox",$('#bdeposit').is(':checked'),$('#bdeposit').val())
            if($('#bdeposit').is(':checked')){
                console.log("Checkbox checked!")
                $('#deposit').attr('disabled', false)
                //$('#deposit').val(deposit_default_value)
                //$('.deposit option[value=' + deposit_default_value + ']').attr('selected',true)
                $('.deposit option[value=' + deposit_default_value + ']').attr("selected","selected")
            } else {
                console.log("Checkbox not checked!")
                //let value = $('#deposit').val()
                $('#deposit').val(0)
                //$('.deposit option[value=' + $('#deposit').val() + ']').removeAttr("selected")
                //$('.deposit option[value=' + $('#deposit').val() + ']').remove()
                //$('.deposit option[value=' + value + ']').attr('selected',false)
                //$('.deposit option[value=0]').attr('selected',true)
                $('#deposit option').removeAttr("selected")
                $('#deposit').attr('disabled', true)
            }
            console.log("deposit value is : ", $('#deposit').val())
            
        })

        /*$('#deposit').change(function(){
            let value = parseInt($('#deposit').val())
            console.log("on change deposit :", value)
            $('#deposit option').removeAttr("selected")
            $('.deposit option[value=' + value + ']').attr("selected","selected")
        })
         $('.bdeposit').click(function () {
            //console.log("click on checkbox")
            value = parseInt($('input[name ="bdeposit"]:checked').val())
            if(value){
                //console.log("coché")
                $('#deposit').val(deposit_default_value)
            } else {
                //console.log("décoché")
                $('#deposit').val(null)
            }
            //updateMontantTotal()
        }) */

        /*$('#montant').change(function () {
            updateMontantTotal()
        })
        
        $('#deposit').change(function () {
            updateMontantTotal()
        })*/

        function prochaineDate (dateCourrante, days){
            tdateV=dateCourrante.split('-');
            if(days == null ){
                days = 549;
            }
            var lastDay =new Date(tdateV[2]+'-'+tdateV[1]+'-'+tdateV[0]) ;
            lastDay.setDate(lastDay.getDate() + days);

            if(lastDay.getDay()==0){
                lastDay.setDate(lastDay.getDate() + 1);
            }
                
            console.log(lastDay.getDate());

            var dd = lastDay.getDate();
            var mm = lastDay.getMonth()+1; //As January is 0.
            var yyyy = lastDay.getFullYear();
            if(dd<10) dd='0'+dd;
            if(mm<10) mm='0'+mm;
            return (dd+'-'+mm+'-'+yyyy);
        };
    </script>
@endpush