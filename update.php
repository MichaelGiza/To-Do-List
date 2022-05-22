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
        $db = $pdo->prepare('UPDATE orders SET id = ?, machine = ?, part = ?, quantity = ?, whorder = ?, created = ? WHERE id = ?');
        $db->execute([$id, $machine, $part, $quantity, $whorder, $created, $_GET['id']]);  
        $message_output = 'Updated';
        header('Location: index.php'); 
    }
    
    $update_db = ('SELECT * FROM orders WHERE id = ?'); 
    $db = $pdo->prepare($update_db);  
    $db->execute([$_GET['id']]);                            
    $result_db = $db->fetch(PDO::FETCH_ASSOC);                
    
?>

<?=template('update')?>
<head>
<link rel="stylesheet" href="style.css">
<div class="content read">
<div class="content update">
<h2>Update order:</h2>
    
    <form action="update.php?id=<?=$result_db['id']?>" method="post">
        <label for="id">ID</label>
        <label for="machine">Machine</label>
        <input type="text" name="id" value="<?=$result_db['id']?>" id="id" readonly>
        <input type="text" name="machine" value="<?=$result_db['machine']?>" id="machine">
        <label for="part">Part</label>
        <label for="quantity">Quantity[pcs]</label>
        <input type="text" name="part" value="<?=$result_db['part']?>" id="part">
        <input type="text" name="quantity"  value="<?=$result_db['quantity']?>" id="quantity">
        <label for="whorder">Who order</label>
        <label for="created">Order creation date</label>
        <input type="text" name="whorder" value="<?=$result_db['whorder']?>" id="whorder">
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i', strtotime($result_db['created']))?>" id="created" readonly>
        <input type="submit" value="Update">
        <a href="index.php" class="create-contact" >Come back to list of orders</a>
    </form>
</div>
</div>
</head>

