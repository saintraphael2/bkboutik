

<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tableau de board</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </section>

    <br><br>
    <div class="content px-3">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-info">
                    <div class="inner">
                        
                        <?php if( Auth::user()->comptable==1  ): ?>
                        <h3><?php echo e($nbConducteurs ?? "---"); ?></h3>
                    <?php else: ?>
                    <h3>--</h3>
                    <?php endif; ?>
                        <p>Conducteurs</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <?php if( Auth::user()->comptable==1  ): ?>
                        <a href="<?php echo e(route('conducteurs.index')); ?>" class="small-box-footer">
                            Voir plus <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    <?php else: ?>
                    <a href="#" class="small-box-footer">
                            Voir plus <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-success">
                    <div class="inner">
                    <?php if( Auth::user()->comptable==1  ): ?>
                        <h3><?php echo e($nbMotos ?? "---"); ?></h3>
                    <?php else: ?>
                    <h3>--</h3>
                    <?php endif; ?>
                        <p>Motos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <?php if( Auth::user()->comptable==1  ): ?>
                        <a href="<?php echo e(route('motos.index')); ?>" class="small-box-footer">
                            Voir plus <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    <?php else: ?>
                    <a href="#" class="small-box-footer">
                            Voir plus <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    <?php endif; ?>
                    
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-warning">
                    <div class="inner">
                   
                    <?php if( Auth::user()->comptable==1  ): ?>
                    <h3><?php echo e($nbContrats ?? "---"); ?></h3>
                    <?php else: ?>
                    <h3>--</h3>
                    <?php endif; ?>
                        
                        
                        <p>Contrats</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <?php if( Auth::user()->comptable==1  ): ?>
                    <a href="<?php echo e(route('contrats.index')); ?>" class="small-box-footer">
                        Voir plus <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    <?php else: ?>
                    <a href="#" class="small-box-footer">
                            Voir plus <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-danger">
                    <div class="inner">
                        <h3><?php echo e($nbArrieres ?? "---"); ?></h3>
                        <p>Nombre d'arriérés</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-list-check"></i>
                    </div>
                    <a href="<?php echo e(route('etats.arrieres')); ?>" class="small-box-footer">
                        Voir plus <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Liste des 5 derniers contrats signés :</h5>
                    </div>
                    <div class="card-body px-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Contrat</th>
                                    <th>Moto</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody  style="font-size:small">
                                <?php if($contrats): ?>
                                    <?php $__currentLoopData = $contrats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $contrat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key+1); ?>.</td>
                                            <td><?php echo e($contrat->numero); ?></td>
                                            <td>
                                                <?php echo e($contrat->motos->immatriculation); ?>

                                            </td>
                                            <td class="text-right">
                                                <?php echo e(number_format($contrat->montant_total, 0," ", " ")); ?>

                                            </td>
                                            <td><?php echo e($contrat->created_at->format('d-m-Y H:i')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
            <div class="card">
                    <div class="card-header">
                        <h5>Liste des 5 derniers arriérés :</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Conducteur</th>
                                    <th>Moto</th>
                                    <th>Mode</th>
                                    <th>Arriérés</th>
                                    <th>Retards</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:small">
                                <?php if($arrieres): ?>
                                    <?php $__currentLoopData = $arrieres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $arriere): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key+1); ?>.</td>
                                            <td>
                                                <?php echo e($arriere->conducteurs->nom); ?> <?php echo e($arriere->conducteurs->prenom); ?>

                                            </td>
                                            <td>
                                                <?php echo e($arriere->motos->immatriculation); ?>

                                            </td>
                                            <td>
                                                <?php echo e(($arriere->journalier) ? "JOURNALIER" : "HEBDOMADAIRE"); ?>

                                            </td>
                                            <td class="text-right">
                                                <?php echo e(number_format($arriere->arrieres, 0," ", " ")); ?>

                                            </td>
                                            <td class="text-right"><?php echo e($arriere->retard); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laravel_projet\bkzedsarl\resources\views/home.blade.php ENDPATH**/ ?>