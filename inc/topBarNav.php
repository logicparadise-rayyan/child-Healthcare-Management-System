<style>
    :root{
        --last-position:0px;
        --last-width:0px;
    }
</style>
<script>
    document.documentElement.style.setProperty('--last-position', getCookie('lastposition')+'px');
    document.documentElement.style.setProperty('--last-width', getCookie('lastwidth')+'px');
</script>
<nav class="navbar navbar-expand-custom navbar-mainbg bg-navbar">
    <a href="./" class="navbar-brand navbar-logo" style="height: 60px"  >
        <img style="height: 100%;opacity: .8;" src="<?php echo validate_image($_settings->info('logo'))?>" alt="Site Logo" class="brand-image img-circle elevation-3" >
        <span><?= $_settings->info('short_name') ?></span>
    </a>
    <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars text-white"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
            <li class="nav-item <?= isset($page) && $page =='home' ? "active" : "" ?>">
                <a href="./" class="nav-link " title="Home"><i class="fas fa-home"></i>Home</a>
            </li>
            <li class="nav-item <?= isset($page) && $page =='programs' ? "active" : "" ?>">
                <a class="nav-link " href="./?page=programs" title="Programs"><i class="fas fa-tasks"></i>Programs</a>
            </li>
            <li class="nav-item <?= isset($page) && $page =='doctors' ? "active" : "" ?>">
                <a class="nav-link" href="./?page=doctors" title="Doctors"><i class="fas fa-user-md"></i>Doctors</a>
            </li>
            <li class="nav-item <?= isset($page) && $page =='babysitters' ? "active" : "" ?>">
                <a class="nav-link " href="./?page=babysitters" title="BabySitters"><i class="fas fa-baby-carriage"></i>BabySitters</a>
            </li>
            <?php if(!$_settings->EnrollerData('id') > 0): ?>
                <li class="nav-item <?= isset($page) && $page =='enrollment' ? "active" : "" ?>">
                    <a class="nav-link" href="./?page=enrollment" title="Enrollment"><i class="fas fa-id-card"></i>Enrollment</a>
                </li>
            <?php endif; ?>
            <li class="nav-item <?= isset($page) && $page =='about' ? "active" : "" ?>">
                <a class="nav-link" href="./?page=about" title="About Us"><i class="fas fa-info-circle"></i>About Us</a>
            </li>
            <li class="nav-item <?= isset($page) && $page =='disease-detection' ? "active" : "" ?>">
                <a class="nav-link" href="./?page=disease-detection" title="Disease Detection"><i class="fas fa-hand-holding-medical"></i>Disease</a>
            </li>
            <li class="nav-item <?= isset($page) && $page =='government-schemes' ? "active" : "" ?>">
                <a class="nav-link" href="./?page=government-schemes" title="Govt Schemes"><i class="fas fa-building"></i>Schemes</a>
            </li>
            <li class="nav-item <?= isset($page) && $page =='Meal-plan-Generator' ? "active" : "" ?>">
                <a class="nav-link" href="./?page=Meal-plan-Generator" title="Meal Plan Generator"><i class="fas fa-utensils"></i>Meal Plan</a>
            </li>

            <li style="display: flex; align-items: center" class="nav-item ml-5 mr-1">
                <?php if($_settings->EnrollerData('id') > 0): ?>
                    <span >
                      <a title="Profile" href="./enroller" class="p-0 text-light">
                          <img src="<?= validate_image($_settings->EnrollerData('avatar')) ?>" alt="User Avatar" id="student-img-avatar">
                      </a>
                    </span>
                    <span class="text-light mx-1"><?= !empty($_settings->EnrollerData('username')) ? $_settings->EnrollerData('username') : "" ?></span>
                    <span class="">
                      <a class="p-0" title="Logout" href="<?= base_url.'classes/Login.php?f=enrollerlogout' ?>">
                          <i class="fa fa-power-off"></i>
                      </a>
                  </span>
                <?php else: ?>
                    <a href="./enroller" class="text-light">
                        Login <i class="fas fa-sign-in-alt"></i>
                    </a>
                <?php endif; ?>
            </li>
        </ul>
    </div>

</nav>
<link rel="stylesheet" href="<?=base_url?>dist/css/header.css">
<script defer src="<?=base_url?>dist/js/header.js"></script>