<?php require_once "App/views/layout/header.php" ?>

<div class="container">
    <a href="task/create" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Add task</a>
    <?php require_once "App/views/task/sort.php" ?>
    <table class="table">
        <thead>
        <tr>
            <?php foreach (array_keys($list[0]) as $key) { ?>
                <th scope="col"><?php echo $key ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $row) { ?>
            <tr>
                <?php foreach ($row as $value) { ?>
                    <th scope="col"><?php echo $value ?></th>
                <?php } ?>
                <?php if (!\App\models\User::isGuest()) { ?>
                    <th scope="col"><a href="task/edit/<?php echo $row['id'] ?>">Edit</a></th>
                <?php } ?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php require_once "pagination.php" ?>
</div>

<?php require_once "App/views/layout/footer.php" ?>
