<!-- Boutique Field -->
<div class="form-group col-sm-6">
    {!! Form::label('boutique', 'Boutique:') !!}
    {!! Form::number('boutique', null, ['class' => 'form-control']) !!}
</div>

<!-- Magasinier Field -->
<div class="form-group col-sm-6">
    {!! Form::label('magasinier', 'Magasinier:') !!}
    {!! Form::number('magasinier', null, ['class' => 'form-control', 'required']) !!}
</div>