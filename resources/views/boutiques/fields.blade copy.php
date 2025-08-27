<!-- Produit Boutique Field -->
<div class="form-group col-sm-6">
    {!! Form::label('produit_boutique', 'Produit Boutique:') !!}
    {!! Form::number('produit_boutique', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Stock Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock', 'Stock:') !!}
    {!! Form::number('stock', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Quantite Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantite', 'Quantite:') !!}
    {!! Form::number('quantite', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Prix Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prix', 'Prix:') !!}
    {!! Form::number('prix', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Ttc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ttc', 'Ttc:') !!}
    {!! Form::number('ttc', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Caissier Field -->
<div class="form-group col-sm-6">
    {!! Form::label('caissier', 'Caissier:') !!}
    {!! Form::number('caissier', null, ['class' => 'form-control', 'required']) !!}
</div>

<fieldset class="row form-group col-sm-12">
<legend>Prestations</legend>
<div class="form-group col-sm-6">
    {!! Form::label('prestation', 'Prestation:') !!}
    {!! Form::select('prestation', null, null, ['class' => 'form-control','id'=>'prestation']) !!}
</div>
<div class="form-group col-sm-2">
    {!! Form::label('quantite', 'Quantité:') !!}
    {!! Form::number('quantite',  null, ['class' => 'form-control','id'=>'quantite','min'=>'1']) !!}
</div>
<div class="form-group col-sm-2">

                {!! Form::button('Ajouter', ['class' => 'btn myButton','id'=>"adPrestation"]) !!}
                
            </div>

           
<div class="table-responsive">
    <table class="table" id="prestations">
        <thead>
        <tr>
            <th>Prestation</th>
        <th>Quantité</th>
        <th>Montant</th>
        <th>% Assurance</th>
        <th>Montant Facturé</th>
        <th>Montant A payer</th>
        <th>Montant Après Remise</th>
        <th>Action</th>
        </tr>
        </thead>
        
        <tfoot>
    <tr>
      <td colspan="4">Total</td>
      <td ></td>
      <td ></td>
      <td id="total"> </td>
      <td id="totalRemise"></td>
      <td></td>
    </tr>
  </tfoot>
    </table>
</div>
</fieldset>