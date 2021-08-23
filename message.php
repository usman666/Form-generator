<?php
    session_start();

    if(!isset($_SESSION["title"]) || !isset($_SESSION["amntFields"])) {
        header("location:index.php");
    }

    if(isset($_GET["insert"])) {
        $message = $_GET["insert"];
        $class = "";

        if($message == "ok") {
            $message = "Your form has been created, click on button to see it!";
            $class = "success";
        } else {
            $message = "Try again, your form could not be created";
            $class = "danger";
        }
    } else {
        header("location:index.php");
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
            <div class="col-8 text-center">
                <h3 class="text-<?php if(isset($class)) echo $class; ?>"><?php if(isset($message)) echo $message; ?></h3>
                <div class="text-center" style="margin-top:1rem;">
                    <a href="forms.php" class="btn btn-<?php if(isset($class)) echo $class; ?>">See Forms</a>
                </div>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>