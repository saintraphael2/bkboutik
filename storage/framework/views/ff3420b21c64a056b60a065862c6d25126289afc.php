<!-- Type Piece Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('type_piece_caution', 'Type Piece:'); ?>

    <select class="select2 form-control" name="type_piece_caution" id="type_piece_caution", required=required>
        <?php $__currentLoopData = $typepieces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typepiece): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($typepiece->id); ?>"><?php echo e($typepiece->libelle); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <span class="text-danger font-size-xsmall error_type_piece_caution"></span>
</div>

<!-- Numero Piece Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('numero_piece_caution', 'Numero Piece:'); ?>

    <?php echo Form::text('numero_piece_caution', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

    <span class="text-danger font-size-xsmall error_numero_piece_caution"></span>
</div>


<!-- Nom Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('nom_caution', 'Nom:'); ?>

    <?php echo Form::text('nom_caution', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

    <span class="text-danger font-size-xsmall error_nom_caution"></span>
</div>

<!-- Prenom Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('prenom_caution', 'Prenom:'); ?>

    <?php echo Form::text('prenom_caution', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

    <span class="text-danger font-size-xsmall error_prenom_caution"></span>
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('telephone_caution', 'Telephone:'); ?>

    <?php echo Form::number('telephone_caution', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

    <span class="text-danger font-size-xsmall error_telephone_caution"></span>
</div>

<!-- Quartier Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('quartier_caution', 'Quartier:'); ?>

    <?php echo Form::text('quartier_caution', null, ['class' => 'form-control', 'required', 'maxlength' => 200, 'maxlength' => 200]); ?>

    <span class="text-danger font-size-xsmall error_quartier_caution"></span>
</div>

<!-- Date Naissance Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('date_naissance_caution', 'Date Naissance:'); ?>

    <?php echo Form::text('date_naissance_caution', null, ['class' => 'form-control']); ?>

    <span class="text-danger font-size-xsmall error_date_naissance_caution"></span>
</div>


<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        $('#date_naissance_caution').datepicker()
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\inetpub\wwwroot\bkzed\resources\views/contrats/forms/create/caution/fields.blade.php ENDPATH**/ ?>