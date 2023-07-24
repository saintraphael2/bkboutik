@extends('layouts.app')

@push('page_css')
<style>
.arrieres>input:first-child+label::before {
    border: 1px solid #dc3545 !important;
}
</style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Ajout Versements
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <!-- progressbar -->
        <ul id="progressbar">
          <li id="progress-bar-step-1" class="active text-center">Immatriculation/Moto</li>
          <li id="progress-bar-step-2">Amortissement</li>
          <li id="progress-bar-step-3">Versement</li>
        </ul>

        <ul id="form-alert" class="" style="list-style-type: none">
            <!-- <li>The mise circulation field is required.</li> -->
        </ul>

        <div class="card">

            <!-- Form step 1 -->
            <div class="form-step">
                <div class="card-header">
                    Information sur le conducteur :
                </div>
                <div class="card-body">
                    <form id="form-step-1" action="#" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <!-- Immatriculation Field -->
                            <div class="form-group col-sm-3">
                                {!! Form::label('immatriculation', 'Immatriculation (TG-1234-AB):') !!}
                                {!! Form::text('immatriculation', null, ['class' => 'form-control basicAutoSelect', 'required', 'maxlength' => 100, 'maxlength' => 100, 'list' => "list-immatriculation"]) !!}
                                <datalist id="list-immatriculation">
                                @foreach ($motos as $moto)
                                        <option>{{ $moto->immatriculation }}</option>
                                        <!-- <option value="{{ $moto->contrats->first()->id ?? 0 }}">{{ $moto->immatriculation }}</option> -->
                                    @endforeach
                                </datalist>
                                <!-- <select class="form-control basicAutoSelect" name="immatriculation" id="immatriculation" required=required placeholder="type to search..." autocomplete="off">
                                    @foreach ($motos as $moto)
                                        <option value="{{ $moto->contrats->first()->id ?? 0 }}">{{ $moto->immatriculation }}</option>
                                    @endforeach
                                </select> -->
                                <span class="text-danger font-size-xsmall error_type_piece_conducteur"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="d-block text-right card-footer">
                    <div class="col-xl-12 col-12">
                        <a href="{{ route('versements.index') }}" class="btn btn-default pull-right cancel-step">
                            <i class="fa fa-circle-xmark"></i>
                            Annuler
                        </a>
                        <button class="btn btn-primary pull-right next-step form-step-action" onclick="validateStep(1)">
                            Suivant <i class="fa fa-circle-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form step 2 -->
            <div class="form-step">
                <div class="card-header">
                    Amortissement :
                </div>
                <div class="card-body">
                    @include('contrats.show_fields_second')
                    <br>
                
                    <form id="form-step-2" action="#" method="POST">
                        {{ csrf_field() }}
                        @include('tableau_armortissements.table')
                    </form>
                </div>
                <div class="d-block text-right card-footer">
                    <div class="col-xl-12 col-12">
                        <a href="{{ route('versements.index') }}" class="btn btn-default pull-right cancel-step">
                            <i class="fa fa-circle-xmark"></i>
                            Annuler
                        </a>

                        <button class="btn btn-primary pull-right prev-step form-step-action" onclick="prevStep()">
                            <i class="fa fa-circle-arrow-left"></i> 
                            Précédent
                        </button>
                        <button class="btn btn-primary pull-right next-step form-step-action" onclick="validateStep(2)">
                            Suivant <i class="fa fa-circle-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form step 3 -->
            <div class="form-step">
                <div class="card-header">
                    Bordereau de versement :
                </div>
                <div class="card-body">

                    <div class="facture">
                        <table>
                            <tr>
                                <td colspan="2">
                                    <h4>VERSEMENT N° VRSM-....... </h4>
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
                                <td class="border-right">Paiement du contrat N° {{ $contrat->numero }}</td>
                                <td class="text-right"><span class="montant_total"></span></td>
                            </tr>
                            <tr><td>&nbsp</td><td class="border-right"></td><td></td></tr>
                            
                            <tr>
                                <td colspan="2" class="text-right text-bold border-right">Montant payé</td>
                                <td class="text-bold text-right">
                                    <span class="montant_total"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right text-bold border-right">Montant restant à payer (Arriérés)</td>
                                <td class="text-bold text-right"><span class="montant_restant"></span></td>
                            </tr>
                        </table>

                        <p class="text-right" style="padding: 8px;">
                            <i style="font-size: small;">
                                Arrêter le présent versement à la somme de <span class="montant_total_lettre" style="font-weight: bold;">xxxx</span> francs CFA.
                            </i>
                            <br><br>
                            Fait à Lomé, le {{ date("j-m-Y") }}
                            <br><br><br>
                            {{ Auth::user()->name }}<br>
                            Le caissier
                        </p>
                    </div>
                </div>
                <div class="d-block text-right card-footer">
                    <div class="col-xl-12 col-12">
                        <a href="{{ route('versements.index') }}" class="btn btn-default pull-right cancel-step">
                            <i class="fa fa-circle-xmark"></i>
                            Annuler
                        </a>
                    
                        <button class="btn btn-primary pull-right prev-step form-step-action" onclick="prevStep()">
                            <i class="fa fa-circle-arrow-left"></i> 
                            Précédent
                        </button>
                        <button class="btn btn-primary pull-right last-step form-step-action" onclick="validateStep(3)">
                            Enregistrer <i class="fa fa-circle-check"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('page_scripts')
