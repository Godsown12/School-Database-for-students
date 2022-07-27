<?php
    include_once 'include/header.php';
    //function of 
    function sanitize($dirty){
        return htmlentities($dirty, ENT_QUOTES, "UTF-8");
    }
    $display= '';
    $path = '';
    $sql= $conn->query("SELECT * FROM info WHERE matNo = '$mat'");
    $result = mysqli_fetch_assoc($sql);
    $mat= ((isset($_POST['mat']) && $_POST['mat'] != '')?sanitize($_POST['mat']):$result['matNO']);

    if(isset($_POST['submit'])){
        if(!preg_match("/(^[A-Z0-9]{5}\/[A-Z]{3}\/[0-9])|([A-Z]{4}\/[A-Z]{3}\/[0-9]{2}\/[0-9]{2}\/[0-9]*$)/",$mat)){
            $display= "Wrong Matric Format";
        }else{
        // check if student exits
            $check= $conn->query("SELECT * FROM info WHERE matNo = '$mat'");
            $studentCheck = mysqli_num_rows($check);
            $path = mysqli_fetch_assoc($check);
            $pathFolder = $path['folderPath'];
            $qrcName = $path['qrCodeName'];
            if($studentCheck < 1){
                $display = 'Matric Number Is Not In Our Database';   
            }else{
                $path = $pathFolder;
                $qrcodeName = $qrcName;
            }
        }  
    }
?>
<!-- css code in style.css-->
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="index.php">NMU QR-CODE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link" href="form.php">Update</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">Back</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main1">
        <div class="containerr">
            <div class="col-sm-6 form-class">
                <form action="check.php" method="post">
                    <div class="form-row">
                        <div class="col-md-6 form-group">
                            <label for="mat">Matric No:</label>
                            <input type="text" name="mat" id="mat" class="form-control" value="<?=$mat;?>" required />
                        </div> 
                        <div class="col-md-5">
                        <label for="mat"></label>
                            <button class="submit form-control button1" name="submit" id="submit">Check</button>
                        </div>   
                    </div>    
                </form>
            </div>   
            <div class="col-md-12">
                <div class="qrc-image">
                <h6><?=$display;?></h6>
                    <img src="<?=$path;?><?=$qrcodeName;?>.png" alt="">
                </div> 
            </div>
        </div>  
    </div>
<?php
    include_once 'include/footer.php';
?>