<?php
	
	class Authentication
	{
		
		private $db;
		private $util;
		private $mail;
		
		public function __construct ( $db , $util , $mail )
		{
			$this -> db   = $db;
			$this -> util = $util;
			$this -> mail = $mail;
		}
		
		public function getFullName ( $id_user )
		{
			$query
				       = "SELECT id_user,fullname FROM tbl_detail_user WHERE id_user=?";
			$data_user = $this -> db -> getValue ( $query , [ $id_user ] );
			
			return $data_user[ 'fullname' ];
		}
		
		public function reqlogout ()
		{
			$dataRespons = [];
			
			$suspected = $this -> util -> decode ( $_COOKIE[ 'mp_journalist' ] );
			setcookie ( "mp_journalist" , $suspected , time () - ( 3600 ) , "/" );
			setcookie ( "mp_journalist_lvl" , $suspected , time () - ( 3600 ) , "/" );
			
			array_push (
				$dataRespons ,
				[
					'type'  => 'reslogout' ,
					'state' => 'true' ,
				]
			);
			
			echo json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function reqreguser (
			$fullname ,
			$password ,
			$email ,
			$username ,
			$level
		)
		{
			$this -> util -> setDefaultTimeZone ( "Asia/Bangkok" );
			$dataRespons = [];
			$state       = "false";
			
			$fullname            = $this -> util -> sanitation ( $fullname );
			$password            = $this -> util -> encode (
				$this -> util -> sanitation ( $password )
			);
			$email               = $this -> util -> sanitation ( $email );
			$username            = $this -> util -> sanitation ( $username );
			$level               = $this -> util -> sanitation ( $level );
			$date_registration   = $this -> util -> getDateTimeToday ();
			$obj_data_check_auth = json_decode ( $this -> reqcheckauth ( $username ) );
			
			if ( $obj_data_check_auth ->{'state'} == "true" )
			{
				$query
					= "INSERT INTO tbl_user(username,password,date_registration,id_level) VALUES(?,?,?,?)";
				$this -> db -> insertValue (
					$query ,
					[
						$username ,
						$password ,
						$date_registration ,
						$level ,
					]
				);
				
				$query
					= "INSERT INTO tbl_detail_user(fullname,email,phone, address,id_user) VALUES(?,?,?,?,?)";
				$this -> db -> insertValue (
					$query ,
					[
						$fullname ,
						$username ,
						"" ,
						"" ,
						self ::getUserID ( $username ) ,
					]
				);
				
				$state = $obj_data_check_auth ->{'state'};
			}
			
			array_push (
				$dataRespons ,
				[
					'type'  => 'resreguser' ,
					'state' => $state ,
				]
			);
			
			echo json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function reqcheckauth ( $username )
		{
			$username    = $this -> util -> sanitation ( $username );
			$dataRespons = null;
			
			$query       = "SELECT * FROM tbl_user WHERE username=?";
			$result_data = $this -> db -> getValue ( $query , [ $username ] );
			
			$state = ! empty( $result_data ) ? "false" : "true";
			
			$dataRespons = [
				'type'  => 'rescheckauth' ,
				'state' => $state ,
			];
			
			return json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function getUserID ( $username )
		{
			$query   = "SELECT id_user,username FROM tbl_user WHERE username=?";
			$data_id = $this -> db -> getValue ( $query , [ $username ] );
			
			return $data_id[ 'id_user' ];
		}
		
		public function reqauthcheck ( $username , $password )
		{
			$username = $this -> util -> sanitation ( $username );
			$password = $this -> util -> encode ( $this -> util -> sanitation ( $password ) );
			
			$dataRespons = [];
			
			$query
				        = "SELECT username,password,id_level FROM tbl_user WHERE username=? AND password=?";
			$chk_result = $this -> db -> getValue ( $query , [ $username , $password ] );
			$id_level   = $chk_result[ 'id_level' ];
			
			$state = ! empty( $chk_result ) ? self ::setCookies (
				$username ,
				$id_level
			) : "false";
			
			array_push (
				$dataRespons ,
				[
					'type'  => 'resauthcheck' ,
					'state' => $state ,
				]
			);
			
			echo json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function setCookies ( $username , $id_level )
		{
			$username = $this -> util -> encode ( $username );
			$id_level = $this -> util -> encode ( $id_level );
			
			setcookie ( "mp_journalist" , $username , time () + ( 3600 * 30 ) , '/' );
			setcookie ( "mp_journalist_lvl" , $id_level , time () + ( 3600 * 30 ) , '/' );
			
			return "true";
		}
		
		public function reqregfbakun ( $name , $email )
		{
			$id_level    = "2";
			$state       = "false";
			$dataRespons = [];
			$this -> util -> setDefaultTimeZone ( "Asia/Bangkok" );
			
			$name                = $this -> util -> sanitation ( $name );
			$email               = $this -> util -> sanitation ( $email );
			$date_registration   = $this -> util -> getDateTimeToday ();
			$obj_data_check_auth = json_decode ( self ::reqcheckauth ( $email ) );
			
			if ( $obj_data_check_auth ->{'state'} == "true" )
			{
				$query
					= "INSERT INTO tbl_user(username,password,date_registration,id_level) VALUES(?,?,?,?)";
				$this -> db -> insertValue (
					$query ,
					[
						$email ,
						"" ,
						$date_registration ,
						$id_level ,
					]
				);
				
				$query
					= "INSERT INTO tbl_detail_user(fullname,email,phone, address,id_user) VALUES(?,?,?,?,?)";
				$this -> db -> insertValue (
					$query ,
					[
						$name ,
						$email ,
						"" ,
						"" ,
						self ::getUserID ( $email ) ,
					]
				);
				
				$state = self ::setCookies ( $email , $id_level );
			}
			else
			{
				$state = self ::setCookies ( $email , $id_level );
			}
			
			
			array_push (
				$dataRespons ,
				[
					'type'  => 'resregfbakun' ,
					'state' => $state ,
				]
			);
			
			echo json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function getLevelName ( $level )
		{
			$level     = $this -> util -> sanitation ( $level );
			$query     = "SELECT * FROM tbl_level WHERE id_level=?";
			$level_dat = $this -> db -> getValue ( $query , [ $level ] );
			
			return $level_dat[ 'level' ];
		}
	}

?>
