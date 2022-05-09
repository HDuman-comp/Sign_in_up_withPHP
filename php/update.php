<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the account id exists, for example update.php?id=1 will get the contact with the id of 1
session_start();
if (isset($_SESSION['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        //$id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE accounts SET  username = ?, email = ?, phone = ? WHERE id = ?');
        $stmt->execute([ $username, $email, $phone, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the account from the account table
    $stmt = $pdo->prepare('SELECT * FROM accounts WHERE id = ?');
 
    $stmt->execute([$_SESSION['id']]);
    $accounts = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$accounts) {
        exit('Account doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
	<h2>Update Account #<?=$accounts['username']?></h2>
    <form action="update.php?id=<?=$accounts['id']?>" method="post">
        
        <label for="name">Name:</label>
        
        <input type="text" name="username" placeholder="John Doe" value="<?=$accounts['username']?>" id="name">
        <label for="email">Email:</label>
        <input type="text" name="email" placeholder="johndoe@example.com" value="<?=$accounts['email']?>" id="email">
        <label for="phone">Phone:</label>
       
        <input type="text" name="phone" placeholder="2025550143" value="<?=$accounts['phone']?>" id="phone">

     

        <input type="submit" value="Update">

       
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>