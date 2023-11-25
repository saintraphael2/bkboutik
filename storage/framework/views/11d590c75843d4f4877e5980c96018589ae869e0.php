<?php echo Form::open(['route' => ['contrats.destroy', $id], 'method' => 'delete']); ?>

<div class='btn-group'>
<a href="javascript:void(0);"  onclick="visualiser_conduteur('Carte','<?php echo e($conducteur); ?>')"  class='btn btn-default btn-xs' title="Visualiser">
        <i class="fa fa-eye"></i>
    </a>
</div>
<?php echo Form::close(); ?>

<?php /**PATH D:\laravel_projet\projet\bkzed\resources\views/etats/arrieres_datatables_actions.blade.php ENDPATH**/ ?>