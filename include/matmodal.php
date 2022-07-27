
<?php/*
$mat =((isset($_POST['mat']) && $_POST['mat'] != '' )?sanitize($_POST['mat']):'');
$mat= trim($mat);

if(isset($_POST)){
    if(!preg_match("/(^[A-Z0-9]{5}\/[A-Z]{3}\/[0-9])|([A-Z]{4}\/[A-Z]{3}\/[0-9]{2}\/[0-9]{2}\/[0-9]*$)/",$mat)){
        $display= "Your matric number does not match";
    }
}

*/?>
<style>
    .img-update{
        width: 100px;
        height: 100px;
        margin: 0 0 0 30% !important;
    }
</style>
<!--Modal: Login with Avatar Form-->
<div class="modal fade" id="modalLoginAvatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
    <!--Content-->
    <div class="modal-content">

      <!--Header-->
      <div class="modal-header">
        <img src="images/logo.jpg" alt="avatar" class="rounded-circle img-update img-responsive">
      </div>
      <!--Body-->
      <div class="modal-body text-center mb-1">
        <h5 class="mt-1 mb-2">Enter Your Matric Number</h5>
        <p id="modal_errors"></p>
        <form action="updateform.php" method="post" id="update_mat_form" >
            <div class="md-form ml-0 mr-0">
            <input type="text" name="getMat" id="getMat" class="form-control form-control-sm validate ml-0" >
            </div>
            <div class="text-center mt-4">
            <button class="btn btn-primary btn-rounded" onclick="updateMat();return false;">Click Here</button>
            </div>
        </form>
      </div>

    </div>
    <!--/.Content-->
  </div>
</div>