<?php
include_once 'include/header.php';
    //function of 
    function sanitize($dirty){
        return htmlentities($dirty, ENT_QUOTES, "UTF-8");
    }
    
    // get input data
    $firstName = ((isset($_POST['firstName']) && $_POST['firstName'] != '')?sanitize($_POST['firstName']):"");
    $firstName= trim($firstName);
    $firstName= strtoupper($firstName);
    $lastName =((isset($_POST['lastName']) && $_POST['lastName'] != '' )?sanitize($_POST['lastName']):'');
    $lastName= trim($lastName);
    $lastName= strtoupper($lastName);
    $middleName =((isset($_POST['middleName']) && $_POST['middleName'] != '' )?sanitize($_POST['middleName']):'');
    $middleName= trim($middleName);
    $middleName= strtoupper($middleName);
    $faculty =((isset($_POST['faculty']) && $_POST['faculty'] != '' )?sanitize($_POST['faculty']):'');
    $department =((isset($_POST['department']) && $_POST['department'] != '' )?sanitize($_POST['department']):'');
    $level =((isset($_POST['level']) && $_POST['level'] != '' )?sanitize($_POST['level']):'');
    $mat =((isset($_POST['mat']) && $_POST['mat'] != '' )?sanitize($_POST['mat']):'');
    $mat= trim($mat);
    $mat= strtoupper($mat);
    $gender =((isset($_POST['gender']) && $_POST['gender'] != '' )?sanitize($_POST['gender']):'');
    $gender= trim($gender);
    $gender= strtoupper($gender);
    $bloodgroup =((isset($_POST['bloodgroup']) && $_POST['bloodgroup'] != '' )?sanitize($_POST['bloodgroup']):'');
    $bloodgroup= trim($bloodgroup);
    $bloodgroup= strtoupper($bloodgroup);
    $phone =((isset($_POST['phone']) && $_POST['phone'] != '' )?sanitize($_POST['phone']):'');
    $phone= trim($phone);
    $emergencyPhone =((isset($_POST['emergencyPhone']) && $_POST['emergencyPhone'] != '' )?sanitize($_POST['emergencyPhone']):'');
    $emergencyPhone= trim($emergencyPhone);
    $display="";
    $existed = "";
    
    if($_POST){
        $char = array("A-","B-","O-","AB-","A+","B+","O+","AB+");
        if(!in_array($bloodgroup,$char)){
            $display = "Please Instert A Proper Boold Group";
        }
        else{
           // $regex = "/^[A-Z]{4}\/[A-Z]{3}\/[0-9]{2}\/[0-9]{2}\/[0-9]*$/" U2019/MTL/001-- FMEM/MEP/18/19/007 +" ;
            if(!preg_match("/(^[A-Z0-9]{5}\/[A-Z]{3}\/[0-9])|([A-Z]{4}\/[A-Z]{3}\/[0-9]{2}\/[0-9]{2}\/[0-9]*$)/",$mat)){
                $display= "Wrong Matric Format";
            }else{
            // check if student exits
                $check= $conn->query("SELECT * FROM info WHERE matNo = '$mat'");
                $studentCheck = mysqli_num_rows($check);
                $studentMat = mysqli_fetch_assoc($check);
                $studentID = $studentMat['id'];
                if($studentCheck > 0){
                    $existed = 1;
                }
                else{
                    // create folder for the input.
                    //$currentDir = getcwd();
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
                        $ins="INSERT INTO `info`(`firstName`, `lastName`, `middleName`, `faculty`, `department`, `level`, `matNo`, `gender`, `bloodGroup`, `EmergencyNo`, `phoneNo`,`folderPath`,`qrCodeName`) 
                        VALUES ('$firstName','$lastName','$middleName','$faculty','$department','$level','$mat','$gender','$bloodgroup','$emergencyPhone','$phone','$dir','$qrFileName')";
                        $conn->query($ins);  
                        ?>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    $('#myModal').modal('toggle');
                                    $('.modal').on('hidden.bs.modal', function (e){
                                    window.location = "index.php";
                                    });
                                });
                                
                            </script>
                        <?php   
                    }else{
                       $display= "You created a file before. See An ICT Staff Now";
                    }
                } 
            }
        }    
    }
