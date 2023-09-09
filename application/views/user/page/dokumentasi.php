<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="row">

    <!-- DataTales Example -->
    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-book fa-fw"></i> Dokumentasi API</h6>
        </div>
        <div class="card-body">
        <?= $this->session->flashdata('message') ?>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              
              <tbody>
                <tr>
                  <td width="500px">METODE HTTP</td>
                  <td>POST</td>
                </tr>
                <tr>
                  <td>API URL</td>
                  <td><?= base_url(); ?>api</td>
                </tr>
                <tr>
                  <td>API ID</td>
                  <td><?= $user['api_id'] ?></td>
                </tr>
                <tr>
                  <td>API KEY</td>
                  <td>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="text" class="form-control" value="<?= $user['api_key'] ?>" disabled>
                      </div>
                      <div class="input-group-append">
                        <a href="<?= base_url('dashboard/ubah_api_key') ?>"><button class="btn btn-outline-primary" type="button"><i class="fa fa-redo"></i> Ubah</button></a>
                      </div>
                    </div>

                  </td>
                </tr>
                <tr>
                  <td>FORMAT RESPON</td>
                  <td>JSON</td>
                </tr>
              </tbody>
              
            </table>
          </div>

        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card shadow mb-4">
        <div class="card-body">

        <ul class="nav nav-pills flex-column flex-sm-row mb-3" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button style="border:aqua;margin-right:20px;" class="nav-link active" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
          </li>
          <li class="nav-item" role="presentation">
            <button style="border:aqua;margin-right:20px;" class="nav-link" id="pills-layanan-tab" data-toggle="pill" data-target="#pills-layanan" type="button" role="tab" aria-controls="pills-layanan" aria-selected="true">Layanan</button>
          </li>
          <li class="nav-item" role="presentation">
            <button style="border:aqua;margin-right:20px;" class="nav-link" id="pills-order-tab" data-toggle="pill" data-target="#pills-order" type="button" role="tab" aria-controls="pills-order" aria-selected="false">Pemesanan</button>
          </li>
          <li class="nav-item" role="presentation">
            <button style="border:aqua;margin-right:20px;" class="nav-link" id="pills-status-tab" data-toggle="pill" data-target="#pills-status" type="button" role="tab" aria-controls="pills-status" aria-selected="false">Status Pesanan</button>
          </li>
        </ul>
        
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <b>URL Prmintaan :</b>
            <div class="alert alert-secondary">
              <?php echo base_url(); ?>api/profile
            </div>
            <b>Parameter :</b>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <tbody>
                <tr>
                  <td width="500px">api_id</td>
                  <td>API ID Anda.</td>
                </tr>
                <tr>
                  <td width="500px">api_key</td>
                  <td>API KEY Anda.</td>
                </tr>
              </tbody>
            </table>

            <b>Contoh Respon :</b>
            <div class="alert alert-secondary">
              <pre>
Sukses
{
  "status": true,
  "data": {
    "username": "smm",
    "full_name": "SMM PANEL",
    "balance": 100900
  }
}

Gagal
{
  "status": false,
  "data": "API Key salah"
}
              </pre>
            </div>
          </div>

          <div class="tab-pane fade" id="pills-layanan" role="tabpanel" aria-labelledby="pills-layanan-tab">
            <b>URL Prmintaan :</b>
            <div class="alert alert-secondary">
              <?php echo base_url(); ?>api/services
            </div>
            <b>Parameter :</b>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <tbody>
                <tr>
                  <td width="500px">api_id</td>
                  <td>API ID Anda.</td>
                </tr>
                <tr>
                  <td width="500px">api_key</td>
                  <td>API KEY Anda.</td>
                </tr>
              </tbody>
            </table>

            <b>Contoh Respon :</b>
            <div class="alert alert-secondary">
              <pre>
