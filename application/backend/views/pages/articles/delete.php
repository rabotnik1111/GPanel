<div class="col-lg-12">
    <h3>Confirmare stergere articol</h3>
    <br>

    <?php if (isset($article['id'])) { ?>
        Urmati sa stergati articolul <b>#<?= $article['id']; ?></b>,<br>
    <?php } else { ?>
        Pagina data nu exista
    <?php } ?>

    <?php if (isset($article_lang)) { ?>
        <br>
        ce continea limbile:<br>
        <?php foreach ($article_lang as $itm) { ?>
        <a target='_blank' href='/news/view/<?= $itm['uri']; ?>'><i>#<?= $itm['id']; ?> <?= $itm['title']; ?></i></a><br>
        <?php } ?>
    <?php } ?>

    <?php if (isset($files)) { ?>
        <br>
        respectiv vor fi sterse si fisierele:<br>
        <?php foreach ($files as $itm) { ?>
             <a target='_blank' href='<?= $itm['path']; ?>'><i>#<?= $itm['id']; ?> <?= $itm['path']; ?></i></a><br>
        <?php } ?>
    <?php } ?>

    <?php if (isset($article['id'])) { ?>
    <br>
    <br>
    <i>Va asumati responsabilitatea de a sterge aceste materiale de pe site?</i><br>
    <a href='<?= base_url(); ?>articles/form/<?=$article['id'];?>' class='btn btn-success'>Renunta</a>
    <a href='<?= base_url(); ?>articles/delete/<?=$article['id'];?>' class='btn btn-warning'>Da, sterge difinitiv</a>
    <?php } ?>
</div>