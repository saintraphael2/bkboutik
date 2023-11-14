<!-- Type Piece Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('type_piece_caution_second', 'Type Piece:'); ?>

    <select class="select2 form-control" name="type_piece_caution_second" id="type_piece_caution_second", required=required>
        <?php $__currentLoopData = $typepieces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typepiece): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($typepiece->id); ?>"><?php echo e($typepiece->libelle); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <span class="text-danger font-size-xsmall error_type_piece_caution_second"></span>
</div>

<!-- Numero Piece Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('numero_piece_caution_second', 'Numero Piece:'); ?>

    <?php echo Form::text('numero_piece_caution_second', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

    <span class="text-danger font-size-xsmall error_numero_piece_caution_second"></span>
</div>


<!-- Nom Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('nom_caution_second', 'Nom:'); ?>

    <?php echo Form::text('nom_caution_second', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

    <span class="text-danger font-size-xsmall error_nom_caution_second"></span>
</div>

<!-- Prenom Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('prenom_caution_second', 'Prenom:'); ?>

    <?php echo Form::text('prenom_caution_second', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

    <span class="text-danger font-size-xsmall error_prenom_caution_second"></span>
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('telephone_caution_second', 'Telephone:'); ?>

    <?php echo Form::number('telephone_caution_second', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

    <span class="text-danger font-size-xsmall error_telephone_caution_second"></span>
</div>

<!-- Quartier Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('quartier_caution_second', 'Quartier:'); ?>

    <?php echo Form::text('quartier_caution_second', null, ['class' => 'form-control', 'required', 'maxlength' => 200, 'maxlength' => 200]); ?>

    <span class="text-danger font-size-xsmall error_quartier_caution_second"></span>
</div>

<!-- Date Naissance Field -->
<div class="form-group col-sm-3">
    <?php echo Form::label('date_naissance_caution_second', 'Date Naissance (jj-mm-aaaa) :'); ?>

    <?php echo Form::text('date_naissance_caution_second', null, ['class' => 'form-control']); ?>

    <span class="text-danger font-size-xsmall error_date_naissance_caution_second"></span>
</div>


<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        $('#date_naissance_caution_second').datepicker()
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\inetpub\wwwroot\bkzed\resources\views/contrats/forms/create/caution/fields_second.blade.php ENDPATH**/ ?>