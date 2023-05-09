<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require("BaseController.php");
class RoutesController extends BaseController{
    function index()
    {
        $this->load->model('DatabaseAccess','data');
        $array['titles']=$this->data->getAllTitles();
        $this->load->view('show',$array);
    }
    public function ecriture()
    {
        $this->load->model('DatabaseAccess','data');
        $array['devise']=$this->data->getAllDevise();
        $array['tier']=$this->data->getTier();
        $array['pcg']=$this->data->getAllPcg();
        $array['reference']=$this->data->getAllRef();
        $array['journal']=$this->data->getDetailJournalById($_GET['idjournal']);
        $array['ecriture']=$this->data->getWritedEcriture($_GET['idjournal']);
        $this->load->view("Ecriture",$array);
    }

    public function validate()
    {
        $this->load->model('DatabaseAccess','data');
        $this->data->validate($_GET['idjournal']);
        redirect('Welcome/newJournal');
    }
}