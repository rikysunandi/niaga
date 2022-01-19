<?php

	date_default_timezone_set("Asia/Jakarta");
	ini_set("memory_limit",-1);

	$d_base = "u1323825_p3all";
	$conn = mysqli_connect("151.106.119.15", "u1323825_bmax", "Sumedang1", "$d_base") or die("-" . $conn->connect_error);
	$conn->set_charset('utf8');

	$sql = "SELECT * FROM h_intimasi ORDER BY tgl_kunjungan desc LIMIT 20 ";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	    echo "tgl_kunjungan: " . $row["tgl_kunjungan"]. " - idpel: " . $row["idpel"]. " " . $row["ket"]. "<br>";
	  }
	} else {
	  echo "0 results";
	}
	$conn->close();

?>
