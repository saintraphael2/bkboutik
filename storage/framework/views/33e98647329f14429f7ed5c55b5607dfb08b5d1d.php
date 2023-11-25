

<?php $__env->startPush('page_css'); ?>
<style>
.arrieres>input:first-child+label::before {
    border: 1px solid #dc3545 !important;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
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

        <?php echo $__env->make('adminlte-templates::common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <!-- Immatriculation Field -->
                            <div class="form-group col-sm-3">
                                <?php echo Form::label('immatriculation', 'Immatriculation (TG-1234-AB):'); ?>

                                <?php echo Form::text('immatriculation', null, ['class' => 'form-control basicAutoSelect', 'required', 'maxlength' => 100, 'maxlength' => 100, 'list' => "list-immatriculation"]); ?>

                                <datalist id="list-immatriculation">
                                <?php $__currentLoopData = $motos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option><?php echo e($moto->immatriculation); ?></option>
                                        <!-- <option value="<?php echo e($moto->contrats->first()->id ?? 0); ?>"><?php echo e($moto->immatriculation); ?></option> -->
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </datalist>
                                <!-- <select class="form-control basicAutoSelect" name="immatriculation" id="immatriculation" required=required placeholder="type to search..." autocomplete="off">
                                    <?php $__currentLoopData = $motos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $moto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($moto->contrats->first()->id ?? 0); ?>"><?php echo e($moto->immatriculation); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select> -->
                                <span class="text-danger font-size-xsmall error_type_piece_conducteur"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="d-block text-right card-footer">
                    <div class="col-xl-12 col-12">
                        <a href="<?php echo e(route('versements.index')); ?>" class="btn btn-default pull-right cancel-step">
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
                    <?php echo $__env->make('contrats.show_fields_second', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <br>
                
                    <form id="form-step-2" action="#" method="POST">
                        <?php echo e(csrf_field()); ?>

                        <?php echo $__env->make('tableau_armortissements.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </form>
                </div>
                <div class="d-block text-right card-footer">
                    <div class="col-xl-12 col-12">
                        <a href="<?php echo e(route('versements.index')); ?>" class="btn btn-default pull-right cancel-step">
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
									<img src="<?php echo e(asset('images/logo_bk_zed.png')); ?>" width="100px" heigth="50px">
								</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="border-unset" style="width: 600px;">
                                    <h5><?php echo e(config('app.name')); ?></h5>
                                    <?php echo e(config('app.address')); ?> <br>
                                    <?php echo e(config('app.contact')); ?>

                                </td>
                                <td class="border-unset">
                                    <h5>Client :</h5>
                                    <?php echo e($contrat->conducteurs['nom']); ?> <?php echo e($contrat->conducteurs['prenom']); ?> <br>
                                    Addresse : <?php echo e($contrat->conducteurs['quartier']); ?> <br>
                                    Tel : <?php echo e($contrat->conducteurs['telephone']); ?> <br>
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
                                <td class="border-right">Paiement du contrat N° <?php echo e($contrat->numero); ?></td>
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
                            Fait à Lomé, le <?php echo e(date("j-m-Y H:i")); ?>

                            <br><br><br>
                            <?php echo e(Auth::user()->name); ?><br>
                            Le caissier
                        </p>
                    </div>
                </div>
                <div class="d-block text-right card-footer">
                    <div class="col-xl-12 col-12">
                        <a href="<?php echo e(route('versements.index')); ?>" class="btn btn-default pull-right cancel-step">
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
<?php $__env->stopSection(); ?>



<?php $__env->startPush('page_scripts'); ?>
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

    //console.log("initialisation", <?php echo json_encode($configStepsLimit, 15, 512) ?>, <?php echo json_encode($currentStep, 15, 512) ?>, <?php echo json_encode($contrat->motos->immatriculation, 15, 512) ?>)
    //showSuccess(null, "Opération réussie", null)
    //setImmatriculationAutocompletion()
    setContratId(<?php echo json_encode($contrat->id, 15, 512) ?>)
    setArrieres(<?php echo json_encode($arrieres, 15, 512) ?>)
    setImmatriculation(<?php echo json_encode($contrat->motos->immatriculation, 15, 512) ?>)
    setCurrentStep(<?php echo json_encode($currentStep, 15, 512) ?>)
    setRedirectUrl('<?php echo e(route('versements.index')); ?>')
    configStepsLimit(<?php echo json_encode($configStepsLimit, 15, 512) ?>)
    setProgression(currentStep-1)
    showStep(currentStep)
                        
    /* function setImmatriculationAutocompletion(){
        console.log("setImmatriculationAutocompletion", <?php echo json_encode($motos, 15, 512) ?>)
        let availableValues = <?php echo json_encode($motos, 15, 512) ?>;
        console.log(availableValues)
         $('#immatriculation').autocomplete({
            source: availableValues,
            autoFocus: true
        })
    } */

    $('#immatriculation').change(function(){
        console.log("on change immatriculation 1:")
		console.log(<?php echo json_encode($motos, 15, 512) ?>)
        let availableValues = <?php echo json_encode($motos, 15, 512) ?>;
        let index = availableValues.findIndex(x => x.immatriculation == $('#immatriculation').val())
        //console.log(immatriculation, availableValues, index, availableValues[index])
        if(availableValues[index]){
            setContratId(availableValues[index].mycontrat[0].id)
        }
        
    })
    
    /* function getContratByImmatriculation(){
        console.log("getContratByImmatriculation")
        let immatriculation = $('#immatriculation').val()
        let availableValues = <?php echo json_encode($motos, 15, 512) ?>;
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

        //montantRestant = <?php echo json_encode($contrat->montant_total, 15, 512) ?> - montantTotal
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
                //let redirect_url = "<?php echo e(route('versements.create', ['contrat' => 8, 'configStepsLimit' => 3, 'currentStep' => 2])); ?>"
                let redirect_url = "<?php echo e(route('versements.create')); ?>?contrat="+contratId+"&configStepsLimit="+last+"&currentStep="+(currentStep+1)
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
                url  : '<?php echo e(route('versements.store')); ?>',
                data : parameters['versements'],
                dataType : 'json',
                headers : getHeaders(),
                success : function(data){
                    console.log("request response", data)
                    console.log("redirect url", "<?php echo e(route('home')); ?>/listeVersement/"+data.contrat+"/"+data.id)
                    window.location.href = "<?php echo e(route('home')); ?>/listeVersement/"+data.contrat+"/"+data.id;
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

//createDataTable("<?php echo e(route('users.index')); ?>")
  //createDataTable("<?php echo e(route('tableau_armortissements.index', ['contrat' => 1, 'ajax' => 1])); ?>")

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
            url  : "<?php echo e(route('tableau_armortissements.index', ['contrat' => 8, 'ajax' => 1])); ?>",
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel_projet\projet\bkzed\resources\views/versements/create.blade.php ENDPATH**/ ?>