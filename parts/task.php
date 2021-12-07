<?php

if (!isset($task))
{
    $task = [];
}

if (!isset($i))
{
    $i = 0;
}

if (!isset($db))
{
    $db = new stdClass();
}

?>

<tr>
    <input type="hidden" value="<?php echo $task['idtask'];?>">
    <td><?php echo $task['description']; ?></td>
    <td>
        <select class="form-select form-select-sm" aria-label="form-select-sm example" id="status-<?php echo $task['idtask'];?>">
            <option value="0" <?php echo $task['name'] == 'Not Started' ? ' selected' : '';?> >Not Started</option>
            <option value="1" <?php echo $task['name'] == 'In Progress' ? ' selected' : '';?> >In Progress</option>
            <option value="2" <?php echo $task['name'] == 'Completed' ? ' selected' : '';?> >Completed</option>
        </select>
    </td>
    <td><?php echo $task['due_date'];?></td>
    <td>
        <a href="update-task.php?idtask=<?php echo $task['idtask'] ;?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
        <a href="delete-task.php?idtask=<?php echo $task['idtask'] ;?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
    </td>
</tr>