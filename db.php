<?php
class DB{
	private $fns;
	public function __construct($fns){
		$this->fns = $fns;
	}
	/* Database Connectivity */
	function db_host(){
		return "localhost";
	}
	function db_username(){
		return "root";
	}
	function db_password(){
		return '';
	}
	function db_name(){
		return "tracking";
	}
	function db_connect(){
		$con = mysqli_connect($this->db_host(),$this->db_username(),$this->db_password(),$this->db_name());
		return $con;
	}
	function db_close($con){
		mysqli_close ($con);
	}
	/* GENERAL FUNCTIONS */
	function escape($con,$str){
		return mysqli_real_escape_string ($con ,$str);
	}
	function db_rows($con,$sql){
		$result = mysqli_query($con,$sql);
		$num_rows = mysqli_num_rows($result);
		return $num_rows;
	}
	function fetch_data($sql){
		$con = $this->db_connect();
		$data = array();
		if($this->db_rows($con,$sql)>0){
			$query = mysqli_query($con,$sql);
			while($row=mysqli_fetch_array($query)){
				array_push($data,$row);
			}
		}
		$this->db_close($con);
		return $data;
	}
	function fetch_row($sql){
		$con = $this->db_connect();
		$query = mysqli_query($con,$sql);
		$this->db_close($con);
		return mysqli_fetch_array($query);
	}
	function authenticate_staff($id,$password){
		$con = $this->db_connect();
		$sql = "select * from staff where password='".$this->fns->encrypt_password($password)."' and block = 0 and id = ".intval($id);
		if($this->db_rows($con,$sql)>0){
			$this->db_close($con);
			return true;
		}else{
			$this->db_close($con);
			return false;
		}
	}
	function login($username,$password){
		$con = $this->db_connect();
		$sql = "select * from staff where lower(username)=lower('".$this->escape($con,$username)."') and password='".$this->fns->encrypt_password($password)."' and block = 0";
		if($this->db_rows($con,$sql)>0){
			$query = mysqli_query($con,$sql);
			while($row=mysqli_fetch_array($query)){
				$id = $row['id'];
				$c_time = $row['current_login_time'];
				$c_address = $row['current_login_ip_address'];
			}
			$_SESSION[$this->fns->app_session()] = $id;
			/* Update last login ip address and time */
			$sql = "update staff set last_login_time='".$c_time."',last_login_ip_address='".$c_address."',current_login_ip_address='".$this->fns->get_client_ip()."', current_login_time=CURRENT_TIMESTAMP() where id=".intval($id);
			mysqli_query($con,$sql);
			$this->db_close($con);
			return true;
		}else{
			$this->db_close($con);
			return false;
		}
	}
	function details($id){
		$con = $this->db_connect();
		$sql = "select * from staff where id=".intval($id);
		return $this->fetch_row($sql);
	}
	function update_lastloginactivity($id){
		$con = $this->db_connect();
		$sql = "update staff set current_login_time=CURRENT_TIMESTAMP(),current_login_ip_address='".$this->escape($con,$this->fns->get_client_ip())."' where id=".intval($id);
		mysqli_query($con,$sql);
		$this->db_close($con);
	}
	function staff_exist($username){
		$con = $this->db_connect();
		$sql = "select * from staff where lower(username) = lower('".$this->escape($con,$username)."')";
		if($this->db_rows($con,$sql)>0){
			$this->db_close($con);
			return true;
		}else{
			$this->db_close($con);
			return false;
		}
	}
	function another_staff_exist($username,$id){
		$con = $this->db_connect();
		$sql = "select * from staff where lower(username) = lower('".$this->escape($con,$username)."') and id !=".intval($id);
		if($this->db_rows($con,$sql)>0){
			$this->db_close($con);
			return true;
		}else{
			$this->db_close($con);
			return false;
		}
	}
	function has_right($id,$password){
		$con = $this->db_connect();
		$sql = "select * from staff where password = '".$this->fns->encrypt_password($password)."' and id = ".intval($id);
		if($this->db_rows($con,$sql)>0){
			$this->db_close($con);
			return true;
		}else{
			$this->db_close($con);
			return false;
		}
	}
	function change_password($id,$password){
		$con = $this->db_connect();
		$sql = "update staff set password = '".$this->fns->encrypt_password($password)."' where id = ".intval($id);
		if(mysqli_query($con,$sql)){
			$this->db_close($con);
			return true;
		}else{
			$this->db_close($con);
			return false;
		}
	}
	function change_username($id,$username){
		$con = $this->db_connect();
		$sql = "update staff set username = '".$this->escape($con,strtolower($username))."' where id = ".intval($id);
		if(mysqli_query($con,$sql)){
			$this->db_close($con);
			return true;
		}else{
			$this->db_close($con);
			return false;
		}
	}
	function generate_username(){
		$con = $this->db_connect();
		$ok = 0;
		while($ok !=1){
			$username = $this->fns->generate_username();
			$sql = "select * from staff where lower(username)=lower('".$this->escape($con,$username)."')";
			if($this->db_rows($con,$sql)==0){
				$ok = 1;
			}
		}
		$this->db_close($con);
		return $username;
	}
	function add_staff($user,$fn,$ln,$phone,$picture,$admin,$inventory,$device_management){
		$con = $this->db_connect();
		$password = $this->fns->default_password();
		$username = $this->generate_username();
		$token = md5($user['id'].$username.time());
		$sql = "insert into staff(staff,first_name,last_name,picture,phone,username,password,admin,inventory,device_management,token,date) values
		(
		".intval($user['id']).",
		'".$this->escape($con,$fn)."',
		'".$this->escape($con,$ln)."',
		'".$this->escape($con,$picture)."',
		'".$this->escape($con,$phone)."',
		'".$this->escape($con,$username)."',
		'".$this->escape($con,$this->fns->encrypt_password($password))."',
		".intval($admin).",
		".intval($inventory).",
		".intval($device_management).",
		'".$this->escape($con,$token)."',
		CURDATE()
		)
		";
		if(mysqli_query($con,$sql)){
			$this->db_close($con);
			return true;
		}else{
			$this->db_close($con);
			return false;
		}
	}
	function edit_staff($user,$fn,$ln,$phone,$picture,$admin,$inventory,$device_management,$block,$token){
		$con = $this->db_connect();
		$sql = "update staff set staff = ".intval($user['id']).",
		first_name = '".$this->escape($con,$fn)."',
		last_name = '".$this->escape($con,$ln)."',
		picture = '".$this->escape($con,$picture)."',
		phone = '".$this->escape($con,$phone)."',
		admin = ".intval($admin).",
		inventory = ".intval($inventory).",
		device_management = ".intval($device_management).",
		block = ".intval($block)." where token = '".$this->escape($con,$token)."'";
		if(mysqli_query($con,$sql)){
			$this->db_close($con);
			return true;
		}else{
			$this->db_close($con);
			return false;
		}
	}
	function staff(){
		return $this->fetch_data("select * from staff order by first_name,last_name asc");
	}
	function staff_options($token){
		$data = $this->staff();
		$options = '';
		foreach($data as $d){
			$options .= '<option value="'.$d['token'].'" '.$this->fns->option_selected($token,$d['token']).'>'.$this->fns->username($d['first_name'],$d['last_name']).'('.$d['staff_id'].')</option>';
		}
		return $options;
	}
	function staff_info($token){
		$con = $this->db_connect();
		$sql = "select * from staff where token = '".$this->escape($con,$token)."'";
		$this->db_close($con);
		return $this->fetch_row($sql);
	}
	function staff_details($token){
		$con = $this->db_connect();
		$sql = "select * from staff where token = '".$this->escape($con,$token)."'";
		$this->db_close($con);
		return $this->fetch_row($sql);
	}
	function reset_staff_password($user,$token){
		$con = $this->db_connect();
		$password = $this->fns->default_password();
		$sql = "update staff set editor = ".intval($user['id']).",date_edited = CURDATE(),password = '".$this->escape($con,$this->fns->encrypt_password($password))."' where token = '".$this->escape($con,$token)."'";
		if(mysqli_query($con,$sql)){
			$this->db_close($con);
			return true;
		}else{
			$this->db_close($con);
			return false;
		}
	}
	function search($q){
		$con = $this->db_connect();
		$sql = "select * from staff where (first_name like '%".$this->escape($con,$q)."%' or last_name like '%".$this->escape($con,$q)."%' or CONCAT(first_name,' ',last_name) like '%".$this->escape($con,$q)."%' or CONCAT(last_name,' ',first_name) like '%".$this->escape($con,$q)."%' or phone like '%".$this->escape($con,$q)."%') order by first_name,last_name asc";
		$this->db_close($con);
		return $this->fetch_data($sql);
	}
}