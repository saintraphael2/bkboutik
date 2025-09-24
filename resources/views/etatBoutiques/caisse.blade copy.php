<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reçu de caisse</title>
</head>
<body style="font-family:verdana; color:navy">
<div style="text-align:center; font-size:40px; margin-bottom:10px">BOUTIQUE BK ZED</div>
<div style="">
<table style="border-spacing: 0px;">
    <tr >
        <td style="width:100px;">Factutre N°</td>
        <td style="width:190px;">{{$facture->code}}</td>
        <td style="">Date</td>
        <td style="width:190px">{{$facture->created_at->format('d-m-Y')}}</td>
       
    </tr>
    
</table>
</div>

<table style="border-spacing: 0px;margin-top:10px;margin-bottom:10px; width:700px">
    <tr  >
        <td style="width:250px;border:none; border-right:none; border-bottom:none; border-bottom:none">Client</td>
        <td style="width:120px;border:none; border-right:none; border-left:none; border-bottom:none">Total à payer</td>
        <td style="width:120px;border:none; border-right:none; border-left:none; border-bottom:none">Montant Remis</td>
        <td style="width:120px;border:none; border-right:none; border-left:none; border-bottom:none"> Relicat</td>
       
    </tr>
    <tr>
        <td style="border:1px solid black; border-right:none">{{$facture->client }} </td>
        <td style="border:1px solid black; border-right:none">{{ strrev(wordwrap(strrev($facture->ttc), 3, ' ', true)) }}</td>
        <td style="border:1px solid black; border-right:none; text-align:right">{{ strrev(wordwrap(strrev($facture->montant_verse), 3, ' ', true)) }} </td>
        
        <td style="border:1px solid black ; text-align:right">{{strrev(wordwrap(strrev($facture->relicat), 3, ' ', true)) }}</td>
    </tr>
</table>


<div style="">Produits</div>
<table style="border-spacing: 0px;margin-top:10px;margin-bottom:10px; width:700px;border-collapse: collapse;">
    <tr  >
        <td style="width:10px;border:none; border-right:none; border-bottom:none; border-bottom:none">#</td>
        <td style="width:120px;border:none; border-right:none; border-left:none; border-bottom:none">Code</td>
        <td style="width:240px;border:none; border-right:none; border-left:none; border-bottom:none">Désignation</td>
        <td style="width:100px;border:none; border-right:none; border-left:none; border-bottom:none">Prix Unitaire</td>
        <td style="width:100px;border:none; border-left:none; border-bottom:none">Quantité</td>
        <td style="width:120px;border:none; border-left:none; border-bottom:none">TTC</td>
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

<div style="margin-top:30px; ">
    <table width=100%>
        <tr>
            <td style="width:50%; text-align:center; ">
                Client
            </td>
            <td style="width:50%; text-align:center; ">
            Caissier
            </td>
        </tr>
    </table>
</div>
</body>
</html>