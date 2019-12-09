  <?php $this->load->view('home/_partial/publikasi_header') ?>
  <main id="main" class="main-page  ">

    <!--==========================
      Speaker Details Section
    ============================-->
    <section id="speakers-details" class="wow fadeIn">
      <div class="container">
        <div class="section-header">
          <h2>Data Kependudukan Desa Tlogorejo</h2>
          <p>Sistem Informasi Satu Data Desa Tlogorejo.</p>
        </div>
        <div class="row">
          <div class="col-md-7">
            <div class="border p-3 mt-3">
              <!-- &nbsp<br><br><br><br><br><br><br><br> -->
              <div id="grafik1" style="height: 600px"></div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="border p-3 mt-3">
              <!-- &nbsp<br><br><br> -->
              <div id="grafik2" style="height: 600px"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="mt-3 pt-3">
              <br>
              <h3><b>Data Penduduk Desa Tlogorejo</b></h3>
              <hr>
            </div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr class="bg-primary text-white text-center">
                  <th scope="col">No</th>
                  <th scope="col"><?= $row_name ?></th>
                  <th scope="col">Jumlah <?= $row_name ?></th>
                  <th scope="col">Laki-Laki</th>
                  <th scope="col">Perempuan</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i = 1;
                foreach ($get_row->result() as $row) {?>
                <tr>
                  <th scope="row" class="text-center"><?= $i ?></th>
                  <td><?= $row_name ?> <?= $rowvalue[$i] ?></td>
                  <td class="text-center"><?= $jumlah_row[$i] ?></td>
                  <td class="text-center"><?= $jumlah_row_laki[$i] ?></td>
                  <td class="text-center"><?= $jumlah_row_perempuan[$i] ?></td>
                </tr>
              <?php 
              $i++;
              } ?>
                <tr class="font-weight-bold">
                  <th scope="row" class="text-center"></th>
                  <td>Total</td>
                  <td class="text-center"><?= $total ?></td>
                  <td class="text-center"><?= $total_laki ?></td>
                  <td class="text-center"><?= $total_perempuan ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </section>

  </main>
  <?php $this->load->view('home/_partial/publikasi_footer') ?>
