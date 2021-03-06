<?php

function get_seat_by_zone($seat_list, $z_name){
		$r = array();
		foreach($seat_list AS $o_seat){
			if($o_seat['zone_name']==$z_name)
				array_push($r, $o_seat['seat_name']);
		}
		return $r;
	}
	function get_zone_price($seat_list, $z_name){
		foreach($seat_list AS $o_seat){
			if($o_seat['zone_name']==$z_name)
				return $o_seat['price'];
		}
		return 0;
	}
	function get_sum_price($seat_list){
		$r = 0;
		foreach($seat_list AS $o_seat){
			$r += $o_seat['price'];
		}
		return $r;
	}
	function get_card_fee($seat_list){
		return count($seat_list) * 20;
	}
	function get_discount($booking_type, $seat_list){
		$r = 0;
		$sum_price = get_sum_price($seat_list);
		if($booking_type==3){
			if(count($seat_list)>=100)
				$r = $sum_price * 15 / 100;
			else if(count($seat_list)>=50)
				$r = $sum_price * 10 / 100;
			else if(count($seat_list)>=30)
				$r = $sum_price * 5 / 100;
		}else if($booking_type==2){
			return 0;
		}
		return $r;
	}
	function get_total_price($booking_type, $seat_list){
		return get_sum_price($seat_list) + (count($seat_list) * 20) - get_discount($booking_type, $seat_list);
	}

