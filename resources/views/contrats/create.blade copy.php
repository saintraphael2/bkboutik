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


        <div class="progress">
          <div class="progress-bar" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 15%;">Meh</div>
          <div class="progress-bar bg-success" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">Wow!</div>
          <div class="progress-bar bg-info" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">Cool</div>
          <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">20%</div>
          <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">!!</div>
        </div>
        <br> <br>
        <!-- progressbar -->
  <ul id="progressbar">
    <li id="progress-bar-step-1" class="active">Account Setup</li>
    <li id="progress-bar-step-2">Social Profiles</li>
    <li id="progress-bar-step-3">Personal Details</li>
  </ul>
  <br> <br>

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
                <button class="btn btn-primary pull-right next-step form-step-action" onclick="nextStep()">
                  Suivant <i class="fa fa-circle-arrow-right"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Form step 2 -->
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
                <button class="btn btn-primary pull-right prev-step form-step-action" onclick="prevStep()">
                  <i class="fa fa-circle-arrow-left"></i> 
                  Précédent
                </button>
                <button class="btn btn-primary pull-right next-step form-step-action" onclick="nextStep()">
                  Suivant <i class="fa fa-circle-arrow-right"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Form step 3 -->
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
                <button class="btn btn-primary pull-right last-step form-step-action" onclick="nextStep()">
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
  let conducteur = null
  let part = null
  configStepsLimit(3)
  
  function validateStep(step) {
    if(progression[step-1]){
      return true
    } else {
      let parameters = null
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
        console.log(parameters['conducteur'])
        //return true
        return $.ajax({
                type : "POST",
                url  : '{{route('conducteurs.store')}}',
                data : parameters['conducteur'],
                dataType : 'json',
                headers : getHeaders(),
                success : function(data){
                    console.log(data)
                    //conducteur = data
                    progression[step-1] = true
                  return true
                },
                error : function(data) {
                    showError(data, part)
                    return false
                }
            })
      } else if(step == 2) {
        //console.log(conducteur, conducteur.id)
        parameters = {
                ajax: 1,
                control: 1,
                typecontrat: $('#typecontrat').val(),
                numero: $('#numero').val(),
                //conducteur: 1,//conducteur.id,
                moto: $('#moto').val(),
                bdeposit: (parseInt($('input[name ="bdeposit"]:checked').val())) ? 1 : 0,
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
        return $.ajax({
                type : "POST",
                url  : '{{route('contrats.store')}}',
                data : parameters,
                dataType : 'json',
                headers : getHeaders(),
                success : function(data){
                    console.log(data)
                    //contrat = data
                    progression[step-1] = true
                  return true
                },
                error : function(data) {
                    showError(data)
                    return false
                }
            })
      } else {
        // last step
        parameters = {
                ajax: 1,
                type_piece: $('#type_piece_caution').val(),
                numero_piece: $('#numero_piece_caution').val(),
                nom: $('#nom_caution').val(),
                prenom: $('#prenom_caution').val(),
                telephone: $('#telephone_caution').val(),
                quartier: $('#quartier_caution').val(),
                date_naissance: $('#date_naissance_caution').val(),
                conducteur: 1, // conducteur.id
            }
        console.log(parameters)
        setRedirectUrl('{{route('contrats.index')}}')
        return true
        /*return $.ajax({
                type : "POST",
                url  : '{{route('cautions.store')}}',
                data : parameters,
                dataType : 'json',
                headers : getHeaders(),
                success : function(data){
                    console.log(data)
                    progression[step-1] = true
                    return true
                },
                error : function(data) {
                    showError(data)
                    return false
                }
            })*/
      }
    }  
  }
</script>
@endpush