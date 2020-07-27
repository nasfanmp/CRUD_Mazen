<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudController extends CI_Controller {
    public function __construct() {
        parent:: __construct();

        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->load->model('Crud_model');
    }

	public function index() {
        $data['result'] = $this->Crud_model->getAllData();
		$this->load->view('crudView', $data);
    }

    public function create() {
        $this->Crud_model->createData();
        redirect("CrudController");
    }

    public function edit($id) {
        $data['row'] = $this->Crud_model->getData($id);
        $this->load->view('crudEdit', $data);
    }

    public function update($id) {
        $this->Crud_model->updateData($id);
        redirect("CrudController");
    }

    public function delete($id) {
        $this->Crud_model->deleteData($id);
        redirect("CrudController");
    }

   public function insert(){
        if ($this->input->is_ajax_request()){
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                    $data = array('responce'=>'error','message'=>validation_errors());
            }
            else
            {
                $ajax_data = $this->input->post();
                if($this->Crud_model->createData($ajax_data)){
                    $data = array('responce'=>'success','message'=>'data added');

                }else{
                    $data = array('responce'=>'error','message'=>'data not added');

                }
            }
        }else{
            echo "no";
        }
        echo json_encode($data);
    }
    
}