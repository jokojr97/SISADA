<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
    {
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->model('m_home');		
	}

	public function index()
	{
		$this->load->view('home/overview');
	}
	public function Publikasi()
	{
		$halaman = $this->uri->segment(3);
		$rowdb = $this->m_home->get_row_name($halaman)->row_array();
		$row_name = $rowdb['row_name'];

		$get_row = $this->m_home->get_row_group($row_name);
		// var_dump($get_row);
		$totall = 0;
		$totalp = 0;
		$i=1;
		foreach ($get_row->result() as $row) {
			// echo $row_name." : ".$row->$row_name."<br>";
			$jkl = "Laki-Laki";
			$jkp = "Perempuan";
			$rowname = $row_name;
			$rowvalue = $row->$row_name;
			$jumlah_row_laki = $this->m_home->count_row_jk($rowname, $rowvalue , $jkl);
			$jumlah_row_perempuan = $this->m_home->count_row_jk($rowname, $rowvalue, $jkp);
			// echo "P :".$jumlah_row_perempuan."<br> L :".$jumlah_row_laki."<br><br>";
			$data['rowvalue'][$i] = $rowvalue;
			$data['jumlah_row_laki'][$i] = $jumlah_row_laki;
			$data['jumlah_row_perempuan'][$i] = $jumlah_row_perempuan;
			$data['jumlah_row'][$i] = $jumlah_row_perempuan+$jumlah_row_laki;
			$totall = $totall+$jumlah_row_laki;
			$totalp = $totalp+$jumlah_row_perempuan;
			$i++;
		}
		$data['total_laki'] = $totall;
		$data['total_perempuan'] = $totalp;
		$data['total'] = $totall+$totalp;
		$data['get_row'] = $get_row;
		$row_name = str_replace("_", " ", $row_name);
		$data['row_name'] = ucfirst($row_name);
		// echo $totall;

		$this->load->view('home/publikasi', $data);
  		$this->load->view('home/_partial/highchart1', $data);

	}
	public function prosesAspirasi()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim',[
			'required' => 'Nama Harus Diisi',
		]);
		$this->form_validation->set_rules('alamat', 'alamat', 'required|trim',[
			'required' => 'Alamat Harus Diisi',
		]);
		$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email',[
			'required' => 'Alamat Harus Diisi',
		]);
		$this->form_validation->set_rules('jk', 'jk', 'required|trim',[
			'required' => 'Jenis Kelamin Harus Diisi',
		]);
		$this->form_validation->set_rules('subject', 'Subject', 'required|trim',[
			'required' => 'Alamat Harus Diisi',
		]);
		$this->form_validation->set_rules('aspirasi', 'aspirasi', 'required|trim',[
			'required' => 'Aspirasi Harus Diisi',
		]);
		if ($this->form_validation->run() == false) {
			$this->load->view('home/overview');
		}else {
			$nama = htmlspecialchars($this->input->post('nama', true));
			$alamat = htmlspecialchars($this->input->post('alamat', true));
			$email = $this->input->post('email', true);
			$jk = htmlspecialchars($this->input->post('jk', true));
			$subject = htmlspecialchars($this->input->post('subject', true));
			$aspirasi = htmlspecialchars($this->input->post('aspirasi', true));
			$data = [
				'nama' => $nama,
				'alamat' => $alamat,
				'email' => $email,
				'jenis_kelamin' => $jk,
				'subject' => $subject,
				'aspirasi' => $aspirasi,
				'role_id' => 3,
				'is_active' => 1,
				'date_created' => time(),
			];
			$this->db->insert('satudata_aspirasi', $data);			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Aspirasi Anda Berhasil di kirim! Terima kasih atas partisipasinya. </div>');			
			redirect('home/#subscribe','refresh');
		}
	}
}
