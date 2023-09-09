<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="row">
		<!-- Page Heading -->
		<div class="col-md-12 text-center">
			<h1 class="h4 mb-2 text-gray-800"><i class="fa fa-history"></i> Penggunaan Saldo</h1>
			<!-- Divider -->
			<hr class="sidebar-divider">
		</div>

		<!-- DataTales Example -->
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-body">

					<form style="margin: 20px 0;" action="<?= base_url() . 'dashboard/mutasi'; ?>" method="post">
						<div class="form-row">
							<div class="form-group col-lg-2">
								<label>Tipe Sortir</label>
								<select class="form-control" name="sortir">
									<option value="">Tipe..</option>
									<option value="ASC">ASC</option>
									<option value="DESC">DESC</option>
								</select>
							</div>
							<div class="form-group col-lg-2">
								<label>Kolom Sortir</label>
								<select class="form-control" name="kolom">
									<option value="">Kolom..</option>
									<option value="date">Tanggal &amp; Waktu</option>
									<option value="tipe">Tipe</option>
									<option value="aksi">Aksi</option>
									<option value="nominal">Jumlah</option>
								</select>
							</div>

							<div class="form-group col-lg-2">
								<label>Filter Kategori</label>
								<select class="form-control" name="aksi">
									<option value="">Semua</option>
									<option value="Penambahan Saldo">Penambahan</option>
									<option value="Pengurangan Saldo">Pengurangan</option>

								</select>
							</div>
							<div class="form-group col-lg-2">
								<label>Kolom Cari</label>
								<select class="form-control" name="tipe">
									<option value="">Kolom..</option>
									<option value="Layanan">Layanan</option>
									<option value="Saldo">Saldo</option>
									<option value="Referral">Referral</option>
								</select>
							</div>
							<div class="form-group col-lg-3">
								<label>Submit</label>
								<input class="btn btn-block btn-primary" type="submit" name="filter" value="Filter">
							</div>
						</div>
					</form>

					<div class="table-responsive">
						<table class="table table-bordered" id="myTable">
							<thead>
								<tr>
									<th width="20%">Tanggal &amp; Waktu</th>
									<th>Tipe</th>
									<th>Aksi</th>
									<th width="15%">Jumlah</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($mutasi)) : ?>
									<?php foreach ($mutasi->result() as $a) : ?>
										<tr>
											<td><?= $a->date . ' ' . $a->time ?></td>
											<td> <?php if ($a->tipe  == 'Saldo') : ?>
													<span class="btn btn-success btn-rd5 btn-pill btn-sm disabled" aria-disabled="true"><?= $a->tipe ?></span>
												<?php elseif ($a->tipe  == 'Layanan') : ?>
													<span class="btn btn-warning btn-rd5 btn-pill btn-sm disabled" aria-disabled="true"><?= $a->tipe ?></span>
												<?php elseif ($a->tipe  == 'Referral') : ?>
													<span class="btn btn-secondary btn-rd5 btn-pill btn-sm disabled" aria-disabled="true"><?= $a->tipe ?></span>
												<?php endif ?>
											</td>
											<td> <?php if ($a->aksi  == 'Penambahan Saldo') : ?>
													<span class="btn btn-info btn-rd5 btn-pill btn-sm float-right disabled" aria-disabled="true"><?= $a->aksi ?></span>
												<?php else : ?>
													<span class="btn btn-danger btn-rd5 btn-pill btn-sm float-right disabled" aria-disabled="true"><?= $a->aksi ?></span>
												<?php endif ?>
											</td>
											<td>Rp <?= number_format($a->nominal, 0, ',', '.'); ?></td>
											<td><?= $a->pesan; ?></td>
										</tr>
									<?php endforeach ?>
								<?php else : ?>
									<tr>
										<td colspan='5'>Data tidak ada</td>
									</tr>
								<?php endif ?>
							</tbody>
						</table>

						<div>
							<ul class="pagination pagination-split">
								<li class="page-item disabled" aria-disabled="true">
									<span class="page-link">
										<b>Total data: <?= $total; ?></b>
									</span>
								</li>
								<?php echo $pagination; ?>
							</ul>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>
</div>