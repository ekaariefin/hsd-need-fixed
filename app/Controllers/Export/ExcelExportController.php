<?php

namespace App\Controllers\Export;

use App\Controllers\BaseController;
use App\Models\Coaching\CoachingModel;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border as StyleBorder;

class ExcelExportController extends BaseController
{
    public function __construct()
    {
        $this->spreadsheet = new Spreadsheet();
    }
    public function index()
    {
        return view('test_view/export-coaching');
    }

    public function exportCoachingToExcel()
    {
        $coachingModel = new CoachingModel();

        $start = $this->request->getVar('startdate');
        $end = $this->request->getVar('enddate');
        $query = $coachingModel->where("tanggal_coaching BETWEEN '$start' AND '$end'")->get()->getResultArray();
        // dd($query);

        // SELECT * FROM `coaching` WHERE tanggal_coaching BETWEEN '2022-6-10' AND '2022-6-12';

        $waktu = "$start sd $end";
        $filename = $waktu . '  Data Coaching';
        // $spreadsheet = new Spreadsheet();
        $sheet = $this->spreadsheet->getActiveSheet();
        $sheet->mergeCells('A1:W1');
        $sheet->mergeCells('A3:A4');
        $sheet->mergeCells('B3:B4');
        $sheet->mergeCells('C3:C4');
        $sheet->mergeCells('D3:K3');
        $sheet->mergeCells('L3:S3');
        $sheet->mergeCells('T3:U3');
        $sheet->mergeCells('V3:V4');
        $sheet->mergeCells('W3:W4');

        $sheet->setCellValue('A1', "Data Coaching $waktu");
        $sheet->setCellValue('A3', "NO");
        $sheet->setCellValue('B3', "TANGGAL COACHING");
        $sheet->setCellValue('C3', "PERIODE COACHING");

        $sheet->setCellValue('D3', "KARYAWAN");
        $sheet->setCellValue('D4', "NIP");
        $sheet->setCellValue('E4', "NAMA");
        $sheet->setCellValue('F4', "JABATAN");
        $sheet->setCellValue('G4', "GOLONGAN");
        $sheet->setCellValue('H4', "DEPARTEMEN");
        $sheet->setCellValue('I4', "SATUAN KERJA");
        $sheet->setCellValue('J4', "BIDANG");
        $sheet->setCellValue('K4', "FUNGSI");

        $sheet->setCellValue('L3', "ATASAN");
        $sheet->setCellValue('L4', "NIP");
        $sheet->setCellValue('M4', "NAMA");
        $sheet->setCellValue('N4', "JABATAN");
        $sheet->setCellValue('O4', "GOLONGAN");
        $sheet->setCellValue('P4', "DEPARTEMEN");
        $sheet->setCellValue('Q4', "SATUAN KERJA");
        $sheet->setCellValue('R4', "BIDANG");
        $sheet->setCellValue('S4', "FUNGSI");

        $sheet->setCellValue('T3', "SASARAN BISNIS/KECAKAPAN KERJA");
        $sheet->setCellValue('T4', "DESKRIPSI");
        $sheet->setCellValue('U4', "CAPAIAN");
        $sheet->setCellValue('V3', "PERILAKU KERJA");
        $sheet->setCellValue('W3', "SARAN DAN DUKUNGAN ATASAN");


        // memberikan border
        $sheet->getStyle('A3:W4')->getBorders()->getAllBorders()->setBorderStyle(StyleBorder::BORDER_THIN);

        // insert data
        $column = 5;
        $i = 1;
        foreach ($query as $user) {
            $this->spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $i)
                ->setCellValue('B' . $column, $user['tanggal_coaching'])
                ->setCellValue('C' . $column, (($user['periode_coaching'] === '1') ? "Januari-Juni" : "Juli-Desember") . ' ' . date('Y', strtotime($user['tanggal_coaching'])))
                ->setCellValue('D' . $column, $user['fnip_karyawan'])
                ->setCellValue('E' . $column, $user['fnama_karyawan'])
                ->setCellValue('F' . $column, $user['jabatan_karyawan'])
                ->setCellValue('G' . $column, $user['fgrade_karyawan'])
                ->setCellValue('H' . $column, $user['departemen_karyawan'])
                ->setCellValue('I' . $column, $user['satuan_kerja_karyawan'])
                ->setCellValue('J' . $column, $user['bidang_karyawan'])
                ->setCellValue('K' . $column, $user['fungsi_karyawan'])
                ->setCellValue('L' . $column, $user['fnip_atasan'])
                ->setCellValue('M' . $column, $user['fnama_atasan'])
                ->setCellValue('N' . $column, $user['jabatan_atasan'])
                ->setCellValue('O' . $column, $user['fgrade_atasan'])
                ->setCellValue('P' . $column, $user['departemen_atasan'])
                ->setCellValue('Q' . $column, $user['satuan_kerja_atasan'])
                ->setCellValue('R' . $column, $user['bidang_atasan'])
                ->setCellValue('S' . $column, $user['fungsi_atasan'])
                ->setCellValue('W' . $column, $user['saran_dukungan'])
                ->setCellValue('T' . $column, (($user['sarbis1'] !== null) ? "1. " . $user['sarbis1'] : "") . (($user['sarbis2'] !== null) ? "\n2. " . $user['sarbis2'] : "") . (($user['sarbis3'] !== null) ? "\n3. " . $user['sarbis3'] : "") . (($user['sarbis4'] !== null) ? "\n4. " . $user['sarbis4'] : "") . (($user['sarbis5'] !== null) ? "\n5. " . $user['sarbis5'] : "") . (($user['sarbis6'] !== null) ? "\n6. " . $user['sarbis6'] : "") . (($user['sarbis7'] !== null) ? "\n7. " . $user['sarbis7'] : "") . (($user['sarbis8'] !== null) ? "\n8. " . $user['sarbis8'] : ""))
                ->setCellValue('U' . $column, (($user['target_tercapai1'] !== null) ? "1. " . $user['target_tercapai1'] : "") . (($user['target_tercapai2'] !== null) ? "\n2. " . $user['target_tercapai2'] : "") . (($user['target_tercapai3'] !== null) ? "\n3. " . $user['target_tercapai3'] : "") . (($user['target_tercapai4'] !== null) ? "\n4. " . $user['target_tercapai4'] : "") . (($user['target_tercapai5'] !== null) ? "\n5. " . $user['target_tercapai5'] : "") . (($user['target_tercapai6'] !== null) ? "\n6. " . $user['target_tercapai6'] : "") . (($user['target_tercapai7'] !== null) ? "\n7. " . $user['target_tercapai7'] : "") . (($user['target_tercapai8'] !== null) ? "\n8. " . $user['target_tercapai8'] : ""))
                ->setCellValue('V' . $column, (($user['budaya_kerja1'] !== null) ? "" . $user['budaya_kerja1'] : "") . (($user['budaya_kerja2'] !== null) ? "\n" . $user['budaya_kerja2'] : "") . (($user['budaya_kerja3'] !== null) ? "\n" . $user['budaya_kerja3'] : "") . (($user['budaya_kerja4'] !== null) ? "\n" . $user['budaya_kerja4'] : "") . (($user['budaya_kerja5'] !== null) ? "\n" . $user['budaya_kerja5'] : "") . (($user['budaya_kerja6'] !== null) ? "\n" . $user['budaya_kerja6'] : "") . (($user['budaya_kerja7'] !== null) ? "\n" . $user['budaya_kerja7'] : "") . (($user['budaya_kerja8'] !== null) ? "\n" . $user['budaya_kerja8'] : "") . (($user['budaya_kerja9'] !== null) ? "\n" . $user['budaya_kerja9'] : "") . (($user['budaya_kerja10'] !== null) ? "\n" . $user['budaya_kerja10'] : ""));

            $i++;
            $column++;
        }
        // // membuat file excel
        // $writer = new Xlsx($this->spreadsheet);
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A1:W4')->getAlignment()->setHorizontal('center');
        $sheet->getStyle("A1:$lastColumn$lastRow")->getAlignment()->setVertical('center');
        // $sheet->getStyle('A1:W4')->getAlignment()->setHorizontal('center');
        // $sheet->getStyle('A1:W4')->getAlignment()->setVertical('center');


        for ($i = 'A'; $i !=  $lastColumn; $i++) {
            $sheet->getColumnDimension($i)->setAutoSize(TRUE);
        }

        $sheet->getStyle('A3:W4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFE900');
        $sheet->getStyle('D3:K4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('39FC04');
        $sheet->getStyle('L3:S4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('0EF2ED');
        $writer = new Xlsx($this->spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
