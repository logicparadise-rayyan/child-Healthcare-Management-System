
<br>
<h1 class="fr-head-color">Government Schemes</h1>
<hr class="border-navy bg-navy">
<br>
<div class="container-fluid">
    <div class="row  justify-content-center">
        <div class="col-md-5">
            <div class="input-group mb-2">
                <input type="search" id="search" class="form-control bg-compo form-control-border fr-head-color" placeholder="Search Government Schemes here...">
                <div class="input-group-append">
                    <button type="button" class="btn btn-sm border-0 bg-compo border-bottom btn-default fr-head-color">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group" id="package-list">
    <?php 
        $package = $conn->query("SELECT * FROM `government_schemes` where `status` = 1 order by `name` asc");
        while($row = $package->fetch_assoc()):
    ?>
    <div class="text-decoration-none bg-compo list-group-item rounded-0 package-item">
        <a class="d-flex w-100 fr-head-color" href="#package_<?= $row['id'] ?>" data-toggle="collapse">
            <div class="col-11">
                <h3><b><?= ucwords($row['name']) ?></b></h3>
            </div>
            <div class="col-1 text-right">
                <i class="fa fa-plus collapse-icon"></i>
            </div>
        </a>
        <div class="collapse fr-color" id="package_<?= $row['id'] ?>">
            <hr class="border-navy">
            <p class="mx-3"><?= html_entity_decode($row['description']) ?></p>
        </div>
    </div>
    <?php endwhile; ?>
    <?php if($package->num_rows < 1): ?>
        <center><span class="text-muted">No package Listed Yet.</span></center>
    <?php endif; ?>
        <div id="no_result" style="display:none"><center><span class="text-muted">No Government Schemes Yet.</span></center></div>
    </div>
</div>
<script>
    $(function(){
        $('.collapse').on('show.bs.collapse', function () {
            $(this).parent().siblings().find('.collapse').collapse('hide')
            $(this).parent().siblings().find('.collapse-icon').removeClass('fa-plus fa-minus')
            $(this).parent().siblings().find('.collapse-icon').addClass('fa-plus')
            $(this).parent().find('.collapse-icon').removeClass('fa-plus fa-minus')
            $(this).parent().find('.collapse-icon').addClass('fa-minus')
        })
        $('.collapse').on('hidden.bs.collapse', function () {
            $(this).parent().find('.collapse-icon').removeClass('fa-plus fa-minus')
            $(this).parent().find('.collapse-icon').addClass('fa-plus')
        })

        $('#search').on("input",function(e){
            var _search = $(this).val().toLowerCase()
            $('#package-list .package-item').each(function(){
                var _txt = $(this).text().toLowerCase()
                if(_txt.includes(_search) === true){
                    $(this).toggle(true)
                }else{
                    $(this).toggle(false)
                }
                if($('#package-list .package-item:visible').length <= 0){
                    $("#no_result").show('slow')
                }else{
                    $("#no_result").hide('slow')
                }
            })
        })
    })
    
</script>
