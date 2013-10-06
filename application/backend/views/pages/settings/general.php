<div class="col-lg-12">
    <form action="<?= base_url(); ?>settings/save" method="post">
        <table class="table">
            <tr>
                <td>Title</td>
                <td>
                    <input class="form-control" type="text" name="settings[title]" value="<?= isset($settings['title']) ? $settings['title'] : ''; ?>"/>
                </td>
            </tr>
            <tr>
                <td>Description</td>
                <td>
                    <input class="form-control" type="text" name="settings[description]" value="<?= isset($settings['description']) ? $settings['description'] : ''; ?>"/>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input class="form-control" type="text" name="settings[email]" value="<?= isset($settings['email']) ? $settings['email'] : ''; ?>"/>
                </td>
            </tr>
        </table>
        <input type="submit" class="btn btn-success pull-right" /><br><br>
    </form>
</div>