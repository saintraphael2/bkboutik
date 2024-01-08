
<div >
    <div  class="row">
        <img src='<?php echo e(asset($conducteur->photo)); ?>' class='file-preview-image' alt='Desert' title='Desert'>
    
    </div>

</div><br>
<div class="row">
<!-- Nom Field -->
<div class="col-sm-3">
    <?php echo Form::label('nom', 'Nom:'); ?>

    <p><?php echo e($conducteur->nom); ?></p>
</div>

<!-- Prenom Field -->
<div class="col-sm-3">
    <?php echo Form::label('prenom', 'Prenom:'); ?>

    <p><?php echo e($conducteur->prenom); ?></p>
</div>

<!-- Telephone Field -->
<div class="col-sm-3">
    <?php echo Form::label('telephone', 'Telephone:'); ?>

    <p><?php echo e($conducteur->telephone); ?></p>
</div>

<!-- Quartier Field -->
<div class="col-sm-3">
    <?php echo Form::label('quartier', 'Quartier:'); ?>

    <p><?php echo e($conducteur->quartier); ?></p>
</div>

<!-- Date Naissance Field -->
<div class="col-sm-3">
    <?php echo Form::label('date_naissance', 'Date Naissance:'); ?>

    <p><?php echo e(date("d-m-Y", strtotime($conducteur->date_naissance))); ?></p>
</div>

<!-- Photo Field -->



<!-- Type Piece Field -->
<div class="col-sm-3">
    <?php echo Form::label('type_piece', 'Type Piece:'); ?>

    <p><?php echo e($conducteur->typePiece["libelle"]); ?></p>
</div>

<!-- Numero Piece Field -->
<div class="col-sm-3">
    <?php echo Form::label('numero_piece', 'Numero Piece:'); ?>

    <p><?php echo e($conducteur->numero_piece); ?></p>
</div>



</div>
<fieldset>
    <legend style="width:100%">Caution (s)</legend>
    <div class="row">
<?php $__currentLoopData = $conducteur->cautionsConduteurs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cautions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-sm-3">
        <?php echo Form::label('nom', 'Nom:'); ?>

        <p><?php echo e($cautions->cautions->nom); ?></p>
    </div>

    <!-- Prenom Field -->
    <div class="col-sm-3">
        <?php echo Form::label('prenom', 'Prenom:'); ?>

        <p><?php echo e($cautions->cautions->prenom); ?></p>
    </div>

    <!-- Telephone Field -->
    <div class="col-sm-3">
        <?php echo Form::label('telephone', 'Telephone:'); ?>

        <p><?php echo e($cautions->cautions->telephone); ?></p>
    </div>

    <!-- Quartier Field -->
    <div class="col-sm-3">
        <?php echo Form::label('quartier', 'Quartier:'); ?>

        <p><?php echo e($cautions->cautions->quartier); ?></p>
    </div>

    <!-- Date Naissance Field -->
    <div class="col-sm-3">
        <?php echo Form::label('date_naissance', 'Date Naissance:'); ?>

        <p><?php echo e(date("d-m-Y", strtotime($cautions->cautions->date_naissance))); ?></p>
    </div>

    <!-- Type Piece Field -->
    <div class="col-sm-3">
        <?php echo Form::label('type_piece', 'Type Piece:'); ?>

        <p><?php echo e($cautions->cautions->typePiece["libelle"]); ?></p>
    </div>

    <!-- Numero Piece Field -->
    <div class="col-sm-3">
        <?php echo Form::label('numero_piece', 'Numero Piece:'); ?>

        <p><?php echo e($cautions->cautions->numero_piece); ?></p>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</fieldset><?php /**PATH D:\laravel_projet\bkzedsarl\resources\views/conducteurs/show_fields.blade.php ENDPATH**/ ?>