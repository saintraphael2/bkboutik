<!-- Produit Boutique Field -->
<div class="form-group col-sm-3">
    {!! Form::label('produit_boutique', 'Produit Boutique:') !!}
    {!! Form::hidden('produit_boutique', null, ['class' => 'form-control', 'required','id'=>'produit_boutique']) !!}
    {!! Form::text('produitBoutique', null, [
            'class' => 'form-control',
            'id' => 'produitBoutique',
            'required',
            'maxlength' => 255,
            'autocomplete' => 'off',
             $readonly
           
        ]) !!}
</div>

<!-- Date Stock Field -->
<div class="form-group col-sm-3">
    {!! Form::label('date_stock', 'Date Stock:') !!}
    {!! Form::text('date_stock', null, ['class' => 'form-control','id'=>'date_stock',$readonly]) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_stock').datepicker()
    </script>
@endpush

<!-- Quantite Field -->
<div class="form-group col-sm-3">
    {!! Form::label('quantite', 'Quantite:') !!}
    {!! Form::number('quantite', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Prix Field -->
<div class="form-group col-sm-3">
    {!! Form::label('prix', 'Prix:') !!}
    {!! Form::number('prix', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Magasinier Field 
<div class="form-group col-sm-3">
    {!! Form::label('magasinier', 'Magasinier:') !!}
    {!! Form::number('magasinier', null, ['class' => 'form-control']) !!}
</div>-->