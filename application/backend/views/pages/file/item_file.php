<tr>
    <td><a href="<?=$file['path'];?>" target="_blank"><?=$file['path'];?></a></td>
    <td><?=$file['type'];?></td>
    <td><?=$file['uploaded'];?></td>
    <td><a href='javascript:delete_file(<?=$file['id'];?>);'>[x]</a></td>
</tr>