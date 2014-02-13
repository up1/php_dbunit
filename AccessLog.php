<?php
class AccessLog {

	private $pdo;

	function setPDO($pdo) {
		$this->pdo = $pdo;
	}

	function countLogAll() {
		$query = "SELECT * FROM access_log";
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        if ($result = $statement->fetchAll(PDO::FETCH_ASSOC)) {
        	return count($result);
        } else {
            return 0;
        }
	}

	function deleteLogByID($id) {
		$query = "DELETe FROM access_log where id=". $id;
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $this->countLogAll();
	}

	
	static public function createTable(PDO $pdo) {
        $query = "
            CREATE TABLE access_log (
                id number PRIMARY KEY,
                content varchar(50) NOT NULL DEFAULT 0
            );
        ";

        $pdo->query($query);
    }

}
?>