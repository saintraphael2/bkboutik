<!-- Boutique Field -->
<div class="col-sm-3">
    {!! Form::label('boutique', 'FACTURE:') !!}
    <p>{{ ($livraison->boutique!=null)?$livraison->boutiques->code:$livraison->ventes->code }}</p>
</div>

<!-- Magasinier Field -->
<div class="col-sm-3">
    {!! Form::label('magasinier', 'DATE ACHAT:') !!}
    <p>{{ ($livraison->boutique!=null)?$livraison->boutiques->created_at->format('d-m-Y'):$livraison->ventes->created_at->format('d-m-Y')  }}</p>
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
