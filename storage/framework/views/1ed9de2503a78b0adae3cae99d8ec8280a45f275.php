<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Liste des versements</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="<?php echo e(route('versements.index')); ?>">
                       Liste des contrats  facturés
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card">
            <div class="card-body">
                <?php echo $__env->make('contrats.show_fields_second', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
        <div class="clearfix"></div>
       
        <div class="card">
            <?php echo $__env->make('versements.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <div id="dialog" style="display: none;">
        <div>
            <iframe id="framerecu" width="800" height="800"></iframe>
        </div>
    </div>
    <?php if(Request::segment(3)!=0): ?> 
    
    <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
           type:'GET',
           url:"<?php echo e(route('cheminVersement')); ?>",
           data:{versement:<?php echo e(Request::segment(3)); ?>},
           success:function(data){
                if($.isEmptyObject(data.error)){
                  
                   url="<?php echo e(asset('storage/recus/$chemin')); ?>";
                   url=url.replace("$chemin", data.chemin);
                  
                    $("#dialog").dialog({
            height: 800,
         width: 800,
         modal: true,
         title:"RECU",
       }
          
       );
     
         $("#framerecu").attr("src",url);   
                }
           }
        });
    </script>
  

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<script>
    function visualiser(title,contrat,versement){
        //chemin="/documents/Recus/"+contrat+'/'+versement+'.pdf'
        chemin="<?php echo e(route('home')); ?>/storage/recus/"+contrat+'/'+versement+'.pdf'
        //chemin="<?php echo e(public_path()); ?>/storage/recus/"+contrat+'/'+versement+'.pdf'
        console.log(chemin);
       
       $("#dialog").dialog({
            height: 800,
         width: 800,
         modal: true,
         title:title,
       }
          
       );
     
         $("#framerecu").attr("src",chemin);   
     
           
  }
</script>
<?php

?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\inetpub\wwwroot\bkzed\resources\views/versements/show.blade.php ENDPATH**/ ?>