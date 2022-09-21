<div class="form-group">
    <label>Periode</label>
    <select class="custom-select rounded-0" name="periode" id="periode" required="required">
        <option value="">--Pilih Salah Satu---</option>
        <?php

        $data_periode = mysqli_query($koneksi, " SELECT * from periode
                                            ");
        while ($rows = mysqli_fetch_array($data_periode)) {
        ?>
            <option value="<?php echo $rows['id_periode']; ?>" <?= $barisbobot['id_periode'] == $rows['id_periode'] ? 'selected' : ''; ?>><?php echo $rows['nama_periode']; ?></option>
        <?php
        }
        ?>
    </select>
</div>