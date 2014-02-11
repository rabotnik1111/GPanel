<div id="file-details-form">
    <input type="hidden" name="id" value="<?= $file['id']; ?>" />
    <table class='table table-bordered'>
        <tr>
            <th>Nume:</th>
            <td><input type="text" name="file[name]" value="<?= $file['name']; ?>" class="form-control" /></td>
        </tr>
    </table>
</div>