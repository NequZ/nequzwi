<?php include 'config.php'; ?>

<?php
$q = $_GET['q'];

$smt = $db->prepare("SELECT * FROM `user` RIGHT JOIN `user_informations` USING (`username`) WHERE `user`.`username` LIKE :username");
$str = "%" . $q . "%";
$smt->bindParam(':username', $str);
$smt->execute();
$users = $smt->fetchAll();

foreach ($users as $user) : ?>
    <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['password']; ?></td>
        <td>
            <?php if ($user['logedin']) : ?>
                <span class="badge badge-danger"><?php echo $user['lastlogin']; ?></span>
            <?php else : ?>
                <span class="badge badge-success"><?php echo $user['lastlogin']; ?></span>
            <?php endif; ?>
        </td>
        <td><?php echo $user['rank']; ?></td>
        <td><?php echo $user['firstname']; ?></td>
        <td><?php echo $user['lastname']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['zip_code']; ?></td>
        <td><?php echo $user['city']; ?></td>
        <td><?php echo $user['county']; ?></td>
        <td><?php echo $user['adress']; ?></td>

        <td><a href="admin_edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">Manage</a></td>
    </tr>
<?php endforeach;