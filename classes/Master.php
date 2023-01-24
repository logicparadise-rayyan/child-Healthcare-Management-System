<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function save_service(){
		$_POST['description'] = htmlentities($_POST['description']);
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `service_list` set {$data} ";
		}else{
			$sql = "UPDATE `service_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `service_list` where `name`='{$name}' ".($id > 0 ? " and id != '{$id}'" : ""))->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Service Name Already Exists.";
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Service details successfully added.";
				else
					$resp['msg'] = "Service details has been updated successfully.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_service(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `service_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Service has been deleted successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_doctor(){
		if(empty($_POST['id'])){
			$prefix = "D-".(date('Ym'));
			$code = sprintf("%'.04d",1);
			while(true){
				$check = $this->conn->query("SELECT * FROM doctor_list where `code` = '{$prefix}{$code}' ")->num_rows;
				if($check > 0){
					$code = sprintf("%'.04d",ceil($code)+1);
				}else{
					break;
				}
			}
			$_POST['code'] = "{$prefix}{$code}";
		}
		$_POST['fullname'] = "{$_POST['lastname']}, {$_POST['firstname']} {$_POST['middlename']}";
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(in_array($k,array('code','fullname','status'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `doctor_list` set {$data} ";
		}else{
			$sql = "UPDATE `doctor_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `doctor_details` where `meta_field`='email' and `meta_value`='{$email}' ".($id > 0 ? " and doctor_id != '{$id}'" : ""))->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "doctors's Email Already Exists.";
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$bsid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "doctors's details successfully added.";
				else
					$resp['msg'] = "doctors's details has been updated successfully.";
					$data = "";
					foreach($_POST as $k =>$v){
						if(!in_array($k,array('id','code','fullname','status'))){
							if(!is_numeric($v))
								$v = $this->conn->real_escape_string($v);
							if(!empty($data)) $data .=",";
							$data .= " ('{$bsid}', '{$k}', '{$v}')";
						}
					}
					if(!empty($data)){
						$sql2 = "INSERT INTO `doctor_details` (`doctor_id`,`meta_field`,`meta_value`) VALUES {$data}";
						$this->conn->query("DELETE FROM `doctor_details` where doctor_id = '{$bsid}'");
						$save_meta = $this->conn->query($sql2);
						if($save_meta){
							$resp['status'] = 'success';
						}else{
							$this->conn->query("DELETE FROM `doctor_list` where id = '{$bsid}'");
							$resp['status'] = 'failed';
							$resp['msg'] = "An error occurred while saving the data. Error: ".$this->conn->error;
						}
					}
					if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
						$fname = 'uploads/doctors/'.$bsid.'.png';
						$dir_path =base_app. $fname;
						$upload = $_FILES['img']['tmp_name'];
						$type = mime_content_type($upload);
						$allowed = array('image/png','image/jpeg');
						if(!in_array($type,$allowed)){
							$resp['msg'].=" But Image failed to upload due to invalid file type.";
						}else{
							$new_height = 200; 
							$new_width = 200;  
					
							list($width, $height) = getimagesize($upload);
							$t_image = imagecreatetruecolor($new_width, $new_height);
							imagealphablending( $t_image, false );
							imagesavealpha( $t_image, true );
							$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
							imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
							if($gdImg){
									if(is_file($dir_path))
									unlink($dir_path);
									$uploaded_img = imagepng($t_image,$dir_path);
									imagedestroy($gdImg);
									imagedestroy($t_image);
							}else{
							$resp['msg'].=" But Image failed to upload due to unkown reason.";
							}
						}
					}
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_doctor(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `doctor_list` where id = '{$id}'");
		$dell = $this->conn->query("DELETE FROM `doctor_details` where doctor_id = '{$id}'");
		if($del && $dell    ){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Doctor has been deleted successfully.");
			if(is_file(base_app."uploads/doctors/{$id}.png")){
				unlink(base_app."uploads/doctors/{$id}.png");
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
    function save_babysitter(){
        if(empty($_POST['id'])){
            $prefix = "BS-".(date('Ym'));
            $code = sprintf("%'.04d",1);
            while(true){
                $check = $this->conn->query("SELECT * FROM babysitter_list where `code` = '{$prefix}{$code}' ")->num_rows;
                if($check > 0){
                    $code = sprintf("%'.04d",ceil($code)+1);
                }else{
                    break;
                }
            }
            $_POST['code'] = "{$prefix}{$code}";
        }
        $_POST['fullname'] = "{$_POST['lastname']}, {$_POST['firstname']} {$_POST['middlename']}";
        extract($_POST);
        $data = "";
        foreach($_POST as $k =>$v){
            if(in_array($k,array('code','fullname','status'))){
                if(!is_numeric($v))
                    $v = $this->conn->real_escape_string($v);
                if(!empty($data)) $data .=",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        if(empty($id)){
            $sql = "INSERT INTO `babysitter_list` set {$data} ";
        }else{
            $sql = "UPDATE `babysitter_list` set {$data} where id = '{$id}' ";
        }
        $check = $this->conn->query("SELECT * FROM `babysitter_details` where `meta_field`='email' and `meta_value`='{$email}' ".($id > 0 ? " and babysitter_id != '{$id}'" : ""))->num_rows;
        if($check > 0){
            $resp['status'] = 'failed';
            $resp['msg'] = "Babysitter's Email Already Exists.";
        }else{
            $save = $this->conn->query($sql);
            if($save){
                $bsid = !empty($id) ? $id : $this->conn->insert_id;
                $resp['status'] = 'success';
                if(empty($id))
                    $resp['msg'] = "Babysitter details successfully added.";
                else
                    $resp['msg'] = "Babysitter details has been updated successfully.";
                $data = "";
                foreach($_POST as $k =>$v){
                    if(!in_array($k,array('id','code','fullname','status'))){
                        if(!is_numeric($v))
                            $v = $this->conn->real_escape_string($v);
                        if(!empty($data)) $data .=",";
                        $data .= " ('{$bsid}', '{$k}', '{$v}')";
                    }
                }
                if(!empty($data)){
                    $sql2 = "INSERT INTO `babysitter_details` (`babysitter_id`,`meta_field`,`meta_value`) VALUES {$data}";
                    $this->conn->query("DELETE FROM `babysitter_details` where babysitter_id = '{$bsid}'");
                    $save_meta = $this->conn->query($sql2);
                    if($save_meta){
                        $resp['status'] = 'success';
                    }else{
                        $this->conn->query("DELETE FROM `babysitter_list` where id = '{$bsid}'");
                        $resp['status'] = 'failed';
                        $resp['msg'] = "An error occurred while saving the data. Error: ".$this->conn->error;
                    }
                }
                if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
                    $fname = 'uploads/babysitters/'.$bsid.'.png';
                    $dir_path =base_app. $fname;
                    $upload = $_FILES['img']['tmp_name'];
                    $type = mime_content_type($upload);
                    $allowed = array('image/png','image/jpeg');
                    if(!in_array($type,$allowed)){
                        $resp['msg'].=" But Image failed to upload due to invalid file type.";
                    }else{
                        $new_height = 200;
                        $new_width = 200;

                        list($width, $height) = getimagesize($upload);
                        $t_image = imagecreatetruecolor($new_width, $new_height);
                        imagealphablending( $t_image, false );
                        imagesavealpha( $t_image, true );
                        $gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
                        imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                        if($gdImg){
                            if(is_file($dir_path))
                                unlink($dir_path);
                            $uploaded_img = imagepng($t_image,$dir_path);
                            imagedestroy($gdImg);
                            imagedestroy($t_image);
                        }else{
                            $resp['msg'].=" But Image failed to upload due to unkown reason.";
                        }
                    }
                }
            }else{
                $resp['status'] = 'failed';
                $resp['msg'] = "An error occured.";
                $resp['err'] = $this->conn->error."[{$sql}]";
            }
        }
        if($resp['status'] =='success')
            $this->settings->set_flashdata('success',$resp['msg']);
        return json_encode($resp);
    }
    function hire_babysitter(){
        $sql="";
        if(!empty($_POST['id'])){
            $baddysitter=$_POST['id'];
            $enroller=$this->settings->EnrollerData("id");
            $sql="SELECT * FROM `hire_babysitter` WHERE babysitter_id=$baddysitter";
            $res = $this->conn->query($sql);
            if($res->num_rows == 0){
                $sql="INSERT INTO `hire_babysitter`( `babysitter_id`, `enroller_id`, `hire_date`) VALUES ('$baddysitter','$enroller',current_timestamp())";
                $save = $this->conn->query($sql);
                if($save){
                    $sql="UPDATE `babysitter_list` SET `status` = '3' WHERE `babysitter_list`.`id` = '$baddysitter'";
                    $save = $this->conn->query($sql);
                    $resp['status'] = 'success';
                    $resp['msg']=" Babysitter hired.";
                }else{
                    $resp['status'] = 'failed';
                    $resp['msg']=" error in hiring babysitter";
                }
            }else{
                $resp['status'] = 'failed';
                $resp['msg']="You have already hired";
            }

        }else{
            $resp['status'] = 'failed';
            $resp['msg']=" error in hiring babysitter";

        }
        return json_encode($resp);
    }
    function fire_babysitter(){
        $sql="";
        if(!empty($_POST['id'])){
            $baddysitter=$_POST['id'];
            $enroller=$this->settings->EnrollerData("id");
            $sql="SELECT * FROM `hire_babysitter` WHERE babysitter_id='$baddysitter' and `hire_babysitter`.`enroller_id` = '$enroller'";
            $res = $this->conn->query($sql);
            if($res->num_rows > 0){
                $sql="DELETE FROM `hire_babysitter` WHERE `hire_babysitter`.`babysitter_id` = '$baddysitter' and `hire_babysitter`.`enroller_id` = '$enroller'";
                $save = $this->conn->query($sql);
                if($save){
                    $sql="UPDATE `babysitter_list` SET `status` = '1' WHERE `babysitter_list`.`id` = '$baddysitter'";
                    $save = $this->conn->query($sql);
                    $resp['status'] = 'success';
                    $resp['msg']=" Babysitter Fired.";
                }else{
                    $resp['status'] = 'failed';
                    $resp['msg']=" error in firing babysitter";
                }
            }else{
                $resp['status'] = 'failed';
                $resp['msg']="You have not Hired  Babysitter";
            }

        }else{
            $resp['status'] = 'failed';
            $resp['msg']=" error in Firing babysitter";

        }
        return json_encode($resp);
    }
    function delete_babysitter(){
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `babysitter_list` where id = '{$id}'");
        $dell = $this->conn->query("DELETE FROM `babysitter_details` where babysitter_id = '{$id}'");
        if($del && $dell){
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success',"Babysitter has been deleted successfully.");
            if(is_file(base_app."uploads/babysitters/{$id}.png")){
                unlink(base_app."uploads/babysitters/{$id}.png");
            }
        }else{
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);

    }
	function save_enrollment(){

		if(empty($_POST['id'])){
			$alpha = range("A","Z");
			shuffle($alpha);
			$prefix = (substr(implode("",$alpha),0,3))."-".(date('Ym'));
			$code = sprintf("%'.04d",1);
			while(true){
				$check = $this->conn->query("SELECT * FROM enrollment_list where `code` = '{$prefix}{$code}' ")->num_rows;
				if($check > 0){
					$code = sprintf("%'.04d",ceil($code)+1);
				}else{
					break;
				}
			}
			$_POST['code'] = "{$prefix}{$code}";
		}
		$_POST['child_fullname'] = "{$_POST['child_lastname']}, {$_POST['child_firstname']} {$_POST['child_middlename']}";
		$_POST['parent_fullname'] = "{$_POST['parent_lastname']}, {$_POST['parent_firstname']} {$_POST['parent_middlename']}";
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(in_array($k,array('username','code','child_fullname','parent_fullname','status'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
        if(!empty($password)){
            $password = md5($password);
            if(!empty($data)) $data .=" , ";
            $data .= " `password` = '{$password}' ";
        }
        if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
            $fname = 'uploads/enroller/enroller-'.$id.'.png';
            $dir_path =base_app. $fname;
            $upload = $_FILES['img']['tmp_name'];
            $type = mime_content_type($upload);
            $allowed = array('image/png','image/jpeg');
            if(!in_array($type,$allowed)){
                $resp['msg'].=" But Image failed to upload due to invalid file type.";
            }else{
                $new_height = 200;
                $new_width = 200;

                list($width, $height) = getimagesize($upload);
                $t_image = imagecreatetruecolor($new_width, $new_height);
                imagealphablending( $t_image, false );
                imagesavealpha( $t_image, true );
                $gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
                imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                if($gdImg){
                    if(is_file($dir_path))
                        unlink($dir_path);
                    $uploaded_img = imagepng($t_image,$dir_path);
                    imagedestroy($gdImg);
                    imagedestroy($t_image);
                }else{
                    $resp['msg'].=" But Image failed to upload due to unkown reason.";
                }
            }
            if(isset($uploaded_img)){
                $data.=",`avatar` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP))";

                    $this->settings->set_EnrollerData('avatar',$fname);

            }
        }
		if(empty($id)){
			$sql = "INSERT INTO `enrollment_list` set {$data} ";

		}else{
			$sql = "UPDATE `enrollment_list` set {$data} where id = '{$id}' ";
		}

		$save = $this->conn->query($sql);
		if($save==1){
			$eid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "Enrollment Details has successfully submitted. Your Enrollment Code is <b>{$code}</b>.";
			else
				$resp['msg'] = "Enrollment details has been updated successfully.";
				$data = "";
				foreach($_POST as $k =>$v){
					if(!in_array($k,array('id','code','fullname','status'))){
						if(!is_numeric($v))
							$v = $this->conn->real_escape_string($v);
						if(!empty($data)) $data .=",";
						$data .= " ('{$eid}', '{$k}', '{$v}')";
					}
				}


				if(!empty($data)){
                    $data .= ", ('{$eid}', 'avatar', CONCAT('{$this->settings->EnrollerData('avatar')}','?v=',unix_timestamp(CURRENT_TIMESTAMP)))";
					$sql2 = "INSERT INTO `enrollment_details` (`enrollment_id`,`meta_field`,`meta_value`) VALUES {$data}";

					$this->conn->query("DELETE FROM `enrollment_details` where enrollment_id = '{$eid}'");

					$save_meta = $this->conn->query($sql2);
					if($save_meta){
						$resp['status'] = 'success';
					}else{
						$this->conn->query("DELETE FROM `enrollment_list` where id = '{$eid}'");
						$resp['status'] = 'failed';
						$resp['msg'] = "An error occurred while saving the data. Error: ".$this->conn->error;
					}
				}

		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occured.";
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] =='success' && !empty($id))
		$this->settings->set_flashdata('success',$resp['msg']);
		if($resp['status'] =='success' && empty($id))
		$this->settings->set_flashdata('pop_msg',$resp['msg']);
		return json_encode($resp);
	}
	function delete_enrollment(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `enrollment_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Enrollment has been deleted successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function update_status(){
		extract($_POST);
		$update = $this->conn->query("UPDATE `Enrollment_list` set status  = '{$status}' where id = '{$id}'");
		if($update){
			$resp['status'] = 'success';
			$resp['msg'] = "Enrollment Status has successfully updated.";
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occurred. Error: " .$this->conn->error;
		}
		if($resp['status'] =='success')
		$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function Appoint_doctor(){
         $sql="";
        if(!empty($_POST['id']) && !empty($_POST['date'])){
            $doctor_id=$_POST['id'];
            $enroller_id=$this->settings->EnrollerData("id");
            $Apoiment_date=$_POST['date'];
            $sql="SELECT * FROM `appointment` WHERE doctor_id=$doctor_id and enroller_id=$enroller_id and `date`='$Apoiment_date' ";
            $res = $this->conn->query($sql);
            if($res->num_rows == 0){
                $sql="INSERT INTO `appointment` (`id`, `date`, `doctor_id`, `enroller_id`, `status`) VALUES (NULL, '$Apoiment_date', '$doctor_id', '$enroller_id', '1');";
                $save = $this->conn->query($sql);
                if($save){
                    $resp['status'] = 'success';
                    $resp['msg']=" You have Successfully Booked an Appointment";
                }else{
                    $resp['status'] = 'failed';
                    $resp['msg']=" error in hiring babysitter";
                }
            }else{
                $resp['status'] = 'failed';
                $resp['msg']="You have already Booked an Appointment on This date ";
            }

        }else{
            $resp['status'] = 'failed';
            $resp['msg']=" error in Booked an Appointment";

        }

        return json_encode($resp);
    }
    function Cancel_Appointment(){
        $sql="";
        if(!empty($_POST['id']) && !empty($_POST['date'])){
            $doctor_id=$_POST['id'];
            $enroller_id=$this->settings->EnrollerData("id");
            $Apoiment_date=$_POST['date'];
            $sql="SELECT * FROM `appointment` WHERE doctor_id=$doctor_id and enroller_id=$enroller_id and `date`='$Apoiment_date' ";
            $res = $this->conn->query($sql);
            if($res->num_rows != 0){
                $sql="DELETE FROM `appointment` WHERE `appointment`.`doctor_id` = $doctor_id and enroller_id=$enroller_id and `date`='$Apoiment_date'";
                $save = $this->conn->query($sql);
                if($save){
                    $resp['status'] = 'success';
                    $resp['msg']=" Appointments has Been Canceled ";
                }else{
                    $resp['status'] = 'failed';
                    $resp['msg']=" Error in Appointments Cancellation ";
                }
            }else{
                $resp['status'] = 'failed';
                $resp['msg']="No Appointment has Found On This Date For You ";
            }

        }else{
            $resp['status'] = 'failed';
            $resp['msg']="Error in Appointments Cancellation ";

        }

        return json_encode($resp);
    }
    function Confirm_Appointment(){
        $sql="";
        if(!empty($_POST['id']) && !empty($_POST['date'])){
            $id=$_POST['id'];
            $Apoiment_date=$_POST['date'];
            $sql="SELECT * FROM `appointment` WHERE id=$id and `date`='$Apoiment_date' ";
            $res = $this->conn->query($sql);
            if($res->num_rows != 0){
                $sql="UPDATE `appointment` SET `status` = '2' WHERE `id` = $id and `date`='$Apoiment_date'";
                $save = $this->conn->query($sql);
                if($save){
                    $resp['status'] = 'success';
                    $resp['msg']=" Appointments has Been Confirmed ";
                }else{
                    $resp['status'] = 'failed';
                    $resp['msg']=" Error in Appointments Confirmation ";
                }
            }else{
                $resp['status'] = 'failed';
                $resp['msg']="No Appointment has Found On This Date ";
            }

        }else{
            $resp['status'] = 'failed';
            $resp['msg']="Error in Appointments Confirmation ";

        }

        return json_encode($resp);
    }
    function Reject_Appointment(){
        $sql="";
        if(!empty($_POST['id']) && !empty($_POST['date'])){
            $apointment_id=$_POST['id'];
            $Apoiment_date=$_POST['date'];
            $sql="SELECT * FROM `appointment` WHERE `id` = $apointment_id and `date`='$Apoiment_date' ";
            $res = $this->conn->query($sql);
            if($res->num_rows != 0){
                $sql="UPDATE `appointment` SET `status` = '3' WHERE `id` = $apointment_id and `date`='$Apoiment_date'";
                $save = $this->conn->query($sql);
                if($save){
                    $resp['status'] = 'success';
                    $resp['msg']=" Appointments has Been Rejected ";
                }else{
                    $resp['status'] = 'failed';
                    $resp['msg']=" Error in Appointments Rejection ";
                }
            }else{
                $resp['status'] = 'failed';
                $resp['msg']="No Appointment has Found On This Date For You ";
            }

        }else{
            $resp['status'] = 'failed';
            $resp['msg']="Error in Appointments Rejection ";

        }

        return json_encode($resp);
    }
    function save_government_schemes(){
        $_POST['description'] = htmlentities($_POST['description']);
        extract($_POST);
        $data = "";
        foreach($_POST as $k =>$v){
            if(!in_array($k,array('id'))){
                if(!is_numeric($v))
                    $v = $this->conn->real_escape_string($v);
                if(!empty($data)) $data .=",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        if(empty($id)){
            $sql = "INSERT INTO `government_schemes` set {$data} ";
        }else{
            $sql = "UPDATE `government_schemes` set {$data} where id = '{$id}' ";
        }
        $check = $this->conn->query("SELECT * FROM `government_schemes` where `name`='{$name}' ".($id > 0 ? " and id != '{$id}'" : ""))->num_rows;
        if($check > 0){
            $resp['status'] = 'failed';
            $resp['msg'] = "Government Scheme Name Already Exists.";
        }else{
            $save = $this->conn->query($sql);
            if($save){
                $rid = !empty($id) ? $id : $this->conn->insert_id;
                $resp['status'] = 'success';
                if(empty($id))
                    $resp['msg'] = "Government Scheme details successfully added.";
                else
                    $resp['msg'] = "Government Scheme details has been updated successfully.";
            }else{
                $resp['status'] = 'failed';
                $resp['msg'] = "An error occured.";
                $resp['err'] = $this->conn->error."[{$sql}]";
            }
        }
        if($resp['status'] =='success')
            $this->settings->set_flashdata('success',$resp['msg']);
        return json_encode($resp);
    }
    function save_disease_detection(){
        $_POST['description'] = htmlentities($_POST['description']);
        extract($_POST);
        $data = "";
        foreach($_POST as $k =>$v){
            if(!in_array($k,array('id'))){
                if(!is_numeric($v))
                    $v = $this->conn->real_escape_string($v);
                if(!empty($data)) $data .=",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        if(empty($id)){
            $sql = "INSERT INTO `disease_detection` set {$data} ";
        }else{
            $sql = "UPDATE `disease_detection` set {$data} where id = '{$id}' ";
        }
        $check = $this->conn->query("SELECT * FROM `disease_detection` where `name`='{$name}' ".($id > 0 ? " and id != '{$id}'" : ""))->num_rows;
        if($check > 0){
            $resp['status'] = 'failed';
            $resp['msg'] = "Disease Detection Name Already Exists.";
        }else{
            $save = $this->conn->query($sql);
            if($save){
                $rid = !empty($id) ? $id : $this->conn->insert_id;
                $resp['status'] = 'success';
                if(empty($id))
                    $resp['msg'] = "Disease Detection details successfully added.";
                else
                    $resp['msg'] = "Disease Detection details has been updated successfully.";
            }else{
                $resp['status'] = 'failed';
                $resp['msg'] = "An error occured.";
                $resp['err'] = $this->conn->error."[{$sql}]";
            }
        }
        if($resp['status'] =='success')
            $this->settings->set_flashdata('success',$resp['msg']);
        return json_encode($resp);
    }
    function delete_government_schemes(){
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `government_schemes` where id = '{$id}'");
        if($del){
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success',"Government Schemes has been deleted successfully.");
        }else{
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);

    }
    function delete_disease_detection(){
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `disease_detection` where id = '{$id}'");
        if($del){
            $resp['status'] = 'success';
            $this->settings->set_flashdata('success',"Disease Detection has been deleted successfully.");
        }else{
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);

    }
    function deletemealplanechart(){
        extract($_POST);
        $del = $this->conn->query("DELETE FROM `mealplanchart` where id = '{$id}'");
        if($del){
            $fname = 'uploads/mealcharts/'.$id.'.pdf';
            $dir_path =base_app. $fname;
            if(is_file($dir_path))
                unlink($dir_path);
            $resp['status'] = 'success';
        }else{
            $resp['status'] = 'failed';
            $resp['error'] = $this->conn->error;
        }
        return json_encode($resp);
    }
    function mealplanchart(){

        extract($_POST);
        $data = "";
        foreach($_POST as $k =>$v){
            if(in_array($k,array('fromC','toC'))){
                if(!is_numeric($v))
                    $v = $this->conn->real_escape_string($v);
                if(!empty($data)) $data .=",";
                $data .= " `{$k}`='{$v}' ";
            }
        }
        if(empty($id)){
            $sql = "INSERT INTO `mealplanchart` set {$data} ";
        }else{
            $sql = "UPDATE `mealplanchart` set {$data} where id = '{$id}' ";
        }

        $save = $this->conn->query($sql);
        if($save){
            $bsid = !empty($id) ? $id : $this->conn->insert_id;
            $resp['status'] = 'success';
            if(empty($id))
                $resp['msg'] = "Meal plan Chart's details successfully added.";
            else
                $resp['msg'] = "Meal plan Chart's details has been updated successfully.";
            if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
                $fname = 'uploads/mealcharts/'.$bsid.'.pdf';
                $dir_path =base_app. $fname;
                $upload = $_FILES['img']['tmp_name'];
                $type = mime_content_type($upload);
                $allowed = array('application/pdf');
                if(!in_array($type,$allowed)){
                    $resp['msg'].=" But Image failed to upload due to invalid file type.";
                }else{
                    if(is_file($dir_path))
                        unlink($dir_path);
                    $is_uploaded=move_uploaded_file($upload,$dir_path);
                    if(!$is_uploaded) {
                        $resp['msg'] .= " But Image failed to upload due to unkown reason.";
                    }
                }
            }
        }else{
            $resp['status'] = 'failed';
            $resp['msg'] = "An error occured.";
            $resp['err'] = $this->conn->error."[{$sql}]";
        }
        //$resp['msg']=$sql;
        return json_encode($resp);
    }
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_service':
		echo $Master->save_service();
	break;
	case 'delete_service':
		echo $Master->delete_service();
	break;
	case 'save_babysitter':
		echo $Master->save_babysitter();
	break;
	case 'delete_babysitter':
		echo $Master->delete_babysitter();
	break;
    case 'save_doctor':
        echo $Master->save_doctor();
        break;
    case 'delete_doctor':
        echo $Master->delete_doctor();
        break;
	case 'save_enrollment':
		echo $Master->save_enrollment();
	break;
	case 'delete_enrollment':
		echo $Master->delete_enrollment();
	break;
	case 'update_status':
		echo $Master->update_status();
	break;
	case 'hire_babysitter':
		echo $Master->hire_babysitter();
	break;
    case 'fire_babysitter':
        echo $Master->fire_babysitter();
        break;
    case 'appoint_doctor':
        echo $Master->Appoint_doctor();
        break;
    case 'cancel_appointment':
        echo $Master->Cancel_Appointment();
        break;
    case 'update':
        echo $Master->save_enrollment();
        break;
    case 'confirm_appointment':
        echo $Master->Confirm_Appointment();
        break;
    case 'reject_appointment':
        echo $Master->Reject_Appointment();
        break;
    case 'save_disease_detection':
        echo $Master->save_disease_detection();
        break;
    case 'save_government_schemes':
        echo $Master->save_government_schemes();
        break;
    case 'delete_government_schemes':
        echo $Master->delete_government_schemes();
        break;
    case 'delete_disease_detection':
        echo $Master->delete_disease_detection();
        break;
    case 'mealplanchart':
        echo $Master->mealplanchart();
        break;
    case 'deletemealplanechart':
        echo $Master->deletemealplanechart();
        break;
	default:
		// echo $sysset->index();
		break;
}