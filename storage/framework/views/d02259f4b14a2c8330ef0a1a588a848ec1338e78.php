

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo e(Auth::user()->name); ?></h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('adminlte-templates::common.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="clearfix"></div>

        <div class="card">
        <?php echo Form::open(['route' => 'password.my_update']); ?>


        <div class="card-header">
            Mise à jour du mot de passe :
        </div>
        <div class="card-body">

            <div class="row">
                <!-- password Field -->
                <div class="form-group col-sm-4">
                    <?php echo Form::label('password', 'Mot de passe actuel:'); ?>

                    <?php echo Form::password('password', ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]); ?>

                </div>

                <!-- password Field -->
                <div class="form-group col-sm-4">
                    <?php echo Form::label('new_password', 'Nouveau mot de passe:'); ?>

                    <?php echo Form::password('new_password', ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]); ?>

                </div>
            </div>

        </div>

        <div class="card-footer text-right">
            <?php echo Form::submit('Enregister', ['class' => 'btn btn-primary']); ?>

            <a href="<?php echo e(route('users.index')); ?>" class="btn btn-default"> Annuler </a>
        </div>

        <?php echo Form::close(); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\wwwroot\bkzed\resources\views/auth/passwords/update.blade.php ENDPATH**/ ?>