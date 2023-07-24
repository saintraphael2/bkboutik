<!-- Type Piece Field -->
<div class="form-group col-sm-3">
    {!! Form::label('type_piece_caution', 'Type Piece:') !!}
    <select class="select2 form-control" name="type_piece_caution" id="type_piece_caution", required=required>
        @foreach ($typepieces as $typepiece)
            <option value="{{ $typepiece->id }}">{{ $typepiece->libelle }}</option>
        @endforeach
    </select>
    <span class="text-danger font-size-xsmall error_type_piece_caution"></span>
</div>

<!-- Numero Piece Field -->
<div class="form-group col-sm-3">
    {!! Form::label('numero_piece_caution', 'Numero Piece:') !!}
    {!! Form::text('numero_piece_caution', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
    <span class="text-danger font-size-xsmall error_numero_piece_caution"></span>
</div>


<!-- Nom Field -->
<div class="form-group col-sm-3">
    {!! Form::label('nom_caution', 'Nom:') !!}
    {!! Form::text('nom_caution', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
    <span class="text-danger font-size-xsmall error_nom_caution"></span>
</div>

<!-- Prenom Field -->
<div class="form-group col-sm-3">
    {!! Form::label('prenom_caution', 'Prenom:') !!}
    {!! Form::text('prenom_caution', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
    <span class="text-danger font-size-xsmall error_prenom_caution"></span>
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-3">
    {!! Form::label('telephone_caution', 'Telephone:') !!}
    {!! Form::number('telephone_caution', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
    <span class="text-danger font-size-xsmall error_telephone_caution"></span>
</div>

<!-- Quartier Field -->
<div class="form-group col-sm-3">
    {!! Form::label('quartier_caution', 'Quartier:') !!}
    {!! Form::text('quartier_caution', null, ['class' => 'form-control', 'required', 'maxlength' => 200, 'maxlength' => 200]) !!}
    <span class="text-danger font-size-xsmall error_quartier_caution"></span>
</div>

<!-- Date Naissance Field -->
<div class="form-group col-sm-3">
    {!! Form::label('date_naissance_caution', 'Date Naissance:') !!}
    {!! Form::text('date_naissance_caution', null, ['class' => 'form-control']) !!}
    <span class="text-danger font-size-xsmall error_date_naissance_caution"></span>
</div>


@push('page_scripts')
    <script type="text/javascript">
        $('#date_naissance_caution').datepicker()
    </script>
@endpush