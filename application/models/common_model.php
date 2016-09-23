<?php
class Common_model extends CI_Model
{
    
    public function __construct()
    {
        $this->load->database();
		$this->load->helper('date');
		
    }
    
    /*
    Purpose: Invoked To Authenticate user from DB.
    
    */
	public function getSettings(){
	   $query = $this->db->get('tbl_settings');
	   if(count($query->result_array())>0){
		 foreach ($query->result_array() as $row)
		 {
				return $row['amount'];
		 }
	   }else{
	         return 0;
	   }
	}
	public function SaveAmount($amount){
		$query = $this->db->get('tbl_settings');
			       $data = array(
			   'amount' => $amount 
			);
	   if(count($query->result_array())>0){
			 $this->db->update('tbl_settings', $data);   
	   }else{
	      $this->db->insert('tbl_settings', $data); 
	   }
	}
    public function login($arr)
    {
        log_message('debug', 'dmb.login_model.login - Starting');
        $response['status'] = "Invalid Login Details";
		$txtEmailId=mysql_real_escape_string($arr['txtEmailId']);
		$txtMobileNo=mysql_real_escape_string($arr['txtMobileNo']);
		$txtPassword=md5(mysql_real_escape_string($arr['txtPassword']));
		if($txtEmailId)
		{
			$sql="Select * from tbl_user where UserID='".$txtEmailId."' AND password='".$txtPassword."'";
			log_message('debug', 'dmb.login_model.login - Logging with Email ' . $sql);
        
			$query = $this->db->query($sql);
			$loginTime = unix_to_human(now(),true,'');
			
			foreach ($query->result_array() as $row) 
			{
				$response['status']      = 'success';
				$response['First_Name']  = $row['First_Name'];
				$response['Last_Name']   = $row['Last_Name'];
				$response['UserID']     = $row['UserID'];
				$response['Id']     = $row['Id'];	
				$response['userType']= $row['userType'];	
				$response['IsPayment']= $row['IsPayment'];	
				$response['DOB']= $row['DOB'];	
				$response['payment_date']= $row['payment_date'];					
				log_message('debug', 'dmb.login_model.login - User Found');
			}
			
		}
		else if($txtMobileNo)
		{
			$sql="Select * from tbl_user where  mobileNo=".$txtMobileNo." AND password='".$txtPassword."'";
			log_message('debug', 'dmb.login_model.login - Logging with Mobile ' . $sql);
        
			$query = $this->db->query($sql);
			
			foreach ($query->result_array() as $row) 
			{
				$response['status']      = 'success';
				$response['First_Name']  = $row['First_Name'];
				$response['Last_Name']   = $row['Last_Name'];
				$response['UserID']     = $row['UserID'];
				$response['Id']     = $row['Id'];	
				$response['userType']= $row['userType'];	
				$response['IsPayment']= $row['IsPayment'];
				$response['payment_date']= $row['payment_date'];
				$response['DOB']= $row['DOB'];				
				log_message('debug', 'dmb.login_model.login - User Found');
			}
		}
		
        log_message('debug', 'dmb.login_model.login - Exiting');
        
        return $response;
    }  
	public function Saveauthorizenet($arr,$User_ID){
		$data = array(
				'payment_gross'=>$arr->amount,
				'transaction_no'=>$arr->transaction_id,
				'payment_date'=>Date('Y-m-d'),
				'payer_email'=>$arr->email_address,
				'UserId'=>$User_ID,
				'receiver_id'=>$arr->account_number,
				'payment_status'=>$arr->approved
			);
		$this->db->insert('tbl_payment', $data);
	}
	public function setPayment($arr,$User_ID){
	     $data = array(
				'payment_gross'=>$arr['payment_gross'],
				'receiver_id'=>$arr['receiver_id'],
				'receiver_email'=>$arr['receiver_email'],
				'payment_date'=>$arr['payment_date'],
				'payment_status'=>$arr['payment_status'],
				'payer_email'=>$arr['payer_email'],
				'UserId'=>$User_ID,
			);
		$this->db->insert('tbl_payment', $data);
	}
    public function getUsers(){
	  $query = $this->db->get('tbl_user');
	   return $query->result_array();
	}
	public function getWill(){
	   $query = $this->db->get('tbl_will');
	   return $query->result_array();
	}
	public function getPayments(){
		 $query = $this->db->get('tbl_payment');
	   return $query->result_array();
	}
	public function deleteUser($ItemId){
	   return $this->db->delete('tbl_user', array('Id' => $ItemId));
	}
	public function deleteWill($ItemId){
		return $this->db->delete('tbl_will', array('Id' => $ItemId));
	}
	public function getUsersById($ItemId){
		$query = $this->db->get_where('tbl_user', array('Id' => $ItemId));
		return $query->result_array();
	}
	public function getWillById($ItemId){
		$query = $this->db->get_where('tbl_will', array('Id' => $ItemId));
		return $query->result_array();
	}
	public function updateUser($arr){
		$txtDateOfBirth= $_POST['txtDateOfBirth'];
		$old_date_timestamp = strtotime($txtDateOfBirth);
		$DateOfBirth = date('Y-m-d ', $old_date_timestamp);
		  $data = array(
				'First_Name'=>$arr['txtFirstName'],
				'Last_Name'=>$arr['txtLastName'],
				'UserID'=>$arr['txtEmailId'],
				'DOB'=>$DateOfBirth,
				'mobileNo'=>$arr['txtMobileNo'],
				'userType'=>$arr['userType']
			);
		$this->db->where('Id',$arr['txtUserId']);
		$response=$this->db->update('tbl_user', $data);
		//echo $sql = $this->db->last_query();
		return $response;
	}
	public function registration($arr,$password)
    {
		log_message('debug', 'dmb.common_model.registration - Starting');
			
			//print_r($_POST);
			//exit;

			log_message('debug', 'dmb.common_model.registration - password '.$password);
			$txtDateOfBirth= $_POST['txtDateOfBirth'];
			$old_date_timestamp = strtotime($txtDateOfBirth);
			$DateOfBirth = date('Y-m-d', $old_date_timestamp); 
			$age = $this->getAge($_POST['txtDateOfBirth']);
			$IsPayment = 0;
			$payment_date = "";
			
			

			if($age<=18){$IsPayment=1;$payment_date=date('Y-m-d');}
			$data=array(
				'First_Name'=>$arr['txtFirstName'],
				'Last_Name'=>$arr['txtLastName'],
				'password'=>md5($password),
				'UserID'=>$arr['txtEmailId-reg'],
				'DOB'=>$DateOfBirth,
				'mobileNo'=>$arr['txtMobileNo-reg'],
				'IsPayment'=>$IsPayment,
				'payment_date'=>$payment_date
			);
			$response=$this->db->insert('tbl_user',$data);
			return $response;
			
		log_message('debug', 'dmb.common_model.registration - Exiting');
	}
	function forgotChangePassword($arr,$UserID)
	{		
		log_message('debug', 'dmb.common_model.forgotChangePassword - Starting');
				$SQl="UPDATE tbl_user SET  password='".MD5($arr['newpassword'])."' where UserID='".$UserID."' AND password='".md5($arr['currentpassword'])."'";
				log_message('debug', 'dmb.common_model.registration -SQl -'.$SQl);
				
				$query = $this->db->query($SQl);
				return $query;	
		log_message('debug', 'dmb.common_model.registration - Exiting');
	}
	public function getPaymentByUserId($userId){
		$this->db->where('UserId', $userId);
		$query = $this->db->get('tbl_payment');
		return $query->result_array();
	}
	public function getReportByDateAndTRAVELOrTicket($TRAVEL,$TrvDate,$TrvDate2,$searchTicketNo){
			$TrvDate_timestamp = strtotime($TrvDate);
			$txtTrvDate = date('Y-m-d', $TrvDate_timestamp); 
			
			$TrvDate_timestamp2 = strtotime($TrvDate2);
			$txtTrvDate2 = date('Y-m-d', $TrvDate_timestamp2); 
			
			$where ="twl.Travel1='".$TRAVEL."' AND twl.TravelDepart1 between '".$txtTrvDate."' AND '".$txtTrvDate2."'";
			$or_Where="twl.Travel2='".$TRAVEL."' AND twl.TravelDepart2 between '".$txtTrvDate."' AND '".$txtTrvDate2."'";
			if(!empty($searchTicketNo))
			{
			  $where="twl.TravelTicket1='".$searchTicketNo."'";
			  $or_Where="twl.TravelTicket2='".$searchTicketNo."'";
			}			
	    
		 $SQL='SELECT tusr.UserId,twl.FirstName,twl.LastName,twl.DOB,twl.WillExpirationDate,twl.NomineeFirstName,twl.NomineeLastName,
						  twl.NomineeEmailID,twl.NomineeMobile,tusr.mobileNo,tusr.UserID as userEmail,twl.Travel1,twl.TravelName1,
						  twl.TravelTicket1, twl.TravelDepart1, twl.Travel2, twl.TravelName2,twl.TravelTicket2,twl.TravelDepart2
						  FROM tbl_will twl 
						  LEFT JOIN tbl_user tusr on tusr.Id=twl.UserId  
						  WHERE ('.$where.') or ('.$or_Where.')';
						  
			log_message('debug', 'dmb.common_model.getReportByDateAndTRAVELOrTicket -SQl -'.$SQL);			  
						  
		$query = $this->db->query($SQL);
		/*$this->db->where("(".$where.") or (".$or_Where.")");
		$query = $this->db->get('tbl_will');*/
	   return $query->result_array();
	}
	public function saveTabsContect1($arr,$userid)
    {
		log_message('debug', 'dmb.login_model.saveTabsContect1 - Starting');
			$txtDateOfBirth= $arr['txtDOB'];
			$old_date_timestamp = strtotime($txtDateOfBirth);
			$DateOfBirth = date('Y-m-d', $old_date_timestamp); 
			
			$txtWillExpiration= $arr['txtWillExpiration'];
			$txtWillExpiration_timestamp = strtotime($txtWillExpiration);
			$txtWillExpiration = date('Y-m-d', $txtWillExpiration_timestamp); 
			
			$TxtDepartData= $arr['TxtDepartData'];
			$TxtDepartData_timestamp = strtotime($TxtDepartData);
			$DepartData = date('Y-m-d', $TxtDepartData_timestamp); 
			
			$TxtDepartData1= $arr['TxtDepartData1'];
			$TxtDepartData1_timestamp = strtotime($TxtDepartData1);
			$DepartData1 = date('Y-m-d', $TxtDepartData1_timestamp); 
			
			$txtWillDate= $arr['txtWillDate'];
			$txtWillDate_timestamp = strtotime($txtWillDate);
			$WillDate = date('Y-m-d', $txtWillDate_timestamp);
			  $isActive=1;
			  $age=$this->getAge($arr['txtDOB']);
			 if($age>18){ $isActive=0;}
			$data=array(
						'UserId'=>$userid,
						'FirstName'=>$arr['txtFirstName'],
						'LastName'=>$arr['txtlastName'],
						'DOB'=>$DateOfBirth,
						'Gender'=>$arr['sltGender'],
						'WillExpirationDate	'=>$txtWillExpiration,
						'WhichId'=>$arr['ckbUserId'],
						'Married'=>$arr['ckbMarried'],
						'Spouse'=>$arr['txtspouse'],
						'Children'=>$arr['txtchildren'],
						'City'=>$arr['txtmailing'],
						'Country'=>$arr['txtcountry'],
						'Zipcode'=>$arr['txtZipcode'],
						'Travel1'=>$arr['trd'],
						'TravelName1'=>$arr['txtName'],
						'TravelTicket1'=>$arr['txtTicketNo'],
						'TravelDepart1'=>$DepartData,
						'Travel2'=>$arr['trr'],
						'TravelName2'=>$arr['txtName1'],
						'TravelTicket2'=>$arr['txtTicketNo1'],
						'TravelDepart2'=>$DepartData1,
						'rationalthought'=>'',
						'NomineeFirstName'=>$arr['txtNomineeFirstName'],
						'NomineeLastName'=>$arr['txtNomineeLastName'],
						'PersonalNominee'=>$arr['txtNominee'],
						'PersonalGuardian'=>$arr['txtGuardian'],
						'NomineeTrust'=>$arr['txtNomineeTrust'],
						'NomineeEmailID'=>$arr['txtNomineeEmailID'],
						'NomineeMobile'=>$arr['txtNomineeMobile'],
						'NotesOFmaily'=>$arr['txtNotesToFmaily'],
						'NotesOothers'=>$arr['txtNotesToOthers'],
						'PersonalState'=>$arr['txtState'],
						'RoamingWillDate'=>$WillDate,
						'DigitalSignature'=>$arr['electronicSign'],
						'ISActive'=>$isActive
					);
				$response="";
				if(!empty($arr['willid']))
				{
					$this->db->where('Id', $arr['willid']);
					$response=$this->db->update('tbl_will', $data); 				
				}
				else
				{
					$response=$this->db->insert('tbl_will',$data);
				}
				return $response;
			
		log_message('debug', 'dmb.common_model.saveTabsContect1 - Exiting');
	}
	function getTabsContect1($userid)
	{
		if(!empty($userid))
		{
			$sql="select * from tbl_will where UserId='$userid' LIMIT 0,1";
			$query = $this->db->query($sql);
        	return $query->result_array();	
	    }
		else
		{
		   return '';
		}
	}
	function getAge($birthday){ 
	     
		$age = strtotime($birthday);
		if($age === false){ 
			return false; 
		} 
		list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age)); 
		$now = strtotime("now"); 
		list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now)); 
		$age = $y2 - $y1; 
		if((int)($m2.$d2) < (int)($m1.$d1)) 
			$age -= 1; 
		return $age; 
	} 
	function sendReportEmail($nomineeEmail)
	{   
		if(empty($nomineeEmail))
		{
		  return "Enter Nominee Email ID";
		}
		else
		{
			$sql="select * from tbl_will where NomineeEmailID='$nomineeEmail'";
			$query = $this->db->query($sql);
        	if($query->num_rows() > 0)
			{
			    $result=$query->result_array();
				$html="";
			    foreach($result as $value) 
			    {							   
					$html.= "<table border='0'>";
					$html.= "<tr><td>Name</td><td>".$value['FirstName'].' '.$value['LastName']."</td></tr>";
					$html.= "<tr><td>City/State</td><td>".$value['City']."</td>";
					$html.= "<tr><td>Country</td><td>".$value['Country']."</td>";
					$html.= "<tr><td>Zipcode</td><td>".$value['Zipcode']."</td>";					
					$html.= "<tr><td colspan='2'>&nbsp;</td></tr>";
					$html.= "<tr><td colspan='2'><b>MY TRAVEL DETAILS : </b></td></tr>";
					$html.= "<tr><td colspan='2'>&nbsp;</td></tr>";
					$html.= "<tr><td>Name</td><td>".$value['TravelName1']."</td>";
					$html.= "<tr><td>Ticket No</td><td>".$value['TravelTicket1']."</td>";
					$html.= "<tr><td>Depart</td><td>".$value['TravelDepart1']."</td>";
					$html.= "<tr><td>Travel By</td><td>".$value['Travel1']."</td>";
					$html.= "<tr><td colspan='2'>&nbsp;</td></tr>";
					$html.= "<tr><td colspan='2'><b>Return :</b></td></tr>";
					$html.= "<tr><td>Name</td><td>".$value['TravelName2']."</td>";
					$html.= "<tr><td>Ticket No</td><td>".$value['TravelTicket2']."</td>";
					$html.= "<tr><td>Depart</td><td>".$value['TravelDepart2']."</td>";
					$html.= "<tr><td>Travel By</td><td>".$value['Travel2']."</td>";
					$html.= "<tr><td colspan='2'>&nbsp;</td></tr>";
					$html.= "<tr><td colspan='2'>&nbsp;</td></tr>";
					$html.= "<tr><td colspan='2'><b>NAME OF THE EXECUTOR :</b></td></tr>";
					$html.= "<tr><td colspan='2'>&nbsp;</td></tr>";
					$html.= "<tr><td>Name</td><td>".$value['NomineeFirstName'].' '.$value['NomineeLastName']."</td>";
					$html.= "<tr><td>Trust</td><td>".$value['NomineeTrust']."</td>";
					$html.= "<tr><td>Email</td><td>".$value['NomineeEmailID']."</td>";
					$html.= "<tr><td>Mobile</td><td>".$value['NomineeMobile']."</td>";
					$html.= "<tr><td colspan='2'>&nbsp;</td></tr>";
					$html.= "<tr><td colspan='2'>&nbsp;</td></tr>";
					$html.= "<tr><td colspan='2'><b>PERSONAL NOTES:</b></td></tr>";
					$html.= "<tr><td colspan='2'>&nbsp;</td></tr>";
					$html.= "<tr><td>Nominee </td><td>".$value['PersonalNominee']."</td>";
					$html.= "<tr><td>Guardian</td><td>".$value['PersonalGuardian']."</td>";
					$html.= "<tr><td>Family</td><td>".$value['NotesOFmaily']."</td>";
					$html.= "<tr><td>Others</td><td>".$value['NotesOothers']."</td></table>";
					$html.= "<br><br>Please let us know, if you have any questions to email: executor@roamingwill.com<br><br>";
					$html.= "Thank you,<br><b>Roamingwill.com</b>";
					//echo $html;
					$this->email->from('admin@gmail.com', 'gmail.com');
					$this->email->to($nomineeEmail); 					
								
					$this->email->subject('Roamingwill - Read Important Information ');
					$this->email->message($html);	
								
					if($this->email->send())
					{
						echo 'Mail Sent Successfully';					
					}
					else
					{
					show_error($this->email->print_debugger());
					}					
				
				}
			
			}
			else
			{
			  return 'No Nominee Present';
			
			}
				
	    }
		
	}
}
?>