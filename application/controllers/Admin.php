<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
    {
		parent::__construct();
		// $this->load->library('form_validation');
		$this->load->library('form_validation');
        $this->load->model('m_admin');
        $this->load->model('m_home');
        $this->load->helper('file');
		$role_id = $this->session->userdata('role_id');
		if ($role_id == 2) {					
		} else if ($role_id == 1) {			
			redirect('adminsuper','refresh');	
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
		$rumah_tangga = $this->m_admin->get_rumah_tangga();
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
		$this->load->view('admin/overview', $data);
		
	}
	
	public function data_desa()
	{
		$this->session->set_flashdata('icon', 'fas fa-chart-pie');
		$this->session->set_flashdata('menu', 'datadesa');
		$this->session->set_flashdata('menuName', 'Data Desa');
		$this->session->set_flashdata('breadcrumb', 'Data Desa');
		$data['pendidikan_group'] = $this->m_admin->get_pendidikan();
		$data['status_perkawinan_group'] = $this->m_admin->get_status_perkawinan();
		$data['pekerjaan_group'] = $this->m_admin->get_pekerjaan();
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

		$sql11 = "SELECT * FROM `satudata_pendduk` WHERE ".$pend." AND ".$pek." AND ".$gender." AND ".$stat." AND is_active=1";
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

		$data['data_penduduk'] = $this->m_admin->get_datatable($sql);
		foreach ($data['data_penduduk']->result_array()  as $row) {
		}
		$this->load->view('admin/data_desa', $data);
		$this->load->view('admin/_partial/datatable', $data);
		
	}
	public function import_data()
	{

		$this->session->set_flashdata('icon', 'fas fa-chart-pie');
		$this->session->set_flashdata('menu', 'datadesa');
		$this->session->set_flashdata('menuName', 'Import Data');
		$this->session->set_flashdata('breadcrumb', 'Data Desa / Import Data');
		$sql = "SELECT * FROM `satudata_pendduk`";
		$data['data_penduduk'] = $this->m_admin->get_datatable($sql);
		
		$delimited = $this->input->post('delimited');
		$enclosure = '"';
		$import = $this->input->post('import');
		if ($import) {

			$data = array();
        	$memData = array();

            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');
            if($this->form_validation->run() == true){
                // echo "joko";

                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                
                // If file uploaded
                if(is_uploaded_file($_FILES['file']['tmp_name'])){
                    // Load CSV reader library
                	$this->load->library('CSVReader');
            	
            		$csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name'], $delimited, $enclosure);

	            	if(!empty($csvData)){
	                    foreach($csvData as $row){ $rowCount++;
	                        
	                        // Prepare data for DB insertion
	                        for ($i=0; $i < 32; $i++) { 
	                        	if (empty($row[$i])) {
	                        		$row[$i] ="";
	                        	}
	                        }
	                        $memData = array(
	                        	'nomor' => $row[0], 
	                            'rt' => $row[1],
								'rw' => $row[2],
								'no_kk' => $row[3],
								'nik' => $row[4],
								'nama_penduduk' => $row[5],
								'tempat_lahir' => $row[6],
								'status_pajak' => $row[7],
								'tahun_pajak' => $row[8],
								'tanggal_lahir' =>$row[9],
								'umur' => $row[10],
								'jenis_kelamin' =>$row[11],
								'no_akta_kelahiran' => $row[12],
								'golongan_darah' =>$row[13],
								'agama' => $row[14],
								'pendidikan_terakhir' =>$row[15],
								'pekerjaan' =>$row[16],
								'status_hubungan_keluarga' => $row[17],
								'status_perkawinan' =>$row[18],
								'no_akta_perkawinan' =>$row[19],
								'tanggal_perkawinan' => $row[20],
								'nomor_akta_perceraian' =>$row[21],
								'tanggal_perceraian' => $row[22],
								'kelainan_fisik_mental' => $row[23],
								'penyandang_cacat' =>$row[24],
								'nama_ayah' =>$row[25],
								'nik_ayah' =>$row[26],
								'nama_ibu' =>$row[27],
								'nik_ibu' =>$row[28],
								'alamat' => $row[29],
								'alamat_penduduk' =>$row[30],
								'nama_kepala_keluarga' =>$row[31],
								'is_active' => 1,
	                        );
	       //                  $memData = array(
	       //                      'rt' => $row[0],
								// 'rw' => $row[1],
								// 'no_kk' => $row[2],
								// 'nik' => $row[3],
								// 'nama_penduduk' => $row[4],
								// 'tempat_lahir' => $row[5],
								// 'status_pajak' => $row[6],
								// 'tahun_pajak' => $row[7],
								// 'tanggal_lahir' =>$row[8],
								// 'umur' => $row[9],
								// 'jenis_kelamin' =>$row[10],
								// 'no_akta_kelahiran' => $row[11],
								// 'golongan_darah' =>$row[12],
								// 'agama' => $row[13],
								// 'pendidikan_terakhir' =>$row[14],
								// 'pekerjaan' =>$row[15],
								// 'status_hubungan_keluarga' => $row[16],
								// 'status_perkawinan' =>$row[17],
								// 'no_akta_perkawinan' =>$row[18],
								// 'tanggal_perkawinan' => $row[19],
								// 'nomor_akta_perceraian' =>$row[20],
								// 'tanggal_perceraian' => $row[21],
								// 'kelainan_fisik_mental' => $row[22],
								// 'penyandang_cacat' =>$row[23],
								// 'nama_ayah' =>$row[24],
								// 'nik_ayah' =>$row[25],
								// 'nama_ibu' =>$row[26],
								// 'nik_ibu' =>$row[27],
								// 'alamat' => $row[28],
								// 'alamat_penduduk' =>$row[29],
								// 'nama_kepala_keluarga' =>$row[30],
								// 'is_active' => 1,
	       //                  );
	                        // Check whether email already exists in the database
	                        $nokk = $row[3];
	                        $nik = $row[4];
	                        $nama = $row[5];
							$this->db->select('*');
					        $this->db->from('satudata_pendduk');
					        $this->db->where('no_kk', $nokk); // Cek berdasarkan nis
					        $this->db->where('nik', $nik); // Cek berdasarkan nama
					        $this->db->where('nama_penduduk', $nama); // Cek berdasarkan nama

					        $exist = $this->db->get()->row();

	                        // $prevCount = $this->m_admin->getRows($con);
	                        
	                        if(!empty($exist)){
	                            // Update member data

	                            $condition = array('no_kk' => $nokk, 'nik' => $row[4], 'nama_penduduk' => $nama);
	                            $update = $this->m_admin->update($memData, $condition);
	                            
	                            if($update){
	                                $updateCount++;
	                            }
	                        }else{
	                            // Insert member data
	                            $insert = $this->m_admin->insert($memData);
	                            
	                            if($insert){
	                                $insertCount++;
	                            }
	                        }
	                    }
	                   // Status message with imported data count
	                    $notAddCount = ($rowCount - ($insertCount + $updateCount));
	                    $successMsg = 'Data Penduduk Berhasil diinput Total Rows ('.$rowCount.') | Diinput ('.$insertCount.') | DiUpdated ('.$updateCount.') | Tidak Terinput ('.$notAddCount.')';
	                    $this->session->set_userdata('success_msg', $successMsg);
	                }
	            }
            }else {
                $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
            }
            redirect('admin/import_data');

        
		}else {
			$this->load->view('admin/import_data', $data);
			$this->load->view('admin/_partial/datatable', $data);
			$this->session->unset_userdata('success_msg');
			$this->session->unset_userdata('error_msg');
		}
		
	}
	public function pengguna()
	{
		$this->session->set_flashdata('icon', 'fas fa-users');
		$this->session->set_flashdata('menu', 'pengguna');
		$this->session->set_flashdata('breadcrumb', 'Pengguna');
		$this->session->set_flashdata('menuName', 'Pengguna');
		$data['pengguna'] = $this->m_admin->get_pengguna();
		$this->load->view('admin/pengguna', $data);
		
	}
	public function tambah_penduduk()
	{
		$this->session->set_flashdata('menu', 'data_desa');
		$this->form_validation->set_rules('nokk', 'nokk', 'required|trim',[
			'required' => 'Nnomor KK Harus Diisi',
		]);
		$this->form_validation->set_rules('nik', 'nik', 'required|trim',[
			'required' => 'NIK Harus Diisi',
		]);
		$this->form_validation->set_rules('rt', 'rt', 'required|trim',[
			'required' => 'RT Harus Diisi',
		]);
		$this->form_validation->set_rules('rw', 'rw', 'required|trim',[
			'required' => 'RW Harus Diisi',
		]);
		$this->form_validation->set_rules('nama', 'nama', 'required|trim',[
			'required' => 'Nama Harus Diisi',
		]);
		$this->form_validation->set_rules('tempatlahir', 'tempatlahir', 'required|trim',[
			'required' => 'Tempat Lahir Harus Diisi',
		]);
		$this->form_validation->set_rules('tanggallahir', 'tanggallahir', 'required|trim',[
			'required' => 'Tanggal Lahir Harus Diisi',
		]);
		$this->form_validation->set_rules('agama', 'agama', 'required|trim',[
			'required' => 'Agama Harus Diisi',
		]);
		$this->form_validation->set_rules('pendidikan', 'pendidikan', 'required|trim',[
			'required' => 'Pendidikan Harus Diisi',
		]);
		$this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'required|trim',[
			'required' => 'Pekerjaan Harus Diisi',
		]);
		$this->form_validation->set_rules('statusdikeluarga', 'statusdikeluarga', 'required|trim',[
			'required' => 'Status di Keluarga Harus Diisi',
		]);
		$this->form_validation->set_rules('statusperkawinan', 'statusperkawinan', 'required|trim',[
			'required' => 'Status Perkawinan Harus Diisi',
		]);
		$this->form_validation->set_rules('statuspajak', 'statuspajak', 'trim');
		$this->form_validation->set_rules('tahunpajak', 'tahunpajak', 'trim');
		$this->form_validation->set_rules('noaktakelahiran', 'noaktakelahiran', 'trim');
		$this->form_validation->set_rules('golongandarah', 'golongandarah', 'trim');
		$this->form_validation->set_rules('noaktaperkawinan', 'noaktaperkawinan', 'trim');
		$this->form_validation->set_rules('tanggalperkawinan', 'tanggalperkawinan', 'trim');
		$this->form_validation->set_rules('noaktaperceraian', 'noaktaperceraian', 'trim');
		$this->form_validation->set_rules('tanggalperceraian', 'tanggalperceraian', 'trim');
		$this->form_validation->set_rules('kelainanffisikmental', 'kelainanffisikmental', 'trim');
		$this->form_validation->set_rules('cacat', 'cacat', 'trim');
		$this->form_validation->set_rules('namaayah', 'namaayah', 'trim');
		$this->form_validation->set_rules('nikayah', 'nikayah', 'trim');
		$this->form_validation->set_rules('namaibu', 'namaibu', 'trim');
		$this->form_validation->set_rules('nikibu', 'nikibu', 'trim');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim');
		$this->form_validation->set_rules('alamatpenduduk', 'alamatpenduduk', 'trim');
		$this->form_validation->set_rules('kepalakeluuarga', 'kepalakeluuarga', 'trim');

		if ($this->form_validation->run() == false) {

			$this->session->set_flashdata('icon', 'fas fa-users');
			$this->session->set_flashdata('menuName', 'Tambah Penduduk');
			$this->session->set_flashdata('breadcrumb', 'Tambah Penduduk');
			$this->load->view('admin/tambah_penduduk');

		}else {
			$tanggallahir = $this->input->post('tanggallahir');
			$lahir = new DateTime($tanggallahir);
			$today = new DateTime();
			$diff = $today->diff($lahir);

			$umur = $diff->y;
			$data = [
				'rt' => htmlspecialchars($this->input->post('rt', true)),
				'rw' => htmlspecialchars($this->input->post('rw', true)),
				'no_kk' => htmlspecialchars($this->input->post('nokk', true)),
				'nik' => $this->input->post('nik', true),
				'nama_penduduk' => htmlspecialchars($this->input->post('nama', true)),
				'tempat_lahir' => htmlspecialchars($this->input->post('tempatlahir', true)),
				'status_pajak' => htmlspecialchars($this->input->post('statuspajak', true)),
				'tahun_pajak' => $this->input->post('tahunpajak', true),
				'tanggal_lahir' => htmlspecialchars($this->input->post('tanggallahir', true)),
				'umur' => $umur,
				'jenis_kelamin' => htmlspecialchars($this->input->post('jk', true)),
				'no_akta_kelahiran' => $this->input->post('noaktakelahiran', true),
				'golongan_darah' => htmlspecialchars($this->input->post('golongandarah', true)),
				'agama' => htmlspecialchars($this->input->post('agama', true)),
				'pendidikan_terakhir' => htmlspecialchars($this->input->post('pendidikan', true)),
				'pekerjaan' => $this->input->post('pekerjaan', true),
				'status_hubungan_keluarga' => htmlspecialchars($this->input->post('statusdikeluarga', true)),
				'status_perkawinan' => htmlspecialchars($this->input->post('statusperkawinan', true)),
				'no_akta_perkawinan' => htmlspecialchars($this->input->post('noaktaperkawinan', true)),
				'tanggal_perkawinan' => $this->input->post('tanggalperkawinan', true),
				'nomor_akta_perceraian' => htmlspecialchars($this->input->post('noaktaperceraian', true)),
				'tanggal_perceraian' => htmlspecialchars($this->input->post('tanggalperceraian', true)),
				'kelainan_fisik_mental' => htmlspecialchars($this->input->post('kelainanfisikmental', true)),
				'penyandang_cacat' => $this->input->post('cacat', true),
				'nama_ayah' => htmlspecialchars($this->input->post('namayah', true)),
				'nik_ayah' => htmlspecialchars($this->input->post('nikayah', true)),
				'nama_ibu' => htmlspecialchars($this->input->post('namaibu', true)),
				'nik_ibu' => $this->input->post('nikibu', true),
				'alamat' => htmlspecialchars($this->input->post('alamat', true)),
				'alamat_penduduk' => $this->input->post('alamatpenduduk', true),
				'nama_kepala_keluarga' => htmlspecialchars($this->input->post('kepalakeluuarga', true)),
				'is_active' => 1,
			];

			$this->db->insert('satudata_pendduk', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Data Penduduk Berhasil Dittambahkan!!!</div>');
			redirect('admin/tambah_penduduk','refresh');
		}		
	}
	public function edit_penduduk()
	{
		$this->session->set_flashdata('menu', 'data_desa');
		$this->form_validation->set_rules('nokk', 'nokk', 'required|trim',[
			'required' => 'Nnomor KK Harus Diisi',
		]);
		$this->form_validation->set_rules('nik', 'nik', 'required|trim',[
			'required' => 'NIK Harus Diisi',
		]);
		$this->form_validation->set_rules('rt', 'rt', 'required|trim',[
			'required' => 'RT Harus Diisi',
		]);
		$this->form_validation->set_rules('rw', 'rw', 'required|trim',[
			'required' => 'RW Harus Diisi',
		]);
		$this->form_validation->set_rules('nama', 'nama', 'required|trim',[
			'required' => 'Nama Harus Diisi',
		]);
		$this->form_validation->set_rules('tempatlahir', 'tempatlahir', 'required|trim',[
			'required' => 'Tempat Lahir Harus Diisi',
		]);
		$this->form_validation->set_rules('tanggallahir', 'tanggallahir', 'required|trim',[
			'required' => 'Tanggal Lahir Harus Diisi',
		]);
		$this->form_validation->set_rules('agama', 'agama', 'required|trim',[
			'required' => 'Agama Harus Diisi',
		]);
		$this->form_validation->set_rules('pendidikan', 'pendidikan', 'required|trim',[
			'required' => 'Pendidikan Harus Diisi',
		]);
		$this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'required|trim',[
			'required' => 'Pekerjaan Harus Diisi',
		]);
		$this->form_validation->set_rules('statusdikeluarga', 'statusdikeluarga', 'required|trim',[
			'required' => 'Status di Keluarga Harus Diisi',
		]);
		$this->form_validation->set_rules('statusperkawinan', 'statusperkawinan', 'required|trim',[
			'required' => 'Status Perkawinan Harus Diisi',
		]);
		$this->form_validation->set_rules('statuspajak', 'statuspajak', 'trim');
		$this->form_validation->set_rules('tahunpajak', 'tahunpajak', 'trim');
		$this->form_validation->set_rules('noaktakelahiran', 'noaktakelahiran', 'trim');
		$this->form_validation->set_rules('golongandarah', 'golongandarah', 'trim');
		$this->form_validation->set_rules('noaktaperkawinan', 'noaktaperkawinan', 'trim');
		$this->form_validation->set_rules('tanggalperkawinan', 'tanggalperkawinan', 'trim');
		$this->form_validation->set_rules('noaktaperceraian', 'noaktaperceraian', 'trim');
		$this->form_validation->set_rules('tanggalperceraian', 'tanggalperceraian', 'trim');
		$this->form_validation->set_rules('kelainanffisikmental', 'kelainanffisikmental', 'trim');
		$this->form_validation->set_rules('cacat', 'cacat', 'trim');
		$this->form_validation->set_rules('namaayah', 'namaayah', 'trim');
		$this->form_validation->set_rules('nikayah', 'nikayah', 'trim');
		$this->form_validation->set_rules('namaibu', 'namaibu', 'trim');
		$this->form_validation->set_rules('nikibu', 'nikibu', 'trim');
		$this->form_validation->set_rules('alamat', 'alamat', 'trim');
		$this->form_validation->set_rules('alamatpenduduk', 'alamatpenduduk', 'trim');
		$this->form_validation->set_rules('kepalakeluuarga', 'kepalakeluuarga', 'trim');

		if ($this->form_validation->run() == false) {
			$id = $this->uri->segment(3);
			$this->session->set_flashdata('icon', 'fas fa-users');
			$this->session->set_flashdata('menuName', 'Edit Penduduk');
			$this->session->set_flashdata('breadcrumb', 'Edit Penduduk');
			$data['detail'] = $this->m_admin->get_penduduk_by_kode($id);
			$this->load->view('admin/edit_penduduk', $data);

		}else 
		{
			// $id = $this->uri->segment(3);
			$id = $this->input->post('id', true);
			$rt = $this->input->post('rt', true);
			$rw = $this->input->post('rw', true);
			$nokk = $this->input->post('nokk', true);
			$nik = $this->input->post('nik', true);
			$nama = $this->input->post('nama', true);
			$tempatlahir = $this->input->post('tempatlahir', true);
			$statuspajak = $this->input->post('statuspajak', true);
			$tahunpajak = $this->input->post('tahunpajak', true);
			$tanggallahir = $this->input->post('tanggallahir', true);
			$jk = $this->input->post('jk', true);
			$noaktakelahiran = $this->input->post('noaktakelahiran', true);
			$golongandarah = $this->input->post('golongandarah', true);
			$agama = $this->input->post('agama', true);
			$pendidikan = $this->input->post('pendidikan', true);
			$pekerjaan = $this->input->post('pekerjaan', true);
			$statusdikeluarga = $this->input->post('statusdikeluarga', true);
			$statusperkawinan = $this->input->post('statusperkawinan', true);
			$noaktaperkawinan = $this->input->post('noaktaperkawinan', true);
			$tanggalperkawinan = $this->input->post('tanggalperkawinan', true);
			$noaktaperceraian = $this->input->post('noaktaperceraian', true);
			$tanggalperceraian = $this->input->post('tanggalperceraian', true);
			$kelainanfisikmental = $this->input->post('kelainanfisikmental', true);
			$cacat = $this->input->post('cacat', true);
			$namaayah = $this->input->post('namayah', true);
			$nikayah = $this->input->post('nikayah', true);
			$namaibu = $this->input->post('namaibu', true);
			$nikibu = $this->input->post('nikibu', true);
			$alamat = $this->input->post('alamat', true);
			$alamatpenduduk = $this->input->post('alamatpenduduk', true);
			$kepalakeluarga = $this->input->post('kepalakeluarga', true);
			$urlredirect = "admin/edit_penduduk/".$id;
			$data['editpend'] = $this->m_admin->edit_penduduk_by_id($id,$rt,$rw,$nokk,$nik,$nama,$tempatlahir,$tanggallahir,$statuspajak,$tahunpajak, $jk,$noaktakelahiran,$golongandarah,$agama,$pendidikan,$pekerjaan,$statusdikeluarga,$statusperkawinan,$noaktaperkawinan,$tanggalperkawinan,$noaktaperceraian,$tanggalperceraian,$kelainanfisikmental,$cacat,$namaayah,$nikayah,$namaibu,$nikibu,$alamat,$alamatpenduduk,$kepalakeluarga);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Akun Anda Berhasil Dirubah!!!</div>');
			// echo $urlredirect;
			redirect($urlredirect,'refresh');
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
			$data['data_pengguna'] = $this->m_admin->get_profil_by_id($id);
			$this->load->view('admin/edit_user', $data);
		} else {
			$uname = $this->input->post('uname');
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$jk = $this->input->post('jk');
			$role = $this->input->post('role');
			$id = $this->input->post('id');
			$this->m_admin->edit_user_by_id($id,$uname,$nama,$email,$jk,$role);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Pengguna Berhasil Diganti!</div>');
			if ($this->input->post('profil') == "user") {
				$urlredirect = "admin/edit_pengguna/".$this->input->post('id');
			}else {
				$urlredirect = "admin/profil";

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
		$data['aspirasi_proses'] = $this->m_admin->get_aspirasi_proses();
		$data['aspirasi_selesai'] = $this->m_admin->get_aspirasi_selesai();
		$data['jumlah_aspirasi_laki2'] = $this->m_admin->count_aspirasi_laki2();
		$data['jumlah_aspirasi_perempuan'] = $this->m_admin->count_aspirasi_perempuan();
		$this->load->view('admin/aspirasi_publik', $data);
		// var_dump($data);
		
	}
	public function detail_penduduk()
	{
		$this->session->set_flashdata('menu', 'Detail Penduduk');
		$this->session->set_flashdata('icon', 'fas fa-chart-pie');
		$this->session->set_flashdata('breadcrumb', 'Detail Penduduk');
		$this->session->set_flashdata('menuName', 'Detail Penduduk');
		$id = $this->uri->segment(3);
		$data['row'] = $this->m_admin->get_penduduk_by_kode($id);
		$this->load->view('adminsuper/detail_penduduk', $data);
		
	}
	public function hapus_penduduk()
	{
		$id = $this->uri->segment(3);
		$this->m_admin->hapus_penduduk($id);
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Penduduk Berhasil di Hapus</div>');
		redirect('admin/data_desa','refresh');
		
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
			$data['profile'] = $this->m_admin->get_profil_by_kode($email);
			$data['aspirasi_by_kode'] = $this->m_admin->get_aspirasi_by_id($id);
			$data['aspirasi_laki'] = $this->m_admin->count_aspirasi_laki2();
			$data['aspirasi_perempuan'] = $this->m_admin->count_aspirasi_perempuan();
			$this->load->view('admin/balas_aspirasi', $data);
			$this->load->view('admin/_partial/highchart',$data);
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
			$this->m_admin->update_status_aspirasi($idkomen);			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Aspirasi Anda Berhasil di kirim! Terima kasih atas partisipasinya. </div>');			
			$url_redirect = "admin/balas_aspirasi/".$id_komen;
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
		$data['profil'] = $this->m_admin->get_profil_by_kode($email);
		$this->load->view('admin/profil', $data);
		// var_dump($data);
		
	}
	public function export_data()
	{
		$this->session->set_flashdata('icon', 'fas fa-chart-pie');
		$this->session->set_flashdata('menu', 'datadesa');
		$this->session->set_flashdata('menuName', 'Data Desa');
		$this->session->set_flashdata('breadcrumb', 'Data Desa / Export');
		$delimited = $this->input->post('delimited');
		$endclosure = $this->input->post('endclosure');
		$export = $this->input->post('export');
		if ($export) {
			if ($endclosure == '"') {
				$endclosure = '"';
			}else {
				$endclosure = "'";
			}
			$newline = "\r\n";
			$this->load->dbutil();
			$query = $this->db->query("SELECT * FROM satudata_pendduk");
			$backup = $this->dbutil->csv_from_result($query, $delimited, $newline, $endclosure);
			// Load the DB utility class
			// $this->load->dbutil();

			// Backup your entire database and assign it to a variable
			// $backup = $this->dbutil->backup();

			// Load the file helper and write the file to your server
			$this->load->helper('file');
			write_file('/path/to/mybackup.csv', $backup);

			// Load the download helper and send the file to your desktop
			$this->load->helper('download');
			force_download('mybackup.csv', $backup);

		}else {
			$this->load->view('admin/export_data');

		}
		// var_dump($data);
		
	}
	public function change_password()
	{
		$this->session->set_flashdata('menu', 'password');
		$this->session->set_flashdata('icon', 'fas fa-key');
		$this->session->set_flashdata('breadcrumb', 'Ganti Password');
		$this->session->set_flashdata('menuName', 'Ganti Password');
		$this->load->view('admin/change_password');
		
	}

	public function hapus_pengguna()
	{
		$id = $this->uri->segment(3);
		$data['hapus_data'] = $this->m_admin->nonaktifkan_user($id);
		if ($data['hapus_data']) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Pengguna Berhasil Dihapus!</div>');
			redirect('admin/pengguna','refresh');	
		}else {

			$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Data Pengguna Gagal Dihapus!</div>');
			redirect('admin/pengguna','refresh');	
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

    /*
     * Callback function to check file value and type during validation
     */
    public function file_check($str){
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }

}
