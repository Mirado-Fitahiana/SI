<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormControl extends CI_Controller{
    //Login Check
    public function Check()
    {    
        $this->load->model('DatabaseAccess','verify');
        $rules=array(
            array(
                'field' => 'user',
                'label' => 'Email ou identifiant utilisateur',
                'rules' => 'trim|required',
                'errors'=> array(
                    'required' => '%s requis.',
                ),
            ),
            array(
                'field'=>'pass',
                'label'=>'Mot de passe',
                'rules'=>'trim|required',
                'errors'=> array(
                    'required' => '%s requis.',
                ),
            )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('Login');
            } else {
                $mail=$this->input->post('user');
                $pass=$this->input->post('pass');                
                $result=$this->verify->login($mail,$pass);
                if($result){
                    foreach($result as $row){
                        $this->session->set_userdata('username',$row->name);
                    }
                    redirect('RoutesController/index');
                } else {
                    redirect('Welcome?error=0');
                }
                
            }
        
    }
    public function insertBase()
    {
        $this->load->model('DatabaseAccess','data');
        $data=$this->data->getAllTitles();
        $rules=array();
        for ($i=0; $i <count($data['idtitles']); $i++) {
            if ($data['importance'][$i]==1) {
                $rules[]=array(
                    'field'=>'form_'.$data['idtitles'][$i],
                    'label'=>$data['name'][$i],
                    'rules'=>'required',
                    'errors'=>array(
                        'required'=>'%s est requis.'
                    ),
                );
            } 
        }
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            $array['titles']=$data;
            echo "tsy poins";
            $this->load->view('Inscription',$array);
        } else {
            $this->data->insertBaseInfo($_POST,$data);

        }
    }

    public function insertLegal()
    {
        $this->load->model('DatabaseAccess','data');
        $data=$this->data->getLegalInfo();
        $rules=array();
        for ($i=0; $i < count($data['idinfo']); $i++) {
            $rules[]=array(
                'field'=>'legal_'.$data['idinfo'][$i],
                'label'=>$data['intitule'][$i],
                'rules'=>'required',
                'errors'=>array(
                    'required'=>'%s est requis.'
                ),
            );
        }
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            $array['legal']=$data;
            $this->load->view('Legal',$array);
        } else {
            $this->data->insertLegalInfo($_POST,$data);
        }
    }
    public function pcg()
    {
        $this->load->model('DatabaseAccess','data');
        $array=array(
            array(
                'field'=>'numero',
                'label'=>'Numero',
                'rules'=>'required|max_length[5]',
                'errors'=>array(
                    'required'=>'Le champ %s est requis.',
                    'max_length[5]'=>'La longueur du numero ne doit pas depasser 5.',
                ),
            ),
            array(
                'field'=>'nom',
                'label'=>'Intitule',
                'rules'=>'required',
            ),
        );
        $this->form_validation->set_rules($array);
        if ($this->form_validation->run() == FALSE){
            $this->load->view('insertPCG');
        } else {
            $this->data->insertPCG($_POST['numero'],$_POST['nom']);
            redirect('Welcome/pcg');
        }
    }

    public function journal()
    {
        $this->load->model('DatabaseAccess','data');
        $array=array(
            array(
                'field'=>'numero',
                'label'=>'Numero',
                'rules'=>'required',
                'errors'=>array(
                    'required'=>'Le champ %s est requis.',
                ),
            ),
            array(
                'field'=>'nom',
                'label'=>'Intitule',
                'rules'=>'required',
            ),
        );
        $this->form_validation->set_rules($array);
        if ($this->form_validation->run() == FALSE){
            $this->load->view('insertJournal');
        } else {
            $this->data->insertJournal($_POST['numero'],$_POST['nom']);
            redirect('Welcome/journal');
        }
    }

    public function tier()
    {
        $this->load->model('DatabaseAccess','data');
        $array=array(
            array(
                'field'=>'numero',
                'label'=>'Numero',
                'rules'=>'required',
                'errors'=>array(
                    'required'=>'Le champ %s est requis.',
                ),
            ),
            array(
                'field'=>'nom',
                'label'=>'Intitule',
                'rules'=>'required',
            ),
        );
        $this->form_validation->set_rules($array);
        if ($this->form_validation->run() == FALSE){
            $this->load->view('insertTier');
        } else {
            $this->data->insertTier($_POST['numero'],$_POST['nom']);
            redirect('Welcome/tier');
        }
    }
    public function insertJournal()
    {
        $this->load->model('DatabaseAccess','data');
        $idcode=$_POST['code'];
        $idexo=$_POST['idexo'];
        $date=$_POST['date'];
        $id=$this->data->newJournal($idcode,$date,$idexo);
        redirect("RoutesController/ecriture?idjournal=".$id);
    }

    public function insertEcriture()
    {
        header( "Content-Type: application/json"); 
        $this->load->model('DatabaseAccess','data');
        $rules=array(
            array(
                'field' => 'libelle',
                'label' => 'Libelle',
                'rules' => 'trim|required',
                'errors'=> array(
                    'required' => '%s requis.',
                ),
            ),
            array(
                'field' => 'numero',
                'label' => 'Numero',
                'rules' => 'trim|required',
                'errors'=> array(
                    'required' => '%s requis.',
                ),
            )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            echo json_encode(validation_errors());
        } else {
            $result=$this->data->insertEcriture($_POST);
            if ($result==1) {
                echo json_encode(200);
            } else {
                echo json_encode(500);   
            }
        }
    }

    public function logout(){
        $this->session->unset_userdata('username',$row->nom);
        $this->session->unset_userdata('id',$row->id);
        redirect('Welcome');
    }
    //Back to the login page
    public function Back(){
        redirect('Welcome');
    }

}