<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Home_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
     
    function get_web(){
       
        $query = $this->db->get('kontak_web');
        return $query->result();
        
        
    }
 
   
     
}