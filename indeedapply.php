    
<?php
/*
   CreateandUpdateIndeedLeads.php
   Marketo REST API Sample Code
   Copyright (C) 2016 Marketo, Inc.
   This software may be modified and distributed under the terms
   of the MIT license.  See the LICENSE file for details.
*/

$lead1 = new stdClass();
file_put_contents("indeed.txt", file_get_contents("php://input"));
$bodydata = file_get_contents("php://input");

$fullarray = json_decode($bodydata, true);

$jsonid = $fullarray['id'];
$jobarray = $fullarray['job'];
$jobtitle = $jobarray['jobTitle'];
$joburl = $jobarray['jobUrl'];
$parse = parse_url($joburl);
$sitedomain = $parse['host'];

//echo $sitedomain;
//exit();


$applicantarray = $fullarray['applicant'];
$analyticsarray = $fullarray['analytics'];
$questionanswersarray = $fullarray['questionsAndAnswers'];
// print_r($jsonid);
// print_r($jobarray);
$jobid = $jobarray['jobId'];
$email = $applicantarray['email'];
$fullname = $applicantarray['fullName'];
$resumename = $applicantarray['resume']['file']['fileName'];
$resumedata = $applicantarray['resume']['file']['data'];
$phone = $applicantarray['phoneNumber'];
$phonewithoutdash = str_replace([' ','-'],'', $phone);

$namesplit = explode(' ', $fullname);

if (count($namesplit) === 1) {
$firstname = $fullname;
$lastname = '';
$lead1->firstName = $fullname;
$lead1->lastName = '';

} 
else {
$firstname = $namesplit[0];
$removed = array_shift($namesplit); 
$lastname = implode( ' ', $namesplit );
//print_r($firstname);
//print_r($lastname);
$lead1->firstName = $firstname;
$lead1->lastName = $lastname;
}

/* getting questions data from json data */

