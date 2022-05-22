<?php
require_once "functions.php";
$pdo = connection_sql();

    if (!empty($_POST)) {     
                       
        $id = ($_POST['id']) ?? NULL;
        $machine = ($_POST['machine']) ?? '';    
        $part = ($_POST['part']) ?? '';
        $quantity = ($_POST['quantity']) ?? '';
        $whorder = ($_POST['whorder']) ?? '';
        $created = ($_POST['created']) ?? date('Y-m-d H:i:s');
        $status = ($_POST['status']) ?? '';
        $db = $pdo->prepare('UPDATE orders SET id = ?, machine = ?, part = ?, quantity = ?, whorder = ?, created = ?, status = ? WHERE id = ?');
        $db->execute([$id, $machine, $part, $quantity, $whorder, $created, $status, $_GET['id']]);  
        $message_output = 'Order confirmed';
        header('Location: index.php'); 
    }
    
    $update_db = ('SELECT * FROM orders WHERE id = ?'); 
    $db = $pdo->prepare($update_db);  
    $db->execute([$_GET['id']]);                            
    $contact = $db->fetch(PDO::FETCH_ASSOC);               
    
?>

<?=template('done')?>

<head>
<link rel="stylesheet" href="style.css">
<div class="content read">
<div class="content update">
    
    <form action="done.php?id=<?=$contact['id']?>" method="post">
    
        <input type="hidden" name="id" placeholder="1" value="<?=$contact['id']?>" id="id" readonly>
        <input type="hidden" name="machine" placeholder="John Doe" value="<?=$contact['machine']?>" id="machine">
        <input type="hidden" name="part" placeholder="johndoe@example.com" value="<?=$contact['part']?>" id="part">
        <input type="hidden" name="quantity" placeholder="2025550143" value="<?=$contact['quantity']?>" id="quantity">
        <input type="hidden" name="whorder" placeholder="Employee" value="<?=$contact['whorder']?>" id="whorder">
        <input type="hidden" name="created" value="<?=date('Y-m-d\TH:i', strtotime($contact['created']))?>" id="created">
        <input type="hidden" name="status"  value="ordered" id="id" readonly>
        <input type="submit" value="Confirm if ordered">&nbsp
        <a href="index.php" class="create-contact">If no come back to list of orders</a>&nbsp
    </form>
    
    <?php 
    echo  (!empty($message_output)) ? $message_output : ''  ;                    
    ?>

</div>
</div>
</head>

