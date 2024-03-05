<?php
require_once('include/database.php');

class Autonumber {
    protected static $tblname = "tblautonumbers";

    public static function dbfields() {
        global $mydb;
        return $mydb->getfieldsononetable(self::$tblname);
    }

    public static function single_autonumber($id = "") {
        global $mydb;
        $mydb->setQuery("SELECT * FROM " . self::$tblname . " WHERE AUTOID = '{$id}'");
        $result = $mydb->query($mydb->getQuery());

        if ($result) {
            $cur = $result->fetch_assoc();
        } else {
            echo "Error: " . $mydb->error;
            $cur = array();
        }

        return $cur;
    }

	public static function set_autonumber($Autokey) {
		global $mydb;
		
		// Establish a connection to the database
		
		// Check if the connection was successful
		if ($mydb->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		// Prepare the SQL query
		$sql = "SELECT CONCAT(`AUTOSTART`, `AUTOEND`) AS 'AUTO' FROM " . self::$tblname . " WHERE AUTOKEY = '{$Autokey}'";
		
		// Execute the query
		$result = $mydb->query($sql);
		
		if ($result) {
			// Fetch the result as an associative array
			$cur = $result->fetch_assoc();
		} else {
			// Handle query error
			echo "Error: " . $mydb->error;
			$cur = array();
		}
		
		// Close the database connection
		$mydb->close();
		
		return $cur;
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

	public function update($id="") {
	  global $mydb;
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE AUTOID='{$id}'";
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery()) return false; 	
		
	}

	public function auto_update($id="") {
	  global $mydb;
		$sql = "UPDATE ".self::$tblname." SET ";
		$sql .= "AutoEnd = AutoEnd + AutoInc";
		$sql .= " WHERE AUTOKEY='{$id}'";
	  $mydb->setQuery($sql);
	 	if(!$mydb->executeQuery())  return false; 	
		
	}
 
	public function delete($id="") {
		global $mydb;
		  $sql = "DELETE FROM ".self::$tblname;
		  $sql .= " WHERE AUTOKEY='{$id}'";
		  $sql .= " LIMIT 1 ";
		  $mydb->setQuery($sql);
		  
			if(!$mydb->executeQuery()) return false; 	
	
	}	


}
?>