class Pdf extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		// load model
		$this->load->model('booking_model','',TRUE);

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

	public function print_booking(){
		if(!is_user_session_exist($this))
			redirect('member/login?rurl='.uri_string());
		$user_id = get_user_session_id($this);

		$booking_id = $this->uri->segment(3);

		if(empty($booking_id) || !is_numeric($booking_id))
			redirect('booking/check');

		$data = $this->booking_model->prepare_print_data($user_id, $booking_id);
		$person = $data['person'];
		$zone_list = $data['zone_list'];
		$booking_data = $data['booking_data'];
		$booking_list = $data['booking_list'];

		$pdf_name = 'boostplus_'.$booking_data['code'];

		//require_once('../libraries/tcpdf/config/lang/eng.php');
		require_once('./application/libraries/tcpdf/tcpdf.php');

		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Boostplus');
		$pdf->SetTitle($pdf_name);

		// set header and footer fonts
		$pdf->setHeaderFont(Array('angsanaupc', 'B', 20));

		// set default header data
		$pdf->SetHeaderData('print-logo.png', 40, 'หลักฐานการจองบัตร', 'www.boostplus.co.th');
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

		// ***** USER INFO *****
		$pdf->SetFont('angsanaupc', 'B', 19);
$tbl = '<table cellspacing="0" cellpadding="3" border="0">
    <tr>
        <td rowspan="4" width="20" width="20"></td>
        <td width="305">คุณ '.$person['thName'].'</td>
        <td rowspan="4" width="10"></td>
        <td rowspan="4" align="center">
        	<table cellspaceing="0" cellpadding="3" border="1">
        		<tr><td style="background-color:#eeeeee;">รหัสการจอง<br />'.$booking_data['code'].'</td></tr>
        	</table>
        </td>
    </tr>
    <tr>
        <td>รหัสบัตรประชาชน '.$person['code'].'</td>
    </tr>
    <tr>
        <td>อีเมล์ '.$person['email'].'</td>
    </tr>
    <tr>
        <td>โทรศัพท์ '.$person['tel'].'</td>
    </tr>
</table>';
		$pdf->writeHTML($tbl, true, false, false, false, '');
		// ***** END USER INFO *****

		$pdf->Ln();

		// ***** BODY LIST *****
		$pdf->SetLineWidth(0.2);
		$pdf->SetFont('', '', '16');
		$tbl = '';
		$tbl .= '<table cellpadding="4" cellspacing="0" width="100%" border="1">
					<tr>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">รายการ</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">โซนที่นั่ง</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">เลขที่นั่ง</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">จำนวนที่นั่ง</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">ราคาต่อหน่วย</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">ราคา</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">สถานะ</td>
					</tr>';
	foreach($zone_list AS $key_z => $z):
		$seat_list = get_seat_by_zone($booking_list, $z);
		$zone_price = get_zone_price($booking_list, $z);

		$tbl .= '<tr>
						<td style="background-color:white;" align="center">'.($key_z+1) .'</td>
						<td style="background-color:white;" align="center">'. strtoupper($z) .'</td>
						<td style="background-color:white;" align="center">'. strtoupper(implode(', ', $seat_list)) .'</td>
						<td style="background-color:white;" align="center">'. count($seat_list) .'</td>
						<td style="background-color:white;" align="center">'. number_format($zone_price) .'</td>
						<td style="background-color:white;" align="center">'. number_format($zone_price * count($seat_list)) .'</td>';
					if($key_z==0):
						$tbl .= '<td style="background-color:white;" align="center" rowspan="'. (count($zone_list)+4) .'" valign="top" style="padding:5px;">
							กรุณาชำระเงิน
							ภายในวันที่ '. util_helper_format_date(util_helper_add_six_hour(new DateTime())) .'
							ก่อนเวลา '. util_helper_format_time(util_helper_add_six_hour(new DateTime())) .'
						</td>';
					endif;
		$tbl .= '</tr>';
	endforeach;

		$tbl .= '<tr>
						<td style="background-color:white;" align="right" colspan="5">ราคารวม</td>
						<td style="background-color:white;" align="center">'. number_format(get_sum_price($booking_list)) .'</td>
					</tr>
					<tr>
						<td style="background-color:white;" align="right" colspan="5">เงินตรวจสอบโอน</td>
						<td style="background-color:white;" align="center">0.'. str_pad(substr($booking_data['id'], -2), 2, '0', STR_PAD_LEFT) .'</td>
					</tr>
					<tr>
						<td style="background-color:white;" align="right" colspan="5">จำนวนเงินสำหรับทำบัตรแข็ง</td>
						<td style="background-color:white;" align="center">20</td>
					</tr>
					<tr>
						<td style="background-color:white;" align="right" colspan="5">ราคารวมทั้งหมด</td>
						<td style="background-color:white;" align="center"><strong>'. number_format(get_sum_price($booking_list) + 20) .'.'. str_pad(substr($booking_data['id'], -2), 2, '0', STR_PAD_LEFT) .'</strong></td>
					</tr>
				</table>';
		//echo $tbl;
		$pdf->writeHTML($tbl, true, false, false, false, '');
		// ***** END BODY LIST *****

		// ***** FOOTER INFO *****
		$pdf->SetFont('', 'B', 18);
		$pdf->MultiCell(0, 0, 'เงื่อนไขการชำระเงิน',0, 'L', 0, 1);
		$pdf->SetFont('', '', 16);
$tbl = '<table cellspacing="0" cellpadding="3" border="0">
    <tr>
        <td>
			<ol>
				<li>กรุณาชำระผ่านธนาคารดังต่อไปนี้
					<ul>
						<li>ธนาคารกรุงเทพ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						สาขาลาดพร้าว
						&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;
						บัญชีกระแสรายวัน เลขที่บัญชี
						129-3-16258-0
						</li>
						<li>ธนาคารกสิกรไทย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						สาขาลาดพร้าวซอย10
						&nbsp;&nbsp;&nbsp;
						บัญชีกระแสรายวัน เลขที่บัญชี
						752-1-02075-4
						</li>
						<li>ธนาคารไทยพาณิชย์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						สาขาลาดพร้าวซอย10
						&nbsp;&nbsp;&nbsp;
						บัญชีกระแสรายวัน เลขที่บัญชี
						047-3-03581-2
						</li>
					</ul>
				</li>
				<li>ชำระเงินภายใน 4 ชั่วโมง</li>
				<li>กรุณานำหลักฐานการชำระเงินมายืนยันการแจ้งโอนเงิน ผ่านทาง <a href="http://www.boostplus.co.th" target="_blank">www.boostplus.co.th</a> ในหัวข้อแจ้งโอนเงิน
				</li>
				<li>หากแจ้งโอนเงินเรียบร้อยแล้ว กรุณาตรวจสอบสถานะการจอง หลังจากแจ้งโอนเงินในเวลาประมาณ 48 ชม.</li>
			</ol>
        </td>
    </tr>
    <tr>
    	<td style="background-color:#ffa01f;" align="center">* หมายเหตุ  สามารถตรวจสอบสถานะการโอนเงินได้ผ่านทางหัวข้อ &quot;ตรวจสอบสถานะบัตร&quot;</td>
    </tr>
</table>';
		$pdf->writeHTML($tbl, true, false, false, false, '');
		// ***** END FOOTER INFO *****

		$pdf->SetY(-40);

		// ***** BARCODE *****
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
		//$pdf->Cell(0, 0, 'Standard 2 of 5', 0, 1);
		$pdf->write1DBarcode($booking_data['id'], 'S25', '', '', '', 18, 0.4, $style, 'N');
		// ***** END BARCODE *****

		// set javascript
		$is_print = $this->input->get('print');
		if($is_print=='1'){
			$pdf->IncludeJS('print(true);');
			$pdf->Output($pdf_name.'.pdf', 'I');
		}else{
			$pdf->Output($pdf_name.'.pdf', 'D');
		}
	}

	public function print_booking_complete(){
		if(!is_user_session_exist($this))
			redirect('member/login?rurl='.uri_string());
		$user_id = get_user_session_id($this);

		$booking_id = $this->uri->segment(3);

		if(empty($booking_id) || !is_numeric($booking_id))
			redirect('booking/check');

		$data = $this->booking_model->prepare_print_data($user_id, $booking_id);
		$person = $data['person'];
		$zone_list = $data['zone_list'];
		$booking_data = $data['booking_data'];
		$booking_list = $data['booking_list'];

		$pdf_name = 'boostplus_'.$booking_data['code'];

		//require_once('../libraries/tcpdf/config/lang/eng.php');
		require_once('./application/libraries/tcpdf/tcpdf.php');

		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Boostplus');
		$pdf->SetTitle($pdf_name);

		// set header and footer fonts
		$pdf->setHeaderFont(Array('angsanaupc', 'B', 20));

		// set default header data
		$pdf->SetHeaderData('print-logo.png', 40, 'หลักฐานการชำระเงิน', 'www.boostplus.co.th');
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
		$pdf->SetAutoPageBreak(TRUE, 1);//(TRUE, PDF_MARGIN_BOTTOM);

		//set image scale factor
		//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		//set some language-dependent strings
		$pdf->setLanguageArray('thai');

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('angsanaupc', '', 16);

		// add a page
		$pdf->AddPage();

		// ***** USER INFO *****
		$pdf->SetFont('angsanaupc', 'B', 19);
$tbl = '<table cellspacing="0" cellpadding="3" border="0">
    <tr>
        <td rowspan="4" width="20" width="20"></td>
        <td width="305">คุณ '.$person['thName'].'</td>
        <td rowspan="4" width="10"></td>
        <td rowspan="4" align="center">
        	<table cellspaceing="0" cellpadding="3" border="1">
        		<tr><td style="background-color:#eeeeee;">รหัสการจอง<br />'.$booking_data['code'].'</td></tr>
        	</table>
        </td>
    </tr>
    <tr>
        <td>รหัสบัตรประชาชน '.$person['code'].'</td>
    </tr>
    <tr>
        <td>อีเมล์ '.$person['email'].'</td>
    </tr>
    <tr>
        <td>โทรศัพท์ '.$person['tel'].'</td>
    </tr>
</table>';
		$pdf->writeHTML($tbl, true, false, false, false, '');
		// ***** END USER INFO *****

		$pdf->Ln();


		// ***** BODY LIST *****
		$pdf->SetLineWidth(0.2);
		$pdf->SetFont('', '', '16');
		$tbl = '';
		$tbl .= '<table cellpadding="3" cellspacing="0" width="100%" border="1">
					<tr>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">รายการ</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">โซนที่นั่ง</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">จำนวนที่นั่ง</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">ราคาต่อหน่วย</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">ราคา</td>
						<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">สถานะ</td>
					</tr>';
	$card_fee = cal_helper_get_card_fee($booking_list);
	$discount = cal_helper_get_discount($booking_data['type'], $booking_list);
	$total = cal_helper_get_total_price($booking_data['type'], $booking_list);
	foreach($zone_list AS $key_z => $z):
		$seat_list = get_seat_by_zone($booking_list, $z);
		$zone_price = get_zone_price($booking_list, $z);

		$tbl .= '<tr>
						<td style="background-color:white;" align="center">'.($key_z+1) .'</td>
						<td style="background-color:white;" align="center">'. strtoupper($z) .'</td>
						<td style="background-color:white;" align="center">'. count($seat_list) .'</td>
						<td style="background-color:white;" align="center">'. number_format($zone_price) .'</td>
						<td style="background-color:white;" align="center">'. number_format($zone_price * count($seat_list)) .'</td>';
					if($key_z==0):
						$tbl .= '<td style="background-color:white;" align="center" rowspan="'. (count($zone_list)+(4+((!empty($discount) && $discount>0)?1:0))) .'" valign="top" style="padding:5px;">';
						if($booking_data['status']==4):
							$tbl .= 'ชำระเงินแล้ว
							<br />วันที่ '.util_helper_format_date(util_helper_parse_date($booking_data['pay_date'])).'
							<br />เวลา '.util_helper_format_time(util_helper_parse_date($booking_data['pay_date']));
						elseif($booking_data['status']==3):
							$tbl .= 'เจ้าหน้าที่กำลังตรวจสอบการโอนเงินของท่าน';
						elseif($booking_data['status']==2):
							$tbl .= 'กรุณาชำระเงิน';
							if($booking_data['type']==3):
								$tbl .= 'ภายในวันที่ 20/09/2013
								<br />ก่อนเวลา 18.00';
							elseif($booking_data['type']==2):
								$tbl .= '<br />ภายในวันที่ '. util_helper_format_date(util_helper_add_six_hour($booking_data['booking_date'])) .'
								<br />ก่อนเวลา '. util_helper_format_time(util_helper_add_six_hour($booking_data['booking_date']));
							else:
								$tbl .= '<br />ภายในวันที่ '. util_helper_format_date(util_helper_add_four_hour($booking_data['booking_date'])) .'
								<br />ก่อนเวลา '. util_helper_format_time(util_helper_add_four_hour($booking_data['booking_date']));
							endif;
						else:
							$tbl .= '-';
						endif;
						$tbl.='</td>';
					endif;
		$tbl .= '</tr>';
	endforeach;

		$tbl .= '<tr>
						<td style="background-color:white;" align="right" colspan="4">ราคารวม</td>
						<td style="background-color:white;" align="center">'. number_format(get_sum_price($booking_list)) .'</td>
					</tr>
					<tr>
						<td style="background-color:white;" align="right" colspan="4">เงินตรวจสอบโอน</td>
						<td style="background-color:white;" align="center">0.'. str_pad(substr($booking_data['id'], -2), 2, '0', STR_PAD_LEFT) .'</td>
					</tr>
					<tr>
						<td style="background-color:white;" align="right" colspan="4">จำนวนเงินสำหรับทำบัตรแข็ง</td>
						<td style="background-color:white;" align="center">'.number_format($card_fee).'</td>
					</tr>';

		if(!empty($discount) && $discount>0){
			$tbl .= '<tr class="tbody">
						<td style="background-color:white;" align="right" colspan="4">ส่วนลด';
						if($booking_data['type']==2):
							$tbl .= ' (500 บาทต่อใบ)';
						elseif($booking_data['type']==3):
							$tbl .= ' ('.cal_helper_get_discount_detail($booking_data['type'], $booking_list).')';
						endif;
				$tbl .= '</td>
						<td style="background-color:white;" align="center">'.number_format($discount).'</td>
				</tr>';
		}
		$tbl .= '<tr>
						<td style="background-color:white;" align="right" colspan="4">ราคารวมทั้งหมด</td>
						<td style="background-color:white;" align="center"><strong>'. number_format($total) .'.'. str_pad(substr($booking_data['id'], -2), 2, '0', STR_PAD_LEFT) .'</strong></td>
					</tr>
				</table>';
		//echo $tbl;
		$pdf->writeHTML($tbl, true, false, false, false, '');
		// ***** END BODY LIST *****


		$pdf->SetFont('', '');
		$pdf->SetFillColor(223, 128, 0);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->MultiCell(0, 0,
'กรุณาพิมพ์หลักฐานฉบับนี้ไว้ พร้อมบัตรประชาชนตัวจริง เพื่อนำมารับบัตรจริง'.(($booking_data['type']==1)?'รุ่น Limited Edition':'').'
ในวันงาน SBS K-POP MUSIC FESTIVAL 2013 วันที่ 20/10/2013
เวลาและสถานที่จะแจ้งให้ทราบอีกครั้ง', 1, 'C', 1, 1);


		$pdf->SetY(-25);

		// ***** BARCODE *****
		// define barcode style
		$style = array(
			'position' => '',
			'align' => 'C',
			'stretch' => false,
			'fitwidth' => true,
			'cellfitalign' => 'R',
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
		$pdf->write1DBarcode($booking_data['id'], 'S25', '', '', '', 18, 0.4, $style, 'N');
		// ***** END BARCODE *****

		if($booking_data['type']==3){

			// ***** SEATS DETAIL *****
			// add a page
			$pdf->AddPage();
			$pdf->SetLineWidth(0.2);
			$pdf->SetFont('', '', '16');
			$tbl = '';
			$tbl .= '<table cellpadding="4" cellspacing="0" width="100%" border="1">
						<tr>
							<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">โซนที่นั่ง</td>
							<td style="color:white; font-weight: bold; background-color:#18171c;" align="center">เลขที่นั่ง</td>
						</tr>';

		foreach($zone_list AS $key_z => $z):
			$seat_list = get_seat_by_zone($booking_list, $z);

			$tbl .= '<tr>
						<td style="background-color:white;" align="center">'. strtoupper($z) .'</td>
						<td style="background-color:white;" align="center">'. strtoupper(implode(', ', $seat_list)) .'</td>
					</tr>';
		endforeach;

			$tbl .= '</table>';
			//echo $tbl;
			$pdf->writeHTML($tbl, true, false, false, false, '');
			// ***** END SEATS DETAIL *****

			// ***** BARCODE *****
			$pdf->SetY(-25);
			$pdf->write1DBarcode($booking_data['id'], 'S25', '', '', '', 18, 0.4, $style, 'N');
			// ***** END BARCODE *****
		}

		// set javascript
		$is_print = $this->input->get('print');
		if($is_print=='1'){
			$pdf->IncludeJS('print(true);');
			$pdf->Output($pdf_name.'.pdf', 'I');
		}else{
			$pdf->Output($pdf_name.'.pdf', 'D');
		}
	}


}
?>
