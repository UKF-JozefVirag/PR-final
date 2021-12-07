<!DOCTYPE html>
<html lang="en">

<?php include_once "parts/header.php"; ?>

<body>

<?php
include_once "nav.php";
$hider = 0;
if (isset($db)) {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = 1;
    }

    if (isset($_GET['upidtask'])) {
        $upidtask = $_GET['upidtask'];
        $updatedTask = $db->getTask($upidtask);

        $temp = explode(" ", $updatedTask['due_date']);
        $date = $temp[0];
        $time = $temp[1];

        $hider = 1;
    }

    $tasks = $db->getTasks($id);


} else {
    $db = new stdClass();
    $tasks = [];
}
?>
<div class="main">
    <input id="hider" type="hidden" value="<?php echo $hider ?>">
    <div class="container col-6">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered text-center" id="Table">
                    <div class="text-center m-5">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                            Add
                            new task
                        </button>
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">New Task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="addtask.php" method="POST">
                                            <input type="hidden" name="list_id" value="<?php echo $id; ?>">
                                            <div class="mb-3">
                                                <label class="form-label required">Description</label>
                                                <input type="text" class="form-control" name="task_description">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Due Date</label>
                                                <input type="date" class="form-control" name="task_date">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Due Time</label>
                                                <input type="time" class="form-control" name="task_time">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary" name="newtask">Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal" id="myModal2">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="update-task-modal.php" method="POST" onsubmit="">
                                            <input type="hidden" name="ulist_id" value="<?php echo $_GET['id']; ?>">
                                            <input type="hidden" name="utask_id" value="<?php echo $upidtask; ?>">
                                            <div class="mb-3">
                                                <label class="form-label required">Description</label>
                                                <input type="text" class="form-control" name="utask_description"
                                                       value="<?php echo $updatedTask['description'] ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Due Date</label>
                                                <input type="date" class="form-control" name="utask_date"
                                                       value="<?php echo $date; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label required">Due Time</label>
                                                <input type="time" class="form-control" name="utask_time"
                                                       value="<?php echo $time; ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" id="modal2submit" class="btn btn-primary" name="newtask">Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <thead>
                    <tr>
                        <th scope="col">Task name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Due date</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php

                    $i = 0;
                    foreach ($tasks as $task) {
                        include "parts/task.php";
                        $i++;
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        type="text/javascript"></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js></script>
<script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap4.min.js></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function () {
        $('#Table').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 20, 50, 100, 200]
        });

        $("select[id^=status-]").each(function () {
            $(this).change(function () {
                let selectId = $(this).attr('id');
                let tmpArray = selectId.split('-');
                let idTask = tmpArray[1];

                let selectedValue = $(this).val();
                $.ajax({
                    type: "POST",
                    url: 'update-task-status.php',
                    data: {
                        id: idTask,
                        status: selectedValue
                    },
                    success: function (response) {
                        console.log(selectedValue);
                    }
                });
            });

        });

        let hider = $('#hider');
        if (hider.val() != "0") $("#myModal2").modal('show');

        $('#modal2submit').submit(function(e) {
            e.preventDefault();
            $('#myModal2').modal('hide'); //or  $('#IDModal').modal('hide');
            return false;
        });

    });
</script>

</body>

</html>