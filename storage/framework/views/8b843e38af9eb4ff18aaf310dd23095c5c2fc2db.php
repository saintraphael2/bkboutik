<?php echo Form::hidden('moto', $id, ['class' => 'form-control', 'required']); ?>

<div class="form-group col-sm-6">
    <?php echo Form::label('compagnie_assurance', 'Compagnie Assurance:'); ?>

    <?php echo Form::select('compagnie_assurance', $compagnie_assurances, $compagnie_assurance, ['class' => 'form-control']); ?>

</div>
<!-- Numero Contrat Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('numero_contrat', 'Numero Contrat:'); ?>

    <?php echo Form::text('numero_contrat', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

</div>




<!-- Date Debut Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('date_debut', 'Date Debut:'); ?>

    <?php echo Form::text('date_debut', $date_debut_fr, ['class' => 'form-control','id'=>'date_debut']); ?>

</div>

<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        $('#date_debut').datepicker()
    </script>
<?php $__env->stopPush(); ?>

<!-- Date Fin Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('date_fin', 'Date Fin:'); ?>

    <?php echo Form::text('date_fin', $date_fin_fr, ['class' => 'form-control','id'=>'date_fin']); ?>

</div>

<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        $('#date_fin').datepicker()
    </script>
<?php $__env->stopPush(); ?><?php /**PATH D:\laravel_projet\bkzedsarl\resources\views/contrat_assurances/fields.blade.php ENDPATH**/ ?>