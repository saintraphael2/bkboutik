<?php if($config->options->localized): ?>
    Flash::success(__('messages.updated', ['model' => __('models/<?php echo e($config->modelNames->camelPlural); ?>.singular')]));
<?php else: ?>
    Flash::success('<?php echo e($config->modelNames->human); ?> mis à jour avec succès.');
<?php endif; ?><?php /**PATH D:\laravel_projet\bkzedsarl\resources\views/vendor/laravel-generator/scaffold/controller/messages/update_success.blade.php ENDPATH**/ ?>