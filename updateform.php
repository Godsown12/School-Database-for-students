<?php
include_once 'include/header.php';
   if(!isset($_POST['getMat']) AND !isset($_GET['update'])){
        header("Location: index.php");
    }

    //function of 
    function sanitize($dirty){
        return htmlentities($dirty, ENT_QUOTES, "UTF-8");
    }
    // delete the existing folder
    function Delete($path){   
        if(is_dir($path) === true){
            $files = array_diff(scandir($path), array('.', '..'));
            foreach($files as $file){
                Delete(realpath($path) . '/' . $file);
            }
            return rmdir($path);
        }
        else if(is_file($path) === true){
            return unlink($path);
        }
        return false;
    }   
    //Get matNo from form.php
    $getMat = ((isset($_POST['getMat']) && $_POST['getMat'] != '')?sanitize($_POST['getMat']):'');
    //echo($getMat);

    //get id from database
    if(isset($_GET['update'])){
        $id = (int)$_GET['update'];
        $id = sanitize($id); 
        $sql = $conn->query("SELECT * FROM `info` WHERE `id`='$id'");
        $sqlResult = mysqli_fetch_assoc($sql);   
    }else{
        if(isset($_POST['getMat'])){
            $sql = $conn->query("SELECT * FROM `info` WHERE `matNo`='$getMat'");
            $matCheck = mysqli_num_rows($sql);
            if(!$matCheck > 0){
                $sqlResult=0;
                ?>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#existModal').modal('toggle');
                    $('.modal').on('hidden.bs.modal', function (e){
                        window.location = "form.php";
                        });
                    });
                    
                </script>
                <?php   
            }else{
                $sqlResult = mysqli_fetch_assoc($sql);
                $id = $sqlResult['id'];
            } 
        }
    }
   
    // get input data
    $firstName = ((isset($_POST['firstName']) && $_POST['firstName'] != '')?sanitize($_POST['firstName']):$sqlResult['firstName']);
    $firstName= trim($firstName);
    $firstName= strtoupper($firstName);
    $lastName =((isset($_POST['lastName']) && $_POST['lastName'] != '' )?sanitize($_POST['lastName']):$sqlResult['lastName']);
    $lastName= trim($lastName);
    $lastName= strtoupper($lastName);
    $middleName =((isset($_POST['middleName']) && $_POST['middleName'] != '' )?sanitize($_POST['middleName']):$sqlResult['middleName']);
    $middleName= trim($middleName);
    $middleName= strtoupper($middleName);
    $faculty =((isset($_POST['faculty']) && $_POST['faculty'] != '' )?sanitize($_POST['faculty']):$sqlResult['faculty']);
    $department =((isset($_POST['department']) && $_POST['department'] != '' )?sanitize($_POST['department']):$sqlResult['department']);
    $level =((isset($_POST['level']) && $_POST['level'] != '' )?sanitize($_POST['level']):$sqlResult['level']);
    $mat =((isset($_POST['mat']) && $_POST['mat'] != '' )?sanitize($_POST['mat']):$sqlResult['matNo']);
    $mat= trim($mat);
    $mat= strtoupper($mat);
    $gender =((isset($_POST['gender']) && $_POST['gender'] != '' )?sanitize($_POST['gender']):$sqlResult['gender']);
    $gender= trim($gender);
    $gender= strtoupper($gender);
    $bloodgroup =((isset($_POST['bloodgroup']) && $_POST['bloodgroup'] != '' )?sanitize($_POST['bloodgroup']):$sqlResult['bloodGroup']);
    $bloodgroup= trim($bloodgroup);
    $bloodgroup= strtoupper($bloodgroup);
    $phone =((isset($_POST['phone']) && $_POST['phone'] != '' )?sanitize($_POST['phone']):$sqlResult['phoneNo']);
    $phone= trim($phone);
    $emergencyPhone =((isset($_POST['emergencyPhone']) && $_POST['emergencyPhone'] != '' )?sanitize($_POST['emergencyPhone']):$sqlResult['EmergencyNo']);
    $emergencyPhone= trim($emergencyPhone);
    $display="";
    $existed = "";
    
    $currentDir = getcwd();//get the current directory
    if(isset($_POST['submit'])){
        $char = array("A-","B-","O-","AB-","A+","B+","O+","AB+");
        if(!in_array($bloodgroup,$char)){
            $display = "Please Instert A Proper Boold Group";
        }
        else{
            $regex = "/^[A-Z]{4}/[A-Z]{3}/[0-9]{2}/[0-9]{2}/[0-9]*$/";
            if(!preg_match("/(^[A-Z0-9]{5}\/[A-Z]{3}\/[0-9])|([A-Z]{4}\/[A-Z]{3}\/[0-9]{2}\/[0-9]{2}\/[0-9]*$)/",$mat)){
                $display= "Your matric number does not match";
            }else{
               // check if folder  exits
               $deletePath =$sqlResult['folderPath'];
               delete($deletePath);
               // create folder for the input.
               $qrCode= $lastName.' '.$firstName.' '.$middleName.', '.$mat.', '.$department.', '.$level.', BLOOD GROUP: '.$bloodgroup.', EMERGENCY CONTACT: '.$emergencyPhone;
               if($middleName != ''){
                    $qrFileName = $lastName.' '.$firstName.' '.$middleName;
                    $dir = 'departments/'.$department.'/'.$lastName.' '.$firstName.' '.$middleName.'/';
                }else{
                    $qrFileName = $lastName.' '.$firstName;
                    $dir = 'departments/'.$department.'/'.$lastName.' '.$firstName.'/';
                }
               if(!is_dir($dir)){
                   mkdir($dir,"0777",true);
                   include ("qrcode.php");   
                   $conn->query("UPDATE `info` SET `firstName`= '$firstName',`lastName`='$lastName',
                   `middleName`='$middleName',`faculty`='$faculty',`department`='$department',`level`='$level',`matNo`='$mat',`gender`='$gender',`bloodGroup`='$bloodgroup',
                   `EmergencyNo`='$emergencyPhone',`phoneNo`= '$phone',`folderPath`='$dir',`qrCodeName`='$qrFileName' WHERE `id` = '$id'");
                    ?>
                        <script>
                             $(document).ready(function(){
                                updateClose(<?=$id;?>);
                             });
                        </script>
                    <?php
                }
                   
            }
        }    
    }

?>
<body body id="body1">
    <div class="img-logo">
        <img class="logo2" src="images/logo.jpg" alt="">
    </div>
    <div class="main">
        <div class="containerr">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="images/free.png" alt="">
                </div>
                <div class="signup-form">
                    <form method="POST" action="updateform.php?update=<?=$id;?>" class="register-form" id="register-form">
                        <h2 class="head">Please Update Here</h2>
                            <h6><?=$display;?></h6>    
                        <div class="form-row">   
                            <div class="form-group">
                                <label for="father_name">Last Name:</label>
                                <input type="text" name="lastName" id="lastName" value="<?=$lastName;?>" required/>
                            </div>                 
                            <div class="form-group">
                                <label for="firstName">First Name:</label>
                                <input type="text" name="firstName" id="firstName" value="<?=$firstName;?>" required/>
                            </div>
							<div class="form-group">
                                <label for="middle_name">Middle Name:</label>
                                <input type="text" name="middleName" id="middleName" value="<?=$middleName;?>"/>
                            </div>
                        </div>
						<div class="form-group">
							<label for="faculty_name">Faculty:</label>
							<div class="form-select">
								<select name="faculty" id="Faculty">
                                    <option value="<?=$faculty;?>"><?=$faculty;?></option>
									<option value="FACULTY OF TRANSPORT">FACULTY OF TRANSPORT</option>
									<option value="FACULTY OF ENGINEERING">FACULTY OF ENGINEERING</option>
									<option value="FACULTY OF ENVIRONMENTAL MANAGEMENT">FACULTY OF ENVIRONMENTAL MANAGEMENT</option>
								</select>
								<span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
							</div>
                        </div>
						<div class="form-group">
							<label for="department_name">Department:</label>
							<div class="form-select">
								<select name="department" id="department">
                                    <option value="<?=$department;?>"><?=$department;?></option>
									<option value="CIVIL ENGINEERING">CIVIL ENGINEERING</option>
									<option value="ELECTRICAL ENGINEERING">ELECTRICAL ENGINEERING</option>
									<option value="ENVIRONMENTAL MANAGEMENT AND POLLUTION CONTROL">ENVIRONMENTAL MANAGEMENT AND POLLUTION CONTROL</option>
									<option value="FISHERIES AND AQUACULTURE">FISHERIES AND AQUACULTURE</option>
									<option value="MARINE ECONOMICS AND FINANCE">MARINE ECONOMICS AND FINANCE</option>
									<option value="MARINE ENGINEERING">MARINE ENGINEERING</option>
									<option value="MARINE GEOLOGY">MARINE GEOLOGY</option>
									<option value="MECHANICAL ENGINEERING">MECHANICAL ENGINEERING</option>
									<option value="METEOROLOGY AND CLIMATE CHANGE">METEOROLOGY AND CLIMATE CHANGE</option>
									<option value="NAUTICAL SCIENCE">NAUTICAL SCIENCE</option>
									<option value="PETROLEUM AND GAS ENGINEERING">PETROLEUM AND GAS ENGINEERING</option>
									<option value="PORT MANAGEMENT">PORT MANAGEMENT</option>
									<option value="TRANSPORT LOGISTICS MANAGEMENT">TRANSPORT LOGISTICS MANAGEMENT</option>
								</select>
								<span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
							</div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="level">Level:</label>
                                <div class="">
                                    <select name="level" id="level">
                                        <option value="<?=$level;?>"><?=$level;?></option>
                                        <option value="Level 1">Level 1</option>
                                        <option value="Level 2">Level 2</option>
										<option value="Level 3">Level 3</option>
										<option value="Level 4">Level 4</option>
										<option value="Level 5">Level 5</option>
                                    </select>
                                    <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                                </div>
                            </div>
							<div class="form-group">
                            	<label for="mat">Mat. No.:</label>
                            	<input type="text" name="mat" id="mat" value="<?=$mat;?>" autocomplete="off" readonly required/>
                        	</div>
                        </div>
                        <div class="form-radio">
                            <label for="gender" class="radio-label">Gender:</label>
                            <div class="form-radio-item">
                                <input type="radio" name="gender" id="male" value="male" <?php if($gender =='MALE') {echo('checked');} ?> />
                                <label for="male">Male</label>
                                <span class="check"></span>
                            </div>
                            <div class="form-radio-item">
                                <input type="radio"  name="gender" id="female" value="female" <?php if($gender =='FEMALE') {echo('checked');} ?> />
                                <label for="female">Female</label>
                                <span class="check"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bloodgroup">Blood Group:</label>
                            <input type="text" name="bloodgroup" placeholder="Please in this format,   O+,   O-,   A+,    A-  etc." id="bloodgroup" value="<?=$bloodgroup;?>" required/>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Contact No:</label>
                                <input type="text" name="phone" id="phone" placeholder="(Personal Phone Number )" value="<?=$phone;?>" required/>
                            </div>
                            <div class="form-group">
                                <label for="phone">Emergency Contact No( Your Reletives No):</label>
                                <input type="text" name="emergencyPhone" id="phone" placeholder="(PLease Not Your own Number)" value="<?=$emergencyPhone;?>" required/>
                            </div>
                        </div>
                        <div class="form-submit">
                            <a href="index.php" class="submit " id="reset">Cancel</a>
                            <input type="submit" value="Update Form" class="submit" name="submit" id="submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
<?php
    include 'include/closingpage.php';  
    include 'include/matexits.php'; 
    include_once 'include/footer.php';
?>  



    
