<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ensiklopedia extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ensiklopedia_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

      $dataensiklopedia=$this->Ensiklopedia_model->get_all();//panggil ke modell
      $datafield=$this->Ensiklopedia_model->get_field();//panggil ke modell

      $data = array(
        'contain_view' => 'admin/ensiklopedia/ensiklopedia_list',
        'sidebar'=>'admin/sidebar',
        'css'=>'admin/crudassets/css',
        'script'=>'admin/crudassets/script',
        'dataensiklopedia'=>$dataensiklopedia,
        'datafield'=>$datafield,
        'module'=>'admin',
        'titlePage'=>'ensiklopedia',
        'controller'=>'ensiklopedia'
       );
      $this->template->load($data);
    }


    public function create(){
      $data = array(
        'contain_view' => 'admin/ensiklopedia/ensiklopedia_form',
        'sidebar'=>'admin/sidebar',//Ini buat menu yang ditampilkan di module admin {DIKIRIM KE TEMPLATE}
        'css'=>'admin/crudassets/css',//Ini buat kirim css dari page nya  {DIKIRIM KE TEMPLATE}
        'script'=>'admin/crudassets/script',//ini buat javascript apa aja yang di load di page {DIKIRIM KE TEMPLATE}
        'action'=>'admin/ensiklopedia/create_action',
        'module'=>'admin',
        'titlePage'=>'ensiklopedia',
        'controller'=>'ensiklopedia'
       );
      $this->template->load($data);
    }

    public function edit($id){
      $dataedit=$this->Ensiklopedia_model->get_by_id($id);
      $data = array(
        'contain_view' => 'admin/ensiklopedia/ensiklopedia_edit',
        'sidebar'=>'admin/sidebar',//Ini buat menu yang ditampilkan di module admin {DIKIRIM KE TEMPLATE}
        'css'=>'admin/crudassets/css',//Ini buat kirim css dari page nya  {DIKIRIM KE TEMPLATE}
        'script'=>'admin/crudassets/script',//ini buat javascript apa aja yang di load di page {DIKIRIM KE TEMPLATE}
        'action'=>'admin/ensiklopedia/update_action',
        'dataedit'=>$dataedit,
        'module'=>'admin',
        'titlePage'=>'ensiklopedia',
        'controller'=>'ensiklopedia'
       );
      $this->template->load($data);
    }


    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'Nama' => $this->input->post('Nama',TRUE),
		'Kategori' => $this->input->post('Kategori',TRUE),
		'Deskripsi' => $this->input->post('Deskripsi',TRUE),
	    );

            $this->Ensiklopedia_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('admin/ensiklopedia'));
        }
    }



    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->edit($this->input->post('ID', TRUE));
        } else {
            $data = array(
		'Nama' => $this->input->post('Nama',TRUE),
		'Kategori' => $this->input->post('Kategori',TRUE),
		'Deskripsi' => $this->input->post('Deskripsi',TRUE),
	    );

            $this->Ensiklopedia_model->update($this->input->post('ID', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('admin/ensiklopedia'));
        }
    }

    public function delete($id)
    {
        $row = $this->Ensiklopedia_model->get_by_id($id);

        if ($row) {
            $this->Ensiklopedia_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('admin/ensiklopedia'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('admin/ensiklopedia'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('Nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('Kategori', 'kategori', 'trim|required');
	$this->form_validation->set_rules('Deskripsi', 'deskripsi', 'trim|required');

	$this->form_validation->set_rules('ID', 'ID', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
