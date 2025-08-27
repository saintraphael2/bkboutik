<!-- Livraison Field -->
<div class="form-group col-sm-6">
    {!! Form::label('livraison', 'Livraison:') !!}
    {!! Form::number('livraison', null, ['class' => 'form-control']) !!}
</div>

<!-- Produit Boutique Field -->
<div class="form-group col-sm-6">
    {!! Form::label('produit_boutique', 'Produit Boutique:') !!}
    {!! Form::number('produit_boutique', null, ['class' => 'form-control']) !!}
</div>

<!-- Detail Boutique Field -->
<div class="form-group col-sm-6">
    {!! Form::label('detail_boutique', 'Detail Boutique:') !!}
    {!! Form::number('detail_boutique', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Quantite Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantite', 'Quantite:') !!}
    {!! Form::number('quantite', null, ['class' => 'form-control', 'required']) !!}
</div>