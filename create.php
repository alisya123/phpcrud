<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id_jadwal = isset($_POST['id_jadwal']) && !empty($_POST['id_jadwal']) && $_POST['id_jadwal'] != 'auto' ? $_POST['id_jadwal'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $kode_guru = isset($_POST['kode_guru']) ? $_POST['kode_guru'] : '';
    $nama_guru = isset($_POST['nama_guru']) ? $_POST['nama_guru'] : '';
    $hari = isset($_POST['hari']) ? $_POST['hari'] : '';
    $mapel = isset($_POST['mapel']) ? $_POST['mapel'] : '';
    $waktu = isset($_POST['waktu']) ? $_POST['waktu'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO sebelas11 VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id_jadwal, $kode_guru, $nama_guru, $hari, $mapel, $waktu]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Jadwal</h2>
    <form action="create.php" method="post">
        <label for="id_jadwal">ID</label>
        <label for="kode_guru">Kode guru</label>
        <input type="text" name="id_jadwal" value="auto" id="id_jadwal">
        <input type="text" name="kode_guru" id="kode_guru">
        <label for="nama_guru">Nama guru</label>
        <label for="hari">Hari</label>
        <input type="text" name="nama_guru" id="nama_guru">
        <input type="text" name="hari" id="hari">
        <label for="mapel">Mapel</label>
        <label for="waktu">Waktu</label>
        <input type="text" name="mapel" id="mapel">
        <input type="text" name="waktu" id="waktu">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>