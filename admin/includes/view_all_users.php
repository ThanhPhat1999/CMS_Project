<div class="table-responsive">
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>UserName</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Admin</th>
            <th>Subscriber</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
                            $query = "SELECT * FROM users";
                            $select_all_users_query = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($select_all_users_query)){
                                $user_id        = $row['user_id'];
                                $username       = $row['username'];
                                $user_firstname = $row['user_firstname'];
                                $user_lastname  = $row['user_lastname'];
                                $user_email     = $row['user_email'];
                                $user_role      = $row['user_role'];
                                
                                echo "<tr>";
                                echo "<td>{$user_id}</td>";
                                echo "<td>{$username}</td>";
                                echo "<td>{$user_firstname}</td>";
                                echo "<td>{$user_lastname}</td>";
                                echo "<td>{$user_email}</td>";
                                echo "<td>{$user_role}</td>";
                                echo "<td><a href = 'users.php?change_to_admin={$user_id}'>Admin</a></td>";
                                echo "<td><a href = 'users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";
                                echo "<td><a href = 'users.php?source=edit_user&p_id={$user_id}'>Edit</a></td>";
                                echo "<td><a onClick = \"javascript: return confirm('Are you sure you want to delete ?');\" href = 'users.php?delete={$user_id}'>Delete</a></td>";
                                echo "</tr>";
                            }
                        ?>
        <?php
            if(isset($_GET['change_to_admin']))
            {
                $the_change_to_admin_id = $_GET['change_to_admin'];

                $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = {$the_change_to_admin_id}";

                $change_to_admin_query = mysqli_query($connection, $query);

                comfirmQuery($change_to_admin_query);

                header("Location: users.php");

            }

            if(isset($_GET['change_to_subscriber']))
            {
                $the_change_to_sub_id = $_GET['change_to_subscriber'];

                $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = {$the_change_to_sub_id}";

                $change_to_sub_query = mysqli_query($connection, $query);

                comfirmQuery($change_to_sub_query);

                header("Location: users.php");

            }

            if(isset($_GET['delete']))
            {
                $the_user_id = $_GET['delete'];

                $query = "DELETE FROM users WHERE user_id = {$the_user_id}";

                $delete_user_query = mysqli_query($connection, $query);

                comfirmQuery($delete_user_query);

                header("Location: users.php");
            }
        ?>
    </tbody>
</table>
</div>