<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', e => {
        //$('#immatriculation').autocomplete()
        //$('form.arrieres').parent().css( "background-color", "red" )
    console.log("arrieres",$('form.arrieres'))
    }, false)

    

</script>
<script>
    //let conducteur = null
    let part = ""
    let contratId = 0
    let parameters = []
    let montantTotal = 0
    let montantRestant = 0
    let arrieres = 0
    let amortissementsArray = []

    //console.log("initialisation", @json($configStepsLimit), @json($currentStep), @json($contrat->motos->immatriculation))
    //showSuccess(null, "Opération réussie", null)
    //setImmatriculationAutocompletion()
    setContratId(@json($contrat->id))
    setArrieres(@json($arrieres))
    setImmatriculation(@json($contrat->motos->immatriculation))
    setCurrentStep(@json($currentStep))
    setRedirectUrl('{{route('versements.index')}}')
    configStepsLimit(@json($configStepsLimit))
    setProgression(currentStep-1)
    showStep(currentStep)
                        
    /* function setImmatriculationAutocompletion(){
        console.log("setImmatriculationAutocompletion", @json($motos))
        let availableValues = @json($motos);
        console.log(availableValues)
         $('#immatriculation').autocomplete({
            source: availableValues,
            autoFocus: true
        })
    } */

    $('#immatriculation').change(function(){
        console.log("on change immatriculation :")
        let availableValues = @json($motos);
        let index = availableValues.findIndex(x => x.immatriculation == $('#immatriculation').val())
        //console.log(immatriculation, availableValues, index, availableValues[index])
        if(availableValues[index]){
            setContratId(availableValues[index].mycontrat[0].id)
        }
        
    })
    
    /* function getContratByImmatriculation(){
        console.log("getContratByImmatriculation")
        let immatriculation = $('#immatriculation').val()
        let availableValues = @json($motos);
        let index = availableValues.findIndex(x => x.immatriculation == $('#immatriculation').val())
        console.log(immatriculation, availableValues, index, availableValues[index].mycontrat[0].id)
        if(availableValues[index]){
            setContratId(availableValues[index].mycontrat[0].id)
        }
    } */

    function setArrieres(value) {
        arrieres = value
    }

    function setContratId(value) {
        contratId = value
    }

    function setImmatriculation(value){
        let immatriculation = $('#immatriculation').val()
        if(!immatriculation){
            $('#immatriculation').val(value)
        }
    }

    function updateFactureMontants() {
        //let index = amortissementsArray.findIndex(x => x.id === data.id)
        //let ref = amortissementsArray.reduce((x,y) => Math.min(x.solde, y.solde))
        montantRestant = Math.min.apply(Math, amortissementsArray.map(function(row) { 
			return row.solde; 
        }));
        
        console.log("resultat de la recherche du tableau : ", montantRestant, amortissementsArray, arrieres)

        //montantRestant = @json($contrat->montant_total) - montantTotal
        $('.montant_total').html(numberFormatter.format(montantTotal))
        //$('.montant_restant').html(numberFormatter.format(montantRestant))
        $('.montant_restant').html(numberFormatter.format((arrieres > 0 ) ? arrieres : 0))
        $('.montant_total_lettre').html($.spellingNumber(montantTotal, spellingNumberOptions))
    }

    function validateAmortissement(id, montant, solde) {
        //let $this = $(this).find('input:checked')
        let data = {
            id : parseInt(id),
            montant : parseInt(montant),
            solde : parseInt(solde),
        }
        let index = amortissementsArray.findIndex(x => x.id === data.id)
        
        console.log("validateAmortissement", data, index)

        //if (index > -1){
        if (index < 0){
            console.log("Checkbox checked!")
            amortissementsArray.push(data)
            montantTotal += data.montant
            arrieres -= data.montant
            
        } else {
            console.log("Checkbox not checked!")
            console.log(index, amortissementsArray[index])
            amortissementsArray.splice(index, 1)
            montantTotal -= data.montant
            arrieres += data.montant

        }
        console.log("amortissements choisis : ", amortissementsArray, montantTotal)
    }



    function validateStep(step) {
        disabledLastStepButton()
        /*if(progression[step-1]){
            //return true
            nextStep()
        } else {*/
      
        console.log("catch the next action", currentStep)
        if(step == 1){

            //if(Number.isInteger(contratID)){
            if(Number.isInteger(contratId)){
                part = ""
                //contratId = parseInt($('#immatriculation').val())
                /*parameters['moto'] = {
                    ajax: 1,
                    control: 1,
                    contrat: $('#immatriculation').val(),
                }
                console.log(parameters)*/
                //let redirect_url = "{{ route('versements.create', ['contrat' => 8, 'configStepsLimit' => 3, 'currentStep' => 2]) }}"
                let redirect_url = "{{ route('versements.create') }}?contrat="+contratId+"&configStepsLimit="+last+"&currentStep="+(currentStep+1)
                console.log("redirect Url : ", redirect_url)
                progression[step-1] = true
                showSuccess(redirect_url, null, null)
            } else {
                let erreur = {
                    responseJSON : {message : "Immatriculation non-reconnue"}
                }
                showError(erreur, part)
            }
            
        } else if(step == 2) {
            part = ""
            if (amortissementsArray.length > 0) {
                showSuccess(null, null, null)
                updateFactureMontants()
                nextStep()
            } else {
                let erreur = {
                    responseJSON : {message : "Vous devez ajouter au moins une ligne d amortissement"}
                }
                showError(erreur, part)
            }
        } else {
            // last step
            part = ""
            //let contratId = $('#immatriculation').val()
            //console.log(amortissementsArray)
            parameters['versements'] = {
                ajax: 1,
                control: 0,
                contrat: contratId,
                montant: montantTotal,
                reste_payer: montantRestant,
                arriere: (arrieres > 0 ) ? arrieres : 0,
                date: new Date().toJSON().slice(0, 10),
                amortissements: amortissementsArray
            }
            console.log("Request parameters : ", parameters['versements'])
            //return true
            //enabledLastStepButton()
            $.ajax({
                type : "POST",
                url  : '{{route('versements.store')}}',
                data : parameters['versements'],
                dataType : 'json',
                headers : getHeaders(),
                success : function(data){
                    console.log("request response", data)
                    console.log("redirect url", "{{route('home')}}/listeVersement/"+data.contrat+"/"+data.id)
                    window.location.href = "{{route('home')}}/listeVersement/"+data.contrat+"/"+data.id;
                    /*progression[step-1] = true
                    showSuccess(null, null, null)
                    //nextStep()
                    store()*/
                    showSuccess(null, "Opération réussie", null)
                   // nextStep()
                },
                error : function(data) {
                    showError(data, part)
                    //return false
                }
            })

        }
    //}
}

