<form class="form-horizontal form-label-left" id="formkriteria" >
    <input type="hidden" name="idsekolah" id="idsekolah" value="<?php echo $idsekolah; ?>" />
    <?php if ($kriteria->num_rows > 0): ?>
        <?php foreach ($kriteria->result() as $r): ?>
            <div class="form-group">
                <label for="kategori_<?php echo $r->kriteria_id; ?>" class="control-label col-md-3 col-sm-3 col-xs-12">
                    <?php echo $r->kriteria_nama; ?>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" multiple name="kategori_<?php echo $r->kriteria_id; ?>[]" id="kategori_<?php echo $r->kriteria_id; ?>" required>
                        <!-- <option value="0">Pilih Detail Kategori</option> -->
                        <?php if ($detailkriteria->num_rows > 0): ?>
                            <?php foreach ($detailkriteria->result() as $k): ?>
                                <?php if ($k->detail_kriteria_parent == 0 && $k->detail_kriteria_id_kriteria == $r->kriteria_id): ?>
                                    <optgroup label="<?php echo $k->detail_kriteria_nama; ?>"></optgroup>
                                    <?php foreach ($detailkriteria->result() as $j): ?>
                                        <?php if ($j->detail_kriteria_parent == $k->detail_kriteria_id): ?>
                                            <option <?php echo ($j->selected) ? 'selected' : ''; ?> value="<?php echo $j->detail_kriteria_id; ?>"><?php echo $j->detail_kriteria_nama; ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php elseif ($k->detail_kriteria_parent == -1 && $k->detail_kriteria_id_kriteria == $r->kriteria_id) : ?>
                                    <option <?php echo ($k->selected) ? 'selected' : ''; ?> value="<?php echo $k->detail_kriteria_id; ?>"><?php echo $k->detail_kriteria_nama; ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php endif ?>
                    </select>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button class="btn btn-success" type="submit">Simpan</button>
            <button class="btn btn-primary" id="btntutupformkriteria">Batal</button>
        </div>
    </div>

</form>
<script type="text/javascript">
    $("#btntutupformkriteria").click(function(e) {
        e.preventDefault();
        $("#contentkriteria").slideUp(400);
    });

    $("#formkriteria").submit(function(event) {
        event.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: '<?php echo base_url(); ?>sekolah/index/insertkriteria',
            type: 'POST',
            dataType: 'json',
            data: data,
        })
        .done(function(response) {
            if(response.status){
                NotifikasiToast({
                    type : 'success', // ini tipe notifikasi success,warning,info,error
                    msg : response.message, //ini isi pesan
                    title : '', //ini judul pesan
                });
                $("#btntutupformkriteria").click();
            }
            else{
                NotifikasiToast({
                    type : 'error', // ini tipe notifikasi success,warning,info,error
                    msg : response.message, //ini isi pesan
                    title : '', //ini judul pesan
                });
            }
        })
        .fail(function() {
            NotifikasiToast({
                type : 'error', // ini tipe notifikasi success,warning,info,error
                msg : 'Network Error', //ini isi pesan
                title : '', //ini judul pesan
            });
        })
        .always(function() {
            console.log("complete");
        });
        
        return false;
    });
</script>