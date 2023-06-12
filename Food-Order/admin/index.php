<?php include('partials/menu.php'); ?>

<!-- Main Section Start -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login']; //Display Session Message
            unset($_SESSION['login']); //Remove Session Message
        }
        ?>
        <div class="col-4 text-center">
            <h1>5</h1>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            Categories
        </div>
        <div class="col-4 text-center">
            <h1>5</h1>
            Categories
        </div>
        <div class="clearfix">

        </div>
    </div>
</div>
<!-- Main Section End -->

<?php include('partials/footer.php'); ?>