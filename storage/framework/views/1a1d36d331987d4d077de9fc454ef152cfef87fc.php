<?php echo Form::open(['route' => ['versements.destroy', $id], 'method' => 'delete']); ?>

<div class='btn-group'>
    <?php $lib = $contrats['numero']?>
    <a href="javascript:void(0);"  onclick="visualiser('Reçu','<?php echo e($lib); ?>','<?php echo e($numero_recu); ?>')"  class='btn btn-default btn-xs' title="Imprimer la facture" >
        <i class="fa fa-print"></i>
    </a>
    
</div>
<?php echo Form::close(); ?>

<?php /**PATH D:\laravel_projet\projet\bkzed\resources\views/versements/datatables_actions.blade.php ENDPATH**/ ?>