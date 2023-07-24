<!-- Type Piece Field -->
<div class="form-group col-sm-3">
    {!! Form::label('type_piece_caution_second', 'Type Piece:') !!}
    <select class="select2 form-control" name="type_piece_caution_second" id="type_piece_caution_second", required=required>
        @foreach ($typepieces as $typepiece)
            <option value="{{ $typepiece->id }}">{{ $typepiece->libelle }}</option>
        @endforeach
    </select>
    <span class="text-danger font-size-xsmall error_type_piece_caution_second"></span>
</div>

<!-- Numero Piece Field -->
<div class="form-group col-sm-3">
    {!! Form::label('numero_piece_caution_second', 'Numero Piece:') !!}
    {!! Form::text('numero_piece_caution_second', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
    <span class="text-danger font-size-xsmall error_numero_piece_caution_second"></span>
</div>


<!-- Nom Field -->
<div class="form-group col-sm-3">
    {!! Form::label('nom_caution_second', 'Nom:') !!}
    {!! Form::text('nom_caution_second', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
    <span class="text-danger font-size-xsmall error_nom_caution_second"></span>
</div>

<!-- Prenom Field -->
<div class="form-group col-sm-3">
    {!! Form::label('prenom_caution_second', 'Prenom:') !!}
    {!! Form::text('prenom_caution_second', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
    <span class="text-danger font-size-xsmall error_prenom_caution_second"></span>
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-3">
    {!! Form::label('telephone_caution_second', 'Telephone:') !!}
    {!! Form::number('telephone_caution_second', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
    <span class="text-danger font-size-xsmall error_telephone_caution_second"></span>
</div>

<!-- Quartier Field -->
<div class="form-group col-sm-3">
    {!! Form::label('quartier_caution_second', 'Quartier:') !!}
    {!! Form::text('quartier_caution_second', null, ['class' => 'form-control', 'required', 'maxlength' => 200, 'maxlength' => 200]) !!}
    <span class="text-danger font-size-xsmall error_quartier_caution_second"></span>
</div>

<!-- Date Naissance Field -->
<div class="form-group col-sm-3">
    {!! Form::label('date_naissance_caution_second', 'Date Naissance (jj-mm-aaaa) :') !!}
    {!! Form::text('date_naissance_caution_second', null, ['class' => 'form-control']) !!}
    <span class="text-danger font-size-xsmall error_date_naissance_caution_second"></span>
</div>


@push('page_scripts')
    <script type="text/javascript">
        $('#date_naissance_caution_second').datepicker()
    </script>
@endpush