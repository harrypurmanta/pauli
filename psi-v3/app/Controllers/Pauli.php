<?php

namespace App\Controllers;
use App\Models\Soalmodel;
use App\Models\Latihanmodel;
use App\Models\Usersmodel;

class Pauli extends BaseController
{
    protected $usermodel;
	protected $soalmodel;
	protected $latihanmodel;
	protected $session;

	public function __construct()
	{
		$this->session = \Config\Services::session();
        $this->session->start();
        $this->usermodel = new Usersmodel();
        $this->soalmodel = new Soalmodel();
        $this->latihanmodel = new Latihanmodel();
	}

    public function index()
    {
        $request = \Config\Services::request();
        $materi_id = $request->uri->getSegment(2);
        $data['group'] = $this->latihanmodel->getSKgroup()->getResult();
        return view('front/pauli/pauli',$data);
    }

    public function pilihansk() {
        $request = \Config\Services::request();
        $data['sk_group_id'] = $request->uri->getSegment(3);
        return view('front/pauli/petunjuksoal',$data);
    }

    public function ujian() {
        $request = \Config\Services::request();
        $data["materi_id"]  = $request->uri->getSegment(3);
        $data["group_id"]   = $request->uri->getSegment(4);
        $kolom_id = 0;
        
        return view('front/pauli/ujian',$data);
    }

    public function petunjukpauli() {
        $request = \Config\Services::request();
        $data = [
            'materi_id' => $request->uri->getSegment(3),            
            'group_id' => $request->uri->getSegment(4)
        ];

        return view('front/pauli/petunjuksoal',$data);
    }

    public function updateFinishRespon() {
        $materi_id = $this->request->getPost("materi_id");
        $group_id = $this->request->getPost("group_id");
        $user_id = $this->session->user_id;
        $data = [
            "status_cd" => "finish"
        ];
        $reset = $this->soalmodel->updateFinishRespon($materi_id,$group_id,$user_id,$data);

        echo json_encode($reset);exit;
    }

    public function pauliujian() {
        $req = $this->request;

        $proc        = $req->getPost("proc");
        $soal_id     = $req->getPost("soal_id");
        $jawaban_id  = $req->getPost("jawaban_id");
        $group_id    = $req->getPost("group_id");
        $no_soal     = (int)$req->getPost("no_soal");
        $pilihan_nm  = $req->getPost("pilihan_nm");
        $kolom_id    = (int)$req->getPost("kolom_id");
        $materi      = $req->getPost("materi");
        $sk_group_id = (int)$req->getPost("sk_group_id");
        
        $user_id = $this->session->user_id;
        $used = $this->session->used;
        
        $date = date("Y-m-d H:i:s");

        if ($proc == "start") {
            if ($this->session->has('pauli_active') && $this->session->pauli_active === true) {

            } else {
                $lastUsed = $this->soalmodel->getLastUsedPauli($user_id, $group_id, $materi)->getRow();

                $used = $lastUsed ? ($lastUsed->used + 1) : 1;
                $this->session->set([
                    'pauli_active' => true,
                    'used'   => $used
                ]);
            }
        }

        if ($jawaban_id != "") {
            $data = [
                "jawaban_id"      => $jawaban_id,
                "pilihan_nm"      => $pilihan_nm,
                "soal_id"         => $soal_id,
                "no_soal"         => $no_soal,
                "group_id"        => $group_id,
                "materi"          => $materi,
                "used"            => $this->session->used,
                "kolom_id"        => $kolom_id,
                "created_user_id" => $user_id,
                "created_dttm"    => $date,
                "session"         => $this->session->session
            ];
            
            $exists = $this->soalmodel->getResponPauli($soal_id, $group_id, $materi, $user_id, $sk_group_id, $used)->getResult();
            
            if (count($exists) > 0) {
                $updaterespon = $this->soalmodel->updateResponPauli($soal_id,$group_id,$materi,$user_id,$sk_group_id, $used, $data);
            } else {
                $this->soalmodel->simpanResponSK($data);
            }
        }
        
        $no_soal++;

        if ($proc === "persiapan" || $no_soal == 51 && $group_id == 9 && $kolom_id <= 20 && $sk_group_id <= 4) {
            return $this->response->setJSON([
                "ret" => "persiapan",
                "kolom_id" => $kolom_id,
                "sk_group_id" => $sk_group_id
            ]);
        }

        if ($proc === "selesai") {
            $this->session->remove([
                'pauli_active'
            ]);

            return $this->response->setJSON(["ret" => "selesai"]);
        }
        
        $soal = $this->soalmodel->getSoalPauliFast($no_soal, $group_id, $materi, $kolom_id, $sk_group_id);

        if (!$soal) {
            return $this->response->setJSON(["ret" => "soal_tidak_ada"]);
        }

        $jawaban = $this->soalmodel->getjawabanPauli($soal->soal_id)->getResult();

        return $this->response->setJSON([
            "ret" => "ok",
            "no_soal" => $no_soal,
            "kolom_id" => $kolom_id,
            "group_id" => $group_id,
            "sk_group_id" => $sk_group_id,
            "data_soal" => [
                "soal_id" => $soal->soal_id,
                "soal_nm" => $soal->soal_nm,
                "jawaban" => $jawaban
            ]
        ]);
    }

    public function hasiltryout() {
        $request = \Config\Services::request();
        $user_id = $this->session->user_id;
        $materi_id = $request->uri->getSegment(3);
        $group_id = $request->uri->getSegment(4);

        $hasil = [];
        $lastUsed = $this->soalmodel->getLastUsedPauli($user_id, $group_id, $materi_id)->getRow();
        $user = $this->usermodel->getbyUserId($user_id)->getResult();
        for ($i = 1; $i <= 4; $i++) {
            $hasil[$i] = $this->usermodel
                ->getHasilPauliByUserUsed(
                    $user_id,
                    $i, // sk_group_id,
                    $materi_id,
                    $lastUsed->used
                )
                ->getResult();
        }
        
        $data = [
            "user" => $user,
            "hasil" => $hasil
        ];
        
        return view('front/pauli/hasiltryout', $data);
    }
    
}
