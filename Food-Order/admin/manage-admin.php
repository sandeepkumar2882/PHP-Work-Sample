<?php include('./partials/menu.php'); ?>
<script type="text/javascript" src="./js/confirm.js" defer></script>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>

        <?php
        if (isset($_SESSION['insert'])) {
            echo $_SESSION['insert']; //Display Session Message
            unset($_SESSION['insert']); //Remove Session Message
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; //Display Session Message
            unset($_SESSION['delete']); //Remove Session Message
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update']; //Display Session Message
            unset($_SESSION['update']); //Remove Session Message
        }

        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found']; //Display Session Message
            unset($_SESSION['user-not-found']); //Remove Session Message
        }
        ?>
        <br><br>

        <a href="add-admin.php" class="btn-primary">Add Admin</a>

        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            //Query to get all admins
            $sql = "SELECT * FROM tbl_admin";

            // Execute the query
            $result = $connection->query($sql);

            //Check the query
            if ($result == true) {
                $count = mysqli_num_rows($result);

                //Check the number of rows
                if ($count > 0) {
                    //We have data in db
                    while ($rows = mysqli_fetch_assoc($result)) {
                        //Using while loop to get all the data from db
                        //while loop will run as long as we have data in db

                        //Get indivisual data
                        $id = $rows['id'];
                        $fullName = $rows['full_name'];
                        $userName = $rows['user_name'];

                        //Display the values in our HTML table
            ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $fullName; ?></td>
                            <td><?php echo $userName; ?></td>
                            <td>
                                <a href="<?php echo SITEURL ?>/admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <a href="#" onclick="deleteUser(<?php echo $id; ?>)" class="btn-danger">Delete Admin</a>
                                <a href="<?php echo SITEURL ?>/admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Update Password</a>
                            </td>
                        </tr>
            <?php
                    }
                }
            } else {
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>