?>
<body id="body1">
        <div class="img-logo">
            <img class="logo2" src="images/logo.jpg" alt="">
        </div>
        <button class="btn btn-sm update-btn" onclick="update();" >Click Here To Update</button>
    <div class="main">
        <div class="containerr">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="images/free.png" alt="">
                </div>
                <div class="signup-form">
                    <form method="POST" action="form.php" class="register-form" id="register-form">
                        <h2 class="head">Student Information Form</h2>
                        <?php if($existed != 1) : ?>
                            <h6><?=$display;?></h6>
                        <?php else  :?>
                            <h6>You Submited Before <a href="updateform.php?update=<?=$studentID;?>">Please Update Here!</a></h6>
                        <?php endif; ?>    
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
								<select name="faculty" id="faculty" required>
                                    <option value="">Please Select</option>
									<option value="FACULTY OF TRANSPORT">FACULTY OF TRANSPORT</option>
									<option value="FACULTY OF ENGINEERING">FACULTY OF ENGINEERING</option>
									<option value="FACULTY OF ENVIRONMENTAL MANAGEMENT">FACULTY OF ENVIRONMENTAL MANAGEMENT</option>
								</select>
								<span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                                <script>
                                     document.getElementById('faculty').value = "<?=$faculty;?>";
                                </script>
							</div>
                        </div>
						<div class="form-group">
							<label for="department_name">Department:</label>
							<div class="form-select">
								<select name="department" id="department" required>
                                    <option value="">Please Select</option>
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
                                <script>
                                    document.getElementById('department').value = "<?=$department;?>";
                                </script>
							</div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="level">Level:</label>
                                <div class="">
                                    <select name="level" id="level" required>
                                        <option value="">Please Select</option>
                                        <option value="Level 1">Level 1</option>
                                        <option value="Level 2">Level 2</option>
										<option value="Level 3">Level 3</option>
										<option value="Level 4">Level 4</option>
										<option value="Level 5">Level 5</option>
                                    </select>
                                    <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                                    <script>
                                        document.getElementById('level').value = "<?=$level;?>";
                                    </script>
                                </div>
                            </div>
							<div class="form-group">
                            	<label for="mat">Mat. No.:<i style="color:#FFC800;"> Note: Please Be Sure Is Yours</i></label>
                            	<input type="text" name="mat" id="mat" value="<?=$mat;?>" placeholder="Please Make Sure Is Yours"  required/>
                        	</div>
                        </div>
                        <div class="form-radio">
                            <label for="gender" class="radio-label">Gender:</label>
                            <div class="form-radio-item">
                                <input type="radio" value="male" name="gender"  id="male" <?php if($gender == 'MALE'){ echo'checked=checked';}?> checked>
                                <label for="male">Male</label>
                                <span class="check"></span>
                            </div>
                            <div class="form-radio-item">
                                <input type="radio" value="female" name="gender" id="female"  <?php if($gender == 'FEMALE'){ echo'checked=checked';}?>>
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
                                <input type="text" name="phone" id="phone" value="<?=$phone;?>" required/>
                            </div>
                            <div class="form-group">
                                <label for="phone">Emergency Contact No( Your Reletives No):</label>
                                <input type="text" name="emergencyPhone" id="phone" value="<?=$emergencyPhone;?>" placeholder="(PLease Not Your own Number)" required/>
                            </div>
                        </div>
                        <div class="form-submit">
                            <a href="index.php" class="submit " id="reset">Back</a>
                            <input type="submit" value="Submit Form" class="submit" name="submit" id="submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function update(){
            $('#modalLoginAvatar').modal('toggle');
        }
    </script>
<?php
    include  'include/closingpage.php';  
    include  'include/matmodal.php';  
    include 'include/footer.php';
?>    


