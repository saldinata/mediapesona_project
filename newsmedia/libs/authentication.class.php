<?php

	class Authentication
	{

		private $db;
		private $util;

		public function __construct ($db , $util)
		{
			$this->db   = $db;
			$this->util = $util;
		}

		public function getUserID ($username)
		{
			$query   = "SELECT id_user,username FROM tbl_user WHERE username=?";
			$data_id = $this->db->getValue ($query , [ $username ]);

			return $data_id['id_user'];
		}

		public function getFullName ($id_user)
		{
			$query     = "SELECT id_user,fullname FROM tbl_detail_user WHERE id_user=?";
			$data_user = $this->db->getValue ($query , [ $id_user ]);

			return $data_user['fullname'];
		}
	}

?>
