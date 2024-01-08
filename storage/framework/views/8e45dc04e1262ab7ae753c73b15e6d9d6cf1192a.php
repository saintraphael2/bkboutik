<?php echo Form::open(['route' => ['typeContrats.destroy', $id], 'method' => 'delete']); ?>

<div class='btn-group'>
    
    <a href="<?php echo e(route('typeContrats.edit', $id)); ?>" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    <?php echo Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('Etes- vous sûr?').'")'

    ]); ?>

</div>
<?php echo Form::close(); ?>

<?php /**PATH D:\laravel_projet\bkzedsarl\resources\views/type_contrats/datatables_actions.blade.php ENDPATH**/ ?>