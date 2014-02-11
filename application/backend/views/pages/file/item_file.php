<tr>
    <td>
        <?php if ($file['type'] == 'image') { ?>
            <img src="<?= $file['path']; ?>" style="width: 35px; max-height: 25px;" />
        <?php } elseif ($file['type'] == 'pdf') { ?>
            <img src="<?= $file['thumb_path']; ?>" style="width: 35px; max-height: 25px;" />
        <?php } ?>
        <a href="<?= $file['path']; ?>" target="_blank"><?= $file['name'] ? $file['name'] : $file['path']; ?></a>
    </td>
    <td>
<center>
    <a href="javascript:;" class='file-move' data-id='<?= $file['id']; ?>' data-dir='0'><i class="icon-chevron-up"></i></a> 
    <button class="btn btn-primary btn-xs open-file-datails" style='margin:0 10px;' data-id="<?= $file['id']; ?>" data-toggle="modal" data-target="#file-details">Detalii fisier</button>
    <a href="javascript:;" class='file-move' data-id='<?= $file['id']; ?>' data-dir='1'><i class="icon-chevron-down"></i></a>
</center>
</td>
<td><?= $file['type']; ?> <?php if (isset($file['category_name'])) { ?>(<?= $file['category_name']; ?>)<?php } ?></td>
<td><?= $file['uploaded']; ?></td>
<td><a href='javascript:delete_file(<?= $file['id']; ?>);'>[x]</a></td>
</tr>