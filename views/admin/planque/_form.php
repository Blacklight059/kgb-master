<form method="POST">

    <?= $form->input('code', 'Code') ?>
    <?= $form->input('adresse', 'Adresse') ?>
    <?= $form->input('pays_id', 'Pays') ?>
    <?= $form->input('type_planque', 'Type de la planque') ?>

    <button class="btn btn-primary">
        <?php if ($item->getId() !== null) : ?>
            modifier
        <?php else: ?>
            Créer
        <?php endif ?>
    </button>
</form>