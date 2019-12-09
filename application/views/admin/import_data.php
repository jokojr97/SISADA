<?php $this->load->view('admin/_partial/header') ?>
<div class="container-fluid">
	<div class="row">		
      <div class="col">
      	<h3>Import Data Penduduk
      </h3><hr>
      	<!-- <?= $sql; ?> -->
      	<div class="row p-3 bg-white m-3 border">
      		<div class="col">
      			<!-- Display status message -->
			    <?php $success_msg = $this->session->userdata('success_msg'); if(!empty($success_msg)){ ?>
			    <div class="col-xs-12">
			        <div class="alert alert-success"><?php echo $success_msg; ?></div>
			    </div>
			    <?php $error_msg = $this->session->userdata('error_msg'); if(!empty($error_msg)){ ?>
			    <div class="col-xs-12">
			        <div class="alert alert-danger"><?php echo $error_msg; ?></div>
			    </div>
			    <?php }} ?>
			    
			  <form method="post" action="<?= base_url() ?>admin/import_data" id="import_csv" enctype="multipart/form-data">
				<input type="hidden" name="import" value=1>
				<div class="form-group">
					<label>Select CSV File</label>
					<input type="file" name="file" id="csv_file" required accept=".csv" />
				</div>
				<div class="form-group col-md-6">
					<label class="control-label h5" for="Delimited" >Delimited :</label>   
					<select class="form-control" id="Delimited" name="delimited">
				    	<option>,</option>
				    	<option>;</option>
					</select>
				</div>
				<b class="text-red">* Pastikan format file adalah .csv</b><br>
				<b class="text-red">* Pastikan tidak ada karakter , atau ; pada data</b><br>
				<b class="text-red">* Pastikan ada header/judul baris di baris pertama data yang akan di import (karena data yang diimport dimulai dari data baris 2</b><br>
			   <br />
			   <button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import CSV</button>
			  </form>
      		</div>	
      	</div>
      	<br><br>
	      	<div class="table table-responsive p-2">
	      		
		        <table class="table table-striped table-bordered bg-white" id="bosdttable1" >
		          <thead>
		            <tr class="bg-success text-white text-center">
		              <th scope="col"></th>
		              <!-- <th scope="col"></th> -->
		              <th scope="col">NO KK</th>
		              <th scope="col">NIK</th>
		              <th scope="col">Nama Lengkap</th>
		              <th scope="col">Tempat Lahir</th>
		              <th scope="col">Tanggal Lahir</th>
		              <th scope="col">Umur</th>              
		              <th scope="col">Jenis_kelamin</th>              
		              <th scope="col">Pendidikan</th>              
		              <th scope="col">Pekerjaan</th>              
		              <th scope="col">Status Kawin</th>              
		            </tr>
		          </thead>
		          <tbody>
		          	
		          </tbody>
		      	</table>
	      	</div>
		</div>
	</div>
</div>
<?php $this->load->view('admin/_partial/footer') ?>