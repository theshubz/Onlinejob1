<?php
require_once('database.php');
class Applicants {
	protected static  $tblname = "tblapplicants";

	
		// Other class methods and properties...
	
		public function create() {
			global $mydb; // Assuming $mydb is your database connection object
	
			// Assuming the table name is 'applicants'
			$sql = "INSERT INTO applicants (APPLICANTID, FNAME, LNAME, MNAME, ADDRESS, SEX, CIVILSTATUS, BIRTHDATE, BIRTHPLACE, AGE, USERNAME, PASS, EMAILADDRESS, CONTACTNO, DEGREE) 
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	
			// Prepare the SQL statement
			$stmt = $mydb->conn->prepare($sql);
			if (!$stmt) {
				die("Error in preparing SQL statement: " . $mydb->conn->error);
			}
	
			// Bind parameters
			$stmt->bind_param("sssssssssssssss", 
				$this->APPLICANTID,
				$this->FNAME,
				$this->LNAME,
				$this->MNAME,
				$this->ADDRESS,
				$this->SEX,
				$this->CIVILSTATUS,
				$this->BIRTHDATE,
				$this->BIRTHPLACE,
				$this->AGE,
				$this->USERNAME,
				$this->PASS,
				$this->EMAILADDRESS,
				$this->CONTACTNO,
				$this->DEGREE
			);
	
			// Execute the prepared statement
			$stmt->execute();
	
			// Check for errors
			if ($stmt->error) {
				die("Error in executing SQL statement: " . $stmt->error);
			}
	
			// Close the statement
			$stmt->close();
		}
	}
	
	function dbfields () {
		global $mydb;
		return $mydb->getfieldsononetable(self::$tblname);

	}
	function listofapplicant(){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname);
		return $cur;
	}
	function find_applicant($id="",$name=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE APPLICANTID = {$id} OR Lastname = '{$name}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}

	function find_all_applicant($lname="",$Firstname="",$mname=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE LNAME = '{$lname}' AND FNAME= '{$Firstname}' AND MNAME='{$mname}'");
		$cur = $mydb->executeQuery();
		$row_count = $mydb->num_rows($cur);
		return $row_count;
	}
	 
	function single_applicant($id=""){
			global $mydb;
			$mydb->setQuery("SELECT * FROM ".self::$tblname." 
				Where APPLICANTID= '{$id}' LIMIT 1");
			$cur = $mydb->loadSingleResult();
			return $cur;
	}
	function select_applicant($id=""){
			global $mydb;
			$mydb->setQuery("SELECT * FROM ".self::$tblname." 
				Where APPLICANTID= '{$id}' LIMIT 1");
			$cur = $mydb->loadSingleResult();
			return $cur;
	}
	function applicantAuthentication($U_USERNAME,$h_pass){
		global $mydb;
		$mydb->setQuery("SELECT * FROM `tblapplicants` WHERE `USERNAME`='".$U_USERNAME."' AND `PASS`='".$h_pass."'");
		$cur = $mydb->executeQuery();
		if($cur==false){
			die(mysql_error());
		}
		$row_count = $mydb->num_rows($cur);//get the number of count
		 if ($row_count == 1){
		 $emp_found = $mydb->loadSingleResult(); 
		 	$_SESSION['APPLICANTID']   		= $emp_found->APPLICANTID; 
		 	$_SESSION['USERNAME'] 			= $emp_found->USERNAME;  
		   return true;
		 }else{
		 	return false;
		 }
	}

	 

 static function instantiate($record) {
		$object = new Applicants();
	
		foreach($record as $attribute => $value){
		  if($object->has_attribute($attribute)) {
			$object->$attribute = $value;
		  }
		} 
		return $object;
	}
	
	
	
	
	private function has_attribute($attribute) {

	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  global $mydb;
	  $attributes = array();
	  foreach($this->dbfields() as $field) {
	    if(property_exists($this, $field)) {
			$attributes[$field] = $this->$field;
		}
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $mydb;
	  $clean_attributes = array();
	
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $mydb->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	
	
	public function save() {
	
	  return isset($this->id) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $mydb;
		
		$attributes = $this->sanitized_attributes();
		$sql = "INSERT INTO ".self::$tblname." (";
		$sql .= join(", ", array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
	echo $mydb->setQuery($sql);
	
	 if($mydb->executeQuery()) {
	    $this->id = $mydb->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}

	public function update($id='') {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE APPLICANTID='". $id."'";
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}

   public function APLupdate($id=0) {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE APPLICANTID=". $id;
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}

	public function delete($id='') {
		global $mydb;
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE APPLICANTID='". $id."'";
		  $sql .= " LIMIT 1 ";
		  $mydb->setQuery($sql);
		  
			if(!$mydb->executeQuery()) return false; 	
	
	}	


}
?>