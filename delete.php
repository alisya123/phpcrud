<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id_jadwal'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM sebelas11 WHERE id_jadwal = ?');
    $stmt->execute([$_GET['id_jadwal']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM sebelas11 WHERE id_jadwal = ?');
            $stmt->execute([$_GET['id_jadwal']]);
            $msg = 'You have deleted the contact!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Jadwal #<?=$contact['id_jadwal']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete contact #<?=$contact['id_jadwal']?>?</p>
    <div class="yesno">
        <a href="delete.php?id_jadwal=<?=$contact['id_jadwal']?>&confirm=yes">Yes</a>
        <a href="delete.php?id_jadwal=<?=$contact['id_jadwal']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>