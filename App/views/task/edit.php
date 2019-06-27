<?php require_once "App/views/layout/header.php" ?>

<div class="container">
    <?php if (isset($this->validation_errors)) {
        echo implode(",\n", $this->validation_errors);
    } ?>
    <form action="#" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <h1 class="form-control"><?php echo $task_row['user'] ?></h1>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <h1 class="form-control" id="email"><?php echo $task_row['email'] ?></h1>
        </div>
        <div class="form-group">
            <label for="task">Text</label>
            <input type="text" class="form-control" id="task" name="task" value="<?php echo $task_row['task'] ?>"
                   placeholder="Task text">
        </div>
        <div class="form-group">
            <label for="select">Status</label>
            <select class="custom-select mr-sm-2" id="select" name="status">
                <?php foreach ($this->model->statuses as $key => $val) { ?>
                    <option value="<?php echo $key ?>" <?php if ($task_row['status'] == $key) echo "selected" ?>><?php echo $val ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php require_once "App/views/layout/footer.php" ?>
