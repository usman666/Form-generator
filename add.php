<?php
    session_start();

    if(isset($_POST['sbmt'])) {
        extract($_POST);

        $err = "";

        if(empty($title)) {
            $err = "Enter form title<br>";
        }
        if(empty($numFields)) {
            $err .= "Enter amount of fields";
        }

        if(!$err) {
            $_SESSION["title"] = $title;
            $_SESSION["amntFields"] = $numFields;
            header("location:specifications.php");
        }
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
        <div class="row align-items-center justify-content-center">
            <div class="col-8">
                <form class="firstForm" method="post">
                    <div class="form-group">
                        <label for="title">Form Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Number of Fields</label>
                        <input type="number" min="1" class="form-control" id="exampleInputPassword1" name="numFields" placeholder="Enter number of fields...">
                    </div>

                    <div class="form-group">
                        <p class="text-danger" style="text-align:center;"><?php if(isset($err)) echo $err;  ?></p>
                    </div>

                    <div style="text-align:center;">
                        <button type="submit" class="btn btn-primary" name="sbmt">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>