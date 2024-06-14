<?php
namespace App\Common;
/*********************************************************************************
 * This program is developed by Softdev Infotech Pvt. Ltd.
 * Copyright Softdev Infotech Pvt. Ltd. 2023
 *********************************************************************************/

use Illuminate\Http\Request;
use TCPDF;
use App\Common\GlobalSettings;
use App\Http\Controllers\AppListController;
use Illuminate\Support\Facades\Auth;
use App\Common\Healpdf;
use App\Common\Datetime\TimeDate;

$tcpdf_include_dirs = array(base_path('app/Common/TCPDF/tcpdf.php'), // True source file
    base_path('app/Common/TCPDF/tcpdf.php'), // Relative from $PWD
    '/usr/share/php/tcpdf/tcpdf.php',
    '/usr/share/tcpdf/tcpdf.php',
    '/usr/share/php-tcpdf/tcpdf.php',
    '/var/www/tcpdf/tcpdf.php',
    '/var/www/html/tcpdf/tcpdf.php',
    '/usr/local/apache2/htdocs/tcpdf/tcpdf.php',
);
foreach ($tcpdf_include_dirs as $tcpdf_include_path)
{
    if (@file_exists($tcpdf_include_path))
    {
        require_once $tcpdf_include_path;
    }
}
class Healpdf extends TCPDF
{
    use SoftdevLog;

