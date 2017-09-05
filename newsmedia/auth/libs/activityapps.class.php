<?php
	
	class ActivityApps
	{
		
		private $db;
		private $util;
		private $auth;
		
		public function __construct (
			$db ,
			$util ,
			$auth
		)
		{
			$this -> db   = $db;
			$this -> util = $util;
			$this -> auth = $auth;
		}
		
		public function getCategoryName ( $id_category )
		{
			$query    = "SELECT * FROM tbl_category WHERE id_category=?";
			$cat_name = $this -> db -> getValue ( $query , [ $id_category ] );
			
			return $this -> util -> uppercaseFirstCharaEachWord ( $cat_name[ 'category' ] );
		}
		
		public function getStateName ( $id_state )
		{
			$return_value = null;
			$query        = "SELECT * FROM tbl_state WHERE id_state=?";
			$state_name   = $this -> db -> getValue ( $query , [ $id_state ] );
			
			return $return_value = $state_name[ 'state' ];
		}
		
		public function reqpostnews (
			$newstitle ,
			$contentnews ,
			$category ,
			$image_source
		)
		{
			$this -> util -> setDefaultTimeZone ( "Asia/Bangkok" );
			
			$date_create   = $this -> util -> getDateTimeToday ();
			$code_uploaded = $this -> util -> randomCodeGenerator ();
			$newstitle     = $this -> util -> sanitation ( $newstitle );
			$category      = $this -> util -> sanitation ( $category );
			$image_source  = $this -> util -> sanitation ( $image_source );
			
			$dataRespons = [];
			$state       = 2;
			
			$username = $this -> util -> decode ( $_COOKIE[ "mp_journalist" ] );
			$id_user  = $this -> auth -> getUserID ( $username );
			
			$query
				        = "INSERT INTO tbl_berita(judul_berita,content_berita,date_create,id_category,id_state,code_uploaded,id_user_kontributor, pict_source) VALUES(?,?,?,?,?,?,?,?)";
			$state_save = $this -> db -> insertValue (
				$query ,
				[
					$newstitle ,
					$contentnews ,
					$date_create ,
					$category ,
					$state ,
					$code_uploaded ,
					$id_user ,
					$image_source ,
				] );
			
			$state_success = $state_save ? self ::setCookiesCodeUploaded ( $code_uploaded ) : "fail";
			
			array_push (
				$dataRespons ,
				[
					'type'          => 'respostnews' ,
					'success'       => $state_success ,
					'code_uploaded' => $code_uploaded ,
				] );
			
			echo json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function setCookiesCodeUploaded ( $code )
		{
			$code = $this -> util -> encode ( $code );
			setcookie ( "mp_journalist_code" , $code , time () + 3600 , '/' );
			
			return "success";
		}
		
		public function reqpostbreakingnews ( $content )
		{
			$dataRespons = [];
			$this -> util -> setDefaultTimeZone ( "Asia/Bangkok" );
			$content   = $this -> util -> sanitation ( $content );
			$date_time = $this -> util -> getDateTimeToday ();
			$regdate   = $this -> util -> setRegisterDate ( $date_time );
			$user      = $this -> util -> decode ( $_COOKIE[ 'mp_journalist' ] );
			$id_user   = $this -> auth -> getUserID ( $user );
			
			$query      = "INSERT INTO tbl_breaking_news(content,date_time,regdate,id_user) VALUES(?,?,?,?)";
			$result_dat = $this -> db -> insertValue ( $query , [ $content , $date_time , $regdate , $id_user ] );
			
			$state = $result_dat ? "true" : "false";
			
			array_push (
				$dataRespons ,
				[
					'type'  => 'respostbreakingnews' ,
					'state' => $state ,
				] );
			
			echo json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function reqeditpostnews (
			$newstitle ,
			$contentnews ,
			$category ,
			$id_news ,
			$source_img
		)
		{
			$newstitle  = $this -> util -> sanitation ( $newstitle );
			$category   = $this -> util -> sanitation ( $category );
			$id_news    = $this -> util -> sanitation ( $id_news );
			$source_img = $this -> util -> sanitation ( $source_img );
			
			$dataRespons   = [];
			$code_uploaded = self ::getCodeUploaded ( $id_news );
			
			$query
				       = "UPDATE tbl_berita SET judul_berita=?, content_berita=?, id_category=?, pict_source=? WHERE id_berita=? ";
			$updt_data = $this -> db -> updateValue ( $query , [ $newstitle , $contentnews , $category , $source_img ,
			                                                     $id_news ] );
			
			
			$state_success = $updt_data ? "fail" : self ::setCookiesCodeUploaded ( $code_uploaded );
			
			array_push (
				$dataRespons ,
				[
					'type'          => 'reseditpostnews' ,
					'success'       => $state_success ,
					'code_uploaded' => $code_uploaded ,
				] );
			
			echo json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function getCodeUploaded ( $id_news )
		{
			$return_value = null;
			$query        = "SELECT * FROM tbl_berita WHERE id_berita=?";
			$info_news    = $this -> db -> getValue ( $query , [ $id_news ] );
			
			return $return_value = $info_news[ 'code_uploaded' ];
		}
		
		public function reqapprovenews ( $id_berita )
		{
			$this -> util -> setDefaultTimeZone ( "Asia/Bangkok" );
			
			//$date_publish = $this->util->getDateBeforeToday($this->util->getDateTimeToday(), 1);
			$id_berita    = $this -> util -> sanitation ( $id_berita );
			$date_publish = $this -> util -> getDateTimeToday ();
			$username     = $this -> util -> decode ( $_COOKIE[ 'mp_journalist' ] );
			$id_user      = $this -> auth -> getUserID ( $username );
			
			$dataRespons = [];
			$id_state    = "1";
			
			$query         = "UPDATE tbl_berita SET id_state=?, date_publish=?,id_user_redaktur=? WHERE id_berita=?";
			$result_change = $this -> db -> updateValue (
				$query ,
				[
					$id_state ,
					$date_publish ,
					$id_user ,
					$id_berita ,
				] );
			
			$state = $result_change == 1 ? "false" : "true";
			
			array_push (
				$dataRespons ,
				[
					'type'  => 'resapprovenews' ,
					'state' => $state ,
				] );
			
			echo json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function reqsendresetpass ( $email )
		{
			$dataRespons = [];
			$email       = $this -> util -> sanitation ( $email );
			
			$query    = "SELECT * FROM tbl_user WHERE username=?";
			$chk_mail = $this -> db -> getValue ( $query , [ $email ] );
			
			$query     = "SELECT * FROM tbl_detail_user WHERE email=?";
			$data_user = $this -> db -> getValue ( $query , [ $email ] );
			$name      = $data_user[ 'fullname' ];
			
			$state = ! empty( $chk_mail ) ? self ::resetPassAndSendMail ( $email , $name ) : "false";
			
			array_push (
				$dataRespons ,
				[
					"type"  => "reqsendresetpass" ,
					"state" => $state ,
				] );
			
			echo json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function resetPassAndSendMail (
			$email ,
			$name
		)
		{
			$seed = str_split ( 'abcdefghijklmnopqrstuvwxyz' . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' );
			shuffle ( $seed );
			$rand = '';
			
			foreach ( array_rand ( $seed , 5 ) as $k )
			{
				$rand .= $seed[ $k ];
			}
			
			$random_pass        = $rand;
			$encode_random_pass = $this -> util -> encode ( $random_pass );
			
			$query     = "UPDATE tbl_user SET password=? WHERE username=? ";
			$updt_data = $this -> db -> updateValue (
				$query ,
				[
					$encode_random_pass ,
					$email ,
				] );
			
			$this -> mail -> IsSMTP ();
			$this -> mail -> SMTPSecure = 'ssl';
			$this -> mail -> Host       = "www.mediapesona.com";        //source hosting
			$this -> mail -> SMTPDebug  = 1;
			$this -> mail -> Port       = 465;
			$this -> mail -> SMTPAuth   = true;
			$this -> mail -> Username   = "resetter@mediapesona.com"; //sender mail
			$this -> mail -> Password   = "zaq1xsw2";                            //sender mail's password
			$this -> mail -> SetFrom (
				"resetter@mediapesona.com" ,
				"Password Resetter" );    //sender
			$this -> mail -> AddReplyTo ( 'resetter@mediapesona.com' , 'Password Resetter' );
			$this -> mail -> Subject = "Pemulihan Kata Sandi";    //Email subject
			$this -> mail -> AddAddress (
				$email ,
				$name );                    //destination mail
			
			$message = "<h1>Hallo," . $name . "</h1>";
			$message .= "<br>Permintaan reset password Anda telah diproses. Password Anda yang baru adalah "
			            . "<strong>" . $random_pass . "</strong>";
			$message .= "<br><br>Silahkan login menggunakan password ini. Apabila ingin mengganti password dengan yang lebih mudah diingat, cukup menggunakan menu ganti password";
			$message .= "<br><br>Terima kasih.";
			$message .= "<br><br><br><br><small>Email ini dikirim secara otomatis. mohon untuk tidak membalas email ini.</small>";
			
			$this -> mail -> MsgHTML ( $message );
			
			if ( $this -> mail -> Send () )
			{
				$send = "true";
			}
			else
			{
				$send = "false";
			}
			
			return "true";
		}
		
		public function reqstorepointreward (
			$point ,
			$id_berita
		)
		{
			$dataRespons = [];
			
			$point     = $this -> util -> sanitation ( $point );
			$id_berita = $this -> util -> sanitation ( $id_berita );
			
			$query    = "SELECT * FROM tbl_berita WHERE id_berita=?";
			$news_dat = $this -> db -> getValue ( $query , [ $id_berita ] );
			$id_user  = $news_dat[ 'id_user_kontributor' ];
			
			$query                = "INSERT INTO tbl_point(nominal,id_berita,id_user) VALUES(?,?,?)";
			$process_data_storing = $this -> db -> insertValue (
				$query ,
				[
					$point ,
					$id_berita ,
					$id_user ,
				] );
			
			$state = $process_data_storing == 1 ? "true" : "false";
			
			array_push (
				$dataRespons ,
				[
					"type"  => "resstorepointreward" ,
					"state" => $state ,
				] );
			
			echo json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function reqsetunpub ( $id_berita )
		{
			$id_berita   = $this -> util -> sanitation ( $id_berita );
			$id_state    = "3";
			$dataRespons = [];
			
			$query    = "UPDATE tbl_berita SET id_state=? WHERE id_berita=?";
			$updt_res = $this -> db -> updateValue ( $query , [ $id_state , $id_berita ] );
			$state    = $updt_res ? "false" : "true";
			
			array_push (
				$dataRespons ,
				[
					'type'  => 'ressetunpub' ,
					'state' => $state ,
				] );
			
			echo json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function reqsetpub ( $id_berita )
		{
			$id_berita   = $this -> util -> sanitation ( $id_berita );
			$id_state    = "1";
			$dataRespons = [];
			
			$query    = "UPDATE tbl_berita SET id_state=? WHERE id_berita=?";
			$updt_res = $this -> db -> updateValue ( $query , [ $id_state , $id_berita ] );
			$state    = $updt_res ? "false" : "true";
			
			array_push (
				$dataRespons ,
				[
					'type'  => 'ressetpub' ,
					'state' => $state ,
				] );
			
			echo json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function reqpreviewnews ( $id_berita )
		{
			$id_berita   = $this -> util -> sanitation ( $id_berita );
			$dataRespons = [];
			
			$query               = "SELECT * FROM tbl_berita WHERE id_berita=?";
			$result_content_news = $this -> db -> getValue ( $query , [ $id_berita ] );
			
			if ( ! empty( $result_content_news ) )
			{
				$this -> util -> setImageDir ( "images/news/" );
				$img_directory = $this -> util -> getImageDir ();
				
				$link_file = $img_directory . $result_content_news[ 'thumbnail' ];
				
				array_push (
					$dataRespons ,
					[
						'type'           => 'respreviewnews' ,
						'title'          => $result_content_news[ 'judul_berita' ] ,
						'pict'           => $link_file ,
						'date_pub'       => $result_content_news[ 'date_publish' ] ,
						'kontent_berita' => $result_content_news[ 'content_berita' ] ,
						'id_berita'      => $result_content_news[ 'id_berita' ] ,
						'id_con'         => $result_content_news[ 'id_user_kontributor' ] ,
					
					] );
			}
			else
			{
				array_push (
					$dataRespons ,
					[
						'type'           => 'respreviewnews' ,
						'title'          => '-' ,
						'pict'           => '-' ,
						'date_pub'       => '-' ,
						'kontent_berita' => '-' ,
						'id_berita'      => '-' ,
						'id_con'         => '-' ,
					] );
			}
			
			echo json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function getNewsData ( $id_berita )
		{
			$id_berita = $this -> util -> sanitation ( $id_berita );
			
			$query               = "SELECT * FROM tbl_berita WHERE id_berita=?";
			$result_content_news = $this -> db -> getValue ( $query , [ $id_berita ] );
			
			if ( ! empty( $result_content_news ) )
			{
				$link_file = $result_content_news[ 'thumbnail' ];
				
				$dataRespons = [
					'title'          => $result_content_news[ 'judul_berita' ] ,
					'pict'           => $link_file ,
					'pict_source'    => $result_content_news[ 'pict_source' ] ,
					'date_pub'       => $result_content_news[ 'date_publish' ] ,
					'kontent_berita' => $result_content_news[ 'content_berita' ] ,
					'id_berita'      => $result_content_news[ 'id_berita' ] ,
					'id_con'         => $result_content_news[ 'id_user_kontributor' ] ,
					'id_category'    => $result_content_news[ 'id_category' ] ,
				];
				
			}
			else
			{
				$dataRespons = [
					'title'          => '-' ,
					'pict'           => '-' ,
					'date_pub'       => '-' ,
					'kontent_berita' => '-' ,
					'id_berita'      => '-' ,
					'id_con'         => '-' ,
					'id_category'    => '-' ,
				];
			}
			
			return json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
	}

?>
