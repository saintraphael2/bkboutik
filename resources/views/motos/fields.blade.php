<!-- Immatriculation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('immatriculation', 'Immatriculation (TG-1234-AB):') !!}
    {!! Form::text('immatriculation', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Chassis Field -->
<div class="form-group col-sm-2">
    {!! Form::label('chassis', 'Chassis:') !!}
    {!! Form::text('chassis', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Mise Circulation Field -->
<div class="form-group col-sm-2">
    {!! Form::label('mise_circulation', 'Mise Circulation:') !!}
    {!! Form::text('mise_circulation', null, ['class' => 'form-control','id'=>'mise_circulation']) !!}
</div>


<!-- date_enregistrement Field -->
<div class="form-group col-sm-2">
    {!! Form::label('date_enregistrement', 'Date Enregistrement:') !!}
    {!! Form::text('date_enregistrement', null, ['class' => 'form-control','id'=>'date_enregistrement']) !!}
</div>


<!-- Disponible Field -->


@push('page_scripts')
    <script type="text/javascript">
        $('#mise_circulation').datepicker()
        $('#date_enregistrement').datepicker()

        $('#mise_circulation').change(function(){
            $('#date_enregistrement').val($('#mise_circulation').val())
        });

    </script>
@endpush