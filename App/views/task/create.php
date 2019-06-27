<?php require_once "App/views/layout/header.php" ?>

<div class="container">
    <?php if (isset($this->validation_errors)) {
        echo implode(",\n", $this->validation_errors);
    } ?>
    <form action="#" method="post">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php if (isset($name)) {
                echo $name;
            } ?>" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                   value="<?php if (isset($email)) {
                       echo $email;
                   } ?>" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="task">Text</label>
            <input type="text" class="form-control" id="task" name="task" value="<?php if (isset($task)) {
                echo $task;
            } ?>" placeholder="Task text">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php require_once "App/views/layout/footer.php" ?>
