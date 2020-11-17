<table class="table table-bordered table-hover">
                    <thead>
                    <tr>                    
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
$query = "SELECT * FROM users ORDER BY user_id DESC";
$select_all_users_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_all_users_query)){
$user_id = $row['user_id'];
$username = $row['username'];
$name = $row['user_firstname'] . " " . $row['user_lastname'];
$user_email = $row['user_email'];
$user_role = $row['user_role'];
$user_image = $row['user_image'];

echo "<tr>";
echo "<td>$username</td>";
echo "<td>$name</td>";
echo "<td>$user_email</td>";
echo "<td>$user_role</td>";
echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'>Edit</a>
<br><a onClick=\"javascript: return confirm('Are you sure want to delete?'); \" href='users.php?delete={$user_id}'>Delete</a></td>";
echo "</tr>";
}
?>
                    </tbody>
                    </table>

<?php 
if(isset($_GET['delete'])){
$delete_user_id = $_GET['delete'];
$query = "DELETE FROM users WHERE user_id = {$delete_user_id}";
$delete_query = mysqli_query($connection, $query);
header("Location: users.php");
}
?>