<?php

require('../../../libs/fpdf185/fpdf.php');

set_time_limit(-1);
require_once '../../../config/config.php';
require_once '../../../config/database.php';

$idpels = "'535510128302','535515523511','538310850098','535515526687','535515524912','535515522584','535515523529','538410648664','535515523537','535515527395'";

class PDF_Rotate extends FPDF
{
	var $angle=0;

	function Rotate($angle,$x=-1,$y=-1)
	{
	    if($x==-1)
	        $x=$this->x;
	    if($y==-1)
	        $y=$this->y;
	    if($this->angle!=0)
	        $this->_out('Q');
	    $this->angle=$angle;
	    if($angle!=0)
	    {
	        $angle*=M_PI/180;
	        $c=cos($angle);
	        $s=sin($angle);
	        $cx=$x*$this->k;
	        $cy=($this->h-$y)*$this->k;
	        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
	    }
	}

	function _endpage()
	{
	    if($this->angle!=0)
	    {
	        $this->angle=0;
	        $this->_out('Q');
	    }
	    parent::_endpage();
	}
}

class PDF extends PDF_Rotate
{
	// Page header
	function Header()
	{
	    // Logo
	    $this->Image('../../../assets/images/logo_pln.jpg',180,7,10);
	    // Arial bold 15
	    $this->SetFont('Arial','B',12);
	    // Move to the right
	    //$this->Cell(10);
	    // Title
	    $this->Cell(190,20,'Pemberitahuan Piutang Prabayar',1,0,'C');
	    // Line break
	    $this->Ln(20);


	    $this->SetFont('Arial','B',50);
	    $this->SetTextColor(255,192,203);
	    $this->RotatedText(35,190,'P L N  U I D  J A B A R',45);
	}

	function RotatedText($x, $y, $txt, $angle)
	{
	    //Text rotated around its origin
	    $this->Rotate($angle,$x,$y);
	    $this->Text($x,$y,$txt);
	    $this->Rotate(0);
	}

	// Page footer
	function Footer()
	{
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}

}

$tempat = 'Bandung';
$tanggal = date('d M Y');
$manager = 'FULAN';
// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetMargins(12,4,12);
$pdf->SetFont('Times','',10);

//echo  "select * from AP3T_SALDO_PRABAYAR where IDPEL IN ($idpels) order by IDPEL";
$stmt = sqlsrv_query($conn, "select * from AP3T_SALDO_PRABAYAR where IDPEL IN ($idpels) order by IDPEL, CONVERT(datetime, tglJatuhTempo, 103) ASC ");
if($stmt){
	$i=0;
	$data = array();
	$idpel_prev='';
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

		if($idpel_prev<>'' && $idpel_prev!=$row['idPel']){
			$nomor = 'INV-'.date('Ymdhis').rand(0,100);
			cetakSuratPemberitahuan($pdf, $nomor, $idpel, $nama, $tarif_daya, $data, $tempat, $tanggal, $manager);
			$data = array();
		}

		$idpel = $row['idPel']; 
		$nama = $row['nama']; 
		$tarif_daya = $row['tarif'].' / '.number_format($row['daya'],0,',','.').' VA'; 
		$data[] = array($row['noRegister'], $row['jenisPiutang'], $row['rpTag'], $row['tglJatuhTempo'], $row['skemaBayar']);

		$idpel_prev=$row['idPel'];

		$i++;
	}
}

$pdf->Output();


function cetakSuratPemberitahuan($pdf, $nomor, $idpel, $nama, $tarif_daya, $data, $tempat, $tanggal, $manager){

	$pdf->AddPage();
    $pdf->Ln(10);
    $pdf->Cell(0,10,'Dengan hormat,',0,1);
    $pdf->Cell(0,10,'Bersama ini kami sampaikan informasi sebagai berikut:',0,1);
    $pdf->Cell(10);$pdf->Cell(40,6,'Id Pelanggan',0,0);
    $pdf->Cell(0,6,': '.$idpel,0,1);
    $pdf->Cell(10);$pdf->Cell(40,6,'Nama Pelanggan',0,0);
    $pdf->Cell(0,6,': '.$nama,0,1);
    $pdf->Cell(10);$pdf->Cell(40,6,'Tarif / Daya',0,0);
    $pdf->Cell(0,6,': '.$tarif_daya,0,1);
    $pdf->Cell(0,10,'Terdapat tunggakan tagihan yang belum diselesaikan dengan rincian sebagai berikut:',0,1);

    $w = array(35, 35, 30, 35, 30);
    // Header

	$header = array('No Register', 'Jenis Piutang', 'Besaran Piutang', 'Tanggal Jatuh Tempo', 'Skema Bayar');
	$pdf->Cell(10);
    for($i=0;$i<count($header);$i++){
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    }
    $pdf->Ln();
    foreach($data as $row)
    {
        $pdf->Cell(10);$pdf->Cell($w[0],6,$row[0],'LR',0,'C');
        $pdf->Cell($w[1],6,$row[1],'LR',0,'C');
        $pdf->Cell($w[2],6,number_format($row[2],0,',','.'),'LR',0,'R');
        $pdf->Cell($w[3],6,$row[3],'LR',0,'C');
        $pdf->Cell($w[4],6,$row[4],'LR',0,'C');
        // $pdf->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
        // $pdf->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
        $pdf->Ln();
    }
    // Closing line
    $pdf->Cell(10);
    $pdf->Cell(array_sum($w),0,'','T');

    $pdf->Ln(2);
    $pdf->MultiCell(0,6,'Tagihan yang sudah melewati batas jatuh tempo tersebut agar dapat diselesaikan maksimal pada tanggal 2023. Apabila pelanggan tidak menyelesaikan tagihan pada waktu yang telah ditentukan maka akan dilakukan blocking token yang berdampak pada:',0,1);
    $pdf->Cell(10);$pdf->Cell(0,6,'1. Tidak dapat melakukan pembelian token.',0,1);
    $pdf->Cell(10);$pdf->Cell(0,6,'2. Tidak dapat melakukan permohonan Pasang Baru, Rubah daya dan Migrasi Layanan.',0,1);
    $pdf->Ln(2);
    $pdf->MultiCell(0,6,'Untuk keterangan lebih lanjut, pelanggan dapat menghubungi contact center 123 (Kode area - 123) atau ke kantor PLN Unit terdekat.',0,1);
    $pdf->Ln(2);
    $pdf->MultiCell(0,6,'Demikian surat pemberitahuan ini, atas kerjasama dan perhatiannya diucapkan terima kasih.',0,1);

    $pdf->Ln(10);
    $pdf->Cell(120); $pdf->Cell(50,6,$tempat.', '.$tanggal,0,1,'C');
    $pdf->Cell(120); $pdf->Cell(50,6,'MANAGER',0,1,'C');
    $pdf->Ln(15);
    $pdf->Cell(120); $pdf->Cell(50,6,$manager,0,1,'C');
}

?>