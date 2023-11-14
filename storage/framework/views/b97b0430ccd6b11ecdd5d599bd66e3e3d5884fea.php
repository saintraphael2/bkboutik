<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Mise à jour Users
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <?php echo $__env->make('adminlte-templates::common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card">

            <?php echo Form::model($users, ['route' => ['users.update', $users->id], 'method' => 'patch']); ?>


            <div class="card-body">
                <div class="row">
                    <?php echo $__env->make('users.fields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('users.infoComplementaire', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>

            <div class="card-footer">
                <?php echo Form::submit('Enregister', ['class' => 'btn btn-primary']); ?>

                <a href="<?php echo e(route('users.index')); ?>" class="btn btn-default"> Annuler </a>
            </div>

            <?php echo Form::close(); ?>


        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\wwwroot\bkzed\resources\views/users/edit.blade.php ENDPATH**/ ?>