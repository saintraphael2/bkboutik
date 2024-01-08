<!-- <?php echo e($fieldTitle); ?> Field -->
<div class="form-group col-sm-6">
<?php if($config->options->localized): ?>
    {!! Form::label('<?php echo e($fieldName); ?>', __('models/<?php echo e($config->modelNames->camelPlural); ?>.fields.<?php echo e($fieldName); ?>').':') !!}
<?php else: ?>
    {!! Form::label('<?php echo e($fieldName); ?>', '<?php echo e($fieldTitle); ?>:') !!}
<?php endif; ?>
    {!! Form::text('<?php echo e($fieldName); ?>', null, ['class' => 'form-control'<?php if(isset($options)) { echo htmlspecialchars_decode($options); } ?>]) !!}
</div><?php /**PATH D:\laravel_projet\bkzedsarl\vendor\infyomlabs\adminlte-templates\src/../views/templates/fields/text.blade.php ENDPATH**/ ?>