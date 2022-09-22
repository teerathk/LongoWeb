<?php

/**
 * Created by mtfz@msn.com
 * Date: 4/28/2017
 * Time: 11:51 PM
 */

$baseProto = isset( $_SERVER['HTTPS'] ) ? "https://" : "http://";
$baseHost  = $_SERVER['HTTP_HOST'];
$baseURI   = $_SERVER['REQUEST_URI'];
$baseLoc   = $baseProto . $baseHost;


class db {
	private $dbCon, $dbDebug = false, $dbHost, $dbName, $dbUserName, $dbPassword;
	private $qStm, $queryType, $table , $dbResult = array(), $json;
	private $selectables, $where, $limit, $orderBy;
	private $set, $values;

	/**
	 * db constructor.
	 */
	public function __construct() {
		global $baseHost;
                die($baseHost);
                $this->dbHost = 'localhost';
                $this->dbUserName = 'plegopro_longonew';
                $this->dbPassword = 'LongoNew@123';
                $this->dbName = 'plegopro_longonew';

//		switch ($baseHost){
//			case 'longocorporation.plego.us' :
//				$this->dbHost = 'localhost';
//				$this->dbUserName = 'admin_longoqrapp';
//				$this->dbPassword = 'Plego@123456';
//				$this->dbName = 'admin_longoqrapp';
//				break;
//
//			case 'longocorporation.com' :
//				$this->dbHost = 'p3plcpnl1192.prod.phx3.secureserver.net';
//				$this->dbUserName = 'longoqrapp';
//				$this->dbPassword = 'Abcd@1234';
//				$this->dbName = 'longoqrapp';
//				break;
//
//			case 'www.longocorporation.com' :
//				$this->dbHost = 'p3plcpnl1192.prod.phx3.secureserver.net';
//				$this->dbUserName = 'longoqrapp';
//				$this->dbPassword = 'Abcd@1234';
//				$this->dbName = 'longoqrapp';
//				break;
//		}

		//$this->dbCon = mysqli_connect($this->dbHost, $this->dbUserName, $this->dbPassword, $this->dbName);
		$this->dbCon = new mysqli( $this->dbHost, $this->dbUserName, $this->dbPassword, $this->dbName );
		if ( $this->dbCon->connect_error ) {
			$sqlErr = array("error" => "Connection failed: " . $this->dbCon->connect_error);
			echo json_encode($sqlErr);
			die();
		}
		//return $this;
	}

	/**
	 * @return mysqli
	 */
	public function connect() {
		return $this->dbCon;
	}

	/**
	 * @param $val 'yes' to enable debug
	 *
	 * @return bool
	 */
	public function setDebug( $val ) {
		$val == strtolower( $val );

		return $this->dbDebug = $val == strtolower( "yes" ) ? true : false;
	}







	/**
	 * @return $this
	 */
	public function select() {
		$this->selectables = func_get_args();
		return $this;
	}

	/**
	 * @param $table
	 *
	 * @return $this
	 */
	public function from( $table ) {
		$this->table = $table;
		$this->queryType = 'fetch';
		return $this;
	}

	/**
	 * @param $where
	 *
	 * @return $this
	 */
	public function where( $where ) {
		$this->where = $where;
		return $this;
	}

	/**
	 * @param $limit
	 *
	 * @return $this
	 */
	public function limit( $limit ) {
		$this->limit = $limit;
		return $this;
	}

	/**
	 * @param $orderBy array i.e. ['lastname asc', 'firstname desc']
	 *
	 * @return $this
	 */
	public function orderBy( $orderBy ) {
		$this->orderBy = $orderBy;
		return $this;
	}

	/**
	 * @return $this
	 */
	protected function fetch() {
		$query[] = "SELECT";
		if ( empty( $this->selectables ) || ! is_array( $this->selectables ) ) {
			// if the selectables array is empty, select all
			$query[] = "*";
		}
		// else select according to selectables
		else {
			$query[] = join( ', ', $this->selectables );
		}

		$query[] = "FROM";
		$query[] = $this->table;

		if ( ! empty( $this->where ) ) {
			$query[] = "WHERE";

			// if the where isn't array isn't empty
			if ( ! is_array( $this->where ) ) {
				$query[] = $this->where;
			} // if the where is array isn't empty
			else {
				$whereClause = '';
				$count       = 0;
				foreach ( $this->where as $index => $item ) {
					if ( $count > 0 ) {
						$whereClause .= ' AND ';
					}
					$whereClause .= $index . "='" . $item . "'";
					$count ++;
				}
				$query[] = $whereClause;
			}
		}

		if ( ! empty( $this->limit ) ) {
			$query[] = "LIMIT";
			$query[] = $this->limit;
		}

		if ( ! empty( $this->orderBy ) ) {
			$query[] = "ORDER BY";


			if ( ! is_array( $this->orderBy ) ) {
				$query[] = $this->orderBy;
			}
			// if is array isn't empty
			else {
				$query[] = join( ', ', $this->orderBy );
			}
		}


		$qStm       = join( ' ', $query );
		$this->qStm = $qStm;
		$q          = $this->dbCon->query( $qStm );
		if ( ! $q ) {
			$this->dbResult['error'] = $this->dbCon->error;
			return $this;
		}

		for ( $rows = array(); $row = $q->fetch_assoc(); $rows[] = $row ) {
			;
		}

		$this->dbCon->close();
		$this->dbResult = $rows;

		return $this;
	}







