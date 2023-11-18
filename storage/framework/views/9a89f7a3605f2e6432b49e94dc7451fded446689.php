<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                    Vidange
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="<?php echo e(route('versements.index')); ?>">
                                                   Facturation
                                            </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        
        <div class="card">
            <div class="card-body">
                    
                    
                    <?php echo $__env->make('motos.show_fields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
               
            </div>
        </div>
        <div class="clearfix"></div>
                
                <div class="card">
                
                    <a class="btn btn-primary float-right"
                       href="<?php echo e(route('addVidande',['IdMoto'=>$id])); ?>">
                        Nouvelle Vidange
                    </a>
                
                    <?php echo $__env->make('vidanges.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\wwwroot\bkzed\resources\views/motos/show.blade.php ENDPATH**/ ?>