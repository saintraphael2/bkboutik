<!-- Datprev Field -->
<div class="form-group col-sm-6">
    {!! Form::label('datprev', 'Datprev:') !!}
    {!! Form::text('datprev', null, ['class' => 'form-control','id'=>'datprev']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#datprev').datepicker()
    </script>
@endpush

<!-- Montant Field -->
<div class="form-group col-sm-6">
    {!! Form::label('montant', 'Montant:') !!}
    {!! Form::number('montant', null, ['class' => 'form-control']) !!}
</div>

<!-- Cummul Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cummul', 'Cummul:') !!}
    {!! Form::number('cummul', null, ['class' => 'form-control']) !!}
</div>

<!-- Solde Field -->
<div class="form-group col-sm-6">
    {!! Form::label('solde', 'Solde:') !!}
    {!! Form::number('solde', null, ['class' => 'form-control']) !!}
</div>

<!-- Contrat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contrat', 'Contrat:') !!}
    {!! Form::number('contrat', null, ['class' => 'form-control']) !!}
</div>

<!-- Etat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('etat', 'Etat:') !!}
    {!! Form::text('etat', null, ['class' => 'form-control']) !!}
</div>

<!-- Datreglement Field -->
<div class="form-group col-sm-6">
    {!! Form::label('datreglement', 'Datreglement:') !!}
    {!! Form::text('datreglement', null, ['class' => 'form-control','id'=>'datreglement']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#datreglement').datepicker()
    </script>
@endpush

<!-- Versement Field -->
<div class="form-group col-sm-6">
    {!! Form::label('versement', 'Versement:') !!}
    {!! Form::number('versement', null, ['class' => 'form-control']) !!}
</div>