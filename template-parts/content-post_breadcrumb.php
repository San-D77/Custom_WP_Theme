<?php
    $categories = get_the_category();
    $parent_cat = get_category_parents($categories[0]->term_id, true, ' &raquo ');
    $parent_cat = trim($parent_cat,' &raquo;')
?>

<div class="bc">
    <ul class="breadcrumb-container">
        <li class="breadcrumb">
            <a href="/"
                >
                Home 
            </a>&raquo;
        </li>
        <li class="breadcrumb">
            <a href="<?php  ?>/"
                class="text-uppercase">
                <?php echo $parent_cat; 
                ?>
            </a>
        </li>
    </ul>

</div>