    public function Header()
    {

        $request = new Request();
        $request->merge([
        'key' => 'upload_logo',
        ]);
        $pdf_settings = GlobalSettings::getCache('pdf_settings');

        if (empty($pdf_settings))
        {
            $appList = new AppListController();
            $pdfLogo = json_encode($appList->getPdfSettings($request));
            $pdf_settings = GlobalSettings::getCache('pdf_settings');
        }
       
        $pdfLogo = !empty($pdf_settings['upload_logo'])?'/uploads/pdf_setting/' . $pdf_settings['upload_logo']:'';
        $header_logo_custom_width = $pdf_settings['pdf_header_logo_custom_width'] ?? '';
        $this->Image($pdfLogo, 10, 10, $header_logo_custom_width);

        $header_string_qoute = $pdf_settings['pdf_header_string_four'] ?? '';
        $this->SetFont('helvetica', 'I', 8); 
        $this->SetTextColor(153, 0, 0);
        $this->Cell(0, 0, $header_string_qoute, 0, 1, 'C', false); 
        
        $header_title = $pdf_settings['PDF_HEADER_TITLE'] ?? 'Softdev HOSPITAL';
        $this->SetFont('helvetica', 'B', 14); 
        $this->Cell(0, 0, $header_title, 0, 1, 'C', false); 
        
        $header_subtitle = $pdf_settings['pdf_header_subtitle'] ?? '';
        $this->SetFont('helvetica', 'I', 9); 
        $this->Cell(0, 0, $header_subtitle, 0, 1, 'C', false); 
        
        $header_string = $pdf_settings['pdf_header_string'] ?? '';
        $this->SetFont('helvetica', '', 11); 
        $this->Cell(0, 0, $header_string, 0, 1, 'C', false); 
        
        $header_string_two = $pdf_settings['pdf_header_string_two'] ?? '';
        $this->SetFont('helvetica', '', 12); 
        $this->Cell(0, 0, $header_string_two, 0, 1, 'C', false); 
        
        $header_string_three = $pdf_settings['pdf_header_string_three'] ?? '';
        $this->SetFont('helvetica', '', 11); 
        $this->Cell(0, 0, $header_string_three, 0, 1, 'C', false); 
        
        $header_string_five = $pdf_settings['pdf_header_string_five'] ?? '';
        $this->SetFont('helvetica', '', 10); 
        $this->Cell(0, 0, $header_string_five, 0, 1, 'C', false); 
        $datetime = new TimeDate();
        $printedOn = $datetime->to_display_date_time(date('Y-m-d H:i:s'));

        $this->SetFont('helvetica', '', 7);
        $this->SetY(40);
        $this->SetX(150);
        $this->Cell(0, 0, 'Printed On: ' . $printedOn, 0, 1, 'C', false);

        // Set the line style to a dotted pattern
        $this->SetDrawColor(153, 0, 0);
        $this->SetLineStyle(array('dash' => '2,2'));
        $this->SetX(10);
        $lineY = 45; 
        $this->Line(10, $lineY, 200, $lineY); 
    }
    public function parentDisplay()
    {
        try
        {
            $user = Auth::user();

            $this->SetCreator(PDF_CREATOR);

            $this->SetAuthor('Softdev Infotech');

            $this->SetTitle('Softdev Infotech Pvt. Ltd');

            $this->SetSubject('TCPDF Tutorial');

            $this->SetKeywords('TCPDF, PDF, example, test, guide');

            // set default header data
            $request = new Request();
            $request->merge([
            'key' => 'upload_logo',
            ]);
            $pdf_settings = GlobalSettings::getCache('pdf_settings');

            if (empty($pdf_settings))
            {
                $appList = new AppListController();
                $pdfLogo = json_encode($appList->getPdfSettings($request));
                $pdf_settings = GlobalSettings::getCache('pdf_settings');
            }


            $logo_custom_height = $pdf_settings['pdf_header_logo_custom_height'] ?? '';

            $pageFormat = $pdf_settings['pdf_page_format'] ?? 'A4';
            $this->setPageFormat($pageFormat);

            $pageOrientation = $pdf_settings['pdf_page_orientation'] ?? 'Portrait';
            $this->setPageOrientation($pageOrientation);

            $margin_header = $pdf_settings['pdf_margin_header'] ?? '';
            $this->SetHeaderMargin($margin_header);

            $margin_footer = $pdf_settings['pdf_margin_footer'] ?? '';
            $this->SetFooterMargin($margin_footer);

            $margin_top = $pdf_settings['pdf_margin_top'] ?? '';
            $this->SetTopMargin($margin_top);

            $margin_bottom = $pdf_settings['pdf_margin_bottom'] ?? '';
            $this->SetAutoPageBreak(true, $margin_bottom);

            $margin_left = $pdf_settings['pdf_margin_left'] ?? '';
            $this->SetLeftMargin($margin_left);

            $margin_right = $pdf_settings['pdf_margin_right'] ?? '';
            $this->SetRightMargin($margin_right);

            $this->setFooterData(array(0, 64, 0), array(0, 64, 128));

            // set header and footer fonts

            $font_name_main = $pdf_settings['pdf_font_name_main'] ?? '';
            $font_size_main = $pdf_settings['pdf_font_size_main'] ?? '';
            $this->setHeaderFont(array($font_name_main, '', $font_size_main));

            $this->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set auto page breaks
            // set image scale factor
            $this->setImageScale(PDF_IMAGE_SCALE_RATIO);
            // set some language-dependent strings (optional)
            if (@file_exists(dirname(__FILE__) . '/lang/eng.php'))
            {
                require_once dirname(__FILE__) . '/lang/eng.php';
                $this->setLanguageArray($l);
            }
            // ---------------------------------------------------------
            // set default font subsetting mode
            $this->setFontSubsetting(true);
            // Set font
            // dejavusans is a UTF-8 Unicode font, if you only need to
            // print standard ASCII chars, you can use core fonts like
            // helvetica or times to reduce file size.
            $font_name_data = $pdf_settings['pdf_font_name_data'] ?? '';
            $font_size_data = $pdf_settings['pdf_font_size_data'] ?? '';
            $this->SetFont($font_name_data, '', $font_size_data, '', true);
            // Add a page
            // This method has several options, check the source code documentation for more information.
            $this->AddPage();

            // set text shadow effect
            $this->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
        }
        catch (\Throwable $e)
        {
            $this->LogCritical('Failed: app->Common->parentDisplay()', ['error' => $e->getMessage()]);
            return false;
        }

    }
}
