

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                   Notification de motif d'arriéré
                    </h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                    href="<?php echo e(route('motif_arrieres.index')); ?>">
                                                    Arriérés
                                            </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?php echo $__env->make('contrats.show_fields_second', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <br>
                <div class="row">
                
                    <fieldset style="border:navy solid 1px; padding:10px; width:100%">
                    <legend>Mise à jour écheance</legend>
                    <?php echo Form::model($contrat, ['route' => ['editmotif', $contrat->id], 'method' => 'post']); ?>

                       
                        <div class="row">
                        <div class="col-sm-2">
            <?php echo Form::label('datprev', '1ere écheance non payée:'); ?>

            <p> <?php echo e(($dateprevnonpaye[0]->datprev!=null)?$dateprevnonpaye[0]->datprev->format('d-m-Y'):'-'); ?></p>
        </div>
        <div class="col-sm-2">
            <?php echo Form::label('montant', 'Total non payé:'); ?>

            <p><?php echo e($montantarriere[0]->arrieres); ?></p>
        </div>
        <div class="col-sm-2">
            <?php echo Form::label('nbrejts', 'Nombre de jours non payés:'); ?>

            <p><?php echo e($retards[0]->retard); ?></p>
        </div>
      
        <div class="col-sm-2">
            <?php echo Form::label('motif_arriere', 'Motif:'); ?>

            <?php echo Form::select('motif_arriere', $motifs, null, ['class' => 'form-control', "id"=>"motif_arriere"]); ?>

        </div>


<div class="col-sm-4">
                <?php echo Form::submit('Enregister', ['class' => 'btn btn-primary']); ?>

               
            </div>

           
        </div>         
                        
                        
                    </fieldset>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel_projet\bkzedsarl\resources\views/contrats/motar.blade.php ENDPATH**/ ?>