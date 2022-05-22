<?php
require_once "functions.php";
$pdo = connection_sql();
$db = $pdo->prepare('SELECT * FROM orders ORDER BY id');
$db->execute();
$result_db = $db->fetchAll(PDO::FETCH_ASSOC);     
 
?>

<?=template('read')?>

<head>
<link rel="stylesheet" href="style.css">
<div class="content read">
	<br>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Machine</td>
                <td>Part</td>
                <td>Quantity</td>
                <td>Who order</td>
                <td>Order creation date</td>
                <td>Order status</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php 
            $count = 1;
            foreach ($result_db as $variable_db): ?> 
            <tr>
                <td><?php echo $count++?></td>
                <td><?=$variable_db['machine']?></td>    
                <td><?=$variable_db['part']?></td>   
                <td><?=$variable_db['quantity']?></td>  
                <td><?=$variable_db['whorder']?></td>   
                <td><?=$variable_db['created']?></td>
                <td><?=$variable_db['status']?></td>

                <td class="actions">
                    <a href="done.php?id=<?=$variable_db['id']?>" class="done">Confirm order</a>
                    <a href="update.php?id=<?=$variable_db['id']?>" class="edit"> Edit</a>
                    <a href="delete.php?id=<?=$variable_db['id']?>" class="trash">Delete</a> 
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="create.php" class="create-contact">Create new order</a>
	</div>
</div>
</head>
