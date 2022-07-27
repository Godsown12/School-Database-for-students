<?php
    require_once "../int.php";
    function sanitize($dirty){
        return htmlentities($dirty, ENT_QUOTES, "UTF-8");
    }
    $id = ((isset($_POST['id']) && $_POST['id'] != '')?sanitize($_POST['id']):'');
    $id = (int)$id;
    $sqlCh= $conn->query("SELECT * FROM `info` WHERE `id` = '$id'");
    $result = mysqli_fetch_assoc($sqlCh);
?>
<style>
@font-face {
   font-family: 'Material Icons';
   font-style: normal;
   font-weight: 400;
   src: url(iconfont/MaterialIcons-Regular.eot); /* For IE6-8 */
   src: local('Material Icons'),
        local('MaterialIcons-Regular'),
        url(iconfont/MaterialIcons-Regular.woff2) format('woff2'),
        url(iconfont/MaterialIcons-Regular.woff) format('woff'),
        url(iconfont/MaterialIcons-Regular.ttf) format('truetype');
}

.material-icons {
  font-family: 'Material Icons';
  font-weight: normal;
  font-style: normal;
  font-size: 24px;  /* Preferred icon size */
  display: inline-block;
  line-height: 1;
  text-transform: none;
  letter-spacing: normal;
  word-wrap: normal;
  white-space: nowrap;
  direction: ltr;

  /* Support for all WebKit browsers. */
  -webkit-font-smoothing: antialiased;
  /* Support for Safari and Chrome. */
  text-rendering: optimizeLegibility;

  /* Support for Firefox. */
  -moz-osx-font-smoothing: grayscale;

  /* Support for IE. */
  font-feature-settings: 'liga';
}

.modal-confirm {		
	color: #434e65;
	width: 525px;
}
.modal-confirm .modal-content {
	padding: 20px;
	font-size: 16px;
	border-radius: 5px;
	border: none;
}
.modal-confirm .modal-header {
	background: #9AA1F8;
	border-bottom: none;   
	position: relative;
	text-align: center;
	margin: -20px -20px 0;
	border-radius: 5px 5px 0 0;
	padding: 35px;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 36px;
	margin: 10px 0;
}
.modal-confirm .form-control, .modal-confirm .btn {
	min-height: 40px;
	border-radius: 3px; 
}
.modal-confirm .close {
	position: absolute;
	top: 15px;
	right: 15px;
	color: #fff;
	text-shadow: none;
	opacity: 0.5;
}
.modal-confirm .close:hover {
	opacity: 0.8;
}
.modal-confirm .icon-box {
	color: #fff;		
	width: 95px;
	height: 95px;
	display: inline-block;
	border-radius: 50%;
	z-index: 9;
	border: 5px solid #fff;
	padding: 15px;
	text-align: center;
}
.modal-confirm .icon-box i {
	font-size: 64px;
	margin: -4px 0 0 -4px;
}
.modal-confirm.modal-dialog {
	margin-top: 80px;
}
.modal-confirm .btn, .modal-confirm .btn:active {
	color: #fff;
	border-radius: 4px;
	background: #eeb711 !important;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	border-radius: 30px;
	margin-top: 10px;
	padding: 6px 20px;
	border: none;
}
.modal-confirm .btn:hover, .modal-confirm .btn:focus {
	background: #eda645 !important;
	outline: none;
}
.modal-confirm .btn span {
	margin: 1px 3px 0;
	float: left;
}
.modal-confirm .btn i {
	margin-left: 1px;
	font-size: 20px;
	float: right;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
</style>
<!-- Modal -->
<!-- Modal HTML -->
<div id="updateClose" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header justify-content-center">
				<div class="icon-box">
					<i class="material-icons">&#xE876;</i>
				</div>
				<button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body text-center">
				<h4>GREAT! <?=$result['lastName'];?></h4>	
				<p>Your QR-Code has been updated.</p>
				<button class="btn btn-success" data-bs-dismiss="modal"><span>Close</span> <i class="material-icons">&#xE5C8;</i></button>
			</div>
		</div>
	</div>
</div> 