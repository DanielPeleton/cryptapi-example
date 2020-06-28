<?php
	if(isset($_GET['id'], $_GET['address_in'], $_GET['address_out'], $_GET['txid_in'], $_GET['txid_out'], $_GET['confirmations'], $_GET['value'], $_GET['value_coin'], $_GET['coin'])){
		
		$id = $_GET['id'];
		$addressin = $_GET['address_in'];
		$addressout = $_GET['address_out'];
		$txidin = $_GET['txid_in'];
		$txidout = $_GET['txid_out'];
		$confirmations = $_GET['confirmations'];
		$value = $_GET['value'];
		$coinvalue = $_GET['value_coin'];
		$valueforwarded = $_GET['value_forwarded'];
		$coinvalueforwarded = $_GET['value_forwarded_coin'];
		$coin = $_GET['coin'];
		
		if($coin == 'btc'){
			$address = 'bitcoin address'; //bitcoin address 
			$callback = 'https://example.com/callback.php?id='; //callback url 
			
			$url = 'https://cryptapi.io/api/btc/logs/?callback=' . $callback . $id;
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_TIMEOUT, 5);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);		
			$getinfo = curl_exec($curl);
			$decodeinfo = json_decode($getinfo);		
			
			$checkcallbackarray = $decodeinfo->{'callbacks'};
			$countcallbackarray = count($checkcallbackarray);
			
			if($countcallbackarray == 1){
				$status = $decodeinfo->{'status'};
				$addressincheck = $decodeinfo->{'address_in'};
				$addressoutcheck = $decodeinfo->{'address_out'};
				$checktxidin = $decodeinfo->{'callbacks'}[0]->{'txid_in'};
				$checktxidout = $decodeinfo->{'callbacks'}[0]->{'txid_out'};
				$checkcoinvalue = $decodeinfo->{'callbacks'}[0]->{'value_coin'};
				
				if($status == 'success'){
					if($addressincheck == $addressin){
						if($addressoutcheck == $addressout){
							if($addressout == $address){
								if($checktxidin == $txidin){
									if($checktxidout == $txidout){
										if($checkcoinvalue == $coinvalue){
											/*
												Here put code to execute 
												
												If you want to execute this code only once, please create checker of values from database here
											*/
										}
									}
								}
							}
						}
					}
				}
			}else{
				/*
					Option when receive 2 or more bitcoin payments
				*/
				$status = $decodeinfo->{'status'};
				$addressincheck = $decodeinfo->{'address_in'};
				$addressoutcheck = $decodeinfo->{'address_out'};

				for($i=0; $i <= $countcallbackarray - 1; $i++){
					$checktxidin = $decodeinfo->{'callbacks'}[$i]->{'txid_in'};
					$checktxidout = $decodeinfo->{'callbacks'}[$i]->{'txid_out'};
					$checkcoinvalue = $decodeinfo->{'callbacks'}[$i]->{'value_coin'};					

					if($status == 'success'){
						if($addressincheck == $addressin){
							if($addressoutcheck == $addressout){
								if($addressout == $address){
									if($checktxidin == $txidin){
										if($checktxidout == $txidout){
											if($checkcoinvalue == $coinvalue){
												/*
													Here put code to execute 
													
													If you want to execute this code only once, please create checker of values from database here
												*/
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}elseif($coin == 'eth'){
			$address = 'ethereum address'; //ethereumaddress 
			$callback = 'https://example.com/callback.php?id='; //callback url 
			
			$url = 'https://cryptapi.io/api/eth/logs/?callback=' . $callback . $id;
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_TIMEOUT, 5);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);		
			$getinfo = curl_exec($curl);
			$decodeinfo = json_decode($getinfo);		
			
			$checkcallbackarray = $decodeinfo->{'callbacks'};
			$countcallbackarray = count($checkcallbackarray);
			
			if($countcallbackarray == 1){
				$status = $decodeinfo->{'status'};
				$addressincheck = $decodeinfo->{'address_in'};
				$addressoutcheck = $decodeinfo->{'address_out'};
				$checktxidin = $decodeinfo->{'callbacks'}[0]->{'txid_in'};
				$checktxidout = $decodeinfo->{'callbacks'}[0]->{'txid_out'};
				$checkcoinvalue = $decodeinfo->{'callbacks'}[0]->{'value_coin'};
				
				if($status == 'success'){
					if($addressincheck == $addressin){
						if($addressoutcheck == $addressout){
							if($addressout == $address){
								if($checktxidin == $txidin){
									if($checktxidout == $txidout){
										if($checkcoinvalue == $coinvalue){
											/*
												Here put code to execute 
												
												If you want to execute this code only once, please create checker of values from database here
											*/
										}
									}
								}
							}
						}
					}
				}
			}else{
				/*
					Option when receive 2 or more ethereum payments
				*/
				$status = $decodeinfo->{'status'};
				$addressincheck = $decodeinfo->{'address_in'};
				$addressoutcheck = $decodeinfo->{'address_out'};

				for($i=0; $i <= $countcallbackarray - 1; $i++){
					$checktxidin = $decodeinfo->{'callbacks'}[$i]->{'txid_in'};
					$checktxidout = $decodeinfo->{'callbacks'}[$i]->{'txid_out'};
					$checkcoinvalue = $decodeinfo->{'callbacks'}[$i]->{'value_coin'};					

					if($status == 'success'){
						if($addressincheck == $addressin){
							if($addressoutcheck == $addressout){
								if($addressout == $address){
									if($checktxidin == $txidin){
										if($checktxidout == $txidout){
											if($checkcoinvalue == $coinvalue){
												/*
													Here put code to execute 
													
													If you want to execute this code only once, please create checker of values from database here
												*/
											}
										}
									}
								}
							}
						}
					}
				}
			}		
		}
	}
?>
