

<!DOCTYPE html>
<html>
<head>
	<title>Ceker Pedazt Ayam</title>

	<link rel="icon" href="https://3.bp.blogspot.com/-H0_UqWd-vLo/WRxyOdw34WI/AAAAAAAAAf4/ljZtX0-skqYnx7Ol5PjGJvLdXRwuUrBEQCLcB/w1200-h630-p-k-no-nu/MIMPI%2BPENIS%2BKELAMIN%2BLAKI-LAKI%2BZAKAR%2B%2528Menurut%2BPrimbon%2529.png" type="image/icon type">

	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	

</head>
<body style="margin:0 auto">
	<div style="text-align: center">
	<h2>Ceker Ayam</h2>
	
	<textarea style="width: 600px;height: 300px" placeholder="4337390003297786|09|22|603 OR 4337390003297786/02/21/603" id="ccarea" name="ccarea" ></textarea><br>
	<button type="button" class="btn btn-primary btn-lg" id="checkBtn" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing Order">Check CC</button>




</div>
	<br><br><br>

	<br>
	<div style="width: 600px;height: 300px;margin: 0 auto;">
		
		<div id="hasilcek" style="text-align: left;margin-left:30px;">
			
			<div id='ccclive' style="display:none">
				<center><strong style="color:green;font-size: 20px"><u>~LIVE~</u></strong></center>
				<textarea id='cclive' style="display:block;width: 100%;height:300px;font-size: 15px" onclick="this.select()"></textarea>
			</div>

			<div id='cccdead' style="display:none">
				<center><strong style="color:red;font-size: 20px"><u>~DEAD~</u></strong></center>
				<textarea id='ccdead' style="display:block;width: 100%;height:300px;font-size: 15px" onclick="this.select()"></textarea>
			</div>

			<div id='cccunk' style="display:none">
				<center><strong style="color:black;font-size: 20px"><u>~Unknown~</u></strong></center>
				<textarea id='ccunk' style="display:block;width: 100%;height:300px;font-size: 15px" onclick="this.select()"></textarea>
			</div>


		</div>
	</div>
</div>

<script type="text/javascript">
	const sleep = (milliseconds) => {
		return new Promise(resolve => setTimeout(resolve, milliseconds))}


	$(document).ready(function(){

		$('#checkBtn').click(function(){


			document.getElementById('ccarea').disabled = true;
			var $btn = $(this);
			$btn.attr('disabled',true);
			var loadingText  = '<i class="spinner-border text-danger"></i> Checking...';
			$btn.html(loadingText);
			var cc = $('#ccarea').val().split('\n');
			var optc = 0;

			function opt(){
				++optc;
				//console.log(cc.length+' '+optc);
				remLine();
				if(optc==cc.length){

					sleep(2000).then(()=>{
						$btn.attr('disabled',false);
						$btn.html('Check CC');
						document.getElementById('ccarea').disabled = false;
					})
					
				}
			}


			for(i=0;i<cc.length;i++){
				
				$.ajax({
					url : 'gate.php',
					type : 'POST',
					data : ({ccarea : cc[i]}),
					success: function(resp){
						console.log(resp);
						if(resp.indexOf('LIVE')!=-1){
							document.getElementById('ccclive').style.display='block';
							document.getElementById('cclive').innerHTML += resp+'\n';

						}else if(resp.indexOf('DEAD')!=-1){
							document.getElementById('cccdead').style.display='block';
							document.getElementById('ccdead').innerHTML += resp+'\n';

						}else if(resp.indexOf('Failed')!=-1){
							document.getElementById('cccunk').style.display='block';
							document.getElementById('ccunk').innerHTML += resp+'\n';

						}
						
						opt();
						
					}
				});

				
			
			}


			

					
			



		});
	});


	function remLine(){
		var val = $('#ccarea').val().split(/\n+/g);
		val.shift();
		$("#ccarea").val(val.join("\n"));
	}




</script>



</body>
</html>


