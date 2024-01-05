<!-- Immatriculation Field -->
<div class="form-group col-sm-6">
    <?php echo Form::label('immatriculation', 'Immatriculation (TG-1234-AB):'); ?>

    <?php echo Form::text('immatriculation', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

</div>

<!-- Chassis Field -->
<div class="form-group col-sm-2">
    <?php echo Form::label('chassis', 'Chassis:'); ?>

    <?php echo Form::text('chassis', null, ['class' => 'form-control', 'required', 'maxlength' => 100, 'maxlength' => 100]); ?>

</div>

<!-- Mise Circulation Field -->
<div class="form-group col-sm-2">
    <?php echo Form::label('mise_circulation', 'Mise Circulation:'); ?>

    <?php echo Form::text('mise_circulation', null, ['class' => 'form-control','id'=>'mise_circulation']); ?>

</div>


<!-- date_enregistrement Field -->
<div class="form-group col-sm-2">
    <?php echo Form::label('date_enregistrement', 'Date Enregistrement:'); ?>

    <?php echo Form::text('date_enregistrement', null, ['class' => 'form-control','id'=>'date_enregistrement']); ?>

</div>


<!-- Disponible Field -->
<div class="form-group col-sm-2">
    <div class="form-check">
        <?php echo Form::hidden('disponible', 0, ['class' => 'form-check-input']); ?>

        <?php echo Form::checkbox('disponible', '1', null, ['class' => 'form-check-input', 'checked' => 'checked',$disabled]); ?>

        <?php echo Form::label('disponible', 'Disponible', ['class' => 'form-check-label']); ?>

    </div>
</div>

<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        $('#mise_circulation').datepicker()
        $('#date_enregistrement').datepicker()

        $('#mise_circulation').change(function(){
            $('#date_enregistrement').val($('#mise_circulation').val())
        });

    </script>
<?php $__env->stopPush(); ?><?php /**PATH D:\laravel_projet\bkzedsarl\resources\views/motos/fields.blade.php ENDPATH**/ ?>