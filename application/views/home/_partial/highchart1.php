<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<?php
  // $a = $_GET['kode'];
  // $tahun = $_GET['tahun'];
  // $table = "odcbjn_rup".$tahun;
  // $query = $this->db->get_where($table, ['id' =>$a]);
  // foreach ($query->result() as $row) {
  //   $pagu = $row->total_pagu;
  // }
  // $query = $this->db->get_where('odcbjn_lpsescrap', ['id_rup' => $a]);
  // foreach ($query->result() as $row) {
  //   $hps = $row->hps;
  //   $penawaran = $row->harga_penawaran;
  //   $koreksi = $row->harga_terkoreksi;
  //   $negosiasi = $row->hasil_negosiasi;
  // } 
?>
<script type="text/javascript">
 var chart1; // globally available
$(document).ready(function() {
      chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'grafik1',
            type: 'column'
         },   
         title: {
            text: 'Grafik <?= $row_name ?> Tahun 2019'
         },
         credits: {
          enabled: false
         },
         xAxis: {
            categories: ['Jiwa']
         },
         yAxis: {
            title: {
               text: 'Data <?= $row_name ?>'
            }
         },
              series:             
            [
                <?php 
                $i=1;
                foreach ($get_row->result() as $row) : ?>

                  {
                      name: '<?= $row_name ?> <?= $rowvalue[$i] ?>',
                      data: [<?= $jumlah_row[$i] ?>]
                  },
                <?php 
                  $i++;
                  endforeach;
                ?>
            ],
            
      });
   }); 
</script>

<!-- l/p chart -->
<?php 
$jumlahl = 490;
$jumlahp = 230;
$jumlahp1 = 40;
$jumlahl1 = 20;
?>
<script type="text/javascript">
var jumlahl = <?= $jumlahl ?>;
var jumlahp = <?= $jumlahp ?>;
var jumlahl1 = <?= $jumlahl1 ?>;
var jumlahp1 = <?= $jumlahp1 ?>;
var Lainnya = 0;
$('#grafik2').highcharts({
 chart: {

  type: 'pie',
  marginTop: 80
 },
 credits: {
  enabled: false
 },
 title: {
  text: 'Data <?= $row_name ?> '
 },
 subtitle: {
  text: 'TAHUN 2019'
 },
 xAxis: {
  categories: ['Data <?= $row_name ?>'],
  labels: {
   style: {
    fontSize: '10px',
    fontFamily: 'Verdana, sans-serif'
   }
  }
 },
 legend: {
  enabled: true
 },
 plotOptions: {
   pie: {
     allowPointSelect: true,
     cursor: 'pointer',
     dataLabels: {
       enabled: false
     },
     showInLegend: true
   }
 },
 series: [{
   'name':'Jumlah Penduduk <?= $row_name ?>',
   'data':[
    <?php 
      $i=1;
      foreach ($get_row->result() as $row) : ?>
         ['<?= $row_name ?> <?= $rowvalue[$i] ?> Laki-Laki',<?= $jumlah_row_laki[$i] ?>],
         ['<?= $row_name ?> <?= $rowvalue[$i] ?> Perempuan',<?= $jumlah_row_perempuan[$i] ?>],
    <?php 
      $i++;
      endforeach;
    ?>
   ]
 }]
});

</script>
