<div class="doctor_calender_bx">
    <table width="100%" id="ContentPlaceHolder1_dlDoctor" cellspacing="0" style="border-collapse:collapse;">
        <tbody>

            <?php
            $count=0;
            for ($i=1; $i<=3;$i++){
                ?>
                <tr>
                    <?php

                    for ($t=1; $t<=3; $t++)
                    {
                        $count++;
                        $date = date('d/m/Y', strtotime(date('Y-m-d'). ' +'.$count.' days'));

                        ?>
                        <td>
                            <div class="cal_info  ">
                                <div style="display: none">
                                    <span id="ContentPlaceHolder1_dlDoctor_lblId_0">4756</span>
                                    User Id
                                </div>
                                <div class="Date_b">
                                    Dated :
                                        <span id="ContentPlaceHolder1_dlDoctor_lbldate_0"><?=$date?></span>
                                </div>
                                <div class="Day_b">
                                    Day :
                                    <span id="ContentPlaceHolder1_dlDoctor_lblday_0"><?=date('l',strtotime(date('Y-m-d'). ' +'.$count.' days'))?></span>

                                </div>
                                <div class="appointment_btn">
                                    <div id="ContentPlaceHolder1_dlDoctor_Panel1_0">
                                        <div id="ContentPlaceHolder1_dlDoctor_Panel2_0">
                                            <a href="#" data-date="<?=date('Y-m-d', strtotime(date('Y-m-d'). ' +'.$count.' days'))?>" class="Appoint_doctor">Book Appointment</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <?php
                    }
                    ?>


                </tr>
            <?php
            }
            ?>



        </tbody></table>
    <div class="row">
        <div class="col-12 text-right">
            <button class="btn btn-flat btn-sm btn-dark" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        </div>
    </div>
</div>
<style>
    #confirm_modal{
        z-index: 11111;
    }
    .cal_info {
        background: #fff none repeat scroll 0 0;
        border-color: #eaeaea #eaeaea #afafaf;
        border-image: none;
        border-style: solid;
        border-width: 1px 1px 3px;
        box-shadow: 0 2px 5px rgb(0 0 0 / 10%);
        float: left;
        margin: 15px 0;
        padding: 25px 20px;
        position: relative;
        width: 100%;
    }
    .Date_b {
        background: #fff none repeat scroll 0 0;
        border-bottom: 3px solid #cdcdcd;
        color: #000;
        float: left;
        font-family: "Istok Web",sans-serif;
        font-size: 16px;
        height: 33px;
        padding: 4px 8px;
        position: absolute;
        text-align: center;
        top: -15px;
        width: 170px;
    }
    .Day_b {
        color: #000;
        float: left;
        font-family: "Istok Web",sans-serif;
        font-size: 16px;
        margin-top: 10px;
    }
    .appointment_btn {
        float: right;
        margin-right: 0;
        margin-top: 10px;
    }
    .appointment_btn a {
        background: #fff none repeat scroll 0 0;
        border: 1px solid #8fcec5;
        color: #2d9604;
        float: right;
        font-size: 14px;
        line-height: 26px;
        text-align: center;
        transition: all 300ms ease-out 0s;
        width: 133px;
    }
    #uni_modal .modal-footer{
        display:none !important;
    }

</style>
<script>
    var date=null;
    $('.Appoint_doctor').click(function(){
        date=($(this).attr('data-date'));
        _conf("Are you sure To Book Appointment on "+$(this).attr('data-date')+"  with <b>"+$(current).attr('data-name')+"</b> ?","Appoint_doctor",[$(current).attr('data-id')])
    });
</script>