<!-- Type Piece Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('type_piece_conducteur', 'Type Piece:'); ?>

    <select class="select2 form-control" name="type_piece_conducteur" id="type_piece_conducteur" required=required>
        <?php $__currentLoopData = $typepieces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typepiece): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($typepiece->id); ?>"><?php echo e($typepiece->libelle); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <span class="text-danger font-size-xsmall error_type_piece_conducteur"></span>
</div>

<!-- Numero Piece Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('numero_piece_conducteur', 'Numero Piece:'); ?>

    <?php echo Form::text('numero_piece_conducteur', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

    <span class="text-danger font-size-xsmall error_numero_piece_conducteur"></span>
</div>

<!-- Nom Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('nom_conducteur', 'Nom:'); ?>

    <?php echo Form::text('nom_conducteur', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

    <span class="text-danger font-size-xsmall error_nom_conducteur"></span>
</div>

<!-- Prenom Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('prenom_conducteur', 'Prenom:'); ?>

    <?php echo Form::text('prenom_conducteur', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

    <span class="text-danger font-size-xsmall error_prenom_conducteur"></span>
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('telephone_conducteur', 'Telephone:'); ?>

    <?php echo Form::number('telephone_conducteur', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

    <span class="text-danger font-size-xsmall error_telephone_conducteur"></span>

</div>

<!-- Quartier Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('quartier_conducteur', 'Quartier:'); ?>

    <?php echo Form::text('quartier_conducteur', null, ['class' => 'form-control', 'required', 'maxlength' => 200, 'maxlength' => 200]); ?>

    <span class="text-danger font-size-xsmall error_quartier_conducteur"></span>

</div>

<!-- Date Naissance Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('date_naissance_conducteur', 'Date Naissance (jj-mm-aaaa):'); ?>

    <?php echo Form::text('date_naissance_conducteur', null, ['class' => 'form-control','id'=>'date_naissance_conducteur']); ?>

    <span class="text-danger font-size-xsmall error_date_naissance_conducteur"></span>
</div>

<!-- Photo Field -->
<!-- <div class="form-group col-sm-3">
    <?php echo Form::label('photo', 'Photo:'); ?>

    <?php echo Form::text('photo', null, ['class' => 'form-control', 'maxlength' => 200, 'maxlength' => 200]); ?>

    <span class="text-danger font-size-xsmall error_photo_conducteur"></span>
</div> -->

<!-- Caution Field -->
<!-- <div class="form-group col-sm-3">
    <?php echo Form::label('caution', 'Caution:'); ?>

    <?php echo Form::number('caution', null, ['class' => 'form-control', 'required']); ?>

</div> -->


<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        
        $('#date_naissance_conducteur').datepicker()
        /*function nextStep() {
            //event.preventDefault()
            console.log("catch the next action")
            nextStep()
        }*/
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\inetpub\wwwroot\bkzed\resources\views/contrats/forms/create/conducteur/fields.blade.php ENDPATH**/ ?>