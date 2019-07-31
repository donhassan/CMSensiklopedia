<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Ensiklopedia</h4>
            <form class="form-material m-t-40" method="post" action="<?php echo base_url().$action ?>">
	  <div class="form-group">
            <label>Nama</label>
            <input type="text" name="Nama" class="form-control" placeholder="">
    </div>
	  <div class="form-group">
            <label>Kategori</label>
            <input type="text" name="Kategori" class="form-control" placeholder="">
    </div>
	  <div class="form-group">
            <label>Deskripsi</label>
            <input type="text" name="Deskripsi" class="form-control" placeholder="">
    </div>
	    <input type="hidden" name="ID" /> 
	
                <div class="form-group">
                  <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
