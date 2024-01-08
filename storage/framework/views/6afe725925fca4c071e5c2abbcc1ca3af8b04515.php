<?php if($config->options->localized): ?>
    Flash::success(__('messages.saved', ['model' => __('models/<?php echo e($config->modelNames->camelPlural); ?>.singular')]));
<?php else: ?>
    Flash::success('<?php echo e($config->modelNames->human); ?> enregistré(e) avec succès.');
<?php endif; ?>
<?php /**PATH D:\laravel_projet\bkzedsarl\resources\views/vendor/laravel-generator/scaffold/controller/messages/save_success.blade.php ENDPATH**/ ?>