	/**
	 * @param $value
	 *
	 * @return $this
	 */
	public function values( $value ) {
		$this->values = $value;
		return $this;
	}

	/**
	 * @param $tblName
	 *
	 * @return $this
	 */
	public function create( $tblName ) {
		$this->table = $tblName;
		$this->queryType = 'create';
		return $this;
	}

	/**
	 * @return $this
	 */
	protected function insert() {
		$query[] = "INSERT INTO";
		$query[] = $this->table;

		if ( empty( $this->values ) ) {
			die( "Error: " . "values cannot be empty." );
		}


		if ( ! is_array( $this->values ) ) {
			$query[] = $this->values;
		}
		else {
			$setCols   = '';
			$setVals   = '';
			$count     = 0;
			foreach ( $this->values as $index => $item ) {
				if ( $count == 0 ) {
					$setCols .= ' (';
					$setVals .= ' (';
				}
				$setCols .= "`" . $index . "`,";
				$setVals .= "'" . $item . "',";
				$count ++;
			}
			$setCols = rtrim($setCols,",") . ") ";
			$setVals = rtrim($setVals,",") . ") ";

			$query[] = $setCols;
			$query[] = "VALUES";
			$query[] = $setVals;
		}


		$qStm       = join( ' ', $query );
		$this->qStm = $qStm;
		$q          = $this->dbCon->query( $qStm );
		if ( ! $q ) {
			$this->dbResult['error'] = $this->dbCon->error;
			return $this;
		}

		$rows = $this->dbCon->insert_id;
		$this->dbResult['id'] = $rows;

		$this->dbCon->close();

		return $this;
	}









	/**
	 * @param $set
	 *
	 * @return $this
	 */
	public function set( $set ) {
		$this->set = $set;
		return $this;
	}

	/**
	 * @param $tblName
	 *
	 * @return $this
	 */
	public function update( $tblName ) {
		$this->table = $tblName;
		$this->queryType = 'update';
		return $this;
	}

	/**
	 * @return $this
	 */
	protected function updateQry() {
		$query[] = "UPDATE";
		$query[] = $this->table;

		if ( empty( $this->set ) ) {
			die( "Error: " . "set values cannot be empty." );
		}
		if ( empty( $this->where ) ) {
			die( "Error: " . "where cannot be empty." );
		}

		if ( ! empty( $this->set ) ) {
			$query[] = "SET";

			// if the where isn't array isn't empty
			if ( ! is_array( $this->set ) ) {
				$query[] = $this->set;
			} // if the where is array isn't empty
			else {
				$setClause = '';
				foreach ( $this->set as $index => $item ) {
					$setClause .= "`" . $index . "`='" . $item . "', ";
				}

				$setClause = rtrim($setClause,", ");
				$query[] = $setClause;
			}
		}

		if ( ! empty( $this->where ) ) {
			$query[] = "WHERE";

			// if the where isn't array isn't empty
			if ( ! is_array( $this->where ) ) {
				$query[] = $this->where;
			}
			// if the where is array isn't empty
			else {
				$whereClause = '';
				$count       = 0;
				foreach ( $this->where as $index => $item ) {
					if ( $count > 0 ) {
						$whereClause .= ' AND ';
					}
					$whereClause .= "`" . $index . "`='" . $item . "'";
					$count ++;
				}
				$query[] = $whereClause;
			}
		}

		$qStm       = join( ' ', $query );
		$this->qStm = $qStm;

		$q          = $this->dbCon->query( $qStm );
		if ( ! $q ) {
			$this->dbResult['error'] = $this->dbCon->error;
			return $this;
		}

		$rows = $this->dbCon->affected_rows;

		$this->dbResult[] = $rows;

		$this->dbCon->close();

		return $this;
	}


	/**
	 * Get fetch results in json format
	 */
	public function json() {
		switch ($this->queryType){
			case "create" : $this->insert(); break;
			case "update" : $this->updateQry(); break;
			case "delete" : break;
			default: $this->fetch();
		}

		// Show debug info
		if ( $this->dbDebug ) {
			$this->dbResult['debug']['q'] = $this->qStm;
		}

		echo json_encode( $this->dbResult );
	}

	/**
	 * @return mixed Returns values in associated array.
	 */
	public function results() {
		switch ($this->queryType){
			case "create" : $this->insert(); break;
			case "update" : $this->updateQry(); break;
			case "delete" : break;
			default: $this->fetch();
		}


		// Show debug info
		if ( $this->dbDebug ) {
			$this->dbResult['debug']['q'] = $this->qStm;
		}

		return $this->dbResult;
	}

}
