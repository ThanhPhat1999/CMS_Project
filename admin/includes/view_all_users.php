<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>UserName</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Image</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
                            $query = "SELECT * FROM users";
                            $select_all_users_query = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($select_all_users_query)){
                                $user_id = $row['user_id'];
                                $username = $row['username'];
                                $user_firstname = $row['user_firstname'];
                                $user_lastname = $row['user_lastname'];
                                $user_email = $row['user_email'];
                                $user_image = $row['user_image'];
                                $user_role = $row['user_role'];
                                echo "<tr>";
                                echo "<td>{$user_id}</td>";
                                echo "<td>{$username}</td>";
                                echo "<td>{$user_firstname}</td>";
                                echo "<td>{$user_lastname}</td>";
                                echo "<td>{$user_email}</td>";
                                echo "<td>{$user_role}</td>";
                                echo "<td>{$user_image}</td>";
                                echo "<td><a href = 'users.php?source=edit_user&p_id={$user_id}'>Edit</a></td>";
                                echo "<td><a href = 'users.php?delete={$user_id}'>Delete</a></td>";
                                echo "</tr>";
                            }
                        ?>
        <?php
            if(isset($_GET['delete']))
            {
                $the_post_id = $_GET['delete'];

                $query = "DELETE FROM posts WHERE post_id = {$post_id}";

                $delete_post_query = mysqli_query($connection, $query);

                comfirmQuery($delete_post_query);

                header("Location: posts.php");
            }
        
        
        
        
        
        ?>
    </tbody>
</table>