<?php
    session_start();

    $conn= mysqli_connect("eu-cdbr-west-01.cleardb.com","b53e8aca15beb0","bc48f174");

    $sql = "SELECT * FROM forms";

    $res = mysqli_query($conn, $sql);

    if($res) {
        $forms = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Generator</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container align-items-center">
        <div class="row justify-content-center" style="margin-top:1.5rem;">
            <div class="col-8">
            <h2>Forms</h2>
            <table class="table" id="forms">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Fields</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach($forms as $val) : ?>
                    <?php $i++; ?>
                            <tr>
                                <th scope="row"><?php echo $i; ?></th>
                                <td><?php echo $val["title"]; ?></td>
                                <td><?php echo $val["fields"]; ?></td>
                                <td><a href="form.php?id=<?php echo $val["id"]; ?>" class="btn btn-warning">See Form</a></td>
                            </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>