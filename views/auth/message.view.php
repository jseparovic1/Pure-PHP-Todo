<div class="container text-center">

    <?php if (isset($message)): ?>
        <div class="row bg-success" role="alert"> <?= $message ?> </div>
    <?php else: ?>
        <div class="row bg-danger" role="alert"> <?= $messageError ?> </div>
    <?php endif;?>

    <p>Return to <a href="/"> homepage</a><p>
</div>