Sukses
{
	"status": true,
	"data": [
		{
			"id": "1",
			"category": "Instagram Followers",
			"name": "Instagram Followers S1",
			"price": "10000",
			"min": "100",
			"max": "10000",
			"description": "Super Fast, Input Username",
			"type": "primary",
			"refill": 1 (Jika 1 = true),
			"masa_refill": 30,
			"average_time": "jumlah pesan rata rata 580 waktu proses 1 jam 13 menit.",
		},
		{
			"id": "2",
			"category": "Instagram Likes",
			"name": "Instagram Likes S1",
			"price": "5000",
			"min": "100",
			"max": "10000",
			"description": "Super Fast, Input Post Url",
			"type": "custom_comments",
			"refill": 0 (Jika 0 = false),
			"masa_refill": null,
			"average_time": "jumlah pesan rata rata 580 waktu proses 1 jam 13 menit.",
		},
		{
			"id": "3",
			"category": "Instagram Likes",
			"name": "Instagram Views S1",
			"price": "100",
			"min": "100",
			"max": "10000",
			"description": "Super Fast, Input Post Url",
			"type": "custom_link",
			"refill": 1 (Jika 1 = true),
			"masa_refill": 0 ,
			"average_time": "jumlah pesan rata rata 580 waktu proses 1 jam 13 menit.",
		},
	]
}

Gagal
{
	"status": false,
	"data": "API Key salah"
}
              </pre>
            </div>
          </div>

          <div class="tab-pane fade" id="pills-order" role="tabpanel" aria-labelledby="pills-order-tab">
            <b>URL Prmintaan :</b>
            <div class="alert alert-secondary">
              <?php echo base_url(); ?>api/order
            </div>
            <b>Parameter :</b>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <tbody>
                <tr>
                  <td width="500px">api_id</td>
                  <td>API ID Anda.</td>
                </tr>
                <tr>
                  <td width="500px">api_key</td>
                  <td>API KEY Anda.</td>
                </tr>
                <tr>
                  <td width="500px">service</td>
                  <td>ID Layanan, lihat di <a target="_blank" href="<?= base_url('dashboard/daftar_harga') ?>">Daftar Layanan</a>.</td>
                </tr>
                <tr>
                  <td width="500px">target</td>
                  <td>Target pesanan sesuai kebutuhan (username/url/id).</td>
                </tr>
                <tr>
                  <td width="500px">quantity</td>
                  <td>Jumlah pesanan.</td>
                </tr>
              </tbody>
            </table>

            <b>Contoh Respon :</b>
            <div class="alert alert-secondary">
              <pre>
Sukses
{
	"status": true,
	"data": {
		"id": 1107,
		"price": 10900
	}
}

Gagal
{
	"status": false,
	"data": "API Key salah"
}
              </pre>
            </div>
          </div>
        

          <div class="tab-pane fade" id="pills-status" role="tabpanel" aria-labelledby="pills-status-tab">
            <b>URL Prmintaan :</b>
            <div class="alert alert-secondary">
              <?php echo base_url(); ?>api/status
            </div>
            <b>Parameter :</b>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <tbody>
                <tr>
                  <td width="500px">api_id</td>
                  <td>API ID Anda.</td>
                </tr>
                <tr>
                  <td width="500px">api_key</td>
                  <td>API KEY Anda.</td>
                </tr>
                <tr>
                  <td width="500px">id</td>
                  <td>ID Pesanan.</td>
                </tr>
              </tbody>
            </table>

            <b>Status :</b>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <tbody>
                <tr>
                  <td width="500px">Pending</td>
                  <td>Pesanan dalam antrian.</td>
                </tr>
                <tr>
                  <td width="500px">Processing</td>
                  <td>Pesanan sedang diproses.</td>
                </tr>
                <tr>
                  <td width="500px">Partial</td>
                  <td>Pesanan selesai diproses tetapi tidak sesuai jumlah pesan.</td>
                </tr>
                <tr>
                  <td width="500px">Error</td>
                  <td>Pesanan gagal diproses.</td>
                </tr>
                <tr>
                  <td width="500px">Success</td>
                  <td>Pesanan selesai dan berhasil.</td>
                </tr>
              </tbody>
            </table>

            <b>Contoh Respon :</b>
            <div class="alert alert-secondary">
              <pre>
Sukses
{
	"status": true,
	"data": {
		"id": 558636,
		"status": "Success",
		"start_count": 10900,
		"remains": 0
	}
}

Gagal
{
	"status": false,
	"data": "API Key salah"
}
              </pre>
            </div>
          </div>
        
        </div>

        </div>
      </div>
    </div>


  </div>
</div>
<!-- /.container-fluid -->