<?php
require_once('include/database.php');
class Applicants {
	protected static  $tblname = "tblapplicants";
	function dbfields() {
		
		$fields = $mydb->getFieldsOnOneTable(self::$tblname);
	
		if ($fields === false) {
			// Handle error, for example:
			die("Error retrieving fields: " . $mydb->getLastError());
		}
	
		return $fields;
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
			WHERE APPLICANTID= '{$id}' LIMIT 1");
		$cur = $mydb->executeQuery();
		$row = $mydb->fetchAssoc($cur); // Fetch the result as an associative array
		return $row;
	}
	
	function select_applicant($id=""){
		global $mydb;
		$mydb->setQuery("SELECT * FROM ".self::$tblname." 
			WHERE APPLICANTID= '{$id}' LIMIT 1");
		$cur = $mydb->executeQuery();
		$row = $mydb->fetchAssoc($cur); // Fetch the result as an associative array
		return $row;
	}
	
	function applicantAuthentication($U_USERNAME, $h_pass){
		global $mydb;
		$mydb->setQuery("SELECT * FROM `tblapplicants` WHERE `USERNAME`='$U_USERNAME' AND `PASS`='$h_pass'");
		$cur = $mydb->executeQuery();
		
		if($cur === false){
			die($mydb->getLastError()); // Use appropriate error handling
		}
		
		$row_count = $mydb->num_rows($cur); // Get the number of rows returned
		if ($row_count == 1){
			// Fetch the row as an associative array
			$emp_found = $mydb->fetchAssoc($cur);
			
			// Set session variables
			$_SESSION['APPLICANTID'] = $emp_found['APPLICANTID'];
			$_SESSION['USERNAME'] = $emp_found['USERNAME'];
			
			return true;
		} else {
			return false;
		}
	
	
	}

	 

	static function instantiate($record) {
		$object = new self;

		foreach($record as $attribute=>$value){
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