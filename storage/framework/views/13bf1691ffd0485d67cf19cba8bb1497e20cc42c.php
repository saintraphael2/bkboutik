<?php echo Form::open(['route' => ['conducteurs.destroy', $id], 'method' => 'delete']); ?>

<div class='btn-group'>
     
    <a href="<?php echo e(route('contrats.create',[ 'conducteur' => $id])); ?>" class='btn btn-default btn-xs' title="créer un contrat">
        <i class="fa fa-file-signature"></i>
    </a>

    <a href="<?php echo e(route('conducteurs.edit', $id)); ?>" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    <a href="javascript:void(0);"  onclick="visualiser_conduteur('Carte','<?php echo e($id); ?>')"  class='btn btn-default btn-xs' title="Visualiser">
        <i class="fa fa-eye"></i>
    </a>
    <?php echo Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('Etes- vous sûr?').'")'

    ]); ?>

</div>
<?php echo Form::close(); ?>

<?php /**PATH D:\laravel_projet\bkzedsarl\resources\views/conducteurs/datatables_actions.blade.php ENDPATH**/ ?>