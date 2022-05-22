<?php
include 'functions.php';
$pdo = connection_sql();
if (!empty($_POST)) {
    $id = ($_POST['id']) ?? NULL;
    $machine = ($_POST['machine']) ?? '';    
    $part = ($_POST['part']) ?? '';
    $quantity = ($_POST['quantity']) ?? '';
    $whorder = ($_POST['whorder']) ?? '';
    $created = ($_POST['created']) ?? date('Y-m-d H:i:s');
    $status = ($_POST['status']) ?? '';
    $insert_to_db = 'INSERT INTO orders VALUES (?, ?, ?, ?, ?, ?, ?)';     
    $db = $pdo->prepare($insert_to_db);
    $db->execute([$id, $machine, $part, $quantity, $whorder, $created, $status]);      
    $message_output = 'Order created';                                      
}
?>

<?=template('create')?>       

<head>
<link rel="stylesheet" href="style.css">
<div class="content read">
<div class="content update">
	<h2>Create new order:</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="machine">Machine</label>         
        <input type="text" name="id" value="auto" id="id" readonly>
        <input type="text" name="machine" id="machine">
        <label for="part">Part</label>         
        <label for="quantity">Quantity</label>       
        <input type="text" name="part" id="part">   
        <input type="text" name="quantity" id="quantity">
        <label for="whorder">Who order</label>          
        <label for="created">Creation date:</label>
        <input type="text" name="whorder"  id="whorder">
        <input type="datetime-local" name="created" value="<?=date('Y-m-d\TH:i')?>" id="created">
        <input type="submit" value="Create"> 
        <a href="index.php" class="create-contact">Come back to list of orders</a>
    </form>

    <?php 
    echo  (!empty($message_output)) ? $message_output : ''  ;                    
    ?>

</div>
</div>
</head>
