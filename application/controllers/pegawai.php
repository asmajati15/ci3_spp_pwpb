<?php

class Pegawai extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        } else {
            $this->load->model('m_data');
            $this->load->helper('url');
        }
    }

    function index()
    {
        $data['pegawai'] = $this->m_data->tampil_data()->result();
        $this->load->view('v_pegawai', $data);
    }

	function tambah(){
		$this->load->view('v_add');
	}
 
	function tambah_aksi(){
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$pekerjaan = $this->input->post('pekerjaan');
 
		$data = array(
			'nama' => $nama,
			'alamat' => $alamat,
			'pekerjaan' => $pekerjaan
			);
		$this->m_data->input_data($data,'pegawai');
		redirect('pegawai');
	}

    function edit($id){
        $where = array('id' => $id);
		$data['pegawai'] = $this->m_data->edit_data($where,'pegawai')->result();
        $this->load->view('v_edit',$data);
    }

    function update(){
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $alamat = $this->input->post('alamat');
        $pekerjaan = $this->input->post('pekerjaan');
     
        $data = array(
            'nama' => $nama,
            'alamat' => $alamat,
            'pekerjaan' => $pekerjaan
        );
     
        $where = array(
            'id' => $id
        );
     
        $this->m_data->update_data($where,$data,'pegawai');
        redirect('pegawai');
    }

    function hapus($id){
		$where = array('id' => $id);
		$this->m_data->hapus_data($where,'pegawai');
		redirect('pegawai');
	}
}