/////////////////// TRASH //////////////////////////////////

//createDataTable("{{ route('users.index') }}")
  //createDataTable("{{ route('tableau_armortissements.index', ['contrat' => 1, 'ajax' => 1]) }}")

/*for (let elt of amortissementsArray) {
                console.log(elt)
                //somme = somme -(-elt.montant)
            }*/


    /*$('input[name ="commandRadio"]').change(function () {
            convertBudget($('#add_budget').val(), parseInt($('input[name ="commandRadio"]:checked').val()))
        })*/

  //$("input[@name='"+chkbox+"']").each( function() { 
  //$('.amortissement').click(function () {
    /*if ( $(this).val() ==  value )
            $(this).attr('checked', true);*/
    //$("[name='amortissement']").click(function () {
    //$("amortissement").click(function () {
    /* $('[id*="amortissement_"]').click(function () {
                var $this = $(this);

      console.log("click on checkbox 1")
      if($('#checkSecondCaution').is(':checked')){
        console.log("Checkbox checked!")
        //$('.secondCautionSection').removeClass("hidden")
      } else {
        console.log("Checkbox not checked!")
        //$('.secondCautionSection').addClass("hidden")
      }
      
  }) */

  /* function createDataTable(ajax_url){
    console.log("createDataTable", ajax_url)
    var table = $('.my_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: ajax_url,
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  } */


//return true
        //return $.ajax({
        /*$.ajax({
            type : "GET",
            url  : "{{ route('tableau_armortissements.index', ['contrat' => 8, 'ajax' => 1]) }}",
            //data : parameters['conducteur'],
            dataType : 'json',
            headers : getHeaders(),
            success : function(data){
                console.log("tableau a generate", data)
                progression[step-1] = true
                showSuccess(null, null, null)
                //return true
                nextStep()
            },
            error : function(data) {
                showError(data, part)
                //return false
            }
        })*/

</script>
@endpush