/* relocation questions */
$questionsAndAnswersdata = $fullarray['questionsAndAnswers'];
$relocation = '';
$legalauth = '';
$currentstudent = '';
$studentcondition1 = '';
$gradcondition1 = '';
$gradcondition2 = '';
$studentcondition2 = '';
$major = '';
$majorc = '';
$programmingexp = '';
/* getting questions data from json data */

 foreach ($fullarray['questionsAndAnswers']['questionsAndAnswers'] as $questionsAndAnswersinner ) {

    /* relocation */
    if ($questionsAndAnswersinner['question']['id'] == 'relocation'){
      $relocationanswerlabel = $questionsAndAnswersinner['answer']['label'];
       if($relocationanswerlabel == 'Yes'){
          $relocation = 'Yes';
       }
       elseif($relocationanswerlabel == 'No'){
          $relocation = 'No';
       }
       else{
          $relocation = '';
       }
    }

    /* legal auth */
    if ($questionsAndAnswersinner['question']['id'] == 'legalauth'){
      $legalauthanswerlabel = $questionsAndAnswersinner['answer']['label'];
       if($legalauthanswerlabel == 'Yes'){
          $legalauth = 'Yes';
       }
       elseif($legalauthanswerlabel == 'No'){
          $legalauth = 'No';
       }
       else{
          $legalauth = '';
       }
    }

    /* current student */
    if ($questionsAndAnswersinner['question']['id'] == 'student'){
      $studentanswerlabel = $questionsAndAnswersinner['answer']['label'];

       if($studentanswerlabel == 'Yes'){
          $currentstudent = 'Yes';
       }
       elseif($studentanswerlabel == 'No'){
          $currentstudent = 'No';
       }
       else{
          $currentstudent = '';
       }
    }
    
    /* Degree Expected */
     if ($questionsAndAnswersinner['question']['id'] == 'studentcondition1'){
      $studentcondition1answerlabel = $questionsAndAnswersinner['answer']['value'];
       if($studentcondition1answerlabel == 1){
          $studentcondition1 = "High School";
       }
       elseif($studentcondition1answerlabel == 2){
          $studentcondition1 = "Associate's Degree";
       }
       elseif($studentcondition1answerlabel == 3){
          $studentcondition1 = "Bachelor's Degree";
       }      
       elseif($studentcondition1answerlabel == 4){
          $studentcondition1 = "Master's Degree";
       }
       else{
          $studentcondition1 = '';
       }
    }   

    /* graduation month */
     if ($questionsAndAnswersinner['question']['id'] == 'studentcondition1-1'){
      $graduation1answerlabel = $questionsAndAnswersinner['answer']['value'];
       if($graduation1answerlabel == 1){
          $gradcondition1 = '01';
       }
       elseif($graduation1answerlabel == 2){
          $gradcondition1 = "02";
       }
       elseif($graduation1answerlabel == 3){
          $gradcondition1 = "03";
       }
       elseif($graduation1answerlabel == 4){
          $gradcondition1 = "04";
       }
       elseif($graduation1answerlabel == 5){
          $gradcondition1 = "05";
       } 
       elseif($graduation1answerlabel == 6){
          $gradcondition1 = "06";
       }
       elseif($graduation1answerlabel == 7){
          $gradcondition1 = "07";
       }
       elseif($graduation1answerlabel == 8){
          $gradcondition1 = "08";
       }
       elseif($graduation1answerlabel == 9){
          $gradcondition1 = "09";
       }
       elseif($graduation1answerlabel == 10){
          $gradcondition1 = "10";
       }
       elseif($graduation1answerlabel == 11){
          $gradcondition1 = "11";
       }
       elseif($graduation1answerlabel == 12){
          $gradcondition1 = "12";
       }
        
       else{
          $gradcondition1 = '';
       }
    }   
   
 
     /* graduation month */
     if ($questionsAndAnswersinner['question']['id'] == 'studentcondition1-2'){
      $graduation2answerlabel = $questionsAndAnswersinner['answer']['value'];
       if($graduation2answerlabel == 1){
          $gradcondition2 = "2022";
       }
       elseif($graduation2answerlabel == 2){
          $gradcondition2 = "2023";
       }
       elseif($graduation2answerlabel == 3){
          $gradcondition2 = "2024";
       }
       elseif($graduation2answerlabel == 4){
          $gradcondition2 = "2025";
       }
       elseif($graduation2answerlabel == 5){
          $gradcondition2 = "2026";
       } 
       elseif($graduation2answerlabel == 6){
          $gradcondition2 = "2027";
       } 
       elseif($graduation2answerlabel == 7){
          $gradcondition2 = "2028";
       } 
       elseif($graduation2answerlabel == 8){
          $gradcondition2 = "2029";
       } 
       elseif($graduation2answerlabel == 9){
          $gradcondition2 = "2030";
       } 
       elseif($graduation2answerlabel == 10){
          $gradcondition2 = "2031";
       } 
       elseif($graduation2answerlabel == 11){
          $gradcondition2 = "2032";
       }     
       else{
          $gradcondition2 = '';
       }
    }      
    
    /* Highest degree questions */
     if ($questionsAndAnswersinner['question']['id'] == 'studentcondition2'){
      $studentcondition2answerlabel = $questionsAndAnswersinner['answer']['value'];
       if($studentcondition2answerlabel == 1){
          $studentcondition2 = 'High School';
       }
       elseif($studentcondition2answerlabel == 2){
          $studentcondition2 = "Associate's Degree";
       }
       elseif($studentcondition2answerlabel == 3){
          $studentcondition2 = "Bachelor's Degree";
       }   
       elseif($studentcondition2answerlabel == 4){
          $studentcondition2 = "Bachelor's Degree";
       }
       elseif($studentcondition2answerlabel == 5){
          $studentcondition2 = "Master's Degree";
       }
       else{
          $studentcondition2 = '';
       }
    }   

    /* major questions */
     if ($questionsAndAnswersinner['question']['id'] == 'degreecondition2'){
      $majoranswerlabel = $questionsAndAnswersinner['answer']['label'];
       if($majoranswerlabel == 'Programming'){
          $major = 'Computer Science';
          $majorc = 'a0A0P00001ZJyDNUA1';
       }
       elseif($majoranswerlabel == 'STEM'){
          $major = 'Information Sciences';
          $majorc = 'a0A0P00001ZJyCsUAL';
       }
       elseif($majoranswerlabel == 'Other'){
          $major = 'Liberal Arts';
          $majorc = 'a0A0P00001ZJyDlUAL';
       }
       else{
          $major = '';
          $majorc = '';
       }
    }   

    /* programming experience questions */
     if ($questionsAndAnswersinner['question']['id'] == 'programmingexp'){
      $programmingexpanswerlabel = $questionsAndAnswersinner['answer']['label'];
       if($programmingexpanswerlabel == 'None'){
          $programmingexp = 'No';
       }
       elseif($programmingexpanswerlabel == '0-1 year'){
          $programmingexp = '0-1 year';
       }
       elseif($programmingexpanswerlabel == '1-3 years'){
          $programmingexp = '1-3 years';
       }
       elseif($programmingexpanswerlabel == '3-5 years'){
          $programmingexp = '3-5 years';
       }
       elseif($programmingexpanswerlabel == '5+ years'){
          $programmingexp = '5+ years';
       }
       else{
          $programmingexp = '';
       }
    }    

   }


