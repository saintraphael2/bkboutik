

<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2"> 
                <div class="col-sm-6">
                    <h1>Conducteurs</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="<?php echo e(route('conducteurs.create')); ?>">
                        Nouveau
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="clearfix"></div>

        <div class="card">
            <?php echo $__env->make('conducteurs.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <div id="dialog" style="display: none;">
        <div>
            <iframe id="frame" width="1000" height="800">

            <div class="row">
                    
                </div>
            </iframe>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<script>
    function visualiser(title,id){
       
        console.log(id);
        chemin="<?php echo e(route('conducteurs.show','id')); ?>";
        chemin=chemin.replace("id", id);
        console.log(chemin);
       
       $("#dialog").dialog({
            height: 800,
         width: 1000,
         modal: true,
         title:title,
       }
          
       );
     
         $("#frame").attr("src",chemin);   
     
           
  }
</script>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\wwwroot\bkzed\resources\views/conducteurs/index.blade.php ENDPATH**/ ?>