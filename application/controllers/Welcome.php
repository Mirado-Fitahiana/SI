<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('Login');
	}		
	public function signup()
	{
		$this->load->model('DatabaseAccess','data');
        $array['titles']=$this->data->getAllTitles();
        $this->load->view('Inscription',$array);
	}

	public function legal(){
		$this->load->model('DatabaseAccess','data');
        $array['legal']=$this->data->getLegalInfo();
        $this->load->view('Legal',$array);
	}
	public function pcg()
	{
		$this->load->view('insertPCG');
	}
	public function journal()
	{
		$this->load->view('insertJournal');
	}
	public function tier()
	{
		$this->load->view('insertTier');
	}
	public function newJournal()
	{
		$this->load->model('DatabaseAccess','data');
		$array['code']=$this->data->getAllCodeJoural();
		$array['invalid']=$this->data->getInvalidJournal();
		$this->load->view('newJournal',$array);
	}
}

