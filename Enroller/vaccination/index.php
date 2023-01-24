<style>
    table {
        width: 100%;
        border: 1px solid #e2e2e2;
        border-spacing: 0;
        border-collapse: collapse;
        background-color: #f3f3f3;
        font-size: 13px;
        font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    }
    th, td, caption {
        padding: 10px;
    }
    td:last-child {
        color: var(--blue);
        font-size: 1.6rem;
    }

    tr:nth-child(2n) {
        background-color: #ebebeb;

    }

</style>


<?php
$id= $_settings->EnrollerData('id');
if(!empty($id)){
    $qry = $conn->query("SELECT * from `enrollment_list` where id = '{$id}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
                $$k = $v;
        }
        $meta_qry = $conn->query("SELECT * FROM `enrollment_details` where enrollment_id = '{$id}'");
        if($meta_qry->num_rows > 0){
            while($row = $meta_qry->fetch_assoc()){
                ${$row['meta_field']} = $row['meta_value'];
            }
        }
    }
}
       ?>

    <div class="container">
            <table cellspacing="0" cellpadding="0" class="report-content">
                <tbody>
                <tr>
                    <td>
                        <strong>Timing</strong>
                    </td>
                    <td>
                        <strong>Vaccination</strong>
                    </td>
                    <td>
                        <strong>Due Date</strong>
                    </td>
                    <td style="width: 100px; font-size: 1rem; color:black;">
                        <strong>status</strong>
                    </td>
                </tr>

                <tr>
                    <td>
                        Birth
                    </td>
                    <td>
                        BCG <br> OPV-0 <br> Hepatitis B-1
                    </td>
                    <td>
                        <?=date("d M Y",strtotime($child_dob))?>
                    </td>
                    <td>
                        <?= strtotime($child_dob) <= strtotime(date('y-m-d'))?'<i class="fas fa-check"></i>':'' ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        6 Weeks
                    </td>
                    <td>
                        DTwP-1 <br> OPV-1 <br> Hib-1 <br> Hepatitis-B-2 <br> PCV-1 <br> Rotavirus-1
                    </td>
                    <td>
                        <?=date("d M Y",strtotime($child_dob.' +6 weeks'))?>
                    </td>
                    <td>
                        <?= strtotime($child_dob.' +6 weeks') <= strtotime(date('y-m-d'))?'<i class="fas fa-check"></i>':'' ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        10 Weeks
                    </td>
                    <td>
                        DTwP-2 <br> OPV-2 <br> Hib-2 <br>PCV-2 <br> Rotavirus-2
                    </td>
                    <td>
                        <?=date("d M Y",strtotime($child_dob.' +10 weeks'))?>
                    </td>
                    <td>
                        <?= strtotime($child_dob.' +10 weeks') <= strtotime(date('y-m-d'))?'<i class="fas fa-check"></i>':'' ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        14 Weeks
                    </td>
                    <td>
                        DTwP-3 <br> OPV-3 <br> Hib-3 <br> Hepatitis-B-3 <br> PCV-3 <br> Rotavirus-3
                    </td>
                    <td>
                        <?=date("d M Y",strtotime($child_dob.' +14 weeks'))?>
                    </td>
                    <td>
                        <?= strtotime($child_dob.' +14 weeks') <= strtotime(date('y-m-d'))?'<i class="fas fa-check"></i>':'' ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        9 Month
                    </td>
                    <td>
                        OPV-4 <br> Measels-1
                    </td>
                    <td>
                        <?=date("d M Y",strtotime($child_dob.' +9 month'))?>
                    </td>
                    <td>
                        <?= strtotime($child_dob.' +9 month') <= strtotime(date('y-m-d'))?'<i class="fas fa-check"></i>':'' ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        12 Month
                    </td>
                    <td>
                        Hepatitis-A-1
                    </td>
                    <td>
                        <?=date("d M Y",strtotime($child_dob.' +12 month'))?>
                    </td>
                    <td>
                        <?= strtotime($child_dob.' +12 month') <= strtotime(date('y-m-d'))?'<i class="fas fa-check"></i>':'' ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        15 Month
                    </td>
                    <td>
                        PCV-Booster-1 <br> MMR-1 <br> Varicella-1
                    </td>
                    <td>
                        <?=date("d M Y",strtotime($child_dob.' +15 month'))?>
                    </td>
                    <td>
                        <?= strtotime($child_dob.' +15 month') <= strtotime(date('y-m-d'))?'<i class="fas fa-check"></i>':'' ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        16-18 Month
                    </td>
                    <td>
                        DTwP-Booster-1 <br> OPV-Booster-1 <br> Hib-Booster-1
                    </td>
                    <td>
                        <?=date("d M Y",strtotime($child_dob.' +16 month'))?>
                    </td>
                    <td>
                        <?= strtotime($child_dob.' +16 month') <= strtotime(date('y-m-d'))?'<i class="fas fa-check"></i>':'' ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        18 Month
                    </td>
                    <td>
                        Hepatitis-A-2
                    </td>
                    <td>
                        <?=date("d M Y",strtotime($child_dob.' +18 month'))?>
                    </td>
                    <td>
                        <?= strtotime($child_dob.' +18 month') <= strtotime(date('y-m-d'))?'<i class="fas fa-check"></i>':'' ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        2 Year
                    </td>
                    <td>
                        Typhoid-1
                    </td>
                    <td>
                        <?=date("d M Y",strtotime($child_dob.' +2 years'))?>
                    </td>
                    <td>
                        <?= strtotime($child_dob.' +2 years') <= strtotime(date('y-m-d'))?'<i class="fas fa-check"></i>':'' ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        5 Year
                    </td>
                    <td>
                        DTwP-Booster-2 <br> MMR-2 <br> Typhoid-2 <br> Varicella-2 <br> OPV-5
                    </td>
                    <td>
                        <?=date("d M Y",strtotime($child_dob.' +5 years'))?>
                    </td>
                    <td>
                        <?= strtotime($child_dob.' +5 years') <= strtotime(date('y-m-d'))?'<i class="fas fa-check"></i>':'' ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        10 Year
                    </td>
                    <td>
                        Tdap/Td <br> HPV
                    </td>
                    <td>
                        <?=date("d M Y",strtotime($child_dob.' +10 years'))?>
                    </td>
                    <td>
                        <?= strtotime($child_dob.' +10 years') <= strtotime(date('y-m-d'))?'<i class="fas fa-check"></i>':'' ?>
                    </td>
                </tr>

                <tr>
                    <td style="color: #575757; font-size: 13px;" colspan="3">
                        <div class="result">
                            <font color="#d5240f"><b>Glossary of Terms:</b></font><br>
                            <br>
                            BCG: Bacille Calmette Guerin. (Protects against Tuberculosis).<br>
                            <br>
                            Hib: Haemophilus influenzae type B (Protects against Brain Fever).<br>
                            <br>
                            DPwT (Diptheria, Pertusis, Tetanus).<br>
                            <br>
                            HPV: Human Pappilomavirus.<br>
                            <br>
                            MMR:Measels, Mumps, Rubella.<br>
                            <br>
                            OPV: Oral Polio Vaccine.<br>
                            <br>
                            PCV: Pneumococcal conjugate vaccine
                            <br><br>
                            Varicella: (Chickenpox)
                            <br><br>
                            TT: Tetanus Toxoid<br><br>
                            Tdap/Td: The Tdap is a "3-in-1" vaccine that protects against diphtheria, tetanus
                            (lockjaw), and pertussis (whooping cough. Td: Td is a "2-in-1"vaccine that protects
                            against tetanus and diphtheria.
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="color: #575757; font-size: 13px;"  colspan="3">
                        <div class="note">
                            <b>Note :</b> The above schedule is as advised by UIP and IAP. Please contact your
                            Doctor for exact dates of vaccination which may vary in some cases based on the
                            condition of the child and/or the date when the last vaccination was done.</div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

