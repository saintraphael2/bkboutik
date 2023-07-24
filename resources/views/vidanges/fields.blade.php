<!-- Moto Field -->

    
    {!! Form::hidden('moto', $id, ['class' => 'form-control', 'required']) !!}


<!-- Date Field -->
<div class="form-group col-sm-4">
    {!! Form::label('date', 'Effectuée le :') !!}
    {!! Form::text('date', $date_fr, ['class' => 'form-control','id'=>'date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date').datepicker(/*{
            @if(strlen($minYear)==4)
            minDate: new Date({{$minYear}}, {{$minMonth}} , {{$minDay}})
            @endif
        }*/);
        $('#date').change(function(){$('#prochaine').val(prochaineVidange ($('#date').val()))});
    </script>
@endpush

<!-- Kilometrage Field -->
<div class="form-group col-sm-4">
    {!! Form::label('kilometrage', 'Kilométrage :') !!}
    {!! Form::number('kilometrage', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Prochaine Field -->
<div class="form-group col-sm-4">
    {!! Form::label('prochaine', 'Prochaine Vidange estimée le :') !!}
    {!! Form::text('prochaine', $prochaine_fr, ['class' => 'form-control','id'=>'prochaine','readonly']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
       // $('#prochaine').datepicker()
       
    </script>
@endpush