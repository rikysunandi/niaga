<?php
 
class DataTable {

  var $database = "NIAGA";
  var $host = "svr103";
  var $user = "sa";
  var $pass = "sqlsvr1q2w3e";
 
 
  var $conn;
  var $numRows;
  var $baseTest = "NIAGA.dbo.";
   
    public function __construct() {
        echo 'conn';
        $this->connect($this->host, $this->user, $this->pass, $this->database);
    }
 
    public function connect($_host, $_user, $_password, $_database) {
        echo 'conn';
        $this->conn = mssql_connect($_host, $_user, $_password) or die(mssql_get_last_message());
        echo 'conn';
        mssql_select_db($this->database, $this->conn) or die(mssql_get_last_message());
    }
 
    function query($sql) {
        mssql_query('SET ANSI_WARNINGS ON', $this->conn) or die(mssql_get_last_message());
        mssql_query('SET ANSI_NULLS ON', $this->conn) or die(mssql_get_last_message());
 
        $resultQuery = mssql_query($sql, $this->conn) or die(mssql_get_last_message());
        $results = array();
        while ($row = mssql_fetch_array($resultQuery))
            $results[] = $row;
        return $results;
    }
     
    function numRows($sql) {
        $resultQuery = mssql_query($sql, $this->conn) or die(mssql_get_last_message());
        $result = mssql_num_rows($resultQuery);
        return $result;
    }
   
  public function getData($params, $table, $columns) {
        $where = $sqlTot = $sqlRec = '';
         
        if( !empty($params['search']['value']) ) {
            $where = " WHERE";
            $i = 0;
            foreach($columns as $c) {
                if($i === 0) {
                    $where .= (count($columns) === 1) ? " (" . $c . " LIKE '%" . $params['search']['value'] . "%' "
                                                      : " ( " . $c . " LIKE '%" . $params['search']['value'] . "%' ";
                } else {
                    $where .=" OR " . $c . " LIKE '%" . $params['search']['value'] . "%' ";
                }
                $i++;
            }
            $where .= " )";
        }
         
        $sql = "SELECT * FROM " . $this->baseTest . "[" . $tabla . "]";
     
        //Total de registros en la tabla
        $totalRecords = $this->numRows(utf8_decode($sql));
     
        $sqlTot .= $sql;
         
        $sqlRec = "SELECT TOP " . $params['length'] . " * FROM( SELECT *, ROW_NUMBER() over (ORDER BY "
                . $columns[$params['order'][0]['column']] . " "
                . $params['order'][0]['dir'] . " ) as ct FROM "
                . $this->baseTest . "[" . $table . "]"
                . " " . $where . " ) sub WHERE ct > " . $params['start'];
        if(isset($where) && $where != '') {
            $sqlTot .= $where;
        }
         
        //Registros a mostrar en la tabla
        $dataRecords = $this->query(utf8_decode($sqlRec));
         
        //Total registros después del filtro
        $totalRecordsFiltered = $this->numRows(utf8_decode($sqlTot));
        $data = array(
            "draw"            => intval($params['draw']),  
            "recordsTotal"    => intval($totalRecords), 
            "recordsFiltered" => intval($totalRecordsFiltered),
            "data"            => $dataRecords
        );
         
        return $data;
    }
}

?>