<?php

namespace App\Http\Controllers;

use App\Models\Clinic\Registration;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
	protected $fpdf;
 
    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function printQueue($regNo) 
    {
        $detailReg = Registration::select(
            'c_registration.reg_no as regNo',
            'c_registration.queue_no as queueNo',
            'c_registration.created_at as createdAt',
            'c_patient.patientname as name',
            'c_patient.gender as gender',
            'c_registration.rm_code as rmNo'
        )
        ->leftJoin('c_patient', 'c_registration.patient_id', 'c_patient.id')
        ->where('c_registration.reg_no', $regNo)
        ->first();
        // custom papersize
        $this->fpdf->AddPage("L", ['100', '100']);
        // custom fontfamily
    	$this->fpdf->SetFont('Arial', 'B', 14);
        // custom margin x, margin y, text
        $this->fpdf->Text(28, 10, 'Klinik Dokter Asep');  

    	$this->fpdf->SetFont('Arial','', 8);
        $this->fpdf->Text(30, 14, 'Jl. Lorem Ipsum Dolor Sit Amet');       
        $this->fpdf->Text(32, 18, 'Nomor Telp. 0895636701586');  
        $this->fpdf->Text(6, 22, '_________________________________________________________');  
        
        $this->fpdf->SetFont('Arial','', 9);
        $this->fpdf->Text(6, 30, 'Nomor Registrasi '); 
        $this->fpdf->SetFont('Arial','B', 9);
        $this->fpdf->Text(40, 30, ": ".$detailReg->regNo); 

        $this->fpdf->SetFont('Arial','', 9);
        $this->fpdf->Text(6, 34, 'Nama Pasien '); 
        $this->fpdf->SetFont('Arial','B', 9);
        $gender = $detailReg->gender == '1' ? 'Tn' : 'Ny';
        $this->fpdf->Text(40, 34, ": ".$detailReg->name.', '.$gender); 

        $this->fpdf->SetFont('Arial','', 9);
        $this->fpdf->Text(6, 38, 'Nomor Rekam Medis '); 
        $this->fpdf->SetFont('Arial','B', 9);
        $this->fpdf->Text(40, 38, ": ".$detailReg->rmNo); 
        

        $this->fpdf->SetFont('Arial','', 9);
        $this->fpdf->Text(6, 42, 'Tanggal Daftar'); 
        $this->fpdf->SetFont('Arial','B', 9);
        $this->fpdf->Text(40, 42, ": ".$detailReg->createdAt);

        $this->fpdf->Text(6, 48, '___________________________________________________');  
        
        $this->fpdf->SetFont('Arial', 'B', 14);
        $this->fpdf->Text(22, 58, 'NOMOR ANTRIAN ANDA');
        $this->fpdf->SetFont('Arial', 'B', 44);
        $this->fpdf->Text(46, 74, $detailReg->queueNo);

        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Text(15, 82, 'Budayakan Antri Untuk Kenyamanan Bersama');
        $this->fpdf->SetFont('Arial', '', 10);
        $this->fpdf->Text(16, 87, 'TERIMA KASIH, SEMOGA LEKAS SEMBUH');
         
        $this->fpdf->Output();

        exit;
    }
}