
<link href="{{asset('css/factures.css')}}" rel="stylesheet">
    
<div class="content px-3">

    <div class="card">
        <div class="card-body">
            <div class="facture">
                <table>
                    <tr>
                        <td colspan="4">
                            <h4>
                                VERSEMENT N° {{ $versement->numero_recu ?? "---" }}
                            </h4>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="border-unset" style="width: 600px;">
                        <h5>{{ $parametre->nom_societe }}</h5>
                            {{ $parametre->adresse_societe }} <br>
                            {{ $parametre->contact_societe }}
                        </td>
                        <td class="border-unset">
                            <h5>Client :</h5>
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
                        <td class="border-right">Paiement du contrat N° {{ $contrat->numero }}
                            (
                                @foreach($amortissement as $echeance)
                                {{$echeance->datprev}} - 
                                @endforeach
                            )
                        </td>
                        <td class="text-right"><span class="montant_total">{{ $versement->montant ?? "---" }}</span></td>
                    </tr>
                    <tr><td>&nbsp</td><td class="border-right"></td><td></td></tr>
                    
                    <tr>
                        <td colspan="2" class="text-right text-bold border-right">Montant payé</td>
                        <td class="text-bold text-right">
                            <span class="montant_total">{{ $versement->montant ?? "---" }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right text-bold border-right">Montant restant à payer</td>
                        <td class="text-bold text-right"><span class="montant_restant">{{ $versement->reste_payer ?? "---" }}</span></td>
                    </tr>
                </table>

                <p class="text-right" style="padding: 8px;">
                    <i style="font-size: small;">
                        Arrêter le présent versement à la somme de <span class="montant_total_lettre">xxxx</span> francs CFA.
                    </i>
                    <br><br>
                    Fait à Lomé, le {{ date("j-m-Y") }}
                    <br><br><br>
                    {{ Auth::user()->name }}<br>
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

<script>

    let montantTotal = 0
    let montantRestant = 0

    updateFactureMontants()

    function updateFactureMontants() {
        if(@json($versement)){
            montantTotal = @json($versement->montant);
            montantRestant = @json($versement->reste_payer);
        } else {
            //montantRestant = @json($contrat->montant_total) - montantTotal
        }
        
        $('.montant_total').html(numberFormatter.format(montantTotal));
        $('.montant_restant').html(numberFormatter.format(montantRestant));
        $('.montant_total_lettre').html($.spellingNumber(montantTotal, spellingNumberOptions));
    }
</script>