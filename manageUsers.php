<?php
session_start();
if(!$_SESSION['username'])
{
    header("location:adminLogin.php");
}


include('dashboardHeader.php');
include ('config.php');


$query = "SELECT  * FROM users";
$statement = $pdo->prepare($query);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

?>



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Posts Table</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Post Id </th>
                        <th>Writer Name</th>
                        <th>Title</th>
                        <th>Tag</th>
                        <th>Post Body</th>
                        <th>Created Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user): ?>

                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['name'] ?></td>
                            <td><?php  echo $user['username'];?></td>
                            <td><?php echo $user['email']; ?></td>

                            <td>
                                <a href="deleteUserFromAdmin.php?id=<?php echo $user[id]; ?>" class="btn btn-danger" >
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

    </body>
    </html>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );

    </script>

<?php
