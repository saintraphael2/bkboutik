<link href="{{ public_path('css/factures.css') }}" rel="stylesheet">
    
<div class="content px-3">

    <div class="card">
        <div class="card-body">
            <div class="facture">
                <table>
                    <tr>
                        <td colspan="2" style="text-align:left">
                            <h4>
                              DEPOT N° {{ $depot->code}}
                            </h4>
                        </td>
                        <td colspan="2" style="text-align:right">
                            <img src="{{ public_path('images/logo_bk_zed.png') }}" width="100">
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
        <td style="width:145px;border:none; border-right:none; border-left:none; border-bottom:none">Télephone</td>
         <td style="width:145px;border:none; border-right:none; border-left:none; border-bottom:none">Solde</td>
    </tr>
     <tr>
        <td style="border:1px solid black; border-right:none">{{ $depot->clients->nom_client }} </td>
        <td style="border:1px solid black; border-right:none">{{ $depot->clients->telephone }}</td>
       <td style="border:1px solid black; border-right:none">{{ strrev(wordwrap(strrev( $depot->clients->solde), 3, ' ', true)) }}</td>
    </tr>
</table>


<div style="">Versement</div>
<table style="border-spacing: 0px;margin-top:10px;margin-bottom:10px; width:690px;border-collapse: collapse;">
    <tr  >
        <td style="width:10px;border:none; border-right:none; border-bottom:none; border-bottom:none">#</td>
        <td style="width:100px;border:none; border-right:none; border-left:none; border-bottom:none">Code</td>
        
        <td style="width:100px;border:none; border-left:none; border-bottom:none">Montant</td>
    </tr>
    
    <?php $pos=1; ?>
   
    <tr>
        <td style="border:1px solid black; border-right:none">{{$pos}}</td>
         <td style="border:1px solid black; border-right:none">{{$depot->code}}</td>
       
        <td style="border:1px solid black; text-align:right">{{ strrev(wordwrap(strrev($depot->montant), 3, ' ', true)) }}</td>
        </tr>
       
        
    
</table>

                <p class="text-right" style="padding: 8px;">
                    <i style="font-size: small;">
                        Arrêter le présent versement à la somme de <span class="montant_total_lettre"> </span> francs CFA.
                    </i>
                    
                    <br><br>
                    Fait à {{$parametre->lieu}}, le {{ $depot->created_at->format("j-m-Y H:i")   }}
                    <br><br><br>
                    {{ $depot->caissiers->name }}<br>
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


