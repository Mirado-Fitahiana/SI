<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileController extends CI_Controller{
   public function importCsv()
   {
        $this->load->model('DatabaseAccess','data');
        $filename = $_FILES['csv']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        echo $ext;
        if (strcasecmp($ext,'csv')!=0) {
            throw new Exception("Format de fichier non supporte");
        }
        $file=$_FILES['csv']['tmp_name'];
        $handler=fopen($file,'r');
        if ($handler) {
            while ($row=fgetcsv($handler,',')) {
                $this->data->insertPCG($row[0],$row[1]);
            }
            fclose($handler);  
        } else {
            throw new Exception("Erreur lors de l'ouverture du fichier");
            
        }
   }
}