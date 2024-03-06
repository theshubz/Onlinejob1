<?php
require_once('database.php');

class Applicants {
	protected static $tblname = "tblapplicants";
    protected $mydb;

    public function __construct($db) {
        $this->mydb = $db;
    }

    public function dbfields() {
        $fields = array();
        $result = $this->mydb->query("DESCRIBE " . self::$tblname);
        while ($row = $result->fetch_assoc()) {
            $fields[] = $row['Field'];
        }
        return $fields;
    }
	

    public function listofapplicant() {
        global $mydb;
        $result = $mydb->query("SELECT * FROM " . self::$tblname);
        return $result;
    }

    public function find_applicant($id = "", $name = "") {
        global $mydb;
        $result = $mydb->query("SELECT * FROM " . self::$tblname . " WHERE APPLICANTID = '{$id}' OR Lastname = '{$name}'");
        $row_count = $result->num_rows;
        return $row_count;
    }

    public function find_all_applicant($lname = "", $Firstname = "", $mname = "") {
        global $mydb;
        $result = $mydb->query("SELECT * FROM " . self::$tblname . " WHERE LNAME = '{$lname}' AND FNAME= '{$Firstname}' AND MNAME='{$mname}'");
        $row_count = $result->num_rows;
        return $row_count;
    }

    public function single_applicant($id = "") {
        global $mydb;
        $result = $mydb->query("SELECT * FROM " . self::$tblname . " WHERE APPLICANTID= '{$id}' LIMIT 1");
        $cur = $result->fetch_assoc();
        return $cur;
    }

    public function select_applicant($id = "") {
        global $mydb;
        $result = $mydb->query("SELECT * FROM " . self::$tblname . " WHERE APPLICANTID= '{$id}' LIMIT 1");
        $cur = $result->fetch_assoc();
        return $cur;
    }

    public function applicantAuthentication($U_USERNAME, $h_pass) {
        global $mydb;
        $sql = "SELECT * FROM `tblapplicants` WHERE `USERNAME`=? AND `PASS`=?";
        $stmt = $mydb->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . $mydb->error);
        }

        $stmt->bind_param("ss", $U_USERNAME, $h_pass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result !== false) {
            $row_count = $result->num_rows;
            if ($row_count == 1) {
                $emp_found = $result->fetch_object();
                $_SESSION['APPLICANTID'] = $emp_found->APPLICANTID;
                $_SESSION['USERNAME'] = $emp_found->USERNAME;
                $result->close(); // Close the result set
                return true;
            } else {
                $result->close(); // Close the result set
                return false;
            }
        } else {
            die("Error executing query: " . $mydb->error);
        }
    }

    public static function instantiate($record) {
        $object = new self;

        foreach ($record as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
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
        foreach ($this->dbfields() as $field) {
            if (property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        global $mydb;
        $clean_attributes = array();

        foreach ($this->attributes() as $key => $value) {
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
        $sql = "INSERT INTO " . self::$tblname . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";

        echo $mydb->setQuery($sql);

        if ($mydb->executeQuery()) {
            $this->id = $mydb->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update($id = '') {
        global $mydb;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . self::$tblname . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE APPLICANTID='" . $id . "'";
        $mydb->setQuery($sql);
        if (!$mydb->executeQuery()) return false;
    }

    public function APLupdate($id = 0) {
        global $mydb;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach ($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . self::$tblname . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE APPLICANTID=" . $id;
        $mydb->setQuery($sql);
        if (!$mydb->executeQuery()) return false;
    }

    public function delete($id = '') {
        global $mydb;
        $sql = "DELETE FROM " . self::$tblname;
        $sql .= " WHERE APPLICANTID='" . $id . "'";
        $sql .= " LIMIT 1 ";
        $mydb->setQuery($sql);

        if (!$mydb->executeQuery()) return false;
    }
}
$mydb = new mysqli("opportunityjunction.mysql.database.azure.com", "shubhamj", "omkar@29", "erisdb");

// Instantiate Applicants Object with MySQLi Object
$applicants = new Applicants($mydb);

// You can now use the $applicants object to call its methods, like dbfields()
$fields = $applicants->dbfields();
?>
