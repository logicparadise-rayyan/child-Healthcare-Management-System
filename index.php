<?php require_once('./config.php'); ?>
 <!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<style>

  #header{
    height:70vh;
    width:calc(100%);
    position:relative;

  }
  #header:before{
    content:"";
    position:absolute;
    height:calc(100%);
    width:calc(100%);
    background-image:url(<?= validate_image($_settings->info("cover")) ?>);
    background-size:cover;
    background-repeat:no-repeat;
    background-position: center center;
  }
  #header>div{
    position:absolute;
    height:calc(100%);
    width:calc(100%);
    z-index:2;
  }

  #top-Nav a.nav-link {
      color: #ffffff;
  }
  #top-Nav a.nav-link.active {
      color: #ffffff;
      font-weight: 900;
      position: relative;
  }
  #top-Nav a.nav-link.active:before {
    content: "";
    position: absolute;
    border-bottom: 2px solid #ffffff;
    width: 50%;
    left: 23.33%;
    bottom: 0;
  }
  .btn-light {
      color: var(--sidebar-bg-color)!important;
      background-color: #f8faf800!important;
      border-color:  var(--sidebar-bg-color)!important;
      box-shadow: none!important;
  }
  .btn-light:hover {
      color:var(--dk-gray-200)!important;
      background-color:  var(--sidebar-bg-color)!important;
      border-color:  var(--dk-gray-200)!important;
      box-shadow: none!important;
  }
    .bg-site{
        background-color: var(--dk-darker-bg) !important;
    }
    .bg-compo{
        background-color: var(--dk-dark-bg) !important;
    }
  .fr-color{
      color: var(--dk-gray-400) !important;
  }
  .fr-head-color{
      color: var(--dk-gray-200) !important;
  }
  .bg-navbar{
      background-color: var(--sidebar-bg-color) !important;
  }
</style>
<script>
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }
</script>
<?php require_once('inc/header.php') ?>
  <body class="layout-top-nav layout-fixed layout-navbar-fixed" style="height: auto; background-color: var(--dk-darker-bg)">
    <div class="wrapper">
     <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>
     <?php require_once('inc/topBarNav.php') ?>
     <?php if($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
      </script>
      <?php endif;?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper bg-site" style="">
        <?php if($page == "home" || $page == "about_us"): ?>
          <div id="header" class="shadow ">
              <div class="d-flex justify-content-center h-100 w-100 align-items-center flex-column px-3">
                  <a href="./?page=programs" class="btn btn-lg btn-light rounded-pill w-25" id="enrollment"><b>Our Services</b></a>
              </div>
          </div>
        <?php endif; ?>
        <!-- Main content -->
        <section class="content ">
          <div class="container">
            <?php
              if(!file_exists($page.".php") && !is_dir($page)){
                  include '404.html';
              }else{
                if(is_dir($page))
                  include $page.'/index.php';
                else
                  include $page.'.php';

              }
            ?>
          </div>
        </section>
        <!-- /.content -->
  <div class="modal fade rounded-0" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header rounded-0">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body rounded-0">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade rounded-0 " id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md  modal-dialog-centered rounded-0" role="document">
      <div class="modal-content bg-compo fr-head-color rounded-0">
        <div class="modal-header rounded-0">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body rounded-0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade  rounded-0" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content ">
        <div class="modal-header rounded-0">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body  rounded-0">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
      </div>
      <!-- /.content-wrapper -->
      <?php require_once('inc/footer.php') ?>
  </body>
</html>
