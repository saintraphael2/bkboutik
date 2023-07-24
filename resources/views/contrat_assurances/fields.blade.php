{!! Form::hidden('moto', $id, ['class' => 'form-control', 'required']) !!}
<div class="form-group col-sm-6">
    {!! Form::label('compagnie_assurance', 'Compagnie Assurance:') !!}
    {!! Form::select('compagnie_assurance', $compagnie_assurances, $compagnie_assurance, ['class' => 'form-control']) !!}
</div>
<!-- Numero Contrat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('numero_contrat', 'Numero Contrat:') !!}
    {!! Form::text('numero_contrat', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>




<!-- Date Debut Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_debut', 'Date Debut:') !!}
    {!! Form::text('date_debut', $date_debut_fr, ['class' => 'form-control','id'=>'date_debut']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_debut').datepicker()
    </script>
@endpush

<!-- Date Fin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_fin', 'Date Fin:') !!}
    {!! Form::text('date_fin', $date_fin_fr, ['class' => 'form-control','id'=>'date_fin']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_fin').datepicker()
    </script>
@endpush