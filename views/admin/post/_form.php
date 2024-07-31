<form method="POST">

    <?= $form->input('slug', 'URL') ?>
    <?= $form->input('title', 'Titre') ?>
    <?= $form->input('content', 'Contenu') ?>
    <?= $form->input('nom_de_code', 'nom de code') ?>
    <?= $form->input('agents', 'Nombre d\'agents') ?>
    <?= $form->input('cibles', 'Nombres de cibles') ?>
    <?= $form->input('contacts', 'Nombres de contacts') ?>
    <?= $form->input('date_debut', 'Date de debut') ?>
    <?= $form->input('date_fin', 'Date de fin') ?>
    <?= $form->select('types_mission', 'type de la mission', $types) ?>
    <?= $form->select('specialite', 'specialite requise pour la mission', $specialites) ?>
    <?= $form->select('statuts_id', 'Statuts de la mission', $statuts) ?>
    <?= $form->select('planque_id', 'Planque pour la mission', $planques) ?>




    <button class="btn btn-primary">
        <?php if ($item->getId() !== null) : ?>
            modifier
        <?php else: ?>
            Créer
        <?php endif ?>
    </button>
</form>