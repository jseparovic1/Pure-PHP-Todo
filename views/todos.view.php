<section id="add-list">
    <div class="container add-list">
        <div class="row">
            <form class="form-inline" method="post">
                <div class="form-group col-lg-12 col-md-12 col-xs-12">
                    <input class="form-control" type="text" name="listName"  id="listName" placeholder="Enter list name here">
                    <button class="btn btn-primary form-control" type="submit" name="createList" >CREATE LIST</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php if($lists) :?>
<section id="list-sort">
    <div class="container">
        <div class="row">
            <span class="glyphicon glyphicon glyphicon-sort-by-alphabet" id="sort-icon-asc" aria-hidden="true"></span>
            <span class="glyphicon glyphicon glyphicon-sort-by-alphabet-alt" id="sort-icon-desc" aria-hidden="true"></span>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="main-list">
    <div class="container">
        <div class="row">
            <div id="list-container">
                    <?php
                        if($lists)
                            require 'templates/list.php';
                        else
                            echo "<p>No todo lists yet :( </p>";
                    ?>
            </div>
        </div>
    </div>
</section>

