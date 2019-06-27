<?php require_once "App/views/layout/header.php" ?>

<div class="container text-center">
    <?php if (isset($this->validation_errors)) {
        echo implode(",\n", $this->validation_errors);
    } ?>
    <form class="form-signin" action="#" method="post">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="name" class="sr-only">Username</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Username" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password"
               required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">©2019</p>
    </form>
</div>

<?php require_once "App/views/layout/footer.php" ?>
