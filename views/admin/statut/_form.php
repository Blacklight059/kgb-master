<form method="POST">
    
    <?= $form->input('name', 'Statut de la mission') ?>



    <button class="btn btn-primary">
        <?php 
        if ($item->getId() !== null) : ?>
            modifier
        <?php else: ?>
            Créer
        <?php endif ?>
    </button>
</form>