/* curl for pushing resume to aws */
$url = "https://8y1ub2vjek.execute-api.us-east-1.amazonaws.com/prod/ResumePush";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = '{"key":"245583662863Rk863369","person":"'.$fullname.'", "filename": "'.$resumename.'", "file": "'.$resumedata.'"}';

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
//var_dump($resp);
$response = json_decode($resp, TRUE);

$resumestatus = $response["success"]; 

$resumename = $response["filename"]; 
$resumelink = $response["link"]; 


$newphone = (strlen($phonewithoutdash)>=10)?substr($phonewithoutdash, -10):trim($phonewithoutdash, '-');
//echo $newphone;
$lead1->email = $email;
$lead1->mobilePhone = $newphone;

if($analyticsarray['device'] == 'desktop'){
  $lead1->ApplicationDevice__c = 'desktop';
}
elseif($analyticsarray['device'] == 'tablet'){
  $lead1->ApplicationDevice__c = 'desktop';
}
elseif($analyticsarray['device'] == 'mobile'){
  $lead1->ApplicationDevice__c = 'mobile';
}
else{
  
}

$lead1->major = $major;
$lead1->Major__c = $majorc;
$lead1->relocationResponse = $relocation;
$lead1->areyouacurrentstudent = $currentstudent;
$lead1->workAuthorization = $legalauth;
$lead1->resumeURL = $resumelink;

if($studentcondition1 == ''){
	//echo "empty degree";
   $lead1->educationLevel = $studentcondition2;
}
elseif($studentcondition2 == ''){
	//echo "empty highest";
$lead1->educationLevel = $studentcondition1;
}
else{
   $lead1->educationLevel = '';
}

$lead1->OOPExperience__c = $programmingexp;
$lead1->graduationterm = $gradcondition1;
$lead1->graduationYear = $gradcondition2;
$str2 = "-";
$str3 = "-01";
if (( $gradcondition1 == '') || ( $gradcondition2 == '')) {

}
else{

   $lead1->graduationDate = "{$gradcondition2}{$str2}{$gradcondition1}{$str3}";
}
$lead1->appliedJobTitle = $jobtitle;
$lead1->url = $joburl;
$lead1->LeadSource = 'Indeed (Applied)';
$lead1->leadType = 'Recruiting';
$lead1->leadDate = date('Y-m-d\TH:i:s.Z\Z', time());

