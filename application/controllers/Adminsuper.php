<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminsuper extends CI_Controller {
	public function __construct()
    {
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->model('m_adminsuper');
        $this->load->model('m_home');
		$role_id = $this->session->userdata('role_id');
		if ($role_id == 1) {					
		} else if ($role_id == 2) {			
			redirect('admin','refresh');	
		} else {
			redirect('auth','refresh');
		}

	}

	public function index()
	{
		$this->session->set_flashdata('breadcrumb', 'Dashboard');
		$this->session->set_flashdata('menu', 'dashboard');
		$this->session->set_flashdata('menuName', 'Dashboard');
		$this->session->set_flashdata('icon', 'fas fa-tachometer-alt');
		$data['jumrt'] = 16;
		$data['jumrw'] = 4;
		$data['jumwarga'] = 2406;
		$jumrumahtangga = 0;
		$rumah_tangga = $this->m_adminsuper->get_rumah_tangga();
		foreach ($rumah_tangga->result() as $row) {
			$jumrumahtangga++;
		}
		$rw = $this->m_home->get_rw();
		$no = 1;
		foreach ($rw->result() as $row) {
			$rwname[$no] = $row->rw;
			$jumlahrw[$no] = $this->m_home->count_rw($row->rw);
			$jumlahrwp[$no] = $this->m_home->count_rwp($row->rw);
			$jumlahrwl[$no] = $this->m_home->count_rwl($row->rw);
			$no++;
		}
		for ($i=1; $i <= 4; $i++) { 
			$data['rw'][$i] = $jumlahrw[$i];
			$data['namarw'][$i] = $rwname[$i];
			$data['jumlahrwp'][$i] = $jumlahrwp[$i];
			$data['jumlahrwl'][$i] = $jumlahrwl[$i];
		}
		$data['p'] = $this->m_home->count_perempuan();
		$data['l'] = $this->m_home->count_laki();
		$data['jumrumahtangga'] = $jumrumahtangga;
		$this->load->view('adminsuper/overview', $data);
		
		
	}

	public function data_desa()
	{
		$this->session->set_flashdata('icon', 'fas fa-chart-pie');
		$this->session->set_flashdata('menu', 'datadesa');
		$this->session->set_flashdata('menuName', 'Data Desa');
		$this->session->set_flashdata('breadcrumb', 'Data Desa');
		$data['pendidikan_group'] = $this->m_adminsuper->get_pendidikan();
		$data['status_perkawinan_group'] = $this->m_adminsuper->get_status_perkawinan();
		$data['pekerjaan_group'] = $this->m_adminsuper->get_pekerjaan();
		$pendidikan = $this->input->post('pendidikan', true);
		$pekerjaan = $this->input->post('pekerjaan', true);
		$name = $this->input->post('name', true);
		$jk = $this->input->post('jk', true);
		$status_kawin = $this->input->post('status_kawin', true);
		$umur = $this->input->post('umur', true);
		// if ($name) {
		if ($pendidikan) {
			$pend = "`pendidikan_terakhir` = '".$pendidikan."'";
		}else {
			$pend = "`pendidikan_terakhir` LIKE '%".$pendidikan."%'";
		}
		if ($pekerjaan) {
			$pek = "`pekerjaan` = '".$pekerjaan."'";
		}else {
			$pek = "`pekerjaan` LIKE '%".$pekerjaan."%'";
		}
		if ($jk) {
			$gender = "`jenis_kelamin` = '".$jk."'";
		}else {
			$gender = "`jenis_kelamin` LIKE '%".$jk."%'";
		}
		if ($status_kawin) {
			$stat = "`status_perkawinan` = '".$status_kawin."'";
		}else {
			$stat = "`status_perkawinan` LIKE '%".$status_kawin."%'";
		}

		$sql11 = "SELECT * FROM `satudata_pendduk` WHERE ".$pend." AND ".$pek." AND ".$gender." AND ".$stat;
		if ($umur) {
			if($umur == 10){
				$sql = $sql11." AND umur <10";
				$umurval = "<10 Tahun";
			}
			if($umur == 20){
				$sql = $sql11." AND umur >= 10 AND umur <=20 ";
				$umurval = "10-20 Tahun";
			}
			if($umur == 30){
				$sql = $sql11." AND umur >= 20 AND umur <=30";
				$umurval = "20-30 Tahun";
			}
			if($umur == 40){
				$sql = $sql11." AND umur >= 30 AND umur <=40";
				$umurval = "30-40 Tahun";
			}
			if($umur == 50){
				$sql = $sql11." AND umur >= 40 AND umur <=50";
				$umurval = "40-50 Tahun";
			}
			if($umur == 60){
				$sql = $sql11." AND umur >=50 AND umur <=60";
				$umurval = "50-60 Tahun";
			}
			if($umur == 70){
				$sql = $sql11." AND umur >60";
				$umurval = ">60 Tahun";
			}

		}else {
			$sql = $sql11;

		}
		if (!isset($umurval)) {
			$umurval =0;
		}
		$data['pendidikan'] = $pendidikan;
		$data['status_kawin'] = $status_kawin;
		$data['jk'] = $jk;
		$data['pekerjaan'] = $pekerjaan;
		$data['umur'] = $umur;
		$data['umurval'] = $umurval;

		// $sql = "SELECT * FROM `satudata_pendduk`";
		// echo $sql."<br>";
			// echo $umur;
		$data['data_penduduk'] = $this->m_adminsuper->get_datatable($sql);
		foreach ($data['data_penduduk']->result_array()  as $row) {
			
		}
		// echo $pend;
		// $data['pend'] = $pend;
		// var_dump($data['data_penduduk']);
		// $data['sql'] = $sql;
		// $this->load->view('adminsuper/data_desa', $data);
		// $this->load->view('adminsuper/_partial/datatable', $data);
		// }else {
			$this->load->view('adminsuper/data_desa', $data);
			$this->load->view('adminsuper/_partial/datatable', $data);
		// }
		
	}
	public function pengguna()
	{
		$this->session->set_flashdata('icon', 'fas fa-users');
		$this->session->set_flashdata('menu', 'pengguna');
		$this->session->set_flashdata('breadcrumb', 'Pengguna');
		$this->session->set_flashdata('menuName', 'Pengguna');
		$data['pengguna'] = $this->m_adminsuper->get_pengguna();
		$this->load->view('adminsuper/pengguna', $data);
		
	}
	public function tambah_pengguna()
	{
		$this->session->set_flashdata('menu', 'pengguna');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim',[
			'required' => 'Nama Harus Diisi',
		]);
		$this->form_validation->set_rules('uname', 'uname', 'required|trim',[
			'required' => 'Nama Harus Diisi',
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[satudata_user.email]',[
			'required' => 'Email Harus Diisi',
			'valid_email' => 'Format Email Tidak Sesuai',
			'is_unique' => 'Email Sudah Terpakai',
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]',[
			'required' => 'Password Harus Diisi',
			'matches' => 'Konfirmasi Password Tidak Sesuai',
			'min_length' => 'Password Minimal 5 Karakter',
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]',[
			'matches' => 'Konfirmasi Password Tidak Sesuai',
			'required' => 'Password Harus Diisi',
		]);;


		if ($this->form_validation->run() == false) {

			$this->session->set_flashdata('icon', 'fas fa-users');
			$this->session->set_flashdata('menuName', 'Tambah Pengguna');
			$this->session->set_flashdata('breadcrumb', 'Pengguna / Tambah Pengguna');
			$this->load->view('adminsuper/tambah_user');

		}else {
			// echo "validasi berhasil";
			$email = $this->input->post('email', true);
			$data = [
				'username' => htmlspecialchars($this->input->post('uname', true)),
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'email' => htmlspecialchars($email),
				'jenis_kelamin' => htmlspecialchars($this->input->post('jk', true)),
				'gambar' => 'default.jpg',
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => $this->input->post('role', true),
				'is_active' => 1,
				'date_created' => time(),
			];

			$this->db->insert('satudata_user', $data);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Akun Anda Berhasil di Buat!!!</div>');
			redirect('adminsuper/tambah_pengguna','refresh');
		}


		
	}
	public function edit_pengguna()
	{
		$this->session->set_flashdata('menu', 'pengguna');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim',[
			'required' => 'Nama Harus Diisi',
		]);
		$this->form_validation->set_rules('uname', 'uname', 'required|trim',[
			'required' => 'Nama Harus Diisi',
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email',[
			'required' => 'Email Harus Diisi',
			'valid_email' => 'Format Email Tidak Sesuai',
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('icon', 'fas fa-users');
			$this->session->set_flashdata('menuName', 'Edit Pengguna');
			$this->session->set_flashdata('breadcrumb', 'Pengguna / Edit Pengguna');
			$id = $this->uri->segment(3);
			$data['data_pengguna'] = $this->m_adminsuper->get_profil_by_id($id);
			$this->load->view('adminsuper/edit_user', $data);
		} else {
			$uname = $this->input->post('uname');
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$jk = $this->input->post('jk');
			$role = $this->input->post('role');
			$id = $this->input->post('id');
			$this->m_adminsuper->edit_user_by_id($id,$uname,$nama,$email,$jk,$role);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pengguna Berhasil Diganti!</div>');
			if ($this->input->post('profil') == "user") {
				$urlredirect = "adminsuper/edit_pengguna/".$this->input->post('id');
			}else {
				$urlredirect = "adminsuper/profil";

			}
			redirect($urlredirect,'refresh');
		}


		
	}
	public function aspirasi_publik()
	{
		$this->session->set_flashdata('menu', 'aspirasi');
		$this->session->set_flashdata('icon', 'fas fa-comments');
		$this->session->set_flashdata('breadcrumb', 'Aspirasi Publik');
		$this->session->set_flashdata('menuName', 'Aspirasi Publik');
		$data['aspirasi_proses'] = $this->m_adminsuper->get_aspirasi_proses();
		$data['aspirasi_selesai'] = $this->m_adminsuper->get_aspirasi_selesai();
		$data['jumlah_aspirasi_laki2'] = $this->m_adminsuper->count_aspirasi_laki2();
		$data['jumlah_aspirasi_perempuan'] = $this->m_adminsuper->count_aspirasi_perempuan();
		$this->load->view('adminsuper/aspirasi_publik', $data);
		// var_dump($data);
		
	}
	public function balas_aspirasi()
	{		
		// $this->form_validation->set_rules('aspirasi', 'aspirasi', 'required|trim',[
		// 	'required' => 'Aspirasi Harus Diisi',
		// ]);
		$this->session->set_flashdata('menu', 'aspirasi');

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
			$this->session->set_flashdata('icon', 'fas fa-comments');
			$this->session->set_flashdata('breadcrumb', 'Aspirasi Publik / Balas Aspirasi');
			$this->session->set_flashdata('menuName', 'Aspirasi Publik');
			$id = $this->uri->segment(3);
			$email = $this->session->userdata('email');
			$data['profile'] = $this->m_adminsuper->get_profil_by_kode($email);
			$data['aspirasi_by_kode'] = $this->m_adminsuper->get_aspirasi_by_id($id);
			$data['aspirasi_laki'] = $this->m_adminsuper->count_aspirasi_laki2();
			$data['aspirasi_perempuan'] = $this->m_adminsuper->count_aspirasi_perempuan();
			$this->load->view('adminsuper/balas_aspirasi', $data);
			$this->load->view('adminsuper/_partial/highchart',$data);
			// var_dump($data);
		}else {
			$nama = htmlspecialchars($this->input->post('nama', true));
			$alamat = htmlspecialchars($this->input->post('alamat', true));
			$email = $this->input->post('email', true);
			$kirim = $this->input->post('kirim', true);
			$idkomen = $this->input->post('idkomen', true);
			$jk = htmlspecialchars($this->input->post('jk', true));
			$subject = htmlspecialchars($this->input->post('subject', true));
			$aspirasi = htmlspecialchars($this->input->post('aspirasi', true));
			$id_komen = htmlspecialchars($this->input->post('id_komen', true));
			$data = [
				'nama' => $nama,
				'alamat' => $alamat,
				'email' => $email,
				'jenis_kelamin' => $jk,
				'subject' => $subject,
				'aspirasi' => $aspirasi,
				'role_id' => 1,
				'is_active' => 2,
				'date_created' => time(),
			];
			$this->db->insert('satudata_aspirasi', $data);
			$this->_sendEmail($aspirasi, $kirim, $idkomen);
			$this->m_adminsuper->update_status_aspirasi($idkomen);			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Aspirasi Anda Berhasil di kirim! Terima kasih atas partisipasinya. </div>');			
			$url_redirect = "adminsuper/balas_aspirasi/".$id_komen;
			redirect($url_redirect,'refresh');
		}

		
	}
	public function profil()
	{
		$this->session->set_flashdata('menu', 'profil');
		$this->session->set_flashdata('icon', 'fas fa-user');
		$this->session->set_flashdata('breadcrumb', 'Profil Saya');
		$this->session->set_flashdata('menuName', 'Profil Saya');
		$email = $this->session->userdata('email');
		$data['profil'] = $this->m_adminsuper->get_profil_by_kode($email);
		$this->load->view('adminsuper/profil', $data);
		// var_dump($data);
		
	}
	public function change_password()
	{
		$this->session->set_flashdata('menu', 'password');
		$this->session->set_flashdata('icon', 'fas fa-key');
		$this->session->set_flashdata('breadcrumb', 'Ganti Password');
		$this->session->set_flashdata('menuName', 'Ganti Password');
		$this->load->view('adminsuper/change_password');
		
	}
	public function detail_penduduk()
	{
		$this->session->set_flashdata('menu', 'Detail Penduduk');
		$this->session->set_flashdata('icon', 'fas fa-chart-pie');
		$this->session->set_flashdata('breadcrumb', 'Detail Penduduk');
		$this->session->set_flashdata('menuName', 'Detail Penduduk');
		$id = $this->uri->segment(3);
		$data['row'] = $this->m_adminsuper->get_penduduk_by_kode($id);
		$this->load->view('adminsuper/detail_penduduk', $data);
		
	}

	public function hapus_pengguna()
	{
		$id = $this->uri->segment(3);
		$data['hapus_data'] = $this->m_adminsuper->nonaktifkan_user($id);
		if ($data['hapus_data']) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Pengguna Berhasil Dihapus!</div>');
			redirect('adminsuper/pengguna','refresh');	
		}else {

			$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Data Pengguna Gagal Dihapus!</div>');
			redirect('adminsuper/pengguna','refresh');	
		}
				
	}

	private function _sendEmail($jawaban, $email, $idkomen)
	{
		$config = [
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'sisadaadm19@gmail.com',
			'smtp_pass' => 'temayang1412',
			'smtp_port' => 465,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->initialize($config);

		$this->email->from('sisadaadm19@gmail.com', 'Sistem Informasi Satu Data (SISADA))');
		$this->email->to($email);

		$this->email->subject('Respon Aspirasi Sistem Informasi Satu Data Aspirasi No #'.$idkomen.'');
		$this->email->message($jawaban);
	

		if ($this->email->send()) {
			return true;
		}else {
			echo $this->email->print_debugger();
			die;
		}
	}

}
