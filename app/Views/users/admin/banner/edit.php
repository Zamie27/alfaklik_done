<?= $this->extend('users/admin/template/index'); ?>

<?= $this->section('content'); ?>
<div class="container my-5">
    <h2 class="mb-4">Edit Banner</h2>
    <form action="<?= base_url('/admin/dashboard/banner/update/' . $banner['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="banner_image" class="form-label">Gambar Banner</label>
            <input type="file" name="banner_image" id="banner_image" class="form-control" accept="image/*">
            <small>Gambar saat ini:</small>
            <img src="<?= base_url('public/' . $banner['image_path']) ?>" alt="Banner" width="100" class="d-block mt-2">
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" rows="4"><?= $banner['keterangan'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('/admin/dashboard/banner') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection(); ?>