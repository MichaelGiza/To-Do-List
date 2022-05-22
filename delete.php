<?php
require_once "functions.php";
$pdo = connection_sql();

    $delete_from_db = ('SELECT * FROM orders WHERE id = ?'); 
    $db = $pdo->prepare($delete_from_db);  
    $db->execute([$_GET['id']]);                           
    $contact = $db->fetch(PDO::FETCH_ASSOC);               
    
   
    if (isset($_GET['confirm'])) {                         
        if ($_GET['confirm'] == 'yes') {
            $db = $pdo->prepare('DELETE FROM orders WHERE id = ?'); 
            $db->execute([$_GET['id']]);
            $message_output = 'Deleted!';
            echo $message_output;
            header('Location: index.php'); 
        } else {
            header('Location: index.php');                        
        }
    }

?>

<?=template('Delete')?>

<div class="content delete">
	<p>Confirm your choice!</p>  
    <div class="confirm">
        <a href="delete.php?id=<?=$contact['id']?>&confirm=yes">Yes</a>      
        <a href="delete.php?id=<?=$contact['id']?>&confirm=no">No</a>
        
    </div>
</div>



