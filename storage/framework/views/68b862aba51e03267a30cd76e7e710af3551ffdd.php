<!-- Name Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('name', 'Nom & Prénoms:'); ?>

    <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('email', 'Email:'); ?>

    <?php echo Form::text('email', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>



<!-- password Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('password', 'Mot de passe:'); ?>

    <?php echo Form::password('password', ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]); ?>

</div>

<?php /**PATH D:\SIMON\LARAVEL\bkzed\bkzed\resources\views/users/fields.blade.php ENDPATH**/ ?>