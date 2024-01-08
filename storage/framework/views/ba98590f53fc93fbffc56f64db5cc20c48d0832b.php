<?php echo Form::open(['route' => ['contrats.destroy', $id], 'method' => 'delete']); ?>

<div class='btn-group'>
    <a href="<?php echo e(route('tableau_armortissements.index', ['contrat' => $id])); ?>" title="Afficher le tableau d'amortissement" class='btn btn-default btn-xs'>
        <i class="fa fa-table"></i>
    </a>
    <a href="<?php echo e(route('versements.create', ['contrat' => $id])); ?>" title="Facturation" class='btn btn-default btn-xs'>
        <i class="fa fa-file-invoice-dollar"></i>
    </a>
    <?php if($montant_total ==$solde): ?> 
    <a href="<?php echo e(route('contrats.edit', $id)); ?>" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a>
    <?php echo Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('Etes- vous sûr de supprimer ?').'")'

    ]); ?>

    <?php endif; ?>
    <?php if($actif): ?>
    <a href="<?php echo e(route('contrats.state', $id)); ?>" class='btn btn-warning btn-xs' onclick="return confirm('Etes- vous sûr de désactiver ?')">
        <i class="fa fa-ban"></i>
    </a>
    <?php endif; ?>
</div>
<?php echo Form::close(); ?>

<?php /**PATH D:\laravel_projet\bkzedsarl\resources\views/contrats/datatables_actions.blade.php ENDPATH**/ ?>