
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <header>
                <h5>Article</h5>
            </header>
            <div class="body">

                <ul class="nav nav-tabs" id="iconsTab">
                    <li class="active">
                        <a href="#general" data-toggle="tab">General</a>
                    </li>

                    <?php foreach ($langs as $k => $lang) { ?>
                        <li>
                            <a href="#lang<?= $lang['id']; ?>" data-toggle="tab">Lang: <?= $lang['name']; ?></a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="#files" data-toggle="tab">Files</a>
                    </li>
                </ul>

                <form action='<?= base_url(); ?>articles/save/<?= isset($article['id']) ? $article['id'] : ""; ?>' method='post'>
                    <div class="tab-content">
                        <div class="tab-pane active" id="general">
                            <table class="table">
                                <tr>
                                    <td style="width:30%;">Category:</td>
                                    <td>
                                        <select name='general[category_id]' class='form-control'>
                                            <?= tree_option($categories, $article['category_id']); ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php if (isset($article)) { ?>
                                    <tr>
                                        <td>Date:</td>
                                        <td>

                                            <div class="input-group">
                                                <input type='text' name='general[date_created]' class='form-control' value='<?= isset($article['date_created']) ? $article['date_created'] : ""; ?>'/>
                                                <span class="input-group-addon">YYYY-MM-DD HH:MM:SS</span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <?php foreach ($langs as $k => $lang) { ?>
                            <div class="tab-pane" id="lang<?= $lang['id']; ?>">
                                <table class="table">
                                    <tr>
                                        <td>Title:</td>
                                        <td>
                                            <input type='text' name='lang[<?= $lang['id']; ?>][title]' class='form-control' value='<?= isset($article['langs'][$lang['id']]['title']) ? $article['langs'][$lang['id']]['title'] : ""; ?>'/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Text:</td>
                                        <td>
                                            <textarea class='form-control  ckeditor' name='lang[<?= $lang['id']; ?>][text]'><?= isset($article['langs'][$lang['id']]['text']) ? $article['langs'][$lang['id']]['text'] : ""; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Enabled:</td>
                                        <td>
                                            <div class="make-switch">
                                                <input name='lang[<?= $lang['id']; ?>][enabled]' type="checkbox" <?= isset($article['langs'][$lang['id']]['enabled']) && $article['langs'][$lang['id']]['enabled'] ? 'checked' : ''; ?>>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>
                        <div class="tab-pane" id="files">
                            <?php if (isset($article)) { ?>
                                <?= $this->load->view('pages/file/upload_files', array('module_name' => 'page', 'module_id' => $article['id'])); ?>
                            <?php } else { ?>
                                Please create article
                            <?php } ?>
                        </div>
                    </div>


                    <br>
                    <input type='submit' class='btn btn-success margin-top pull-right' value="Trimite"/>
                    <?php if (isset($article)) { ?>
                        <a href='<?= base_url(); ?>articles/cdelete/<?= $article['id']; ?>' style='margin-right: 10px;' class='btn btn-danger pull-right'>Sterge</a>
                    <?php } ?>
                    <div class='clearfix'></div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- /.row -->