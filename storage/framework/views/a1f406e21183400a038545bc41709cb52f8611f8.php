<?php echo Form::open(['route' => ['vidanges.destroy', $id], 'method' => 'delete']); ?>

<div class='btn-group'>

<?php if($motos['prochaine_vidange'] ==$prochaine): ?> 

    <a href="<?php echo e(route('vidanges.edit', $id)); ?>" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    <?php echo Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('Etes- vous sûr?').'")'

    ]); ?>

    <?php endif; ?>
</div>
<?php echo Form::close(); ?>

<?php /**PATH C:\inetpub\wwwroot\bkzed\resources\views/vidanges/datatables_actions.blade.php ENDPATH**/ ?>