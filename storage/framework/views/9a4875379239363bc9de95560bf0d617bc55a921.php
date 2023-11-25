

<?php $__env->startSection('content'); ?>
  

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?php echo $__env->make('conducteurs.show_fields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel_projet\projet\bkzed\resources\views/conducteurs/show.blade.php ENDPATH**/ ?>