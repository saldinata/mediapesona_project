<?php
	
	class ActivityApps
	{
		
		private $db;
		private $util;
		private $auth;
		
		public function __construct ( $db , $util , $auth )
		{
			$this -> db   = $db;
			$this -> util = $util;
			$this -> auth = $auth;
		}
		
		public function getIDTopic ( $name_topik )
		{
			$name_topik = $this -> util -> uppercaseFirstCharaEachWord ( $name_topik );
			
			$query           = "SELECT * FROM tbl_category WHERE category=?";
			$result_id_topic = $this -> db -> getValue ( $query , [ $name_topik ] );
			
			$id_category = $result_id_topic[ 'id_category' ];
			$dataRespons = [ 'id_category' => $id_category ];
			
			return json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function getIDNews (
			$id_category ,
			$current_date ,
			$last_date
		)
		{
			$id_state = "1";
			$count    = 0;
			$id_news  = [];
			
			//$current_date = $current_date." 00:00:00";
			//$last_date    = $last_date." 00:00:00";
			
			$current_date = $current_date;
			$last_date    = $last_date;
			
			
			$query
				         = "SELECT * FROM tbl_berita WHERE id_category=? AND id_state=? AND ( date_publish BETWEEN ? AND ? )  ORDER BY id_berita DESC";
			$result_data = $this -> db -> getAllValue (
				$query ,
				[
					$id_category ,
					$id_state ,
					$last_date ,
					$current_date ,
				]
			);
			
			
			foreach ( $result_data as $data )
			{
				$id_news[ $count ] = $data[ 'id_berita' ];
				$count ++;
			}
			
			return $id_news;
		}
		
		public function getNewsContent ( $id_news )
		{
			$id_news = htmlentities ( addslashes ( $id_news ) );
			
			$query               = "SELECT * FROM tbl_berita WHERE id_berita=?";
			$result_content_news = $this -> db -> getValue ( $query , [ $id_news ] );
			
			$link_file = $result_content_news[ 'thumbnail' ];
			
			$dataRespons = [
				'title'     => $result_content_news[ 'judul_berita' ] ,
				'pict'      => $link_file ,
				'date_pub'  => $result_content_news[ 'date_publish' ] ,
				'id_berita' => $result_content_news[ 'id_berita' ] ,
			];
			
			return json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function getNewsContentForRead ( $id_news )
		{
			$id_news = $this -> util -> sanitation ( $id_news );
			
			$query               = "SELECT * FROM tbl_berita WHERE id_berita=?";
			$result_content_news = $this -> db -> getValue ( $query , [ $id_news ] );
			
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
				];
			}
			
			return json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function reqsubmitcomment (
			$comment ,
			$id_berita
		)
		{
			$dataRespons = [];
			
			$this -> util -> setDefaultTimeZone ( "Asia/Bangkok" );
			
			$date_comment = $this -> util -> getDateTimeToday ();
			$comment      = $this -> util -> sanitation ( $comment );
			$id_berita    = $this -> util -> sanitation ( $id_berita );
			
			$username = $this -> util -> decode ( $_COOKIE[ 'mp_journalist' ] );
			$id_user  = $this -> auth -> getUserID ( $username );
			
			$query
				    = "INSERT INTO tbl_comment(comment,date_comment,id_berita,id_user) VALUES(?,?,?,?)";
			$result = $this -> db -> insertValue (
				$query ,
				[
					$comment ,
					$date_comment ,
					$id_berita ,
					$id_user ,
				]
			);
			
			$state = $result ? "true" : "false";
			
			self ::reqstacomment ( $id_berita );
			
			array_push (
				$dataRespons ,
				[
					'type'  => 'ressubmitcomment' ,
					'state' => $state ,
				]
			);
			
			echo json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function reqstacomment ( $id_berita )
		{
			$id_berita = $this -> util -> sanitation ( $id_berita );
			
			$query           = "SELECT * FROM tbl_statistic_comment_news WHERE id_berita=?";
			$get_last_number = $this -> db -> getValue ( $query , [ $id_berita ] );
			
			if ( empty( $get_last_number ) )
			{
				$nominal = 0;
				$query   = "INSERT INTO tbl_statistic_comment_news(nominal,id_berita) VALUES(?,?)";
				$result  = $this -> db -> insertValue (
					$query ,
					[
						$nominal ,
						$id_berita ,
					]
				);
			}
			else
			{
				$nominal      = (int) $get_last_number[ 'nominal' ];
				$id_statistic = $get_last_number[ 'id_statistic_comment_news' ];
				$nominal      = $nominal + 1;
				
				$query  = "UPDATE tbl_statistic_comment_news SET nominal=? WHERE id_statistic_comment_news=?";
				$result = $this -> db -> updateValue (
					$query ,
					[
						$nominal ,
						$id_statistic ,
					]
				);
			}
		}
		
		public function getIDComment ( $id_news )
		{
			$query       = "SELECT * FROM tbl_comment WHERE id_berita=? ORDER BY id_comment DESC";
			$result_data = $this -> db -> getAllValue ( $query , [ $id_news ] );
			
			$id_comment = null;
			$count      = 0;
			
			foreach ( $result_data as $data )
			{
				$id                   = $data[ 'id_comment' ];
				$id_comment[ $count ] = $id;
				$count ++;
			}
			
			$dataRespons = [ 'id_comment' => $id_comment ];
			
			return json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function getCommentContent ( $id_comment )
		{
			$id_comment = $this -> util -> sanitation ( $id_comment );
			
			$query                  = "SELECT * FROM tbl_comment WHERE id_comment=? ORDER BY id_comment DESC";
			$result_content_comment = $this -> db -> getValue (
				$query ,
				[ $id_comment ]
			);
			$id_commentator         = $result_content_comment[ 'id_user' ];
			
			$commentator_name = $this -> auth -> getFullName ( $id_commentator );
			
			$dataRespons = [
				'commentator_name' => $commentator_name ,
				'comment'          => $result_content_comment[ 'comment' ] ,
				'registered'       => $result_content_comment[ 'date_comment' ] ,
				'id_news'          => $result_content_comment[ 'id_berita' ] ,
			];
			
			return json_encode ( $dataRespons , JSON_PRETTY_PRINT );
		}
		
		public function reqstareadnews ( $id_berita )
		{
			$id_berita = $this -> util -> sanitation ( $id_berita );
			
			$query           = "SELECT * FROM tbl_statistic_read_news WHERE id_berita=?";
			$get_last_number = $this -> db -> getValue ( $query , [ $id_berita ] );
			
			if ( empty( $get_last_number ) )
			{
				$nominal = 0;
				$query   = "INSERT INTO tbl_statistic_read_news(nominal,id_berita) VALUES(?,?)";
				$result  = $this -> db -> insertValue (
					$query ,
					[
						$nominal ,
						$id_berita ,
					]
				);
			}
			else
			{
				$nominal      = (int) $get_last_number[ 'nominal' ];
				$id_statistic = $get_last_number[ 'id_statistic_read_news' ];
				$nominal      = $nominal + 1;
				
				$query  = "UPDATE tbl_statistic_read_news SET nominal=? WHERE id_statistic_read_news=?";
				$result = $this -> db -> updateValue (
					$query ,
					[
						$nominal ,
						$id_statistic ,
					]
				);
			}
		}
		
		public function getStaReadNews ( $id_berita )
		{
			$id_berita      = $this -> util -> sanitation ( $id_berita );
			$query          = "SELECT * FROM tbl_statistic_read_news WHERE id_berita=?";
			$stat_read_news = $this -> db -> getValue ( $query , [ $id_berita ] );
			
			return empty( $stat_read_news ) ? 0 : $stat_read_news[ 'nominal' ];
		}
		
		public function getStaComNews ( $id_berita )
		{
			$id_berita         = $this -> util -> sanitation ( $id_berita );
			$query             = "SELECT * FROM tbl_statistic_comment_news WHERE id_berita=?";
			$stat_comment_news = $this -> db -> getValue ( $query , [ $id_berita ] );
			
			return empty( $stat_comment_news ) ? 0
				: $stat_comment_news[ 'nominal' ] + (int) 1;
		}
	}

?>
