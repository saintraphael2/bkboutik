<?php echo Form::open(['route' => ['motos.destroy', $id], 'method' => 'delete']); ?>

<div class='btn-group'>
    <!--a href="<?php echo e(route('motos.show', $id)); ?>" class='btn btn-default btn-xs' title="Vidange">
        <i class="fa fa-cog"></i>
    </a-->
    <a href="<?php echo e(route('contratsAssurance',['IdMoto'=>$id])); ?>" class='btn btn-default btn-xs' title="Assurance">
    <i class="fa-solid fa-file-contract"></i>
    </a>
    <a href="<?php echo e(route('motos.edit', $id)); ?>" class='btn btn-default btn-xs' title="Mise à jour">
        <i class="fa fa-edit"></i>
    </a>
    <?php echo Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('Etes- vous sûr?').'")'

    ]); ?>

</div>
<?php echo Form::close(); ?>

<?php /**PATH D:\laravel_projet\bkzedsarl\resources\views/motos/datatables_actions.blade.php ENDPATH**/ ?>