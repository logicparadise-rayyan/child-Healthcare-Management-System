<style>
    .content-wrapper{
        background-color: #2a2b3d;
    }
    .pane{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .meal-plane-chart{
        background-color: #313348;
        min-width: 100%;
        padding: 20px;
        border-radius: 5px;
        color: #D1D5DB;
    }
    .meal-plane{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 10px;
    }
    .pane form{
        background-color: #313348;
        color: #D1D5DB;
        padding: 20px;
        border-radius: 5px;
        min-width: 60%;
        margin-bottom: 20px;
        overflow: hidden;
    }
    .pane .result{
        background-color: #313348;
        color: #D1D5DB;
        padding: 20px;
        border-radius: 5px;
        margin-left: 20px;
        min-width: calc(40% - 20px);
        margin-bottom: 20px;
    }
    .pane form tr input ,select,.pane form tr a {
        border:1px solid #9CA3AF;
        border-radius: 5px;
        color: #9CA3AF;
        background-color: #313348;
        padding: 5px 10px;
        margin-bottom: 15px;
    }
    .pane form tr{
       height: 40px;
    }
    .pane form tr:last-child{
        height: 60px;
    }
    .pane form tr:last-child *{
        margin-bottom: 0px;
    }
    .pane form tr:last-child td{
        padding-top: 20px;
        padding-right: 10px;
    }
    .arrow_box {
        position: relative;

        border: 1px solid #aaa;
        padding: 3px 8px;
        text-align: center;
    }
    .result_box {
        height: 75px;
        width: 205px;
        border: 1px solid #8db46d;
        padding: 9px 21px;
        text-align: center;
        background-color: #2a2b3d;
    }


    .arrow_box:after, .arrow_box:before {
        left: 100%;
        top: calc(50% - 15px);
        border: 15px solid transparent;
        border-left-color: #313348;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
    }
    .arrow_box:before{
        top: calc(50% - 16px);
        border-width: 16px;
        border-left-color: white;
    }
    .bigtext {
        font-size: 15px;
    }
    .verybigtext {
        font-size: 18px;
    }
</style>
<br>
<br>
<br>
<div class="pane" style="padding:10px;">

    <form method="post">
        <table id="calinputtable" >
            <thead>
                <h2>Meal Plan Generator</h2>
                <hr>
            </thead>
            <tbody>
                <tr>
                    <td>
                       <label for="age">Age</label>
                    </td>
                    <td>
                        <input type="text" name="age" id="age" value="<?php echo isset($_POST['age'])? $_POST['age']: '25'?>" class="inhalf"  spellcheck="false" data-ms-editor="true">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Gender</label>
                    </td>
                    <td>
                        <input type="radio" <?php echo isset($_POST['sex'])? $_POST['sex']=='5' ? 'checked' : '' : 'checked'?>  name="sex" id="m" value="5">
                        <label for="m">
                            male
                        </label>
                        <input type="radio" <?php echo isset($_POST['sex'])? $_POST['sex']=='-161' ? 'checked' : '' : ''?>  name="sex" id="f" value="-161">
                        <label for="f" >
                            female
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="height">Height</label>
                    </td>
                    <td >
                        <input type="text" name="height" id="height" value="<?php echo isset($_POST['height'])? $_POST['height']: '180'?>" class="infull inuick"  spellcheck="false" data-ms-editor="true">
                        <span >cm</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Weight</label>
                    </td>
                    <td>
                        <input type="text" name="weight" id="weight" value="<?php echo isset($_POST['weight'])? $_POST['weight']: '65'?>" class="infull inuick"  spellcheck="false" data-ms-editor="true">
                        <span>kg</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="activity">Activity</label>
                    </td>
                    <td>
                        <select id="activity" style="width: 204px" name="activity">
                            <option <?php echo isset($_POST['activity'])? $_POST['activity'] == 1 ? 'selected': '' : ''?> value="1">Basal Metabolic Rate (BMR)</option>
                            <option <?php echo isset($_POST['activity'])? $_POST['activity'] == 1.2 ? 'selected': '' : ''?> value="1.2">Sedentary: little or no exercise</option>
                            <option <?php echo isset($_POST['activity'])? $_POST['activity'] == 1.375 ? 'selected': '' : ''?> value="1.375">Light: exercise 1-3 times/week</option>
                            <option <?php echo isset($_POST['activity'])? $_POST['activity'] == 1.465 ? 'selected': '' : ''?> value="1.465">Moderate: exercise 4-5 times/week</option>
                            <option <?php echo isset($_POST['activity'])? $_POST['activity'] == 1.55 ? 'selected': '' : ''?> value="1.55">Active: daily exercise or intense exercise 3-4 times/week</option>
                            <option <?php echo isset($_POST['activity'])? $_POST['activity'] == 1.725 ? 'selected': '' : ''?> value="1.725" >Very Active: intense exercise 6-7 times/week</option>
                            <option <?php echo isset($_POST['activity'])? $_POST['activity'] == 1.9 ? 'selected': '' : ''?> value="1.9">Extra Active: very intense exercise daily, or physical job</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input style="  background-color: #0d6efd;
                                        color: #EEE;
                                        font-size: 1.1rem;
                                        padding: 2px 15px;
                                        " type="submit" value="Calculate" alt="Calculate">
                    </td>
                    <td>
                        <a href="" class="rounded" style="
                                        background-color: #dc3545;
                                        color: #EEE;
                                        font-size: 1.1rem;
                                         padding: 5px 15px;
                                        ">
                            Clear
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <div class="result">
        <table>
            <thead>
            <h2>Result</h2>
            <hr>
            </thead>
            <?php
            $BMR=null;
                if(!empty($_POST)) {
                $age=$_POST['age'];
                $sex=$_POST['sex'];
                $height=$_POST['height'];
                $weight=$_POST['weight'];
                $activity=$_POST['activity'];

                $BMR = ((10*$weight)+($height*6.25)-(5*$age)+($sex))*($activity);

            }
        ?>
            <tbody>
            <tr>
                <td class="arrow_box">
                    <div class="bigtext">Maintain weight</div>
                </td>
                <td class="result_box">
                    <?php
                         if(!empty($_POST)) {
                             ?>
                             <div class="verybigtext"><b><?php echo(int) ($BMR); ?>
                                 </b>
                                 <span class="smalltext">&nbsp;&nbsp;&nbsp;&nbsp;100%</span>
                                 <div style="color:#888;">Calories/day</div>
                             </div>
                             <?php
                         }
                        ?>
                </td>
            </tr>
            <tr>
                <td class="arrow_box">
                    <div class="bigtext">Mild weight loss</div>
                    <div style="color:#888;">0.25 kg/week</div>
                </td>

                <td class="result_box">
                    <?php
                         if(!empty($_POST)) {
                             ?>
                             <div class="verybigtext"><b><?php echo (int) ($BMR-250); ?></b> <span
                                         class="smalltext"> &nbsp;&nbsp;&nbsp;&nbsp; <?php echo (int)((($BMR-250) /$BMR)*100); ?>%</span>
                                 <div style="color:#888;">Calories/day</div>
                             </div>
                             <?php
                         }
 ?>
                </td>
            </tr>
            <tr>
                <td class="arrow_box">
                    <div class="bigtext">Weight loss</div>
                    <div style="color:#888;">0.5 kg/week</div>
                </td>
                <td class="result_box">
                    <?php
                         if(!empty($_POST)) {
                             ?>
                             <div class="verybigtext"><b><?php echo (int) ($BMR - 500); ?></b> <span
                                         class="smalltext"> &nbsp;&nbsp;&nbsp;&nbsp; <?php echo (int)((($BMR-500) /$BMR)*100); ?>%</span>
                                 <div style="color:#888;">Calories/day</div>
                             </div>
                             <?php
                         }
 ?>
                </td>
            </tr>
            <tr>
                <td class="arrow_box">
                    <div class="bigtext">Extreme weight loss</div>
                    <div style="color:#888;">1 kg/week</div>
                </td>
                <td class="result_box">
                    <?php
                         if(!empty($_POST)) {
                             ?>
                             <div class="verybigtext"><b><?php echo (int) ($BMR - 1000); ?></b> <span
                                         class="smalltext"> &nbsp;&nbsp;&nbsp;&nbsp; <?php echo (int)((($BMR-1000) /$BMR)*100); ?>%</span>
                                 <div style="color:#888;">Calories/day</div>
                             </div>
                             <?php
                         }
 ?>
                </td>
            </tr>
            </tbody>

        </table>

    </div>
</div>
<?php
    if(isset($BMR)){
        $i = 1;
        $qry = $conn->query("SELECT * from `mealplanchart` where $BMR BETWEEN fromC and toC");
        if($row = $qry->fetch_assoc()) {
            ?>
            <div class="meal-plane">
                <div class="meal-plane-chart">

                    <object data="<?= base_url ?>/uploads/mealcharts/<?=$row['id']?>.pdf" style="width:100%; height: 100vh; "
                            ></object>

                </div>
            </div>
            <?php
        }
    }
?>