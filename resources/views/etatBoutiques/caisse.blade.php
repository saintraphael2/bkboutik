
<link href="{{asset('css/factures.css')}}" rel="stylesheet">
    
<div class="content px-3">

    <div class="card">
        <div class="card-body">
            <div class="facture">
                <table>
                    <tr>
                        <td colspan="2">
                            <h4>
                                FACTURE N° {{ $facture->code}}
                            </h4>
                        </td>
                        <td colspan="2" style="text-align:right">
                            <img src="{{ asset('images/logo_bk_zed.png') }}" width="100px" heigth="50px">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="border-unset" style="width: 600px;">
                            <h5>{{ $parametre->nom_societe }}</h5>
                            {{ $parametre->adresse_societe }} <br>
                            {{ $parametre->contact_societe }}
                        </td>
                        <td class="border-unset">
                           
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="border-unset"></td>
                    </tr>
                </table>

                <table style="border-spacing: 0px;margin-top:10px;margin-bottom:10px; width:690px">
    <tr  >
        <td style="width:250px;border:none; border-right:none; border-bottom:none; border-bottom:none">Client</td>
        <td style="width:145px;border:none; border-right:none; border-left:none; border-bottom:none">Total à payer</td>
        <td style="width:145px;border:none; border-right:none; border-left:none; border-bottom:none">Montant Remis</td>
        <td style="width:100px;border:none; border-right:none; border-left:none; border-bottom:none"> Relicat</td>
       
    </tr>
    <tr>
        <td style="border:1px solid black; border-right:none">{{$facture->client }} </td>
        <td style="border:1px solid black; border-right:none">{{ strrev(wordwrap(strrev($facture->ttc), 3, ' ', true)) }}</td>
        <td style="border:1px solid black; border-right:none; text-align:right">{{ strrev(wordwrap(strrev($facture->montant_verse), 3, ' ', true)) }} </td>
        
        <td style="border:1px solid black ; text-align:right">{{strrev(wordwrap(strrev($facture->relicat), 3, ' ', true)) }}</td>
    </tr>
</table>


<div style="">Produits</div>
<table style="border-spacing: 0px;margin-top:10px;margin-bottom:10px; width:690px;border-collapse: collapse;">
    <tr  >
        <td style="width:10px;border:none; border-right:none; border-bottom:none; border-bottom:none">#</td>
        <td style="width:100px;border:none; border-right:none; border-left:none; border-bottom:none">Code</td>
        <td style="width:240px;border:none; border-right:none; border-left:none; border-bottom:none">Désignation</td>
        <td style="width:100px;border:none; border-right:none; border-left:none; border-bottom:none">Prix Unitaire</td>
        <td style="width:30px;border:none; border-left:none; border-bottom:none">Quantité</td>
        <td style="width:100px;border:none; border-left:none; border-bottom:none">TTC</td>
    </tr>
    
    <?php $pos=1; ?>
    @foreach($produits as $produit)
    <tr>
        <td style="border:1px solid black; border-right:none">{{$pos}}</td>
         <td style="border:1px solid black; border-right:none">{{$produit->produitBoutique->code}}</td>
        <td style="border:1px solid black; border-right:none">{{$produit->produitBoutique->libelle}}</td>
        
        <td style="border:1px solid black; border-right:none; text-align:right">{{strrev(wordwrap(strrev($produit->prix), 3, ' ', true))}}</td>
        <td style="border:1px solid black; text-align:right">{{$produit->quantite}}</td>
        <td style="border:1px solid black; text-align:right">{{ strrev(wordwrap(strrev($produit->ttc), 3, ' ', true)) }}</td>
        </tr>
        <?php $pos++; ?>
    @endforeach
        
    
</table>

                <p class="text-right" style="padding: 8px;">
                    <i style="font-size: small;">
                        Arrêter le présent versement à la somme de <span class="montant_total_lettre"> </span> francs CFA.
                    </i>
                    
                    <br><br>
                    Fait à {{$parametre->lieu}}, le {{ $facture->created_at->format("j-m-Y H:i")   }}
                    <br><br><br>
                    {{ $facture->caissiers->name }}<br>
                    Le caissier
                </p>
            </div>
        </div>
            
    </div>
</div>
<script src="/vendor/jquery/jquery.min.js" crossorigin="anonymous"></script>
<script src="{{asset('js/app.js')}}"></script>
<script type="text/javascript" src="{{ asset('vendor/UIjs/jquery-ui.min.js') }}"></script>
<script src="{{asset('js/request.js')}}"></script>

<script src="{{asset('js/numbers/jquerySpellingNumber.js')}}"></script>


