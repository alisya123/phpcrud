<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id_jadwal'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id_jadwal = isset($_POST['id_jadwal']) ? $_POST['id_jadwal'] : NULL;
        $kode_guru = isset($_POST['kode_guru']) ? $_POST['kode_guru'] : '';
        $nama_guru = isset($_POST['nama_guru']) ? $_POST['nama_guru'] : '';
        $hari = isset($_POST['hari']) ? $_POST['hari'] : '';
        $mapel = isset($_POST['mapel']) ? $_POST['mapel'] : '';
        $waktu = isset($_POST['waktu']) ? $_POST['waktu'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE sebelas11 SET id_jadwal = ?, kode_guru = ?, nama_guru = ?, hari = ?, mapel = ?, waktu = ? WHERE id_jadwal = ?');
        $stmt->execute([$id_jadwal, $kode_guru, $nama_guru, $hari, $mapel, $waktu, $_GET['id_jadwal']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM sebelas11 WHERE id_jadwal = ?');
    $stmt->execute([$_GET['id_jadwal']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update Jadwal #<?=$contact['id_jadwal']?></h2>
    <form action="update.php?id_jadwal=<?=$contact['id_jadwal']?>" method="post">
        <label for="id_jadwal">ID</label>
        <label for="kode_guru">Kode guru</label>
        <input type="text" name="id_jadwal" value="<?=$contact['id_jadwal']?>" id="id_jadwal">
        <input type="text" name="kode_guru" value="<?=$contact['kode_guru']?>" id="kode_guru">
        <label for="nama_guru">Nama guru</label>
        <label for="hari">Hari</label>
        <input type="text" name="nama_guru" value="<?=$contact['nama_guru']?>" id="nama_guru">
        <input type="text" name="hari" value="<?=$contact['hari']?>" id="hari">
        <label for="mapel">mapel</label>
        <label for="waktu">Wapel</label>
        <input type="text" name="mapel" value="<?=$contact['mapel']?>" id="mapel">
        <input type="text" name="waktu" value="<?=$contact['waktu']?>" id="waktu">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>