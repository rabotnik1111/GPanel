<ul class="nav nav-tabs" id="iconsTab">
    <li class="active">
        <a href="#ganeral" data-toggle="tab">Ganeral</a>
    </li>
    <?php foreach ($langs as $lang) { ?>
        <li>
            <a href="#lang<?= $lang['id']; ?>" data-toggle="tab">Lang: <?= $lang['name']; ?></a>
        </li>
    <?php } ?>
    <li>
        <a href="#files" data-toggle="tab">Files</a>
    </li>
</ul>

<form action='<?= base_url(); ?>pages/save/<?= $page['id']; ?>' method='post'>
    <div class="tab-content">
        <div class="tab-pane active" id="ganeral">
            <table class="table">
                <tr>
                    <td>Parent:</td>
                    <td>
                        <select name="general[parent]" class='form-control'>
                            <?= tree_option($tree, $page['parent']); ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Enabled:</td>
                    <td>
                        <div class="make-switch">
                            <input name='general[enabled]' type="checkbox" <?= $page['enabled'] ? 'checked' : ''; ?>>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <?php foreach ($langs as $lang) { ?>
            <div class="tab-pane" id="lang<?= $lang['id']; ?>">
                <table class="table">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type='text' name='lang[<?= $lang['id']; ?>][title]' class='form-control' value='<?= $page['langs'][$lang['id']]['title']; ?>'/>
                        </td>
                    </tr>
                    <tr>
                        <td>Text:</td>
                        <td>
                            <textarea class='form-control' name='lang[<?= $lang['id']; ?>][text]'><?= $page['langs'][$lang['id']]['text']; ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>
        <?php } ?>
        <div class="tab-pane" id="files">
            <?=$this->load->view('pages/file/upload_files',array('module_name'=>'page','module_id'=>$page['id']));?>
        </div>
    </div>


    <br>
    <input type='submit' class='btn btn-success margin-top pull-right'/>
    <div class='clearfix'></div>
</form>