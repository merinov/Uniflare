<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->data = array();
    }

	public function index()
	{
	    $this->data['contentBlock'] = 'index';
		$this->load->view('index', $this->data);
	}
    
    public function products($main_cat = '', $cat='', $product='')
    {
        if($main_cat==='')
        {
            $this->data['contentBlock'] = 'products';
            $category = $this->db->order_by('id', 'asc')->get('main_category')->result();
    		foreach($category as $k => $row)
            {
                $this->data['category'][$k]['cat'] = $row;
                $this->data['category'][$k]['podcat'] = $this->db->get_where('category', array('mcid' => $row->id))->result();
            }
            $this->load->view('index', $this->data);
        }
        else
        {
            $this->data['category'] = $this->db->get_where('main_category', array('link' => $main_cat))->result();
            if(empty($category)){show_404();}
            if($cat==='')
            {
                
            }
        }
        
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */