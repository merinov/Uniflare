<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administrator extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->data = array();
        $this->load->library('session');
    }
    
    public function index()
    {
        if(!$this->session->userdata('admin')){redirect(base_url('administrator/login'));}
        $this->data['_cb'] = 'index';
        //$this->load->library('metrika');
        //$resp = $this->metrika->getSummary();
        //print_r($resp);
        $this->load->view('admin/index', $this->data);
    }
    
    public function login()
    {
        if($this->session->userdata('admin')){redirect(base_url('admin'));}
        $this->load->library('form_validation');
        $this->form_validation->set_rules('login', 'Name', 'trim|required');
        $this->form_validation->set_rules('password', 'Pass', 'trim|required');
        if ($this->form_validation->run() == true)
        { 
            if($this->input->post('login') == 'admin' and $this->input->post('password') == 'mg001p')
            {
                $this->session->set_userdata(array('admin' => 1));
                redirect(base_url('administrator'));
            }else
            {
                $this->session->set_flashdata('error', '<strong>Ошибка!</strong> Логин-пароль не подходит!');
                redirect(base_url('administrator/login'), 'refresh');
            }
        }
        else
        {
            $this->load->view('admin/login', $this->data);
        }
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('administrator'));
    }
    
    /**
     * Каталоги
     */
     public function catalogs($action='', $id='')
     {
        if(!$this->session->userdata('admin')){redirect(base_url('administrator/login'));}
        // Просмотр
        if($action=='')
        {
            $this->data['_cb'] = 'catalogs';
            $this->data['catalogs'] = $this->db->order_by('id', 'desc')->get('catalogs')->result();
            $this->load->view('admin/index', $this->data);
        }
        // Добавление
        elseif($action=='add')
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Название', 'trim|required');
            if ($this->form_validation->run() == true)
            {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'docx|doc|xls|pdf|xlsx';
        		$this->load->library('upload', $config);
        		if ( ! $this->upload->do_upload())
        		{
        			$error = array('error' => $this->upload->display_errors());
        			$this->session->set_flashdata('error', $error['error']);
                    redirect(base_url('administrator/catalogs/add'), 'refresh');
        		}
        		else
        		{
   		            $this->load->helper('date');
        			$data = array('upload_data' => $this->upload->data());
                    $insert['name'] = $this->input->post('name', TRUE);
                    $insert['path'] = '/uploads/'.$data['upload_data']['file_name'];
                    $insert['date'] = unix_to_human(time(), TRUE, 'eu');
                    $this->db->insert('catalogs', $insert);
                    $this->session->set_flashdata('message', 'Каталог успешно добавлен!');
                    redirect(base_url('administrator/catalogs'), 'refresh');
        		}
            }else
            {
                $this->data['catalog'][0]->name = '';
                $this->data['catalog'][0]->path = '';
                $this->data['_cb'] = 'catalogs_edite';
                $this->load->view('admin/index', $this->data);
            }
        }
        // Редактировани
        elseif($action=='edite')
        {
            if($id==''){show_404();}
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Название', 'trim|required');
            if ($this->form_validation->run() == true)
            {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'docx|doc|xls|pdf|xlsx';
        		$this->load->library('upload', $config);
        		if ( ! $this->upload->do_upload())
        		{
        			$error = array('error' => $this->upload->display_errors());
        			if($error['error'] != '<p>Вы не выбрали файл.</p>')
                    {
                        $this->session->set_flashdata('error', 'Каталог успешно добавлен!');
                        redirect(base_url('administrator/catalogs/edite/'.$id), 'refresh');
        			}
        		}
       			$data = array('upload_data' => $this->upload->data());
                $insert['name'] = $this->input->post('name', TRUE);
                if(isset($data['upload_data']['file_name'])){
                    if($data['upload_data']['file_name'] != '')
                    $insert['path'] = '/uploads/'.$data['upload_data']['file_name'];
                }
                $this->db->where('id', $id)->update('catalogs', $insert);
                $this->session->set_flashdata('message', 'Каталог успешно обновлён!');
                redirect(base_url('administrator/catalogs'), 'refresh');
            }else
            {
                $this->data['catalog'] = $this->db->get_where('catalogs', array(
                    'id' => $id
                ))->result();
                if(empty($this->data['catalog'])){show_404();}
                $this->data['_cb'] = 'catalogs_edite';
                $this->load->view('admin/index', $this->data);
            }
        }
        // Удаление
        elseif($action=='delete')
        {
            if($id==''){show_404();}
            $catalog = $this->db->get_where('catalogs', array(
                'id' => $id
            ))->result();
            if(empty($catalog)){show_404();}
            unlink('.'.$catalog[0]->path);
            $this->db->delete('catalogs', array(
                'id' => $id
            ));
            $this->session->set_flashdata('message', 'Каталог удалён!');
            redirect(base_url('administrator/catalogs'), 'refresh');
        }
     }
     
     /**
      * Технологии и инновации
      */
      public function technology($action='', $id='')
      {
        if(!$this->session->userdata('admin')){redirect(base_url('administrator/login'));}
        // Просмотр
        if($action=='')
        {
            $this->data['_cb'] = 'technology';
            $this->data['catalogs'] = $this->db->order_by('id', 'desc')->get('technology')->result();
            $this->load->view('admin/index', $this->data);
        }
        // Добавление
        elseif($action=='add')
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Название', 'trim|required');
            if ($this->form_validation->run() == true)
            {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'docx|doc|xls|pdf|xlsx';
        		$this->load->library('upload', $config);
        		if ( ! $this->upload->do_upload())
        		{
        			$error = array('error' => $this->upload->display_errors());
        			$this->session->set_flashdata('error', $error['error']);
                    redirect(base_url('administrator/technology/add'), 'refresh');
        		}
        		else
        		{
   		            $this->load->helper('date');
        			$data = array('upload_data' => $this->upload->data());
                    $insert['name'] = $this->input->post('name', TRUE);
                    $insert['path'] = '/uploads/'.$data['upload_data']['file_name'];
                    $insert['date'] = unix_to_human(time(), TRUE, 'eu');
                    $this->db->insert('technology', $insert);
                    $this->session->set_flashdata('message', 'Технология успешно добавлена!');
                    redirect(base_url('administrator/technology'), 'refresh');
        		}
            }else
            {
                $this->data['catalog'][0]->name = '';
                $this->data['catalog'][0]->path = '';
                $this->data['_cb'] = 'technology_edite';
                $this->load->view('admin/index', $this->data);
            }
        }
        // Редактировани
        elseif($action=='edite')
        {
            if($id==''){show_404();}
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Название', 'trim|required');
            if ($this->form_validation->run() == true)
            {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'docx|doc|xls|pdf|xlsx';
        		$this->load->library('upload', $config);
        		if ( ! $this->upload->do_upload())
        		{
        			$error = array('error' => $this->upload->display_errors());
        			if($error['error'] != '<p>Вы не выбрали файл.</p>')
                    {
                        $this->session->set_flashdata('error', ($error['error']));
                        redirect(base_url('administrator/technology/edite/'.$id), 'refresh');
        			}
        		}
       			$data = array('upload_data' => $this->upload->data());
                $insert['name'] = $this->input->post('name', TRUE);
                if(isset($data['upload_data']['file_name'])){
                    if($data['upload_data']['file_name'] != '')
                    $insert['path'] = '/uploads/'.$data['upload_data']['file_name'];
                }
                $this->db->where('id', $id)->update('technology', $insert);
                $this->session->set_flashdata('message', 'Технология успешно обновлёна!');
                redirect(base_url('administrator/technology'), 'refresh');
            }else
            {
                $this->data['catalog'] = $this->db->get_where('technology', array(
                    'id' => $id
                ))->result();
                if(empty($this->data['catalog'])){show_404();}
                $this->data['_cb'] = 'technology_edite';
                $this->load->view('admin/index', $this->data);
            }
        }
        // Удаление
        elseif($action=='delete')
        {
            if($id==''){show_404();}
            $catalog = $this->db->get_where('technology', array(
                'id' => $id
            ))->result();
            if(empty($catalog)){show_404();}
            unlink('.'.$catalog[0]->path);
            $this->db->delete('technology', array(
                'id' => $id
            ));
            $this->session->set_flashdata('message', 'Технология удалёна!');
            redirect(base_url('administrator/technology'), 'refresh');
        }
    }
      
    public function history()
    {
        if(!$this->session->userdata('admin')){redirect(base_url('administrator/login'));}
        $this->load->helper('file');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('text', 'Текст', 'trim|required');
        if ($this->form_validation->run() == true)
        {
            $text = $this->input->post('text', TRUE);
            if (write_file('./uploads/history_company.html', $text))
            {
                 $this->session->set_flashdata('message', 'История успешно изменена!');
                 redirect(base_url('administrator/history'), 'refresh');
            }
        }else
        {
            $this->data['_cb'] = 'history';
            $this->data['history'] = read_file('./uploads/history_company.html');
            $this->load->view('admin/index', $this->data);
        }
        
    }
    
    /**
      * Новости
      */ 
    public function news($action='', $id='')
    {
        if(!$this->session->userdata('admin')){redirect(base_url('administrator/login'));}
        $this->load->helper('text');
        if($action=='')
        {
            $this->data['_cb'] = 'news';
            $this->data['news'] = $this->db->order_by('date', 'desc')->get('news')->result();
            $this->load->view('admin/index', $this->data);
        }
        // Добавление
        elseif($action=='add')
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Название', 'trim|required');
            $this->form_validation->set_rules('text', 'Содержание', 'trim|required');
            if ($this->form_validation->run() == true)
            {
                $this->load->helper('date');
                $post = $this->input->post(NULL, TRUE);
                $post['date'] = unix_to_human(time(), TRUE, 'eu');
                $post['text'] = trim(str_replace('�', '', $post['text']));                
                $this->db->insert('news', $post);
                $this->session->set_flashdata('message', 'Новость добавлена!');
                 redirect(base_url('administrator/news'), 'refresh');
            }else
            {
                $this->data['catalog'][0]->name = '';
                $this->data['catalog'][0]->text = '';
                $this->data['_cb'] = 'news_edite';
                $this->load->view('admin/index', $this->data);
            }
        }elseif($action=='edite')
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Название', 'trim|required');
            $this->form_validation->set_rules('text', 'Содержание', 'trim|required');
            if ($this->form_validation->run() == true)
            {
                $this->load->helper('date');
                $post = $this->input->post(NULL, TRUE);
                $post['text'] = trim(str_replace('�', '', $post['text']));                
                $this->db->where('id', $id)->update('news', $post);
                $this->session->set_flashdata('message', 'Новость обновлена!');
                redirect(base_url('administrator/news'), 'refresh');
            }else
            {
                if($id==''){show_404();}
                $this->data['catalog'] = $this->db->get_where('news', array('id' => $id))->result();
                if(empty($this->data['catalog'])){show_404();}
                $this->data['_cb'] = 'news_edite';
                $this->load->view('admin/index', $this->data);
            }
        }elseif($action=='delete')
        {
            if($id==''){show_404();}
            $this->db->delete('news', array('id' => $id));
            $this->session->set_flashdata('message', 'Новость удалена!');
            redirect(base_url('administrator/news'), 'refresh');
        }
    }
    
    /**
     * Главные Категории
     */
    public function mCategory($action='', $id='')
    {
        if(!$this->session->userdata('admin')){redirect(base_url('administrator/login'));}
        if($action=='')
        {
            $this->data['_cb'] = 'mCategory';
            $this->data['category'] = $this->db->get('main_category')->result();
            $this->load->view('admin/index', $this->data);
        }
        elseif($action=='add')
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Название', 'trim|required');
            $this->form_validation->set_rules('text', 'Содержание', 'trim|required');
            $this->form_validation->set_rules('link', 'Ссылка', 'trim|callback_checkLink');
            if ($this->form_validation->run() == true)
            {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|png|gif';
        		$this->load->library('upload', $config);
        		if ( ! $this->upload->do_upload())
        		{
        			$error = array('error' => $this->upload->display_errors());
        			$this->session->set_flashdata('error', $error['error']);
                    redirect(base_url('administrator/category/add'), 'refresh');
        		}
        		else
        		{
        			$data = array('upload_data' => $this->upload->data());
                    $insert['name'] = $this->input->post('name', TRUE);
                    $insert['img'] = '/uploads/'.$data['upload_data']['file_name'];
                    $insert['text'] = $this->input->post('text', TRUE);
                    $insert['mcid'] = $this->input->post('mcid', TRUE);
                    $link = $this->input->post('link', TRUE);
                    if($link==''){
                        $insert['link'] = $this->url_title($insert['name']);
                    }else
                    {
                        $insert['link'] = $this->url_title($link);
                    }
                    $this->db->insert('category', $insert);
                    $this->session->set_flashdata('message', 'Категория успешно добавлена!');
                    redirect(base_url('administrator/category'), 'refresh');
        		}
            }else
            {
                $this->data['category'][0]->name = '';
                $this->data['category'][0]->text = '';
                $this->data['category'][0]->link = '';
                $this->data['category'][0]->img = '';
                $this->data['category'][0]->mcid = '';
                $this->data['_cb'] = 'category_edite';
                $this->data['mcats'] = $this->db->get('main_category')->result();
                $this->load->view('admin/index', $this->data);
            }
        }elseif($action=='edite')
        {
            if($id === ''){show_404();}
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Название', 'trim|required');
            $this->form_validation->set_rules('text', 'Содержание', 'trim|required');
            $this->form_validation->set_rules('link', 'Ссылка', 'trim');
            if ($this->form_validation->run() == true)
            {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|png|gif';
        		$this->load->library('upload', $config);
        		if ( ! $this->upload->do_upload())
        		{
        			$error = array('error' => $this->upload->display_errors());
        			if($error['error'] != '<p>Вы не выбрали файл.</p>')
                    {
                        $this->session->set_flashdata('error', ($error['error']));
                        redirect(base_url('administrator/mCategory/edite/'.$id), 'refresh');
        			}
        		}
       			$data = array('upload_data' => $this->upload->data());
                $insert['name'] = $this->input->post('name', TRUE);
                $insert['text'] = $this->input->post('text', TRUE);
                $link = $this->input->post('link', TRUE);
                if($link==''){
                    $insert['link'] = $this->url_title($insert['name']);
                }else
                {
                    $insert['link'] = $this->url_title($link);
                }
                if(isset($data['upload_data']['file_name'])){
                    if($data['upload_data']['file_name'] != '')
                    $insert['img'] = '/uploads/'.$data['upload_data']['file_name'];
                }
                $this->db->where('id', $id)->update('main_category', $insert);
                $this->session->set_flashdata('message', 'Категория успешно обновлёна!');
                redirect(base_url('administrator/mCategory'), 'refresh');
            }else
            {
                $this->data['category'] = $this->db->get_where('main_category', array('id' => $id))->result();
                if(empty($this->data['category'])){show_404();}
                $this->data['_cb'] = 'mCategory_edite';
                $this->data['mcats'] = $this->db->get('main_category')->result();
                $this->load->view('admin/index', $this->data);
            }
        }
        elseif($action=='feature')
        {
            if($id==''){show_404();}
            $this->data['category'] = $this->db->get_where('main_category', array(
                'id' => $id
            ))->result();
            if(empty($this->data['category'])){show_404();}
            $this->data['features'] = $this->db->get_where('features_category', 
            array(
                'cid' => $id
            ))->result();
            $this->data['_cb'] = 'mCategory_features';
            $this->load->view('admin/index', $this->data);
        }elseif($action=='add_feature')
        {
            if($id==''){show_404();}
            $this->data['category'] = $this->db->get_where('main_category', array(
                'id' => $id
            ))->result();
            if(empty($this->data['category'])){show_404();}
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'характеристику', 'trim|required');
            $this->form_validation->set_rules('unit', 'единицу измерения', 'trim|required');
            if ($this->form_validation->run() == true)
            {
                $post = $this->input->post(NULL, TRUE);
                $post['cid'] = $id;
                $this->db->insert('features_category', $post);
                $this->session->set_flashdata('message', 'Характеристика добавлена!');
                redirect(base_url('administrator/mCategory/feature/'.$id));
            }else
            {
                $this->data['_cb'] = 'mCategory_add_features';
                $this->load->view('admin/index', $this->data);
            }
        }
        elseif($action=='del_feature')
        {
            if($id==''){show_404();}
            $cat = $this->db->get_where('features_category', array('id' => $id))->result();
            if(empty($cat)){show_404();}
            $this->db->delete('features_category', array('id' => $id));
            $this->session->set_flashdata('message', 'Характеристика удалена!');
            redirect(base_url('administrator/mCategory/feature/'.$cat[0]->cid));
        }
    }
    
    /**
     * Категории
     */
    public function category($action='', $id='')
    {
        if(!$this->session->userdata('admin')){redirect(base_url('administrator/login'));}
        if($action=='')
        {
            $this->data['_cb'] = 'category';
            $this->data['category'] = $this->db->order_by('id', 'desc')->get('category')->result();
            $this->load->view('admin/index', $this->data);
        }
        elseif($action=='add')
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Название', 'trim|required');
            $this->form_validation->set_rules('text', 'Содержание', 'trim|required');
            $this->form_validation->set_rules('link', 'Ссылка', 'trim|callback_checkLink');
            if ($this->form_validation->run() == true)
            {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|png|gif';
        		$this->load->library('upload', $config);
        		if ( ! $this->upload->do_upload())
        		{
        			$error = array('error' => $this->upload->display_errors());
        			$this->session->set_flashdata('error', $error['error']);
                    redirect(base_url('administrator/category/add'), 'refresh');
        		}
        		else
        		{
        			$data = array('upload_data' => $this->upload->data());
                    $insert['name'] = $this->input->post('name', TRUE);
                    $insert['img'] = '/uploads/'.$data['upload_data']['file_name'];
                    $insert['text'] = $this->input->post('text', TRUE);
                    $insert['mcid'] = $this->input->post('mcid', TRUE);
                    $link = $this->input->post('link', TRUE);
                    if($link==''){
                        $insert['link'] = $this->url_title($insert['name']);
                    }else
                    {
                        $insert['link'] = $this->url_title($link);
                    }
                    $this->db->insert('category', $insert);
                    $this->session->set_flashdata('message', 'Категория успешно добавлена!');
                    redirect(base_url('administrator/category'), 'refresh');
        		}
            }else
            {
                $this->data['category'][0]->name = '';
                $this->data['category'][0]->text = '';
                $this->data['category'][0]->link = '';
                $this->data['category'][0]->img = '';
                $this->data['category'][0]->img_shem = '';
                $this->data['category'][0]->mcid = '';
                $this->data['_cb'] = 'category_edite';
                $this->data['mcats'] = $this->db->get('main_category')->result();
                $this->load->view('admin/index', $this->data);
            }
        }elseif($action=='edite')
        {
            if($id === ''){show_404();}
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Название', 'trim|required');
            $this->form_validation->set_rules('text', 'Содержание', 'trim|required');
            $this->form_validation->set_rules('link', 'Ссылка', 'trim');
            if ($this->form_validation->run() == true)
            {
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|png|gif';
        		$this->load->library('upload', $config);
        		if ( ! $this->upload->do_upload())
        		{
        			$error = array('error' => $this->upload->display_errors());
        			if($error['error'] != '<p>Вы не выбрали файл.</p>')
                    {
                        $this->session->set_flashdata('error', ($error['error']));
                        redirect(base_url('administrator/category/edite/'.$id), 'refresh');
        			}
        		}
       			$data = array('upload_data' => $this->upload->data());
                
                $insert['name'] = $this->input->post('name', TRUE);
                $insert['text'] = $this->input->post('text', TRUE);
                $insert['mcid'] = $this->input->post('mcid', TRUE);
                $link = $this->input->post('link', TRUE);
                if($link==''){
                    $insert['link'] = $this->url_title($insert['name']);
                }else
                {
                    $insert['link'] = $this->url_title($link);
                }
                if(isset($data['upload_data']['file_name'])){
                    if($data['upload_data']['file_name'] != '')
                    $insert['img'] = '/uploads/'.$data['upload_data']['file_name'];
                }
                $this->db->where('id', $id)->update('category', $insert);
                $this->session->set_flashdata('message', 'Категория успешно обновлёна!');
                redirect(base_url('administrator/category'), 'refresh');
            }else
            {
                $this->data['category'] = $this->db->get_where('category', array('id' => $id))->result();
                if(empty($this->data['category'])){show_404();}
                $this->data['_cb'] = 'category_edite';
                $this->data['mcats'] = $this->db->get('main_category')->result();
                $this->load->view('admin/index', $this->data);
            }
        }
        elseif($action=='delete')
        {
            if($id==''){show_404();}
            $category = $this->db->get_where('category', array(
                'id' => $id
            ))->result();
            if(empty($category)){show_404();}
            unlink('.'.$category[0]->img);
            $this->db->delete('category', array(
                'id' => $id
            ));
            $this->session->set_flashdata('message', 'Категория удалена!');
            redirect(base_url('administrator/category'), 'refresh');
        }
    }
    
    /**
     * Продукты
     */
    public function products($action='', $id='')
    {
        if(!$this->session->userdata('admin')){redirect(base_url('administrator/login'));}
        if($action=='')
        {
            $this->data['category'] = $this->db->order_by('id', 'desc')->get('category')->result();
            $get = $this->input->get(NULL, TRUE);
            if(isset($get['cat']) and $get['cat']!=''){$this->db->where('cid', $get['cat']);$this->data['cat'] = $get['cat'];}
            else{$this->data['cat'] = '';}
            if(isset($get['name']) and $get['name']!=''){$this->db->like('name', $get['name']);$this->data['name'] = $get['name'];}
            else{$this->data['name'] = '';}
            $this->data['_cb'] = 'products';
            $this->data['products'] = $this->db->order_by('id', 'desc')->get('products')->result();
            $this->load->view('admin/index', $this->data);
        }
        elseif($action=='add')
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'название', 'trim|required');
            $this->form_validation->set_rules('text', 'описание', 'trim|required');
            $this->form_validation->set_rules('direction', 'направление раздачи', 'trim|required');
            $this->form_validation->set_rules('power_from', 'мощность от', 'trim|required');
            $this->form_validation->set_rules('power_up', 'мощность до', 'trim|required');
            $this->form_validation->set_rules('peculiarity', 'особенности', 'trim|required');
            $this->form_validation->set_rules('options', 'опции', 'trim|required');
            $this->form_validation->set_rules('cid', 'категорию', 'trim|required');
            $this->form_validation->set_rules('link', 'ссылку', 'trim');
            if ($this->form_validation->run() == true)
            {
                $post = $this->input->post(NULL, TRUE);  
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|png|gif';
        		$this->load->library('upload', $config);
        		if ( ! $this->upload->do_upload())
        		{
        			$error = array('error' => $this->upload->display_errors());
        			$this->session->set_flashdata('error', $error['error']);
                    redirect(base_url('administrator/products/add'), 'refresh');
        		}
        		else
        		{
        		    if($_FILES['userfile2']['tmp_name'] == ''){
  		                $this->session->set_flashdata('error', 'Выберете изображение схемы!');
                        redirect(base_url('administrator/products/add'), 'refresh');
        		    }else{
                        $uploaddir = './uploads/';
                        $filename = $_FILES['userfile2']['name'];
                        move_uploaded_file($_FILES['userfile2']['tmp_name'], $uploaddir . $filename);
                        $post['img_shem'] = '/uploads/'.$filename;
                    }
        			$data = array('upload_data' => $this->upload->data());
                    $post['img'] = '/uploads/'.$data['upload_data']['file_name'];
                    $this->load->helper('date');
                    $post['date'] = unix_to_human(time(), TRUE, 'eu');   
                    if($post['link']==''){
                        $post['link'] = $this->url_title($post['name']);
                    }else{
                        $post['link'] = $this->url_title($post['link']);
                    }        
                    $this->db->insert('products', $post);
                    $this->session->set_flashdata('message', 'Продукт добавлен!');
                    redirect(base_url('administrator/products'), 'refresh');
                }
            }else
            {
                $this->data['product'][0]->name = '';
                $this->data['product'][0]->text = '';
                $this->data['product'][0]->direction = '';
                $this->data['product'][0]->power_from = '';
                $this->data['product'][0]->power_up = '';
                $this->data['product'][0]->peculiarity = '';
                $this->data['product'][0]->options = '';
                $this->data['product'][0]->cid = '';
                $this->data['product'][0]->link = '';
                $this->data['product'][0]->img = '';
                $this->data['product'][0]->img_shem = '';
                $this->data['_cb'] = 'products_add';
                $this->data['category'] = $this->db->order_by('id', 'desc')->get('category')->result();
                $this->load->view('admin/index', $this->data);
            }
        }
        elseif($action=='edite')
        {
            if($id==''){show_404();}
            $this->data['product'] = $this->db->get_where('products', array('id' => $id))->result();
            if(empty($this->data['product'])){show_404();}
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'название', 'trim|required');
            $this->form_validation->set_rules('text', 'описание', 'trim|required');
            $this->form_validation->set_rules('direction', 'направление раздачи', 'trim|required');
            $this->form_validation->set_rules('power_from', 'мощность от', 'trim|required');
            $this->form_validation->set_rules('power_up', 'мощность до', 'trim|required');
            $this->form_validation->set_rules('peculiarity', 'особенности', 'trim|required');
            $this->form_validation->set_rules('options', 'опции', 'trim|required');
            $this->form_validation->set_rules('cid', 'категорию', 'trim|required');
            $this->form_validation->set_rules('link', 'ссылку', 'trim');
            if ($this->form_validation->run() == true)
            {
                $this->load->helper('date');
                $post = $this->input->post(NULL, TRUE);  
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'jpg|png|gif';
        		$this->load->library('upload', $config);
        		if ( ! $this->upload->do_upload())
        		{
        			$error = array('error' => $this->upload->display_errors());
        			if($error['error'] != '<p>Вы не выбрали файл.</p>')
                    {
                        $this->session->set_flashdata('error', ($error['error']));
                        redirect(base_url('administrator/category/edite/'.$id), 'refresh');
        			}
        		}
                if($_FILES['userfile2']['tmp_name'] != '')
                {
                    $uploaddir = './uploads/';
                    $filename = $_FILES['userfile2']['name'];
                    move_uploaded_file($_FILES['userfile2']['tmp_name'], $uploaddir . $filename);
                    $post['img_shem'] = '/uploads/'.$filename;
                }
       			$data = array('upload_data' => $this->upload->data());
                if($post['link']==''){
                    $post['link'] = $this->url_title($post['name']);
                }else{
                    $post['link'] = $this->url_title($post['link']);
                }  
                if(isset($data['upload_data']['file_name'])){
                    if($data['upload_data']['file_name'] != '')
                    $post['img'] = '/uploads/'.$data['upload_data']['file_name'];
                }         
                $this->db->where('id', $id)->update('products', $post);
                $this->session->set_flashdata('message', 'Продукт обновлён!');
                redirect(base_url('administrator/products'), 'refresh');
            }else{
                $this->data['product'] = $this->db->get_where('products', array('id' => $id))->result();
                $this->data['_cb'] = 'products_add';
                $this->data['category'] = $this->db->order_by('id', 'desc')->get('category')->result();
                $this->load->view('admin/index', $this->data);
            }
        }
        elseif($action=='delete')
        {
            $this->db->delete('products', array('id' => $id));
            $this->session->set_flashdata('message', 'Продукт удалён!');
            redirect(base_url('administrator/products'), 'refresh');
        }
        elseif($action=="add_model")
        {
            if($id==''){show_404();}
            $this->data['product'] = $this->db->get_where('products', array('id' => $id))->result();
            $this->data['category'] = $this->db->get_where('category', array('id' => $this->data['product'][0]->cid))->result();
            $this->data['features'] = $this->db->get_where('features_category', array('cid' => $this->data['category'][0]->mcid))->result();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'название', 'trim|required');
            $this->form_validation->set_rules('feaut', 'характеристики', 'required');
            if ($this->form_validation->run() == true)
            {
                $post = $this->input->post(NULL, TRUE);
                $feaut = $post['feaut'];
                unset($post['feaut']);
                $post['pid'] = $id;
                $this->db->insert('models', $post);
                $mid = $this->db->insert_id();
                foreach($feaut as $fid => $value)
                {
                    $insert['mid'] = $mid;
                    $insert['fid'] = $fid;
                    $insert['value'] = $value;
                    $this->db->insert('model_of_feaut', $insert);
                }
                $this->session->set_flashdata('message', 'Модель добавлена!');
                redirect(base_url('administrator/products'), 'refresh');
            }else
            {
                $this->data['model'][0]->name = '';
                $this->data['m_f'] = array();
                $this->data['_cb'] = 'products_add_model';
                $this->load->view('admin/index', $this->data);
            }
        }elseif($action=='model_delete')
        {
            if($id==''){show_404();}
            $this->db->delete('model_of_feaut', array('mid' => $id));
            $this->db->delete('models', array('id' => $id));
            $this->session->set_flashdata('message', 'Модель удалена!');
            redirect(base_url('administrator/products'), 'refresh');
        }elseif($action=='model_edite')
        {
            if($id==''){show_404();}
            $this->data['model'] = $this->db->get_where('models', array('id' => $id))->result();
            $this->data['m_f'] = $this->db->get_where('model_of_feaut', array('mid' => $id))->result();
            $this->data['product'] = $this->db->get_where('products', array('id' => $this->data['model'][0]->pid))->result();
            $this->data['category'] = $this->db->get_where('category', array('id' => $this->data['product'][0]->cid))->result();
            $this->data['features'] = $this->db->get_where('features_category', array('cid' => $this->data['category'][0]->mcid))->result();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'название', 'trim|required');
            $this->form_validation->set_rules('feaut', 'характеристики', 'required');
            if ($this->form_validation->run() == true)
            {
                $post = $this->input->post(NULL, TRUE);
                $feaut = $post['feaut'];
                unset($post['feaut']);
                $this->db->where('id', $id)->update('models', $post);
                $this->db->delete('model_of_feaut', array('mid' => $id));
                foreach($feaut as $fid => $value)
                {
                    $insert['mid'] = $id;
                    $insert['fid'] = $fid;
                    $insert['value'] = $value;
                    $this->db->insert('model_of_feaut', $insert);
                }
                $this->session->set_flashdata('message', 'Модель обновлена!');
                redirect(base_url('administrator/products'), 'refresh');
            }else
            {
                $this->data['_cb'] = 'products_add_model';
                $this->load->view('admin/index', $this->data);
            }
        }
    }
    
    /**
     * Файловый менеджер
     */
     
     public function fileManager($action='', $name='')
     {
        if(!$this->session->userdata('admin')){redirect(base_url('administrator/login'));}
        $this->load->helper('directory');
        $this->load->helper('file');
        if($action=='')
        {
            $this->data['directory'] = directory_map('./uploads/files', 30);
            $this->load->view('admin/manager', $this->data);
        }
        elseif($action=='add')
        {
            if($name=='up')
            {
                $config['upload_path'] = './uploads/files/';
                $config['allowed_types'] = 'docx|doc|xls|pdf|xlsx|jpg|png|gif';
        		$this->load->library('upload', $config);
        		if ( ! $this->upload->do_upload())
        		{
        			die($this->upload->display_errors().'<br /><a href="/administrator/FileManager/add">Вернуться</a>');
        		}else
                {
                    $data = array('upload_data' => $this->upload->data());
                    $this->data['link'] = base_url().'uploads/files/'.$data['upload_data']['file_name'];
                    $this->load->view('admin/manager_success', $this->data);
                }
            }else
            {
               $this->load->view('admin/manager_add', $this->data); 
            }
        }elseif($action=='delete')
        {
            if($name==''){show_404();}
            unlink('./uploads/files/'.base64_decode(urldecode($name)));
             redirect(base_url('administrator/fileManager'), 'refresh');
        }
        
     }
     
     /**
      * ----------------------------------------- Доп функции --------------------------------------
      */
      
    function checkLink($str='')
    {
        if($str=='')
        {
            return true;
        }else
        {
            $c1 = $this->db->where('link', $str)->get('category')->result();
            if(empty($c1))
            {
              return true;  
            }else
            {
                $this->form_validation->set_message('checkLink', 'Данный адресс ссылки уже существует!');
                return false;
            }
        }       
    }
    
    function url_title($str, $separator = 'dash', $lowercase = FALSE)
    {
        if ($separator == 'dash')
        {
            $search     = '_';
            $replace    = '-';
        }
        else
        {
            $search     = '-';
            $replace    = '_';
        }
        $trans = array(
            '&\#\d+?;'              => '',
            '&\S+?;'                => '',
            '\s+'                   => $replace,
            '[^a-z0-9\-\._]'        => '',
            $replace.'+'            => $replace,
            $replace.'$'            => $replace,
            '^'.$replace            => $replace,
            '\.+$'                  => ''
        );
       $translit = array(
            "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "zh", "з" => "z",
            "и" => "i", "й" => "y", "к" => "k", "л" => "l", "м" => "m", "н" => "n", "о" => "o", "п" => "p",
            "р" => "r", "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h", "ц" => "c", "ч" => "ch",
            "ш" => "sh", "щ" => "sch", "ъ" => "", "ы" => "y", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
            "А" => "a", "Б" => "b", "В" => "v", "Г" => "g", "Д" => "d", "Е" => "e", "Ж" => "zh", "З" => "z",
            "И" => "i", "Й" => "y", "К" => "k", "Л" => "l", "М" => "m", "Н" => "n", "О" => "o", "П" => "p",
            "Р" => "r", "С" => "s", "Т" => "t", "У" => "u", "Ф" => "f", "Х" => "h", "Ц" => "c", "Ч" => "ch",
            "Ш" => "sh", "Щ" => "sch", "Ъ" => "", "Ы" => "y", "Ь" => "", "Э" => "e", "Ю" => "yu", "Я" => "ya",
            " " => "_", "," => ""
                );
        $str = strtr($str, $translit);
        $str = strip_tags($str);
        foreach ($trans as $key => $val)
        {
            $str = preg_replace("#".$key."#i", $val, $str);
        }
        if ($lowercase === TRUE)
        {
            $str = strtolower($str);
        }
        return trim(stripslashes($str));
    } 
}