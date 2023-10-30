<?php if (isset($_SESSION['success_msg'])) : ?>
    <div class="alert alert-success">
        <button type="button" aria-hidden="true" class="close">×</button>
        <?php
        echo $_SESSION['success_msg'];
        unset($_SESSION['success_msg']);
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error_msg'])) : ?>
    <div class="alert alert-warning">
        <button type="button" aria-hidden="true" class="close">×</button>
        <?php
        echo $_SESSION['error_msg'];
        unset($_SESSION['error_msg']);
        ?>
    </div>
<?php endif; ?>

<!-- 
<div class="alert alert-success">
    <button type="button" aria-hidden="true" class="close">×</button>
    <span><b> Success - </b> This is a regular notification made with ".alert-success"</span>
</div>
<div class="alert alert-warning">
    <button type="button" aria-hidden="true" class="close">×</button>
    <span><b> Warning - </b> This is a regular notification made with ".alert-warning"</span>
</div> -->