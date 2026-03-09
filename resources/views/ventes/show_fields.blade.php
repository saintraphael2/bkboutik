<!-- Code Field -->
<div class="col-sm-2">
    {!! Form::label('code', 'Code:') !!}
    <p>{{ $vente->code }}</p>
</div>

<!-- Ttc Field -->
<div class="col-sm-2">
    {!! Form::label('ttc', 'Ttc:') !!}
    <p>{{ $vente->ttc }}</p>
</div>

<!-- Caissier Field -->
<div class="col-sm-2">
    {!! Form::label('caissier', 'Caissier:') !!}
    <p>{{ $vente->caissiers->name }}</p>
</div>

<!-- Client Field -->
<div class="col-sm-2">
    {!! Form::label('client', 'Client:') !!}
    <p>{{ $vente->clients->nom_client }}</p>
</div>
<!-- Client Field -->
<div class="col-sm-2">
    {!! Form::label('created_at', 'Date Achat:') !!}
    <p>{{ $vente->created_at->format('d-m-Y') }}</p>
</div>

