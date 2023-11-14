<fieldset style="border:navy solid 1px; padding:10px; width:100%">
    <legend style="color:navy;width:120px ">Info Contrat</legend>
                
    <div class="row">

        <!-- Typecontrat Field -->
        <div class="col-sm-2">
            <?php echo Form::label('typecontrat', 'Type contrat:'); ?>

            <p><?php echo e($contrat->typecontrats['libelle']); ?></p>
        </div>

        <!-- Numero Field -->
        <div class="col-sm-2">
            <?php echo Form::label('numero', 'Numero:'); ?>

            <p><?php echo e($contrat->numero); ?></p>
        </div>

        <!-- Moto Field -->
        <div class="col-sm-2">
            <?php echo Form::label('moto', 'Moto:'); ?>

            <p><?php echo e($contrat->motos['immatriculation']); ?></p>
        </div>

        <!-- Conducteur Field -->
        <div class="col-sm-2">
            <?php echo Form::label('conducteur', 'Conducteur:'); ?>

            <p><?php echo e($contrat->conducteurs['nom']); ?>    <?php echo e($contrat->conducteurs['prenom']); ?></p>
        </div>


        <!-- Bdeposit Field -->
        <!-- <div class="col-sm-2">
            <?php echo Form::label('bdeposit', 'Bdeposit:'); ?>

            <p><?php echo e($contrat->bdeposit); ?></p>
        </div> -->

        <!-- Deposit Field -->
        <div class="col-sm-2">
            <?php echo Form::label('deposit', 'Deposit:'); ?>

            <p><?php echo e(($contrat->deposit) ? number_format($contrat->deposit, 0," ", " ") : "---"); ?></p>
        </div>

        <!-- Montant Total Field -->
        <div class="col-sm-2">
            <?php echo Form::label('montant_total', 'Montant Total:'); ?>

            <p><?php echo e(number_format($contrat->montant_total, 0," ", " ")); ?></p>
        </div>
            <!-- Montant Total Field -->
        <div class="col-sm-2">
            <?php echo Form::label('solde', 'Reste à Payer:'); ?>

            <p><?php echo e(number_format($contrat->solde, 0," ", " ")); ?></p>
        </div>

        <!-- Montant Total Field -->
        <div class="col-sm-2">
            <?php echo Form::label('journalier', 'Mode de Paiement:'); ?>

            <p><?php echo e(($contrat->journalier)?"JOURNALIER":"HEBDOMADAIRE"); ?></p>
        </div>
        <!-- Date Signature Field -->
        <div class="col-sm-2">
            <?php echo Form::label('date_signature', 'Date Signature:'); ?>

            <p><?php echo e($contrat->date_signature->format('d-m-Y')); ?></p>
        </div>

        <!-- Date Debut Field -->
        <div class="col-sm-2">
            <?php echo Form::label('date_debut', 'Date Debut:'); ?>

            <p><?php echo e($contrat->date_debut->format('d-m-Y')); ?></p>
        </div>

        <!-- Date Fin Field -->
        <div class="col-sm-2">
            <?php echo Form::label('date_fin', 'Date Fin:'); ?>

            <p><?php echo e($contrat->date_fin->format('d-m-Y')); ?></p>
        </div>

        <!-- Datprm Field -->
        <div class="col-sm-2">
            <?php echo Form::label('datprm', 'Date Premier Paiement:'); ?>

            <p><?php echo e(($contrat->datprm) ? $contrat->datprm->format('d-m-Y') : "---"); ?></p>
        </div>


    </div>
</fieldset><?php /**PATH C:\inetpub\wwwroot\bkzed\resources\views/contrats/show_fields_second.blade.php ENDPATH**/ ?>