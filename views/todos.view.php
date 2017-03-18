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

<!-- Message container -->
<div class="container">
    <div class="alert margin20" id="message" style="display: none;" >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
</div>

<?php if($lists) :?>
<!-- Table sort -->
<div class="container">
    <div class="row margin20">
            <label>Sort by :</label>
            <select id="list-sort" onchange="listSort()">
                <option>Default</option>
                <option value="nameAsc">Name: <span> A-Z</span></option>
                <option value="nameDesc">Name: <span> Z-A</span></option>
                <option value="createdDesc">Created: <span> newest first</span></option>
                <option value="createdAsc">Created: <span> oldest first</span></option>
            </select>
        </div>
    </div>
</div>
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

