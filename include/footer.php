 <!-- Footer-->
 <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">
                        Copyright &copy; NMU ID Card portal
                        <!-- This script automatically adds the current year to your website footer-->
                        <!-- (credit: https://updateyourfooter.com/)-->
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                    </div>
                    <!--<div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>-->
                </div>
            </div>
        </footer>
    </body>
</html>

<script>
    function updateMat(){  
        var getMat = jQuery('#getMat').val();
        var data = {"getMat" : getMat };
        if(!getMat.match(/(^[A-Z0-9]{5}\/[A-Z]{3}\/[0-9])|([A-Z]{4}\/[A-Z]{3}\/[0-9]{2}\/[0-9]{2}\/[0-9]*$)/)){
            error = "Wrong Matric Format";
 			jQuery('#modal_errors').html(error);
 			return;
        }else{
            windows.locaton="updateform.php";
            jQuery.ajax({
                url : '/nmuQRC/updateform.php',
                method: "post",
                data : data,
                success :function(){
                },
                error : function(){alert('Something went wrong');}
            });
        }

 	};

    function updateClose(id){
        var data = {"id" : id};
 		jQuery.ajax({
 			url : '/nmuQRC/include/updateClose.php',
 			method: "post",
 			data : data,
 			success :function(data){
 				//we append the content of the modal to this page before the closing body
 				jQuery('body').append(data);
 				//we open our modal by using our #id
 				jQuery('#updateClose').modal('toggle');
   				$("#updateClose").on("hidden.bs.modal", function () {
    			window.location = "index.php";
				});
 			},
 			error : function(){alert('Something went wrong');}
 		});
     };
</script>
