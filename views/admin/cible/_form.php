<form method="POST">
    
    <?= $form->input('name', 'NOM') ?>
    <?= $form->input('firstname', 'Prénom') ?>    
    <?= $form->input('nom_de_code', 'Nom de code') ?>
    <?= $form->input('date_naissance', 'Date de naissance') ?>
    <?= $form->input('nationalite_id', 'Id de nationalité') ?>
    <?= $form->select('mission_id', 'Id de la mission', $missions) ?>


    <button class="btn btn-primary">
        <?php 
        if ($item->getId() !== null) : ?>
            modifier
        <?php else: ?>
            Créer
        <?php endif ?>
    </button>
</form>