$upsert = new UpsertLeads();
$upsert->input = array($lead1);
print_r($upsert->postData());
class UpsertLeads{
	private $host = "https://733-JWE-559.mktorest.com";//CHANGE ME
	private $clientId = "9fb5371b-5c50-4d8e-8c6e-5e6b266a1453";//CHANGE ME
	private $clientSecret = "2yhrGi2LuuLrFZ1cmAlso8uhVQi7GwvL";//CHANGE ME
	public $input = array('Email'); //an array of lead records as objects
	public $lookupField = "email"; //field used for deduplication
	public $action = "createOrUpdate"; //operation type, createOnly, updateOnly, createOrUpdate, createDuplicate
	
	public function postData(){
		$url = $this->host . "/rest/v1/leads.json?access_token=" . $this->getToken();
		$ch = curl_init($url);
		$requestBody = $this->bodyBuilder();
		//

		//print_r($requestBody);
		$character = json_decode($requestBody,true);
		//print_r($character);
		$inputarray = $character['input'];
    	//print_r($inputarray);
		$myJSON = json_encode($inputarray);
		//print_r($myJSON);
		//echo json_encode($character[0]->input);		
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json','Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
		curl_getinfo($ch);
		$response = curl_exec($ch);
		$arrayresponse = json_decode($response,true);
		//print_r($arrayresponse);
		$arrayresponse2 = $arrayresponse['result'];
		$arrayresponse3 = $arrayresponse['result']['0'];
		$arrayresponse4 = $arrayresponse['result']['0']['reasons'];
		$statusresponse1 = $arrayresponse['result']['0']['status'];
		$arrayresponse5 = $arrayresponse['result']['0']['reasons']['0']['message'];
		
		print_r($arrayresponse5);
		print_r($statusresponse1);
		if($statusresponse1 == "created") {

	        //create a PHP object to store Marketo data
	        $jsonObj -> result = 'true';
	        $jsonObj -> status = 'Lead Created';
			$json = json_encode($jsonObj);
    		echo $json;
		}
		elseif (($arrayresponse5 == "Lead already exists") && ($statusresponse1 == "skipped") ){
			//$message = "Lead Already exist";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			//return $arrayresponse5;
			$jsonObj -> result = 'false';
        	$jsonObj -> status = 'Lead already exists';
        	$json = json_encode($jsonObj);
    		echo $json;
			//exit();
			
		}
		elseif ($statusresponse1 == "updated") {
			//$message = "Lead Already exist";
			//echo "<script type='text/javascript'>alert('$message');</script>";
			//return $arrayresponse5;
			$jsonObj -> result = 'true';
        	$jsonObj -> status = 'Lead data updated';
        	$json = json_encode($jsonObj);
    		echo $json;
			//exit();
			
		}		
		
		elseif (($arrayresponse5 == "Field 'key' not found") && ($statusresponse1 == "skipped") ) {

			$jsonObj -> result = 'false';
        	$jsonObj -> status = 'Please try with correct data';
        	$json = json_encode($jsonObj);
    		echo $json;
			//exit();
		}

		else {
			$jsonObj -> result = 'false';
        	$jsonObj -> status = 'Please try with correct data error';
        	$json = json_encode($jsonObj);
    		echo $json;
			//exit();
		}
		
		//return $arrayresponse;

	}
	
	private function getToken(){
		$ch = curl_init($this->host . "/identity/oauth/token?grant_type=client_credentials&client_id=" . $this->clientId . "&client_secret=" . $this->clientSecret);
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json',));
		$response = json_decode(curl_exec($ch));
		curl_close($ch);
		$token = $response->access_token;
		return $token;
	}
	private function bodyBuilder(){
		$body = new stdClass();
		if (isset($this->action)){
			$body->action = $this->action;
		}
		if (isset($this->lookupField)){
			$body->lookupField = $this->lookupField;
		}
		$body->input = $this->input;
		$json = json_encode($body);
		
		return $json;
		
	}
}
?>
