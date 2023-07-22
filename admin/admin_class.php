<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM users where email = '".$email."' and password = '".md5($password)."' and type= 1 ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function login2(){
		extract($_POST);
			$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM users where email = '".$email."' and password = '".md5($password)."'  and type= 2 ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}

		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			return 1;
		}
	}
	function signup(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass')) && !is_numeric($k)){
				if($k =='password'){
					if(empty($v))
						continue;
					$v = md5($v);

				}
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}

		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");

		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			if(empty($id))
				$id = $this->db->insert_id;
			foreach ($_POST as $key => $value) {
				if(!in_array($key, array('id','cpass','password')) && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
					$_SESSION['login_id'] = $id;
			return 1;
		}
	}
	function update_user(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','cpass','table')) && !is_numeric($k)){
				if($k =='password')
					$v = md5($v);
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if($_FILES['img']['tmp_name'] != ''){
			$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
			$data .= ", avatar = '$fname' ";

		}
		$check = $this->db->query("SELECT * FROM users where email ='$email' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set $data");
		}else{
			$save = $this->db->query("UPDATE users set $data where id = $id");
		}

		if($save){
			foreach ($_POST as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if($_FILES['img']['tmp_name'] != '')
			$_SESSION['login_avatar'] = $fname;
			return 1;
		}
	}
	function add_to_cart(){
		extract($_POST);
		$data = " user_id = {$_SESSION['login_id']} ";
		$data .= ", product_id = $product_id ";
		$data .= ", colour_id = $colour_id ";
		$data .= ", size_id = $size_id ";
		$data .= ", qty= $qty";
		$data .= ", price= $price";
		$check = $this->db->query("SELECT * FROM cart where product_id = $product_id and colour_id = $colour_id  and  size_id = $size_id  and user_id ={$_SESSION['login_id']} ");
		$id= $check->num_rows > 0 ? $check->fetch_array()['id'] : '';
		if(!empty($id))
			$save = $this->db->query("UPDATE cart set qty = qty+$qty where id = $id");
		else
			$save = $this->db->query("INSERT INTO cart set $data");
		if($save){
			return 1;
		}
	}
	function get_cart_count(){
		$qry = $this->db->query("SELECT c.*,p.item_code,p.name as pname FROM cart c inner join products p on p.id = c.product_id where c.user_id ={$_SESSION['login_id']}");
		$data = array();
		$count = 0 ; 
		$data['list']=array();
		while ($row=$qry->fetch_array()) {
			$img = array();
			if(isset($row['item_code']) && !empty($row['item_code'])):
	            if(is_dir('../assets/uploads/products/'.$row['item_code'])):
	                $_fs = scandir('../assets/uploads/products/'.$row['item_code']);
	              foreach($_fs as $k => $v):
		                if(is_file('../assets/uploads/products/'.$row['item_code'].'/'.$v) && !in_array($v,array('.','..'))):
		                	$img[] = 'assets/uploads/products/'.$row['item_code'].'/'.$v;
						endif;
					endforeach;
				endif;
			endif;
			$row['img_path'] = isset($img[0]) ? $img[0]:'';
			$data['list'][]=$row;
			$count += $row['qty'];
		}
		$data['count'] = $count;
		return json_encode($data);
	}
	function update_cart(){
		extract($_POST);
		$save = $this->db->query("UPDATE cart set qty = $qty where id = $id");
		if($save){
			return 1;
		}

	}
	function delete_cart(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM cart where id = $id");
		if($delete){
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	function upload_file(){
		extract($_FILES['file']);
		// var_dump($_FILES);
		// if(empty($item_code)){
		// 	$i = 0; 
		// 	$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		// 	while($i == 0){
		// 		$item_code = substr(str_shuffle($chars), 0, 16);
		// 		if(!is_dir('../assets/uploads/products/'.$item_code)){
		// 			mkdir('../assets/uploads/products/'.$item_code);
		// 			$i = 1;
		// 		}
		// 	}
		// }
		if($tmp_name != ''){
				$fname = strtotime(date('y-m-d H:i')).'_'.$name;
				$move = move_uploaded_file($tmp_name,'../assets/uploads/products/'. $fname);
		}
		if(isset($move) && $move){
			return json_encode(array("status"=>1,"fname"=>$fname));
		}
	}
	function remove_file(){
		extract($_POST);
		if(is_file('../assets/uploads/products/'.$fname))
			unlink('../assets/uploads/products/'.$fname);
		return 1;
	}
	function save_upload(){
		extract($_POST);
		// var_dump($_FILES);
		$data = " title ='$title' ";
		$data .= ", description ='".htmlentities(str_replace("'","&#x2019;",$description))."' ";
		$data .= ", user_id ='{$_SESSION['login_id']}' ";
		$data .= ", file_json ='".json_encode($fname)."' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO documents set $data ");
		}else{
			$save = $this->db->query("UPDATE documents set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function save_category(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}

		$check = $this->db->query("SELECT * FROM categories where name ='$name' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO categories set $data");
		}else{
			$save = $this->db->query("UPDATE categories set $data where id = $id");
		}
		if($save){
			return 1;
		}
	}
	function delete_category(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM categories where id = $id");
		if($delete){
			return 1;
		}
	}
	function save_product(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id','dname','fname','size','sid','color','cid','item_code')) && !is_numeric($k)){
				if($k == 'description')
					$v = htmlentities(str_replace("'","&#x2019;",$v));
				if($k == 'price')
					$v = str_replace(',', '', $v);

				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		if(empty($item_code)){
			$i = 0; 
			$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			while($i == 0){
				$item_code = substr(str_shuffle($chars), 0, 16);
				if(!is_dir('../assets/uploads/products/'.$item_code)){
					mkdir('../assets/uploads/products/'.$item_code);
					$i = 1;
				}
			}
		}
		$data .= ", item_code='$item_code' ";
		
		if(empty($id)){
			
			$save = $this->db->query("INSERT INTO products set $data");
		}else{
			$save = $this->db->query("UPDATE products set $data where id = $id");
		}
		if($save){
			if(empty($id))
			$id = $this->db->insert_id;
			if(isset($size)){
				foreach ($size as $k => $v) {
					if(!empty($size)){
						$data = " product_id = $id ";
						$data .= ", size = '$v' ";
						if($sid[$k] > 0){
							$this->db->query("UPDATE sizes set $data where id = {$sid[$k]}");
						}else{
							$this->db->query("INSERT INTO sizes set $data");
							$sid[$k] = $this->db->insert_id;
						}
					}
				}
			}
			if(isset($sid)){
				$sids = array_filter($sid);
				if(count($sids) > 0){
					$sids = implode(',', $sids);
					$this->db->query("DELETE FROM sizes where id not in ($sids) and product_id = $id ");
				}
			}
			if(isset($color)){
				foreach ($color as $k => $v) {
					if(!empty($color)){
						$data = " product_id = $id ";
						$data .= ", color = '$v' ";
						if($cid[$k] > 0){
							$this->db->query("UPDATE colours set $data where id = {$cid[$k]}");
						}else{
							$this->db->query("INSERT INTO colours set $data");
							$cid[$k] = $this->db->insert_id;

						}
					}
				}
			}
			if(isset($cid)){
				$cids= array_filter($cid);
				if(count($cids) > 0){
					$cids = implode(',', $cids);
					$this->db->query("DELETE FROM colours where id not in ($cids) and product_id = $id ");
				}
			}
			if(isset($fname)){
				foreach($fname as $k =>$v){
					if(is_file('../assets/uploads/products/'.$v))
					$move = rename('../assets/uploads/products/'.$v, '../assets/uploads/products/'.$item_code.'/'.$v);
				}
			}
			return $id;
		}
	}
	function delete_product(){
		extract($_POST);
		$prod = $this->db->query("SELECT * from products where id = $id")->fetch_array();
		$delete = $this->db->query("DELETE FROM products where id = $id");
		if($delete){
			$this->db->query("DELETE FROM sizes where product_id = $id");
			$this->db->query("DELETE FROM colours where product_id = $id");
			if(is_dir('../assets/uploads/products/'.$prod['item_code'])){
				$_f = scandir('../assets/uploads/products/'.$prod['item_code']);
				foreach ($_f as $k => $v) {
					if(is_file('../assets/uploads/products/'.$prod['item_code'].'/'.$v) && !in_array($v, array('.','..'))){
						unlink('../assets/uploads/products/'.$prod['item_code'].'/'.$v);
					}
				}
				rmdir('../assets/uploads/products/'.$prod['item_code']);
			}
			return 1;
		}
	}
	function save_order(){
		extract($_POST);
		$data = " user_id = {$_SESSION['login_id']} ";
		$data .= ", delivery_address = '$address' ";
			$i = 0; 
			$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			while($i == 0){
				$ref_id = substr(str_shuffle($chars), 0, 16);
				$chk = $this->db->query("SELECT * FROM orders where ref_id = '$ref_id'")->num_rows;
				if($chk <= 0){
					$i = 1;
				}
			}
		$data .= ", ref_id = '$ref_id' ";
		$save = $this->db->query("INSERT INTO orders set $data");
		if($save){
			$id = $this->db->insert_id;
			$qry = $this->db->query("SELECT * FROM cart where user_id ={$_SESSION['login_id']}");
			while($row = $qry->fetch_array()){
				$data = " order_id = $id ";
				$data .= ", product_id = {$row['product_id']} ";
				$data .= ", qty = {$row['qty']} ";
				$data .= ", price = '{$row['price']}'";
				$data .= ", colour_id = '{$row['colour_id']}'";
				$data .= ", size_id = '{$row['size_id']}'";
				if($order[] = $this->db->query("INSERT INTO order_items set $data")){
					$this->db->query("DELETE FROM cart where id ='{$row['id']}' ");
				}
			}
			if(isset($order))
				return 1;
		}
	}
	function update_order(){
		extract($_POST);
		$save = $this->db->query("UPDATE orders set status = $status where id = $id");
		if($save)
			return 1;

	}
	function delete_order(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM orders where id = ".$id);
		$delete2 = $this->db->query("DELETE FROM order_items where order_id = ".$id);
		if($delete && $delete2){
			return 1;
		}
	}
}