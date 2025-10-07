<?php
class FNS{
	function company(){
		return "AUCB";
	}
	function domain(){
		return "localhost";
	}
	function home(){
		/* note the last character shouldn't be / */
		return "http://".$this->domain()."/Library";
	}
	function portal(){
		return $this->home()."/home/";
	}
	function admin_username(){
		return date('Y');
	}
	function default_password(){
		return "PASSWORD@".date('Y');
	}
	function admin_password(){
		return "PASSWORD@".date('Y');
	}
	function pic($pic){
		if(empty($pic)){
			$pic = "staff.png";
		}
		return $this->home()."/pics/".$pic;
	}
	function student_pic($pic){
		if(empty($pic)){
			$pic = "student.png";
		}
		return $this->home()."/st_pics/".$pic;
	}
	function staff_picture_dir(){
		return "../pics/";
	}
	function picture_dir(){
		return "pics/";
	}
	function app_session(){
		return "aucb_tracking";
	}
	function validate_link($link){
		if (preg_match("~^(?:f|ht)tps?://~i", $link)) {
			return true;
		}else{
			return false;
		}
	}
	function validate_website($url){
		$url = strpos($url, 'http') !== 0 ? "http://$url" : $url;
		if (filter_var($url, FILTER_VALIDATE_URL)) {
			return true;
		} else {
			return false;
		}
	}
	function ip_address(){
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	function remove_empty_space($text){
		return str_replace(' ','',$text);
	}
	function empty_space(){
		return "&nbsp;";
	}
	function clean_content($content){
		return str_replace("<p><br></p>",'',$content); 
	}
	function add_empty_space($total){
		$space = "";
		for($i=0;$i<=$total;$i++){
			$space .=$this->empty_space();
		}
		return $space;
	}
	function add_dashes($total){
		$dashes = "";
		for($i=0;$i<=$total;$i++){
			$dashes .="-";
		}
		return $dashes;
	}
	function add_dots($total){
		$dots = "";
		for($i=0;$i<$total;$i++){
			$dots .=".";
		}
		return $dots;
	}
	function encrypt_password($password)
	{
		return sha1(md5(md5(md5(md5($password)))));
	}
	function username($fn,$ln)
	{
		return ucwords(strtolower($fn))." ".ucwords(strtolower($ln));
	}
	function validate_image($file){
		$image = array("jpg","jpeg","png","gif");
		$ext = strtolower($this->get_extension($file));
		if(in_array($ext,$image)){
			return true;
		}else{
			return false;
		}
	}
	function validate_excel_document($file){
		$doc = array("xls","xlsx");
		$ext = strtolower($this->get_extension($file));
		if(in_array($ext,$doc)){
			return true;
		}else{
			return false;
		}
	}
	function validate_resource($file){
		$allowed = array("jpg","jpeg","png","gif","pdf");
		$ext = strtolower($this->get_extension($file));
		if(in_array($ext,$allowed)){
			return true;
		}else{
			return false;
		}
	}
	function validate_pdf($file){
		$allowed = array("pdf");
		$ext = strtolower($this->get_extension($file));
		if(in_array($ext,$allowed)){
			return true;
		}else{
			return false;
		}
	}
	function repeated($list,$value){
		if(in_array($value,$list)){
			return true;
		}else{
			return false;
		}
	}
	function is_checked($com,$val){
		if($com==$val){
			return "checked";
		}else{
			return "";
		}
	}
	function generate_token() {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 20; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	function generate_long_token($length) {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < $length; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	function generate_short_token() {
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 10; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	function generate_username(){
		$alphabet = "abcdefghijklmnopqrstuwxyz0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 10; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); 
	}
	function generate_random_text($length){
		$alphabet = "abcdefghijklmnopqrstuwxyz0123456789";
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < $length; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); 
	}
	function generate_digits($length){
		$numbers = "0123456789";
		$digits = array(); //remember to declare $pass as an array
		$len = strlen($numbers) - 1; //put the length -1 in cache
		for ($i = 0; $i < $length; $i++) {
			$n = rand(0, $len);
			$digits[] = $numbers[$n];
		}
		return implode($digits);
	}
	function generate_strong_password($length = 9, $add_dashes = false, $available_sets = 'luds')
	{
		$sets = array();
		if(strpos($available_sets, 'l') !== false)
			$sets[] = 'abcdefghjkmnpqrstuvwxyz';
		if(strpos($available_sets, 'u') !== false)
			$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
		if(strpos($available_sets, 'd') !== false)
			$sets[] = '23456789';
		if(strpos($available_sets, 's') !== false)
			$sets[] = '!@#$%&*?';
		$all = '';
		$password = '';
		foreach($sets as $set)
		{
			$password .= $set[array_rand(str_split($set))];
			$all .= $set;
		}
		$all = str_split($all);
		for($i = 0; $i < $length - count($sets); $i++)
			$password .= $all[array_rand($all)];
		$password = str_shuffle($password);
		if(!$add_dashes)
			return $password;
		$dash_len = floor(sqrt($length));
		$dash_str = '';
		while(strlen($password) > $dash_len)
		{
			$dash_str .= substr($password, 0, $dash_len) . '-';
			$password = substr($password, $dash_len);
		}
		$dash_str .= $password;
		return $dash_str;
	}
	function format_amount($amount,$sign_figure)
	{
		if(empty($amount)){
			$amount = 0;
		}
		return number_format($amount,$sign_figure);
	}
	function option_selected($value,$compareto){
		if($value==$compareto){
			return "selected";
		}else{
			return "";
		}
	}
	function selected_submenu($value,$compareto){
		if($value==$compareto){
			return "display:block";
		}else{
			return "";
		}
	}
	function selected_link($value,$compareto){
		if($value==$compareto){
			return "font-weight:bold";
		}else{
			return "";
		}
	}
	function validate_phone($phone){
		$phone = $this->remove_empty_space($phone);
		/* Phone string must be 10 to 14 incase phones are written */
		/* Strip the possible additions to a phone number */ 
		/* Strip + */
		$phone = str_replace("+", "", $phone);
		/* Strip of any - */
		$phone = str_replace("-", "", $phone);
		/* Strip of any ( */
		$phone = str_replace("(", "", $phone);
		/* Strip of any ) */
		$phone = str_replace(")", "", $phone);
		/* Now the characters left must be an integer */
		if(!ctype_digit($phone)){
			return false;
		}else if((strlen($phone)<10)||(strlen($phone)>15)){
			return false;
		}else{
			return true;
		}
	}
	function validate_int($value){
		if(!ctype_digit($value)){
			return false;
		}else{
			return true;
		}
	}
	function plural($total){
		if($total>1){
			return "s";
		}else{
			return "";
		}
	}
	function clean_name($name){
		return ucwords(strtolower(trim($name)));
	}
	function validate_password($password)
	{
		if(strlen($password)<6){
			return false;
		}else if(!$this->contains_uppercase($password)){
			return false;
		}else if(!$this->contains_lowercase($password)){
			return false;
		}else if(!$this->contains_number($password)){
			return false;
		}else{
			return true;
		}
	}
	function validate_password_length($password)
	{
		if(strlen($password)<6){
			return false;
		}else{
			return true;
		}
	}
	function contains_uppercase($word){
		if(preg_match('/[A-Z]/',$word)){
			return true;
		}else{
			return false;
		}
	}
	function contains_lowercase($word){
		if(preg_match('/[a-z]/',$word)){
			return true;
		}else{
			return false;
		}
	}
	function contains_number($word){
		if (preg_match('~[0-9]+~',$word)) {
			return true;
		}else{
			return false;
		}
	}
	function last_digits($digits,$digit){
		return substr($digits, -$digit);
	}
	function generate_staff_password($phone){
		return $this->last_digits($phone,6);
	}
	function change_date_to_day_month_year($date){
		$atoms = explode("-",$date);
		return $atoms[2]."/".$atoms[1]."/".$atoms[0];
	}
	function format_timestamp($time){
		$atoms = explode(" ",$time);
		$date = $this->change_date_to_day_month_year($atoms[0]);
		$atoms = explode(":",$atoms[1]);
		$time = $atoms[0].":".$atoms[1];
		return $date." ".$time;
	}
	function convert_minutes_to_hours($minutes){
		return (int)($minutes/60); 
	}
	function time_from_timestamp($time){
		$atoms = explode(" ",$time);
		$atoms = explode(":",$atoms[1]);
		return $atoms[0].":".$atoms[1];
	}
	function page_not_found(){
		return "<p>The requested page cannot be found</p>";
	}
	function get_client_ip() 
	{
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
		   $ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	function shorten_words($string,$length)
	{
		$truncated = (strlen($string) > $length) ? substr($string, 0, $length) . '...' : $string;
		return $truncated;
	}
	/* validate email address */
	function validate_email($email)
	{
		$email = strtolower($email);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
		  return false; 
		}
		else
		{
			return true;
		}
	}
	function get_extension($str) 
	{
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return strtolower($ext);
	}
	function validate_date($date)
	{
		/*/split the date to check if all are numbers  */
		$atoms = explode('/',$date);
		$day = $atoms[0];
		$month = $atoms[1];
		$year = $atoms[2];
		if((is_numeric($day))&&(is_numeric($month))&&(is_numeric($year)))
		{
			if (checkdate($month, $day, $year))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	function validate_db_date_format($date)
	{
		/*/split the date to check if all are numbers  */
		$atoms = explode('-',$date);
		$day = $atoms[2];
		$month = $atoms[1];
		$year = $atoms[0];
		if((is_numeric($day))&&(is_numeric($month))&&(is_numeric($year)))
		{
			if (checkdate($month, $day, $year))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	function validate_time($time){
		$atoms = explode(":",$time);
		$hours = $atoms[0];
		$minutes = $atoms[1];
		if(empty($hours)){
			return false;
		}else if(!is_numeric($hours)){
			return false;
		}else if(($hours<0)||($hours>24)){
			return false;
		}else if(empty($minutes)){
			return false;
		}else if(!is_numeric($minutes)){
			return false;
		}else if(($minutes<0)||($minutes>60)){
			return false;
		}else{
			return true;
		}
	}
	function validate_year_month_day_date($date)
	{
		/*/split the date to check if all are numbers  */
		$atoms = explode('-',$date);
		$day = $atoms[2];
		$month = $atoms[1];
		$year = $atoms[0];
		if((is_numeric($day))&&(is_numeric($month))&&(is_numeric($year)))
		{
			if (checkdate($month, $day, $year))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	function translate_account_status($block){
		if($block==0){
			return "Active";
		}else{
			return "Blocked";
		}
	}
	function correct_mark(){
		return "&#10004;";
	}
	function wrong_mark(){
		return "&#10006;";
	}
	function is_ticked($value,$comp){
		if($value==$comp){
			return "<span style='margin-right:15px'>".$this->correct_mark()."</span>";
		}else{
			return "<span style='margin-right:15px'>".$this->wrong_mark()."</span>";
		}
	}
	function translate_month($value){
		if(($value=="01")||($value=="1")){
			return "January";
		}else if(($value=="02")||($value=="2")){
			return "February";
		}else if(($value=="03")||($value=="3")){
			return "March";
		}else if(($value=="04")||($value=="4")){
			return "April";
		}else if(($value=="05")||($value=="5")){
			return "May";
		}else if(($value=="06")||($value=="6")){
			return "June";
		}else if(($value=="07")||($value=="7")){
			return "July";
		}else if(($value=="08")||($value=="8")){
			return "August";
		}else if(($value=="09")||($value=="9")){
			return "September";
		}else if($value=="10"){
			return "October";
		}else if($value=="11"){
			return "November";
		}else if($value=="12"){
			return "December";
		}
	}
	function translate_month_number($value){
		if((strtolower($value)=="january")||(strtolower($value)=="jan")){
			return 1;
		}else if((strtolower($value)=="february")||(strtolower($value)=="feb")){
			return 2;
		}else if((strtolower($value)=="march")||(strtolower($value)=="mar")){
			return 3;
		}else if((strtolower($value)=="april")||(strtolower($value)=="apr")){
			return 4;
		}else if(strtolower($value)=="may"){
			return 5;
		}else if((strtolower($value)=="june")||(strtolower($value)=="jun")){
			return 6;
		}else if((strtolower($value)=="july")||(strtolower($value)=="jul")){
			return 7;
		}else if((strtolower($value)=="august")||(strtolower($value)=="aug")){
			return 8;
		}else if((strtolower($value)=="september")||(strtolower($value)=="sep")){
			return 9;
		}else if((strtolower($value)=="october")||(strtolower($value)=="oct")){
			return 10;
		}else if((strtolower($value)=="november")||(strtolower($value)=="nov")){
			return 11;
		}else if((strtolower($value)=="december")||(strtolower($value)=="dec")){
			return 12;
		}
	}
	function sanitize($text) 
	{
		$text = htmlspecialchars($text, ENT_QUOTES);
		$text = str_replace("\n\r","\n",$text);
		$text = str_replace("\r\n","\n",$text);
		$text = str_replace("\n","<br>",$text);
		return $text;
	}
	function unsanitize($text){
		$breaks = array("<br />","<br>","<br/>");  
		$text = str_ireplace($breaks, "\r\n", $text);  
		return $text;
	}
	function noreply(){
		return "noreply@".$this->domain();
	}
	function send_text($to,$text){
		
	}
	function send_email($content,$to,$subject)
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: '.$to."\r\n";
		$headers .= 'From:'.$this->company().'<'.$this->noreply().'>' . "\r\n";
		if(mail($to, $subject, $content, $headers))
		{
			return true;
		}else{
			return false;
		}
	}
	function contact($name,$email,$phone,$message){
		$subject = "Message from ".$this->domain();
		$content = "<p>Name: ".$name."</p>
		<p>Email: ".$email."</p>
		<p>phone: ".$phone."</p>
		<p>".$message."</p>
		";
		$to = "info@".$this->domain();
		if($this->send_email($content,$to,$subject)){
			return true;
		}else{
			return false;
		}
	}
	function change_date_to_year_month_day($date){
		$atoms = explode("/",$date);
		return $atoms[2]."-".$atoms[1]."-".$atoms[0];
	}
	function date_from_date_time($time){
		$atoms = explode(" ",$time);
		return $this->change_date_to_year_month_day($atoms[0]);
	}
	function date_time($time){
		$atoms = explode(" ",$time);
		$date = $this->change_date_to_day_month_year($atoms[0]);
		$t = explode(":",$atoms[1]);
		return $date." ".$t[0].":".$t[1]; 
	}
	function date_greater($d_1,$d_2){
	    $dt_1 =strtotime($this->change_date_to_year_month_day($d_1));
	    $dt_2=strtotime($this->change_date_to_year_month_day($d_2));
        if($dt_1 > $dt_2)
        {
            return true;
        }else{
            return false;
        }
	}
	function change_date_time_to_year_month_day_date_format($time){
		$atoms = explode(" ",$time);
		return $this->change_date_to_year_month_day($atoms[0])." ".$atoms[1];
	}
	function change_date_time_to_timestamp($time){
		return strtotime($time);
	}
	function change_time_to_hours_minutes($time){
		$atoms = explode(" ",$time);
		$t = explode(":",$atoms[1]);
		return $t[0].":".$t[1]; 
	}
	function phone_format($phone){
		$phone = str_replace(' ','',$phone);
		if(strlen($phone)==10){
			$phone = "233".substr($phone,1,10);
		}else if(strlen($phone)==13){
			$phone = substr($phone,1,13);
		}else if(strlen($phone)==14){
			$phone = substr($phone,2,14);
		}
		return $phone;
	}
	function localize_phone($phone){
		if(strlen($phone)>10){
			$other_parts = explode("233",$phone);
			return $this->space_phone("0".$other_parts[1]);
		}else{
			return $this->space_phone($phone);
		}
	}
	function space_phone($code){
		$part_1 = substr($code,0,3);
		$part_2 = substr($code,3,4);
		$part_3 = substr($code,7,3);
		return $part_1." ".$part_2." ".$part_3;
	}
	function validate_username($username){
		if(strlen($username)<4){
			return false;
		}else if (!ctype_alnum($username)){
			return false;
		}else{
			return true;
		}
	}
	function validate_sender_id($id){
		if (!ctype_alnum(str_replace(' ', '', $id))){
			return false;
		}else if(strlen($id)>10){
			return false;
		}else{
			return true;
		}
	}
	function url_exists($url){
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		curl_exec($ch);
		if (curl_errno($ch)) {
		  return false;
		} else {
		  curl_close($ch);
		  return true;
		}
	}
	function add_stars($total){
		$dots = "";
		for($i=0;$i<$total;$i++){
			$dots .="*";
		}
		return $dots;
	}
	function in_future($date){
		$startDate = strtotime(date('Y-m-d', strtotime($date)));
		$currentDate = strtotime(date('Y-m-d'));
		if($startDate > $currentDate) {
			return true;
		}else{
			return false;
		}
	}
	function is_last_day_of_month(){
		$t=date('d-m-Y');
		$day = strtolower(date("D",strtotime($t)));
		$month = strtolower(date("m",strtotime($t)));
		$dayNum = strtolower(date("d",strtotime($t)));
		$weekno = floor(($dayNum - 1) / 7) + 1;
		if($weekno=="4" or $weekno=="5")
		{
			$Date = date("d-m-Y");
			$new_month = date('m', strtotime($Date. ' + 1 days'));
			if($new_month != $month)
			{
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	function translate_minister_status($status){
		if($status==0){
			return "Active";
		}else if($status==1){
			return "Superannuated";
		}else if($status==2){
			return "Terminated";
		}
	}
	function format_imported_date($date){
		$atoms = explode("-",$date);
		$month = $this->translate_month_number($atoms[1]);
		return $atoms[2]."-".$month."-".$atoms[0];
	}
	function number_of_days($date1,$date2){
		if($date1==$date2){
			return 1;
		}else{
			$datetime1 = new DateTime($this->change_date_to_year_month_day($date1));
			$datetime2 = new DateTime($this->change_date_to_year_month_day($date2));
			$interval = $datetime1->diff($datetime2);
			return ($interval->days+1);
		}
	}
}
?>