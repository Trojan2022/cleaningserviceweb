
<nav class="navbar navbar-expand-lg bg-white navbar-light p-0">
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto py-0">
            <a href="index.php" class="nav-item nav-link active">Home</a>
            <a href="about.php" class="nav-item nav-link">About</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Services</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="Transportation.php" class="dropdown-item">transportation Service</a>
                    <a href="CleaningService.php" class="dropdown-item">Cleaning Service</a>
                </div>
            </div>
            <a href="?feedback" class="nav-item nav-link">Feedback</a>
            <?php if(isset($_GET['feedback']))
            { echo "<script> alert('If you want to give feedback, Do booking First!');</script>"; } ?>
            <a href="Contact.php" class="nav-item nav-link">Contact</a>
        </div>
        <?php if (isset($_SESSION['cusID'])) { ?>
                <a href="CustomerProfile.php" class="btn btn-info mr-3">Profile</a>
        <?php } else { ?>
                <a href="LoginCustomer.php" class="btn mr-3" style="background-color: deepskyblue; font-weight:bolder;">Log In</a>
        <?php } ?>
    </div>
</nav>