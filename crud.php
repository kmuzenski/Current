<?php
require_once('session.php');
error_reporting(E_ALL);
// helper function for validation
function valid($varname){
	return ( !empty($varname) && isset($varname) );
}

// USER CRUD
class UserCrud {	

public $user_id;


        public function __construct($user_id){
                $this->user_id = $user_id;
        }



	public function create($username, $email, $password, $location){
		if (!valid($username) || !valid($email) || !valid($password) || !valid($location)) {
			return false;
		} else {

			$pdo = Database::connect();
			$sql = "INSERT INTO user (username,email,password,location) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($username,$email,$password,$location));


			Database::disconnect();
			return $pdo->lastInsertId();
		}
	}

	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM user WHERE id = ?';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->user_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
	        	Database::disconnect();
	        	return $data;
			} catch (PDOException $error){

			header( "Location: 500.php" );
			//echo $error->getMessage();
		}

    }

	public function update($username,$email,$password){
		if (!valid($username) || !valid($email) || !valid($password)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "UPDATE user SET username = ?, email = ?, password = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($username,$email,$password,$id));
			Database::disconnect();
			return true;
		}
	}

	public function delete($user_id){

        $pdo = Database::connect();
        $sql = "DELETE FROM user WHERE id = ?"; //taken from SQL query on phpMyAdmin
        $q = $pdo->prepare($sql);
        $q->execute(array($user_id));
        Database::disconnect();
        return true;

	}

}





// END USER CRUD


class aviCrud {	

	public function create($type, $avi, $size, $user_FK){
		if (!valid($type) || !valid($avi) || !valid($size) || !valid($user_FK)) {
			return false;
		} else {

			$pdo = Database::connect();
			$sql = "INSERT INTO avatar (type,avi,size,user_FK values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($type,$avi,$size,$user_FK));


			Database::disconnect();
		
		}
	}
}

//CATEGORY CRUD
class CategoryCrud {	
	public $user_id;
	public function __construct($user_id){
		$this->user_id = $user_id;
	}
	public function create($name){
		if (!valid($name)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "INSERT INTO category (name) values(?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name));
			$category_id = $pdo->lastInsertId();
			Database::disconnect();
			return true;
		}	
	}
	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM category ORDER BY id';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->user_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
	         Database::disconnect();
	        return $data;
		} catch (PDOException $error){
			header( "Location: 500.php" );
			//echo $error->getMessage();
			
		}
    }
	public function update($name,$category_id){
		if (!valid($name)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "UPDATE category SET name = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$category_id));
			Database::disconnect();
			return true;
		}
	}
	public function delete($category_id){
        $pdo = Database::connect();
        $sql = "DELETE FROM category WHERE id = ?"; 
        $q = $pdo->prepare($sql);
        $q->execute(array($category_id));
        Database::disconnect();
        return true;
	
	}
}


class blogCrud {	
	public $user_id;


	public function __construct($user_id){
		$this->user_id = $user_id;
	}

	//$user_FK = $_SESSION['uid'];
	
	public function create($blogTitle, $blogPost, $user_FK){
	
		
		if ( !valid($blogTitle) || !valid($blogPost) || !valid($user_FK)) {
			return false;
		} else {

			$pdo = Database::connect();
			$sql = "INSERT INTO blog (blogTitle,blogPost,user_FK) values(?, ?, ?)";

			$q = $pdo->prepare($sql);
			$q->execute(array($blogTitle,$blogPost,$user_FK));
			$blog_id = $pdo->lastInsertId();

			$sql = "INSERT INTO user_blog (blog_fk, user_fk) values(?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($blog_id, $this->user_id));
			Database::disconnect();
			return true;
		
		}
	
	}

	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM blog ORDER BY postDate DESC';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->user_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
	        	Database::disconnect();
	        	return $data;
			} catch (PDOException $error){

			header( "Location: 500.php" );
			//echo $error->getMessage();
		}

    }

    	public function readUserBlog(){
		try{
			$pdo = Database::connect();
			//$sql = 'SELECT * FROM blog WHERE user_fk IN (SELECT id FROM user WHERE user_FK = ?) ORDER BY id DESC';
			$sql = 'SELECT * FROM blog WHERE user_fk = ?';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->user_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
	        Database::disconnect();
	        	return $data;
			} catch (PDOException $error){

			header( "Location: 500.php" );
			//echo $error->getMessage();
		}

    }

    public function getAuthor(){
		try{
			$pdo = Database::connect();
			
			$sql = 'SELECT * FROM blog WHERE user_FK IN (SELECT id FROM user WHERE id = ?)';
			
			$q = $pdo->prepare($sql);
			$q->execute(array($this->user_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
	        Database::disconnect();
	        	return $data;
			} catch (PDOException $error){

			header( "Location: 500.php" );
			//echo $error->getMessage();
		}

    }


	public function update($blogTitle,$blogPost,$blog_id){
		if (!valid($blogTitle) || !valid($blogPost)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "UPDATE blog SET blogTitle = ?, blogPost = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($blogTitle,$blogPost,$blog_id));
			Database::disconnect();
			return true;
		}
	}

	public function delete($blog_id){

        $pdo = Database::connect();
        $sql = "DELETE FROM user_blog WHERE blog_fk = ?"; //taken from SQL query on phpMyAdmin
        $q = $pdo->prepare($sql);
        $q->execute(array($blog_id));
        Database::disconnect();
        return true;

	}

}
