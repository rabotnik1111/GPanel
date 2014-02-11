<div class="center_content" style="width:100%" >
    <form action="<?=base_url();?>vars/save_lang" method="post">
        <?php foreach ($langs as $lang) { ?>
        <b><?=$lang['lang'];?>:</b>
        <input type="hidden" name="langs[<?=$lang['lang_id'];?>][id]" value="<?=$lang['id'];?>" />
        <textarea class="form-control" name="langs[<?=$lang['lang_id'];?>][value]"><?=$lang['value'];?></textarea>
        <br>
        <?php } ?>

        <input type="submit" value="Salveaza" class="btn btn-success" />
    </form>  
</div>
