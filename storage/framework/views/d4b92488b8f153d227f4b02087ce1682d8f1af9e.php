<?php echo Form::open(['route' => ['liens.destroy', $id], 'method' => 'delete']); ?>

<div class='btn-group'>
    <a href="<?php echo e(route('liens.show', $id)); ?>" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <a href="<?php echo e(route('liens.edit', $id)); ?>" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    <?php echo Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'

    ]); ?>

</div>
<?php echo Form::close(); ?>

<?php /**PATH C:\inetpub\wwwroot\bkzed\resources\views/liens/datatables_actions.blade.php ENDPATH**/ ?>