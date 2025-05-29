<!-- Type Produit Field -->
<div class="form-group col-sm-4">
    {!! Form::label('type_produit', 'Type Produit:') !!}
    {!! Form::select('type_produit', $typeProduits,null, ['class' => 'form-control']) !!}
</div>

<!-- Modele Field -->
<div class="form-group col-sm-4">
    {!! Form::label('modele', 'Modele:') !!}
    {!! Form::text('modele', null, ['class' => 'form-control', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>

<!-- Montant Field -->
<div class="form-group col-sm-4">
    {!! Form::label('montant', 'Montant:') !!}
    {!! Form::number('montant', null, ['class' => 'form-control']) !!}
</div>