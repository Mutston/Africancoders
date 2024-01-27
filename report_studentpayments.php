<?php
 include('db.php');
require('other/fpdf.php');
class PDF_MC_Table extends FPDF
{
	protected $widths;
	protected $aligns;

	function SetWidths($w)
	{
		// Set the array of column widths
		$this->widths = $w;
	}

	function SetAligns($a)
	{
		// Set the array of column alignments
		$this->aligns = $a;
	}

	function Row($data)
	{
		// Calculate the height of the row
		$nb = 0;
		for($i=0;$i<count($data);$i++)
			$nb = max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h = 5*$nb;
		// Issue a page break first if needed
		$this->CheckPageBreak($h);
		// Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			// Save the current position
			$x = $this->GetX();
			$y = $this->GetY();
			// Draw the border
			$this->Rect($x,$y,$w,$h);
			// Print the text
			$this->MultiCell($w,5,$data[$i],0,$a);
			// Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		// Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		// If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w, $txt)
	{
		// Compute the number of lines a MultiCell of width w will take
		if(!isset($this->CurrentFont))
			$this->Error('No font has been set');
		$cw = $this->CurrentFont['cw'];
		if($w==0)
			$w = $this->w-$this->rMargin-$this->x;
		$wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
		$s = str_replace("\r",'',(string)$txt);
		$nb = strlen($s);
		if($nb>0 && $s[$nb-1]=="\n")
			$nb--;
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$nl = 1;
		while($i<$nb)
		{
			$c = $s[$i];
			if($c=="\n")
			{
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep = $i;
			$l += $cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i = $sep+1;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
}

	


$pdf = new PDF_MC_Table();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->Ln();
$pdf->SetFont('Arial', '', 14);

	
	

	//$pdf->Image('../images/log.JPG',10,6);
		$pdf->SetFont('Arial','B',14);
		
		$pdf->Cell(276,5,'STUDENT PAYMENTS REPORT',0,0,'C');
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(276,5,'',0,0,'C');
		$pdf->Ln();
		$pdf->SetFont('Times','',12);
		$pdf->Cell(276,10,'',0,0,'C');
		$pdf->Ln(3);
// Table with 20 rows and 4 columns
$pdf->SetWidths(array(10,40,40,80,50,50));
	$pdf->SetFont('Arial','B',14);
$pdf->Row(array('No','PAYMENTDATE','STUDENTCODE','STUDENTNAME','PAYMENTMODEL','PAYMENTAMOUNT'));
	$pdf->SetFont('Arial','',10);
	$sql="SELECT `STUDENTPAYMENT_id`, `STUDENTPAYMENT_std`, `STUDENTPAYMENT_amount`, `STUDENTPAYMENT_pydate`, `STUDENTPAYMENT_receiptno`, `STUDENTPAYMENT_receiptdoc`, `STUDENTPAYMENT_pymtmodel`, `STUDENTPAYMENT_status`, `STUDENTPAYMENT_comment`, `PAYMENTMODEL_name`,`student_reg`, `student_fname`, `student_lname`,`student_academicyear` FROM `studentpayment_tb` INNER JOIN `student_tb` ON `student_id`=`STUDENTPAYMENT_std` INNER JOIN `paymentmodel_tb` ON `PAYMENTMODEL_id`=`STUDENTPAYMENT_pymtmodel`";
	
	$run_query=mysqli_query($conn,$sql);
if(mysqli_num_rows($run_query) > 0) {
	$no=0;
	$loan_tot=0;
while($row=mysqli_fetch_array($run_query)){
$STUDENTPAYMENT_id=$row["STUDENTPAYMENT_id"];
$STUDENTPAYMENT_pydate=$row["STUDENTPAYMENT_pydate"];
$PAYMENTMODEL_name=$row["PAYMENTMODEL_name"];
$STUDENTPAYMENT_amount=$row["STUDENTPAYMENT_amount"];
$student_reg=$row["student_reg"];
$student_name=$row["student_fname"].$row["student_lname"];
$studentyear=$row["student_academicyear"];
$no=$no+1;
	
$pdf->Row(array($no,$STUDENTPAYMENT_pydate,$student_reg,$student_name,$PAYMENTMODEL_name,$STUDENTPAYMENT_amount));}
$pdf->SetFont('Arial','B',14);
}	else{
			$pdf->SetWidths(array(374));
	$pdf->Row(array('PAYMENT MODEL NOT FOUND:'));
	
	
}
$pdf->Output();
?>