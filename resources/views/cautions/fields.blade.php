<!-- Nom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nom', 'Nom:') !!}
    {!! Form::text('nom', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Prenom Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prenom', 'Prenom:') !!}
    {!! Form::text('prenom', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telephone', 'Telephone:') !!}
    {!! Form::text('telephone', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Quartier Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quartier', 'Quartier:') !!}
    {!! Form::text('quartier', null, ['class' => 'form-control', 'required', 'maxlength' => 200, 'maxlength' => 200]) !!}
</div>

<!-- Date Naissance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_naissance', 'Date Naissance:') !!}
    {!! Form::text('date_naissance', null, ['class' => 'form-control','id'=>'date_naissance']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_naissance').datepicker()
    </script>
@endpush

<!-- Type Piece Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type_piece', 'Type Piece:') !!}
    {!! Form::number('type_piece', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Numero Piece Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero_piece', 'Numero Piece:') !!}
    {!! Form::text('numero_piece', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>