<!-- Type Piece Field -->
<div class="form-group col-sm-3">
    {!! Form::label('type_piece_conducteur', 'Type Piece:') !!}
    <select class="select2 form-control" name="type_piece_conducteur" id="type_piece_conducteur" required=required>
        @foreach ($typepieces as $typepiece)
            <option value="{{ $typepiece->id }}">{{ $typepiece->libelle }}</option>
        @endforeach
    </select>
    <span class="text-danger font-size-xsmall error_type_piece_conducteur"></span>
</div>

<!-- Numero Piece Field -->
<div class="form-group col-sm-3">
    {!! Form::label('numero_piece_conducteur', 'Numero Piece:') !!}
    {!! Form::text('numero_piece_conducteur', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
    <span class="text-danger font-size-xsmall error_numero_piece_conducteur"></span>
</div>

<!-- Nom Field -->
<div class="form-group col-sm-3">
    {!! Form::label('nom_conducteur', 'Nom:') !!}
    {!! Form::text('nom_conducteur', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
    <span class="text-danger font-size-xsmall error_nom_conducteur"></span>
</div>

<!-- Prenom Field -->
<div class="form-group col-sm-3">
    {!! Form::label('prenom_conducteur', 'Prenom:') !!}
    {!! Form::text('prenom_conducteur', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
    <span class="text-danger font-size-xsmall error_prenom_conducteur"></span>
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-3">
    {!! Form::label('telephone_conducteur', 'Telephone:') !!}
    {!! Form::number('telephone_conducteur', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
    <span class="text-danger font-size-xsmall error_telephone_conducteur"></span>

</div>

<!-- Quartier Field -->
<div class="form-group col-sm-3">
    {!! Form::label('quartier_conducteur', 'Quartier:') !!}
    {!! Form::text('quartier_conducteur', null, ['class' => 'form-control', 'required', 'maxlength' => 200, 'maxlength' => 200]) !!}
    <span class="text-danger font-size-xsmall error_quartier_conducteur"></span>

</div>

<!-- Date Naissance Field -->
<div class="form-group col-sm-3">
    {!! Form::label('date_naissance_conducteur', 'Date Naissance (jj-mm-aaaa):') !!}
    {!! Form::text('date_naissance_conducteur', null, ['class' => 'form-control','id'=>'date_naissance_conducteur']) !!}
    <span class="text-danger font-size-xsmall error_date_naissance_conducteur"></span>
</div>

<!-- Photo Field -->
<!-- <div class="form-group col-sm-3">
    {!! Form::label('photo', 'Photo:') !!}
    {!! Form::text('photo', null, ['class' => 'form-control', 'maxlength' => 200, 'maxlength' => 200]) !!}
    <span class="text-danger font-size-xsmall error_photo_conducteur"></span>
</div> -->

<!-- Caution Field -->
<!-- <div class="form-group col-sm-3">
    {!! Form::label('caution', 'Caution:') !!}
    {!! Form::number('caution', null, ['class' => 'form-control', 'required']) !!}
</div> -->


@push('page_scripts')
    <script type="text/javascript">
        
        $('#date_naissance_conducteur').datepicker()
        /*function nextStep() {
            //event.preventDefault()
            console.log("catch the next action")
            nextStep()
        }*/
    </script>
@endpush