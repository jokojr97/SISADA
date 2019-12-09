<?php $this->load->view('admin/_partial/header') ?>
<div class="container-fluid">
	<div class="row">		
      <div class="col">
      	<h3>export Data Data
      	<!-- <a href="<?= base_url('admin/ m  tambah_user') ?>" class="btn btn-primary float-right mb-3"><i class="fas fa-plus"></i> Tambah Penduduk</a> -->
      </h3><hr>  
      	<div class="p-3">      		
			<form  action="<?= base_url() ?>admin/export_data" method="POST"id="import_csv" enctype="multipart/form-data">
					<input type="hidden" name="export" value=1>
				<div class="col-md-6">
					
					<div class="form-group">
						<label class="control-label h5" for="Delimited" >Delimited :</label>   
						<select class="form-control" id="Delimited" name="delimited">
                        	<option>,</option>
                        	<option>;</option>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label h5" for="Endclosure" >Endclosure :</label>   
						<select class="form-control" id="Endclosure" name="endclosure">
                        	<option>"</option>
                        	<option>'</option>
						</select>
					</div>
				</div>
				<br />
				<div class="form-group">
					Export Data Penduduk <label> (.CSV)</label>
				</div>
				<button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn"><i class="fa fa-export"></i> Export CSV</button>
			</form>
      	</div>
      	<br><br>
		</div>
	</div>
</div>
<?php $this->load->view('admin/_partial/footer') ?>