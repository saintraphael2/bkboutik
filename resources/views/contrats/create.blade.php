@extends('layouts.app')

@push('page_css')
<!--Your CSS Assets or Code Goes Here -->
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Ajout Contrats
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <!-- progressbar -->
        <ul id="progressbar">
          <li id="progress-bar-step-1" class="active text-center">Conducteur</li>
          <li id="progress-bar-step-2">Caution</li>
          <li id="progress-bar-step-3">Contrat</li>
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
              <form id="storeConducteur" action="#" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    @include('contrats.forms.create.conducteur.fields')
                </div>
              </form>
            </div>
            <div class="d-block text-right card-footer">
              <div class="col-xl-12 col-12">
                <a href="{{ route('contrats.index') }}" class="btn btn-default pull-right cancel-step">
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
              Information sur la caution :
            </div>
            <div class="card-body">
              <form id="storeCaution" action="#" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    @include('contrats.forms.create.caution.fields')
                </div>
                <br>
                <div class="icheck-success d-inline">
                    <input type="checkbox" id="checkSecondCaution" name="checkSecondCaution">
                    <label for="checkSecondCaution">
                      Saisir une seconde caution (Optionnel)
                    </label>
                </div>
                <hr class="dashed-line secondCautionSection hidden">
                <!-- 2nd caution -->
                <br><br>
                <div class="row secondCautionSection hidden">
                    @include('contrats.forms.create.caution.fields_second')
                </div>
              </form>
            </div>
            <div class="d-block text-right card-footer">
              <div class="col-xl-12 col-12">
                <a href="{{ route('contrats.index') }}" class="btn btn-default pull-right cancel-step">
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
          <div class="form-step hide">
            <div class="card-header">
              Information sur le contrat :
            </div>
            <div class="card-body">
              <form id="storeContrat" action="#" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    @include('contrats.forms.create.contrat.fields')
                </div>
              </form>
            </div>
            <div class="d-block text-right card-footer">
              <div class="col-xl-12 col-12">
                <a href="{{ route('contrats.index') }}" class="btn btn-default pull-right cancel-step">
                  <i class="fa fa-circle-xmark"></i>
                  Annuler
                </a>
              
                <button class="btn btn-primary pull-right prev-step form-step-action last-prev-step" onclick="prevStep()">
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
<script>
  let part = null
  let parameters = []
  let conducteur = null

    
  setConducteur(@json($conducteur))
  setRedirectUrl('{{route('contrats.index')}}')
  configStepsLimit(3)
  initializeTheView()
  
  //$('button[type=submit]').attr('disabled', true)

  $('#checkSecondCaution').click(function () {
      //console.log("click on checkbox")
      if($('#checkSecondCaution').is(':checked')){
        //console.log("Checkbox checked!")
        $('.secondCautionSection').removeClass("hidden")
      } else {
        //console.log("Checkbox not checked!")
        $('.secondCautionSection').addClass("hidden")
      }
      
  })

  function setConducteur(valeur){
    conducteur = valeur
  }

  function initializeTheView(){
    console.log("initializeTheView", conducteur)
    //showSuccess(null, "Opération réussie", null)
    

    if(conducteur){
      setCurrentStep(3)
      //setProgression(3)
      showStep(3)

      $('.last-prev-step').addClass("hidden")
      console.log("progression is : ", progression)
      // initialisation des champs
      /*$('#type_piece_conducteur').val(conducteur.nom),
      $('#numero_piece_conducteur').val(conducteur.nom),
      $('#nom_conducteur').val(conducteur.nom),
      $('#prenom_conducteur').val(conducteur.nom),
      $('#telephone_conducteur').val(conducteur.nom),
      $('#quartier_conducteur').val(conducteur.nom),
      $('#date_naissance_conducteur').val(conducteur.nom)*/

    } else {
      showStep(currentStep)
    }

    
    //showStep(3)
  }

  function validateStep(step) {
    disabledLastStepButton()
    if(progression[step-1]){
      //return true
      nextStep()
    } else {
      
      console.log("catch the next action", currentStep)
      if(step == 1){
        part = "_conducteur"
        parameters['conducteur'] = {
            ajax: 1,
            control: 1,
            type_piece: $('#type_piece_conducteur').val(),
            numero_piece: $('#numero_piece_conducteur').val(),
            nom: $('#nom_conducteur').val(),
            prenom: $('#prenom_conducteur').val(),
            telephone: $('#telephone_conducteur').val(),
            quartier: $('#quartier_conducteur').val(),
            date_naissance: $('#date_naissance_conducteur').val()
        }
        console.log(parameters)
        //return true
        //return $.ajax({
        $.ajax({
            type : "POST",
            url  : '{{route('conducteurs.store')}}',
            data : parameters['conducteur'],
            dataType : 'json',
            headers : getHeaders(),
            success : function(data){
                progression[step-1] = true
                showSuccess(null, null, null)
                //return true
                nextStep()
            },
            error : function(data) {
                showError(data, part)
                //return false
            }
        })
      } else if(step == 2) {

        part = "_caution"
        parameters['caution'] = {
            ajax: 1,
            control: 1,
            type_piece: $('#type_piece_caution').val(),
            numero_piece: $('#numero_piece_caution').val(),
            nom: $('#nom_caution').val(),
            prenom: $('#prenom_caution').val(),
            telephone: $('#telephone_caution').val(),
            quartier: $('#quartier_caution').val(),
            date_naissance: $('#date_naissance_caution').val(),
            //conducteur: 1, // conducteur.id
        }
        console.log(parameters)
        //setRedirectUrl('{{route('contrats.index')}}')
        //return true
        $.ajax({
            type : "POST",
            url  : '{{route('cautions.store')}}',
            data : parameters['caution'],
            dataType : 'json',
            headers : getHeaders(),
            success : function(data){
                //console.log(data)
                showSuccess(null, null, null)
                if(!$('#checkSecondCaution').is(':checked')){
                  // only one caution
                  progression[step-1] = true
                  nextStep()
                } else {
                  // two cautions
                  part = "_caution_second"
                  parameters['caution_second'] = {
                      ajax: 1,
                      control: 1,
                      type_piece: $('#type_piece_caution_second').val(),
                      numero_piece: $('#numero_piece_caution_second').val(),
                      nom: $('#nom_caution_second').val(),
                      prenom: $('#prenom_caution_second').val(),
                      telephone: $('#telephone_caution_second').val(),
                      quartier: $('#quartier_caution_second').val(),
                      date_naissance: $('#date_naissance_caution_second').val(),
                      //conducteur: 1, // conducteur.id
                  }
                  $.ajax({
                    type : "POST",
                    url  : '{{route('cautions.store')}}',
                    data : parameters['caution_second'],
                    dataType : 'json',
                    headers : getHeaders(),
                    success : function(data){
                        console.log(data)
                        showSuccess(null, null, null)
                        progression[step-1] = true
                        nextStep()
                    },
                    error : function(data) {
                        showError(data, part)
                        //return false
                    }
                  })
                }
            },
            error : function(data) {
                showError(data, part)
                //return false
            }
        })

      } else {
        // last step
        // $('.last-step').attr('disabled','disabled')
        part = ""
        //console.log(conducteur, conducteur.id)
        parameters['contrat'] = {
            ajax: 1,
            control: 1,
            typecontrat: $('#typecontrat').val(),
            numero: $('#numero').val(),
            conducteur: 0,//conducteur.id,
            moto: $('#moto').val(),
            bdeposit: ($('#bdeposit').is(':checked')) ? 1 : 0,
            //journalier: ($('#journalier').is(':checked')) ? 1 : 0,
            frequence_paiement: $('#frequence_paiement').val(),
            offre: $('#offre').val(),
            deposit: $('#deposit').val(),
            montant: $('#montant').val(),
            montant_total: $('#montant_total').val(),
            date_signature: $('#date_signature').val(),
            date_debut: $('#date_debut').val(),
            date_fin: $('#date_fin').val(),
            datprm: $('#datprm').val(),
            observation: $('#observation').val()
        }
        console.log(parameters)
        //return true
        $.ajax({
            type : "POST",
            url  : '{{route('contrats.store')}}',
            data : parameters['contrat'],
            dataType : 'json',
            headers : getHeaders(),
            success : function(data){
                progression[step-1] = true
                showSuccess(null, null, null)
                //nextStep()
                store()
            },
            error : function(data) {
                showError(data, part)
                //return false
            }
        })
      }
    }  
  }

  function store(){
    console.log("store function", parameters)
    
    swal({  
      //title: 'Auto close alert!',
      text: "Enregistrement et génération du tableau d'amortissement en cours ...",
      buttons: false
    })
    if(conducteur){
      parameters['contrat'].control = 0
      console.log(parameters)
      // store the contrat
      parameters['contrat'].conducteur = conducteur.id
      $.ajax({
          type : "POST",
          url  : '{{route('contrats.store')}}',
          data : parameters['contrat'],
          dataType : 'json',
          headers : getHeaders(),
          success : function(contrat){
              console.log("contrat",contrat)
              swal.close()
              showSuccess(null, "Opération réussie", null)
              nextStep()
          },
          error : function(data) {console.log(data)}
      })
    } else {
      parameters['conducteur'].control = 0
      parameters['contrat'].control = 0
      parameters['caution'].control = 0
      console.log(parameters)
      // store the conducteur
      $.ajax({
        type : "POST",
        url  : '{{route('conducteurs.store')}}',
        data : parameters['conducteur'],
        dataType : 'json',
        headers : getHeaders(),
        success : function(conducteur){
            console.log("conducteur ",conducteur)
            showSuccess(null, null, null)
            // store the caution
            parameters['caution'].conducteur = conducteur.id
            $.ajax({
                type : "POST",
                url  : '{{route('cautions.store')}}',
                data : parameters['caution'],
                dataType : 'json',
                headers : getHeaders(),
                success : function(caution){
                    console.log("caution", caution)
                    if(!$('#checkSecondCaution').is(':checked')){
                      // only one caution
                      showSuccess(null, null, null)
                      // store the contrat
                      parameters['contrat'].conducteur = conducteur.id
                      $.ajax({
                          type : "POST",
                          url  : '{{route('contrats.store')}}',
                          data : parameters['contrat'],
                          dataType : 'json',
                          headers : getHeaders(),
                          success : function(contrat){
                              console.log("contrat",contrat)
                              swal.close()
                              showSuccess(null, "Opération réussie", null)
                              nextStep()
                          },
                          error : function(data) {console.log(data)}
                      })
                      
                    } else {
                      // second cautions
                      parameters['caution_second'].control = 0
                      parameters['caution_second'].conducteur = conducteur.id
                      $.ajax({
                          type : "POST",
                          url  : '{{route('cautions.store')}}',
                          data : parameters['caution_second'],
                          dataType : 'json',
                          headers : getHeaders(),
                          success : function(caution_second){
                            console.log("caution", caution_second)
                            showSuccess(null, null, null)
                            // store the contrat
                            parameters['contrat'].conducteur = conducteur.id
                            $.ajax({
                                type : "POST",
                                url  : '{{route('contrats.store')}}',
                                data : parameters['contrat'],
                                dataType : 'json',
                                headers : getHeaders(),
                                success : function(contrat){
                                    console.log("contrat",contrat)
                                    swal.close()
                                    showSuccess(null, "Opération réussie", null)
                                    nextStep()
                                },
                                error : function(data) {console.log(data)}
                              })
                          },
                          error : function(data) {console.log(data)}
                      })
                    }
                },
                error : function(data) {console.log(data)}
            })
        },
        error : function(data) {console.log(data)}
      })
    }
    
  }

</script>
@endpush