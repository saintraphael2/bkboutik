<!-- Boutique Field -->
<div class="col-sm-3">
    {!! Form::label('boutique', 'FACTURE:') !!}
    <p>{{ $livraison->boutiques->code }}</p>
</div>

<!-- Magasinier Field -->
<div class="col-sm-3">
    {!! Form::label('magasinier', 'DATE ACHAT:') !!}
    <p>{{ $livraison->boutiques->created_at->format('d-m-Y')  }}</p>
</div>

<!-- Boutique Field -->
<div class="col-sm-3">
    {!! Form::label('boutique', 'DATE LIVRAISON:') !!}
    <p>{{ $livraison->created_at->format('d-m-Y') }}</p>
</div>

<!-- Magasinier Field -->
<div class="col-sm-3">
    {!! Form::label('magasinier', 'Magasinier:') !!}
    <p>{{ $livraison->magasiniers->name }}</p>
</div>
