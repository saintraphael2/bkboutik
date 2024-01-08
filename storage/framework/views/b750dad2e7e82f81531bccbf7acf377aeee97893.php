<?php echo Form::open(['route' => ['versements.destroy', $id], 'method' => 'delete']); ?>

<div class='btn-group'>
    
   
    <a href="<?php echo e(route('listeVersement', ['IdContrat'=>$id,'IdVersement'=>0])); ?>" class='btn btn-default btn-xs'>
        <i class="fa fa-list"></i>
    </a>
   <a href="<?php echo e(route('motos.show', $moto)); ?>" class='btn btn-default btn-xs' title="Vidange">
        <i class="fa fa-cog"></i>
    </a>
</div>
<?php echo Form::close(); ?>

<?php /**PATH D:\laravel_projet\bkzedsarl\resources\views/versements/datatablescontratfactures_actions.blade.php ENDPATH**/ ?>