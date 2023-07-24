<!-- Numero Contrat Field -->
<div class="col-sm-12">
    {!! Form::label('numero_contrat', 'Numero Contrat:') !!}
    <p>{{ $contratAssurance->numero_contrat }}</p>
</div>

<!-- Compagnie Assurance Field -->
<div class="col-sm-12">
    {!! Form::label('compagnie_assurance', 'Compagnie Assurance:') !!}
    <p>{{ $contratAssurance->compagnie_assurance }}</p>
</div>

<!-- Moto Field -->
<div class="col-sm-12">
    {!! Form::label('moto', 'Moto:') !!}
    <p>{{ $contratAssurance->moto }}</p>
</div>

<!-- Date Debut Field -->
<div class="col-sm-12">
    {!! Form::label('date_debut', 'Date Debut:') !!}
    <p>{{ $contratAssurance->date_debut }}</p>
</div>

<!-- Date Fin Field -->
<div class="col-sm-12">
    {!! Form::label('date_fin', 'Date Fin:') !!}
    <p>{{ $contratAssurance->date_fin }}</p>
</div>

