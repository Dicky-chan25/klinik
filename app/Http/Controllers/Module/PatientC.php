<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientReq;
use App\Models\Clinic\MedicalRecord;
use App\Models\Clinic\Patient;
use App\Models\MenuAccess;
use App\Models\Menus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PatientC extends Controller
{
    public function filter($fromdate, $todate, $search)
    {
        $dateFilter = '';
        $searchFilter = '';
        $endWhereQry = 'status in (0,1) AND deleted_at IS NULL';
        if ($fromdate != null && $todate != null) {
            $filterfromdate = implode(' ', [str_replace('-', '/', $fromdate), '00:00:00']);
            $filtertodate = implode(' ', [str_replace('-', '/', $todate), '23:59:00']);
            $dateFilter = "DATE(created_at) BETWEEN '$filterfromdate' AND '$filtertodate' AND ";
        }
        if ($search != '') {
            $searchFilter = "patientname LIKE '$search%' AND ";
        }

        $query = $dateFilter . $searchFilter . $endWhereQry;
        return $query;
    }

    public function index(Request $request)
    {
        // validate role user, 
        if (is_null($request->segment(2))) {
            $segment = $request->segment(1);
        } else {
            $segment = $request->segment(2);
        }
        $menu = Menus::select('id')->where('routepath', $segment)->first();
        $access = MenuAccess::where('level_id', Auth::user()->level_id)->where('menu_id', $menu->id)->first();
        
        // filter and search detection
        $fromdate = $request->fromDate == null ? '' : $request->fromDate;
        $todate = $request->toDate == null ? '' : $request->toDate;
        $search = $request->search == null ? '' : $request->search;

        $dataResult = Patient::select(
            'c_patient.id as patientId',
            'c_patient.patientname as patientName',
            'c_patient.birthdate as birthDate',
            'c_patient.identity as identity',
            'c_patient.bpjs as bpjsNo',
            'c_patient.phone as phone',
            'c_patient.gender as gender',
            'c_patient.status as status',
            'c_patient.created_at as createdAt',
        )->whereRaw($this->filter($fromdate, $todate, $search))
        ->orderBy('c_patient.updated_at', 'desc')
        ->paginate(10);

        return view('dashboard.patient.index', compact(
            'dataResult',
            'access',
            'search',
            'fromdate',
            'todate'
        ));
    }

    public function detail($id){

        // get detail patient
        $detailPatient = Patient::select(
            'c_patient.patientname as patientName',
            'c_patient.email as email',
            'c_patient.identity as identity',
            'c_patient.identity as identity',
            'c_patient.bpjs as bpjs',
            'c_patient.birthplace as birthplace',
            'c_patient.birthdate as birthdate',
            'c_patient.phone as phone',
            'c_patient.gender as gender',
            'm_religion.title as religion',
            'm_education.title as education',
            'm_career.title as career',
        )
        ->leftJoin('m_religion', 'c_patient.religion_id', 'm_religion.id')
        ->leftJoin('m_career', 'c_patient.career_id', 'm_career.id')
        ->leftJoin('m_education', 'c_patient.education_id', 'm_education.id')
        ->where('c_patient.id',$id)
        ->first();

        // get detail medical check
        $detailMr = MedicalRecord::where('patient_id', $id)->get();

        return view('dashboard.patient.detail', compact(
            'detailPatient',
            'detailMr'
        ));
    }

    public function createPost(PatientReq $req){
        try {
            $req->validated();
            $satusehat = $req->satusehat;
            $bpjs = $req->bpjs;
            $language = $req->language;
            $fullname = $req->fullname;
            $language = $req->language;
            $identity = $req->identity;
            $birthplace = $req->birthplace;
            $birthdate = $req->birthdate;
            $gender = $req->gender;
            $religion = $req->religion;
            $career = $req->career;
            $education = $req->education;
            $wa = $req->wa;
            $email = $req->email;
            $address = $req->address;

            DB::beginTransaction();
            // insert to patient table
            $insertPatient = new Patient();
            $insertPatient->satusehat = $satusehat;
            $insertPatient->bpjs = $bpjs;
            $insertPatient->language = $language;
            $insertPatient->patientname = $fullname;
            $insertPatient->address = $address;
            $insertPatient->email = $email;
            $insertPatient->birthdate = $birthdate;
            $insertPatient->birthplace = $birthplace;
            $insertPatient->identity = $identity;
            $insertPatient->phone = $wa;
            $insertPatient->religion_id = $religion;
            $insertPatient->career_id = $career;
            $insertPatient->education_id = $education;
            $insertPatient->gender = $gender;
            $insertPatient->status = 1;
            $insertPatient->created_by_id = Auth::user()->id;
            $insertPatient->save();

            DB::commit();

            Session::flash('success', 'Data Pasien Baru berhasil dibuat');
            return redirect()->route('pasien');

        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            DB::rollBack();
        }
    }
    public function create(){
        $religion =  DB::table('m_religion')->get();
        $education =  DB::table('m_education')->get();
        $career =  DB::table('m_career')->get();
        return view('dashboard.patient.create', compact(
            'religion','education','career',
        ));
    }

    public function edit($id)
    {
        $dataDetail = Patient::find($id);
        $religion =  DB::table('m_religion')->get();
        $education =  DB::table('m_education')->get();
        $career =  DB::table('m_career')->get();
        return view('dashboard.patient.edit', compact(
            'dataDetail','religion','education','career',
        ));
    }

    public function editPut(Request $req, $id)
    {
        try {
            // $detailData = Patient::where('id', $id)->first();
            
            $bpjs = $req->bpjs;
            $fullname = $req->fullname;
            $identity = $req->identity;
            $birthplace = $req->birthplace;
            $birthdate = $req->birthdate;
            $gender = $req->gender;
            $religion = $req->religion;
            $career = $req->career;
            $education = $req->education;
            $wa = $req->wa;
            $email = $req->email;
            $address = $req->address;

            Patient::where('id',$id)->update([
                'bpjs' => $bpjs,
                'patientname' => $fullname,
                'birthplace' => $birthplace,
                'birthdate' => $birthdate,
                'gender' => $gender,
                'phone' => $wa,
                'email' => $email,
                'address' => $address,
                'religion_id' => $religion,
                'career_id' => $career,
                'education_id' => $education,
                'updated_by_id' => Auth::user()->id
            ]);


            Session::flash('success', 'Ubah Data Pasien Berhasil');
            return redirect()->route('pasien');
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }

}
