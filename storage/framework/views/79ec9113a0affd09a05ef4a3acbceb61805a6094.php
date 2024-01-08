<!-- Typecontrat Field -->
<div class="col-sm-12">
    <?php echo Form::label('typecontrat', 'Typecontrat:'); ?>

    <p><?php echo e($contrat->typecontrat); ?></p>
</div>

<!-- Numero Field -->
<div class="col-sm-12">
    <?php echo Form::label('numero', 'Numero:'); ?>

    <p><?php echo e($contrat->numero); ?></p>
</div>

<!-- Moto Field -->
<div class="col-sm-12">
    <?php echo Form::label('moto', 'Moto:'); ?>

    <p><?php echo e($contrat->moto); ?></p>
</div>

<!-- Conducteur Field -->
<div class="col-sm-12">
    <?php echo Form::label('conducteur', 'Conducteur:'); ?>

    <p><?php echo e($contrat->conducteur); ?></p>
</div>

<!-- Bdeposit Field -->
<div class="col-sm-12">
    <?php echo Form::label('bdeposit', 'Bdeposit:'); ?>

    <p><?php echo e($contrat->bdeposit); ?></p>
</div>

<!-- Deposit Field -->
<div class="col-sm-12">
    <?php echo Form::label('deposit', 'Deposit:'); ?>

    <p><?php echo e($contrat->deposit); ?></p>
</div>

<!-- Montant Total Field -->
<div class="col-sm-12">
    <?php echo Form::label('montant_total', 'Montant Total:'); ?>

    <p><?php echo e($contrat->montant_total); ?></p>
</div>

<!-- Montant Total Field -->
<div class="col-sm-12">
    <?php echo Form::label('solde', 'Reste à Payer:'); ?>

    <p><?php echo e($contrat->solde); ?></p>
</div>

<!-- Montant Total Field -->
<div class="col-sm-12">
    <?php echo Form::label('journalier', 'Mode de Paiement:'); ?>

    <p><?php echo e(($contrat->journalier)?"JOURNALIER":"HEBDOMADAIRE"); ?></p>
</div>
<!-- Date Signature Field -->
<div class="col-sm-12">
    <?php echo Form::label('date_signature', 'Date Signature:'); ?>

    <p><?php echo e($contrat->date_signature); ?></p>
</div>

<!-- Date Debut Field -->
<div class="col-sm-12">
    <?php echo Form::label('date_debut', 'Date Debut:'); ?>

    <p><?php echo e($contrat->date_debut); ?></p>
</div>

<!-- Date Fin Field -->
<div class="col-sm-12">
    <?php echo Form::label('date_fin', 'Date Fin:'); ?>

    <p><?php echo e($contrat->date_fin); ?></p>
</div>

<!-- Datprm Field -->
<div class="col-sm-12">
    <?php echo Form::label('datprm', 'Datprm:'); ?>

    <p><?php echo e($contrat->datprm); ?></p>
</div>

<!-- Observation Field -->
<div class="col-sm-12">
    <?php echo Form::label('observation', 'Observation:'); ?>

    <p><?php echo e($contrat->observation); ?></p>
</div>

<?php /**PATH D:\laravel_projet\bkzedsarl\resources\views/contrats/show_fields.blade.php ENDPATH**/ ?>