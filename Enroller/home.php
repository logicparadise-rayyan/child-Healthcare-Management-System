<h1>Welcome to <?php echo $_settings->info('name') ?></h1>
<hr class="border-info">
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-gradient-blue elevation-1">
                <i class="fas fa-user-md"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Pending Appointments</span>
                <span class="info-box-number text-right">
                <?php
                    $enroller=$_settings->EnrollerData("id");
                echo $conn->query("SELECT * FROM `appointment` where enroller_id= $enroller and status=1")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-gradient-success elevation-1">
                <i class="fas fa-user-md"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Accepted Appointments</span>
                <span class="info-box-number text-right">
                <?php
                $enroller=$_settings->EnrollerData("id");
                echo $conn->query("SELECT * FROM `appointment` where enroller_id= $enroller and status=2")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-gradient-danger elevation-1">
                <i class="fas fa-user-md"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Rejected Appointments</span>
                <span class="info-box-number text-right">
                <?php
                $enroller=$_settings->EnrollerData("id");
                echo $conn->query("SELECT * FROM `appointment` where enroller_id= $enroller and status=3")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-gradient-green elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Babysitters Hire List</span>
                <span class="info-box-number text-right">
                <?php
                echo $conn->query("SELECT * FROM `hire_babysitter` where enroller_id= $enroller")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>