<select class="form-control select2" onchange="document.getElementById('alamatClient')
.value=this.options[this.selectedIndex].
getAttribute('alamatClient')">

    <?php foreach ($client as $client) : ?>
        <option value="<?= $client->user_id ?>" data-alamat="<?= $client->alamat ?>" data-telp="<?= $client->telp ?>">
            <?= $client->fullname ?>
        </option>
    <?php endforeach; ?>

</select>