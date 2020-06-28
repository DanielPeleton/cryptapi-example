<html>
<head>
<title>CryptApi compatibility</title>
<meta charset="UTF-8">
<style>
  .container{
    width:50%;
    margin-left:auto;
    margin-right:auto;
  }
  .mainboxheader{
    border-left:solid 1px #cecece;
    border-right:solid 1px #cecece;
    border-top:solid 1px #cecece;
    border-top-left-radius:5px;
    border-top-right-radius:5px;
    background-color:#1d9f00;
    color:#fff;
    padding:10px;
    font-size:16px;
    text-align:center;
  }
  .mainboxcontent{
    border-left:solid 1px #cecece;
    border-right:solid 1px #cecece;
    border-bottom:solid 1px #cecece;
    font-size:13px;
    text-align:center;
    color:#000;
	padding:10px;
  }
  form{
	margin-top:5px;
  }
  input{
    padding:5px;
    border:solid 1px #cecece;
    border-radius:5px;
    width:50%;
    margin-bottom:5px;
  }
  select{
    padding:5px;
    border:solid 1px #cecece;
    border-radius:5px;
    width:50%;
    margin-bottom:5px;
    background-color:#fff;
  }
  .submit{
    background-color:#1d9f00;
    color:white;
    border:none !important;
    outline:none;
    margin-bottom:0 !important;
  }
  .error{
    padding:5px;
    background-color:#b41418;
    margin-bottom:5px;
    color:white;
    width:50%;
    border-radius:5px;
    margin-left:auto;
    margin-right:auto;
    box-sizing:border-box;
  }
</style>
</head>
<body>
<div class="container">
	<div class="mainboxheader">CryptApi Example</div>
	<div class="mainboxcontent">
		<?php 
		if(isset($_POST['submit'])){
			if(!empty($_POST['coin'] && $_POST['price'])){
				if($_POST['coin'] == 'btc'){
					$callback = 'https://example.com/callback.php?id='; //callback url
					$id = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 30); //random string id
					$btc = 'bitcoin address'; //bitcoin address
					$pending = 0; //confirmation about payment to email
					$confirmations = 1; //number of confirmations before receiving the callback
					$email = 'example@example.com'; //put this empty if you didnt want receive any notification email
					$post = 0; //you can change that to 1 if you want receive post requests
					$price = $_POST['price'];

					$curl = curl_init('https://cryptapi.io/api/btc/info/');
					curl_setopt($curl, CURLOPT_TIMEOUT, 5);
					curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					$getbitcoinrate = curl_exec($curl);
					$decoderate = json_decode($getbitcoinrate);
					$rate = $decoderate->{'prices'}->{'USD'};
				  
					$calculatebitcoinrate = round($price/$rate, 8);
					  
					$url = 'https://cryptapi.io/api/btc/create/?callback=' . $callback . $id .'&address=' . $btc . '&pending=' . $pending . '&confirmations=' . $confirmations . '&email=' . $email . '&post=' . $post;

					$curl = curl_init($url);
					curl_setopt($curl, CURLOPT_TIMEOUT, 5);
					curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					$getaddress = curl_exec($curl);
					$decodeaddress = json_decode($getaddress);
			  
					$getstatus = $decodeaddress->{'status'};
					if($getstatus == 'success'){
						$getaddressin = $decodeaddress->{'address_in'};
						echo '<img alt="qr code" src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=bitcoin:'. $getaddressin . '?amount=' . $calculatebitcoinrate . '"></img><br>';
						echo "Send <b>$calculatebitcoinrate</b> to <b>$getaddressin</b>";
					}
				}elseif($_POST['coin'] == 'eth'){
					$callback = 'https://example.com/callback.php?id='; //callback url
					$id = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 30); //random string id
					$eth = 'ethereum address'; //ethereum address
					$pending = 0; //confirmation about payment to email
					$confirmations = 1; //number of confirmations before receiving the callback
					$email = 'example@example.com'; //put this empty if you didnt want receive any notification email
					$post = 0; //you can change that to 1 if you want receive post requests
					$price = $_POST['price'];

					$curl = curl_init('https://cryptapi.io/api/eth/info/');
					curl_setopt($curl, CURLOPT_TIMEOUT, 5);
					curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					$getethereumrate = curl_exec($curl);
					$decoderate = json_decode($getethereumrate);
					$rate = $decoderate->{'prices'}->{'USD'};
					
					$calculateethereumrate = round($price/$rate, 8);
				  
					$url = 'https://cryptapi.io/api/eth/create/?callback=' . $callback . $id .'&address=' . $eth . '&pending=' . $pending . '&confirmations=' . $confirmations . '&email=' . $email . '&post=' . $post;

					$curl = curl_init($url);
					curl_setopt($curl, CURLOPT_TIMEOUT, 5);
					curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					$getaddress = curl_exec($curl);
					$decodeaddress = json_decode($getaddress);
			  
					$getstatus = $decodeaddress->{'status'};
					if($getstatus == 'success'){
						$getaddressin = $decodeaddress->{'address_in'};
						echo '<img alt="qr code" src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=ethereum:'. $getaddressin . '&amount=' . $calculateethereumrate . '"></img><br>';
						echo "Send <b>$calculateethereumrate</b> to <b>$getaddressin</b>";
					} 
				}else{
					echo '<div class="error">Something went wrong</div>';
				}
			}else{
				echo '<div class="error">Please select coin or fill price value</div>';
			}
		}
	?>
		<form method="POST">
			<input type="number" name="price" placeholder="Price" min="1"/>
			<select name="coin">
				<option value="btc">Bitcoin</option>
				<option value="eth">Ethereum</option>
			</select>
			<input type="submit" class="submit" name="submit" value="Submit"/>
		</form>	
	</div>
</div>	
</body>
</html>
