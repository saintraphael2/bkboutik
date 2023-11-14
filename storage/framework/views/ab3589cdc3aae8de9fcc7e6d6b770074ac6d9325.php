<!-- Moto Field -->

    
    <?php echo Form::hidden('moto', $id, ['class' => 'form-control', 'required']); ?>



<!-- Date Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('date', 'Effectuée le :'); ?>

    <?php echo Form::text('date', $date_fr, ['class' => 'form-control','id'=>'date']); ?>

</div>

<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
        $('#date').datepicker(/*{
            <?php if(strlen($minYear)==4): ?>
            minDate: new Date(<?php echo e($minYear); ?>, <?php echo e($minMonth); ?> , <?php echo e($minDay); ?>)
            <?php endif; ?>
        }*/);
        $('#date').change(function(){$('#prochaine').val(prochaineVidange ($('#date').val()))});
    </script>
<?php $__env->stopPush(); ?>

<!-- Kilometrage Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('kilometrage', 'Kilométrage :'); ?>

    <?php echo Form::number('kilometrage', null, ['class' => 'form-control', 'required']); ?>

</div>

<!-- Prochaine Field -->
<div class="form-group col-sm-4">
    <?php echo Form::label('prochaine', 'Prochaine Vidange estimée le :'); ?>

    <?php echo Form::text('prochaine', $prochaine_fr, ['class' => 'form-control','id'=>'prochaine','readonly']); ?>

</div>

<?php $__env->startPush('page_scripts'); ?>
    <script type="text/javascript">
       // $('#prochaine').datepicker()
       
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\inetpub\wwwroot\bkzed\resources\views/vidanges/fields.blade.php ENDPATH**/ ?>