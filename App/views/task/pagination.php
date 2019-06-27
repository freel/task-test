<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php if ($page > 1) { ?>
            <li class="page-item"><a class="page-link" href="<?php echo $page - 1 ?>">Previous</a></li>
            <li class="page-item"><a class="page-link" href="<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li>
        <?php } ?>
        <li class="page-item active"><a class="page-link" href="<?php echo $page ?>"><?php echo $page ?></a></li>
        <?php if ($page < $pages_count) { ?>
            <li class="page-item"><a class="page-link" href="<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li>
            <li class="page-item"><a class="page-link" href="<?php echo $page + 1 ?>">Next</a></li>
        <?php } ?>
    </ul>
</nav>
