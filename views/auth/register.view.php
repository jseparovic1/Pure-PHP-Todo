<div class="col-xs-6 col-xs-offset-3">
    <div class="row">
        <div class="page-header">
            <h1>Register</h1>
        </div>
        <?php
            if (isset($errorMessage)){
                foreach ($errorMessage as $error) {
                    echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
                }
            }
        ?>
        <form class="form-horizontal" method="post" action="">
            <div class="form-group">
                <input type="email" name="email" class="form-control" required placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control"  required placeholder="Password(minimum 3 characters)">
            </div>
            <div class="form-group">
                <input type="text" name="firstName" class="form-control " required placeholder="First name">
            </div>

            <div class="form-group">
                <input type="text" name="lastName" class="form-control " required placeholder="Last Name">
            </div>
            <button type="submit" class="btn btn-default">Register</button>
        </form>
        <p class="form-helptext">Or <a href="/"> log in </a></p>
    </div>
</div>
