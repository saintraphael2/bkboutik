<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title>{{ $title }}</title>
 <style>
.page-break {
    page-break-before: always;
}

</style>
<link href="{{ asset('css/factures.css') }}" rel="stylesheet">
<script src="{{ asset('vendor/jquery/jquery.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/UIjs/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/numbers/jquerySpellingNumber.js') }}"></script>

</head>
<body style="">

<div class="facture">
                <table>
                    <tr>
                        <td colspan="2">
                            <h4>
                                VERSEMENT N° {{ $versement->numero_recu ?? "---" }}
                            </h4>
                        </td>
                        <td colspan="2" style="text-align:right">
                            <img src="{{ asset('images/logo_bk_zed.png') }}" width="100px" heigth="50px">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="border-unset" style="width: 600px;">
                            <h5>{{ config('app.name') }}</h5>
                            {{ config('app.address') }} <br>
                            {{ config('app.contact') }}
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
                                {{$echeance->datprev->format('d/m/Y')}} - 
                                @endforeach
                            )
						</td>
                        <td class="text-right"><span class="montant_total">{{ $versement->montant ?? "---" }}</span></td>
                    </tr>
                    <tr><td></td><td class="border-right"></td><td></td></tr>
                    
                    <tr>
                        <td colspan="2" class="text-right text-bold border-right">Montant payé</td>
                        <td class="text-bold text-right">
                            <span class="montant_total">{{ $versement->montant ?? "---" }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right text-bold border-right">Montant restant à payer (Arriérés)</td>
                        <td class="text-bold text-right"><span class="montant_restant" style="font-weight: bold;">{{ $versement->arriere ?? "---" }}</span></td>
                    </tr>
                </table>

                <p class="text-right" style="padding: 8px;">
                    <i style="font-size: small;">
                        Arrêter le présent versement à la somme de <span class="montant_total_lettre" id="montant_total_lettre">{{ $montant_total_lettre ?? "---" }}</span> francs CFA.
                    </i>
                    <br><br>
                    Fait à Lomé, le {{ date("j-m-Y H:i") }}
                    <br><br><br>
                    {{ Auth::user()->name }}<br>
                    Le caissier
                </p>
            </div>
        </div>
            
    </div>
</div>

<script>

    let montantTotal = 0
    let montantRestant = 0

	let numberFormatter = new Intl.NumberFormat(
		'fr', 
		{
			style: 'currency', 
			currency: 'xof'
			//minimumFractionDigits: 0, maximumFractionDigits: 0
		});

	let spellingNumberOptions = {
		lang: "fr",
		//wholesUnit:"dollars",
		//fractionUnit:"cents",
		//digitsLengthW2F: 2,
		//decimalSeperator:"and"

	}

    updateFactureMontants()

    function updateFactureMontants() {
		console.log("update facture montant",@json($versement))
        if(@json($versement)){
            montantTotal = @json($versement->montant);
            montantRestant = @json($versement->reste_payer);
            arrieres = @json($versement->arriere);
			
			console.log("resultat de la recherche du tableau : ", montantRestant, arrieres)

			//$('.montant_total').html(numberFormatter.format(montantTotal));
			//$('.montant_restant').html(numberFormatter.format(montantRestant))
			//$('.montant_restant').html(numberFormatter.format((arrieres > 0 ) ? arrieres : 0));
			//$('#montant_total_lettre').html($.spellingNumber(montantTotal, spellingNumberOptions));
		
        } else {
            //montantRestant = @json($contrat->montant_total) - montantTotal
        }
        
    }
	

</script>

</body>

</html>