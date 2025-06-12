
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
                            <h5>Client : {{ $contrat->motos['immatriculation']}}</h5>
                            {{ $contrat->conducteurs['nom']}} {{$contrat->conducteurs['prenom'] }} <br>
                            Addresse : {{ $contrat->conducteurs['quartier']}} <br>
                            Tel : {{ $contrat->conducteurs['telephone']}} <br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="border-unset"></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <th>#</th>
                        <th class="border-right">Désignation</th>
                        <th class="text-right">Montant</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td class="border-right">Paiement du {{$facture->souscriptions->produits->typeProduit->libelle}}
                        {{$facture->souscriptions->produits->modele}} ({{ $facture->souscriptions->montant_initial }})
                        </td>
                        <td class="text-right"><span class="montant_total">{{ $facture->montant_a_payer }}</span></td>
                    </tr>
                    <tr><td>Prochaine date de payement {{$facture->souscriptions->date_souscription->format('d-m-Y')}}</td><td class="border-right"></td><td></td></tr>
                    
                    <tr>
                        <td colspan="2" class="text-right text-bold border-right">Montant payé</td>
                        <td class="text-bold text-right">
                            <span class="montant_total">{{ $facture->montant_paye }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right text-bold border-right">Montant restant à payer</td>
                        <td class="text-bold text-right"><span class="montant_restant">{{ $facture->souscriptions->solde }}</span></td>
                    </tr>
                </table>

                <p class="text-right" style="padding: 8px;">
                    <i style="font-size: small;">
                        Arrêter le présent versement à la somme de <span class="montant_total_lettre">{{ $lettrage }}</span> francs CFA.
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

