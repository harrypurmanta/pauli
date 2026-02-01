<?php

namespace App\Controllers;
use App\Models\Soalmodel;
use App\Models\Usersmodel;
class Materi extends BaseController
{
    protected $soalmodel;
	protected $usersmodel;
	protected $session;

    public function __construct()
	{
		$this->session = \Config\Services::session();
        $this->soalmodel = new Soalmodel();
		$this->usersmodel = new Usersmodel();

	}


    public function index()
    {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		} else {
            $data = [
                'materi' => $this->soalmodel->getjawAllJMateri()->getResult(),
                'materiSK' => $this->soalmodel->getMateriSK()->getResult(),
            ];
            return view('front/materi',$data);
        }
    }

    public function pilihanMateri() {
         if ($this->session->get("user_nm") == "") {
			return redirect('/');
		}
        $request = \Config\Services::request();
        $data = [
            'materi_id' => $request->uri->getSegment(3),
            'group' => $this->soalmodel->getGroup()->getResult(),
        ];
        
        return view('front/pilihanmateri',$data);
    }
}
