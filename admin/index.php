<?php
    include "include/header.php";

    // get login id
    if(!isset($_SESSION['login'])){
        header("location: login.php");
    }
    if(isset($_SESSION['welcome'])){
        //$login = $_SESSION['login'];
        ?>
            <script type="text/javascript">
                $(document).ready(function(){
                    $('#welcome').modal('toggle');
                });
                
            </script>
        <?php   
        unset($_SESSION['welcome']);
    }
    include 'include/nav.php'; 
    // import from database
    $sql = $conn->query("SELECT * FROM `info`");
   // $result = mysqli_fetch_assoc($sql);

?>
<body>
    <div class="main">
        <script>
            $(document).ready(function() {
                $('#example').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5'
                        
                    ]
                } );    
            } );
        </script>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>SurN</th>
                    <th>FirstN</th>
                    <th>MidN</th>
                    <th>Faculty</th>
                    <th>Dept.</th>
                    <th>Level</th>
                    <th>MatNo</th>
                    <th>Sex</th>
                    <th>BG</th>
                    <th>E-No</th>
                    <th>P-No</th>
                    <th>Printed</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($result = mysqli_fetch_assoc($sql)) : ?>
                <tr>
                    <td><?=$result['lastName'];?></td>
                    <td><?=$result['firstName'];?></td>
                    <td><?=$result['middleName'];?></td>
                    <td><?=$result['faculty'];?></td>
                    <td><?=$result['department'];?></td>
                    <td><?=$result['level'];?></td>
                    <td><?=$result['matNo'];?></td>
                    <td><?=$result['gender'];?></td>
                    <td><?=$result['bloodGroup'];?></td>
                    <td><?=$result['EmergencyNo'];?></td>
                    <td><?=$result['phoneNo'];?></td>
                    <td> &nbsp;</td>  
                </tr>
                <?php endwhile; ?>    
            </tbody>
            <tfoot>
                <tr>
                    <th>SurN</th>
                    <th>FirstN</th>
                    <th>MidN</th>
                    <th>Faculty</th>
                    <th>Dept.</th>
                    <th>Level</th>
                    <th>MatNo</th>
                    <th>Sex</th>
                    <th>BG</th>
                    <th>E-No</th>
                    <th>P-No</th>
                    <th>Printed</th>
                </tr>
            </tfoot>
        </table>
        <div class="clear"></div>
    </div>    
</body>
<?php 
include 'include/welcome.php';
include 'include/footer.php'; 
?>