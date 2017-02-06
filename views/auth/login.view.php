<div class="col-xs-6 col-xs-offset-3">
    <div class="row">
        <div class="page-header">
            <h1>Login</h1>
        </div>
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <input type="email" name="email" class="form-control"  required placeholder="Email" value="<?php if(isset($email)) echo $email?>">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" required placeholder="Password">
            </div>
            <?php if(isset($errorMessage)) :?>
                <div class="alert alert-danger" role="alert"><?php echo $errorMessage ?></div>
            <?php endif ?>
            <button type="submit" name="singIn" class="btn btn-default">Sign in</button>
        </form>
        <p class="reg-account">Or <a href="/register"> register </a>a new account</p>
    </div>
</div>