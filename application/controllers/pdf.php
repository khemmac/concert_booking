<?php
class Pdf extends CI_Controller {


	function __construct()
	{
		parent::__construct();

		$this->output->set_header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
	}

	public function print1(){
		$id = end($this->uri->segments);

		$pdf_name = 'xxxxx';

		//require_once('../libraries/tcpdf/config/lang/eng.php');
		require_once('./application/libraries/tcpdf/tcpdf.php');

		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('test author');
		$pdf->SetTitle('test pdf');

		// set header and footer fonts
		$pdf->setHeaderFont(Array('angsanaupc', '', 15));

		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, 20, PDF_HEADER_TITLE.' PRINT', PDF_HEADER_STRING);
		// remove default header/footer
		//$pdf->setPrintHeader(false);
		//$pdf->setPrintFooter(false);

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		//set margins
		$pdf->SetMargins(4, 32, 4, 0);//PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(3);//PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(0);//PDF_MARGIN_FOOTER);

		//set auto page breaks
		$pdf->SetAutoPageBreak(FALSE, 1);//(TRUE, PDF_MARGIN_BOTTOM);

		//set image scale factor
		//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		//set some language-dependent strings
		$pdf->setLanguageArray('thai');

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('angsanaupc', '', 16);

		// add a page
		$pdf->AddPage();

		$html = 'ภาษาไทย';
		// define barcode style
		$style = array(
			'position' => '',
			'align' => 'C',
			'stretch' => false,
			'fitwidth' => true,
			'cellfitalign' => '',
			'border' => true,
			'hpadding' => 'auto',
			'vpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255),
			'text' => true,
			'font' => 'helvetica',
			'fontsize' => 8,
			'stretchtext' => 4
		);

		// Standard 2 of 5
		$pdf->Cell(0, 0, 'Standard 2 of 5', 0, 1);
		$pdf->write1DBarcode('101109220000071', 'S25', '', '', '', 18, 0.4, $style, 'N');

		function ColoredTable($_pdf, $header,$data) {
			// Colors, line width and bold font
			$_pdf->SetFillColor(255, 0, 0);
			$_pdf->SetTextColor(255);
			$_pdf->SetDrawColor(0, 0, 0);
			$_pdf->SetLineWidth(0.3);
			$_pdf->SetFont('', 'B');
			// Header
			$w = array(20, 35, 40, 25, 30, 40);
			$num_headers = count($header);
			for($i = 0; $i < $num_headers; ++$i) {
				$_pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
			}
			$_pdf->Ln();
			// Color and font restoration
			$_pdf->SetFillColor(224, 235, 255);
			$_pdf->SetTextColor(0);
			$_pdf->SetFont('');
			// Data
			$fill = 0;
			foreach($data as $row) {
				$_pdf->Cell($w[0], 6, $row[0], 'LRTB', 0, 'C', $fill);
				$_pdf->Cell($w[1], 6, $row[1], 'LRTB', 0, 'L', $fill);
				$_pdf->Cell($w[2], 6, $row[2], 'LRTB', 0, 'L', $fill);
				$_pdf->Cell($w[3], 6, number_format($row[3]), 'LRTB', 0, 'C', $fill);
				$_pdf->Cell($w[4], 6, number_format($row[4]), 'LRTB', 0, 'R', $fill);
				$_pdf->Cell($w[5], 6, number_format($row[5]), 'LRTB', 0, 'R', $fill);
				$_pdf->Ln();
				$fill=!$fill;
			}
			$_pdf->SetFillColor(220, 220, 220);
			// SUM
			$_pdf->Cell(array_sum(array($w[0],$w[1],$w[2],$w[3],$w[4]))
				, 6, 'ราคารวม', 'LRTB', 0, 'R', 1);
			$_pdf->Cell($w[5], 6, number_format(39000), 'LRTB', 0, 'R', 1);
			$_pdf->Ln();
			// ส่วนลด
			$_pdf->Cell(array_sum(array($w[0],$w[1],$w[2],$w[3],$w[4]))
				, 6, 'ส่วนลด 5% สำหรับผู้ที่มี ปตท. Bluecard', 'LRTB', 0, 'R', 1);
			$_pdf->Cell($w[5], 6, 0.95, 'LRTB', 0, 'R', 1);
			$_pdf->Ln();
			// total
			$_pdf->Cell(array_sum(array($w[0],$w[1],$w[2],$w[3],$w[4]))
				, 6, 'ราคาสุทธิ', 'LRTB', 0, 'R', 1);
			$_pdf->Cell($w[5], 6, number_format(37050), 'LRTB', 0, 'R', 1);
			$_pdf->Ln();

			//$_pdf->Cell(array_sum($w), 0, '', 'T');
		}

		ColoredTable($pdf, array('รายการที่','โซนที่นั่ง','เลขที่นั่ง','จำนวนที่นั่ง','ราคาต่อหน่วย','ราคา'),
			array(
				array('1','A1','001, 022, 023, 100',4,6000,24000),
				array('2','B2','002, 099, 097',3,5000,15000)
		));

		//$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
		//$pdf->writeHTML($html, true, false, true, false, '');

		// set javascript
		//$pdf->IncludeJS('print(true);');
		// ---------------------------------------------------------

		//Close and output PDF document
		$pdf->Output($pdf_name.'.pdf', 'I');
	}


}
?>
