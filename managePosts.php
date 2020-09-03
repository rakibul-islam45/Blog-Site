<?php
include('dashboardHeader.php');
include ('config.php');

$query = "SELECT  users.name, post.postId, post.titile, post.tag,post.body,post.created 
FROM users,post 
WHERE  users.id=post.userId";
$statement = $pdo->prepare($query);
$statement->execute();
$posts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>


<title>Admin | posts</title>
</head>
<body>
<div class="header">
    <div class="logo">
            <h1 style="text-align: center">Welcome to - posts</h1>
        </a>
    </div>

</div>


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
                </tr>
                </thead>
                <tbody>
                <?php foreach ($posts as $post): ?>

                <tr>
                    <td><?php echo $post['postId']; ?></td>
                    <td><?php echo $post['name'] ?></td>
                    <td><?php  echo $post['titile'];?></td>
                    <td><?php echo $post['tag']; ?></td>
                    <td><?php echo $post['body']; ?></td>
                    <td><?php echo $post['created']; ?></td>
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

