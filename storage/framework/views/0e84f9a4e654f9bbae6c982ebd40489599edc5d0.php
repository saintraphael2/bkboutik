
<?php echo Form::open(['route' => ['tableau_armortissements.destroy', $id], 'method' => 'delete']); ?>

<div class='btn-group'>
    <?php if(\Carbon\Carbon::parse($datprev)->lte(\Carbon\Carbon::now())): ?>
    <div class="icheck-success d-inline arrieres">
    <?php else: ?>
    <div class="icheck-success d-inline">
    <?php endif; ?>
  
        <input type="checkbox" id="amortissement_<?php echo e($id); ?>" name="amortissements[<?php echo e($id); ?>]" data-id="<?php echo e($id); ?>" data-montant="<?php echo e($montant); ?>" value="<?php echo e($montant); ?>" class="amortissement" onclick="validateAmortissement('<?php echo e($id); ?>', '<?php echo e($montant); ?>','<?php echo e($solde); ?>')">
        <!-- <input type="checkbox" id="amortissement<?php echo e($id); ?>" name="amortissement" data-id="<?php echo e($id); ?>" data-montant="<?php echo e($montant); ?>" class="amortissement"> -->
        <label for="amortissement_<?php echo e($id); ?>">
            À Payer
        </label>
    </div>

    <!-- <a href="<?php echo e(route('tableau_armortissements.edit', $id)); ?>" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    <?php echo Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('Etes- vous sûr?').'")'

    ]); ?> -->
</div>
<?php echo Form::close(); ?>

<?php /**PATH D:\laravel_projet\bkzedsarl\resources\views/tableau_armortissements/datatables_actions.blade.php ENDPATH**/ ?>