
<div >
    <div  class="row">
        <img src='{{asset($conducteur->photo)}}' class='file-preview-image' alt='Desert' title='Desert'>
    
    </div>

</div><br>
<div class="row">
<!-- Nom Field -->
<div class="col-sm-3">
    {!! Form::label('nom', 'Nom:') !!}
    <p>{{ $conducteur->nom }}</p>
</div>

<!-- Prenom Field -->
<div class="col-sm-3">
    {!! Form::label('prenom', 'Prenom:') !!}
    <p>{{ $conducteur->prenom }}</p>
</div>

<!-- Telephone Field -->
<div class="col-sm-3">
    {!! Form::label('telephone', 'Telephone:') !!}
    <p>{{ $conducteur->telephone }}</p>
</div>

<!-- Quartier Field -->
<div class="col-sm-3">
    {!! Form::label('quartier', 'Quartier:') !!}
    <p>{{ $conducteur->quartier }}</p>
</div>

<!-- Date Naissance Field -->
<div class="col-sm-3">
    {!! Form::label('date_naissance', 'Date Naissance:') !!}
    <p>{{ date("d-m-Y", strtotime($conducteur->date_naissance))  }}</p>
</div>

<!-- Photo Field -->



<!-- Type Piece Field -->
<div class="col-sm-3">
    {!! Form::label('type_piece', 'Type Piece:') !!}
    <p>{{ $conducteur->typePiece["libelle"] }}</p>
</div>

<!-- Numero Piece Field -->
<div class="col-sm-3">
    {!! Form::label('numero_piece', 'Numero Piece:') !!}
    <p>{{ $conducteur->numero_piece }}</p>
</div>



</div>
<fieldset>
    <legend style="width:100%">Caution (s)</legend>
    <div class="row">
@foreach($conducteur->cautionsConduteurs as $cautions)
    <div class="col-sm-3">
        {!! Form::label('nom', 'Nom:') !!}
        <p>{{ $cautions->cautions->nom }}</p>
    </div>

    <!-- Prenom Field -->
    <div class="col-sm-3">
        {!! Form::label('prenom', 'Prenom:') !!}
        <p>{{ $cautions->cautions->prenom }}</p>
    </div>

    <!-- Telephone Field -->
    <div class="col-sm-3">
        {!! Form::label('telephone', 'Telephone:') !!}
        <p>{{ $cautions->cautions->telephone }}</p>
    </div>

    <!-- Quartier Field -->
    <div class="col-sm-3">
        {!! Form::label('quartier', 'Quartier:') !!}
        <p>{{ $cautions->cautions->quartier }}</p>
    </div>

    <!-- Date Naissance Field -->
    <div class="col-sm-3">
        {!! Form::label('date_naissance', 'Date Naissance:') !!}
        <p>{{ date("d-m-Y", strtotime($cautions->cautions->date_naissance))  }}</p>
    </div>

    <!-- Type Piece Field -->
    <div class="col-sm-3">
        {!! Form::label('type_piece', 'Type Piece:') !!}
        <p>{{ $cautions->cautions->typePiece["libelle"]  }}</p>
    </div>

    <!-- Numero Piece Field -->
    <div class="col-sm-3">
        {!! Form::label('numero_piece', 'Numero Piece:') !!}
        <p>{{ $cautions->cautions->numero_piece }}</p>
    </div>
@endforeach
</div>
</fieldset>