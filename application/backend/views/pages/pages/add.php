<div>
    <form method="post" action="<?=base_url();?>pages/add">
        <input type="text" class="form-control" name="name" placeholder="Page name"/><br>
        
        <select name="parent" class="form-control">
            <?=tree_option($tree);?>
        </select><br>
        <input type="submit" class="btn btn-success btn-sm pull-right" />
    </form>
</div>