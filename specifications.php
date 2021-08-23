<?php
session_start();

    function queryDB($conn, $fields, $attributes, $i, $last_id) {
        $type = $fields[$i][$i]["type"];
        $label = $fields[$i][$i]["label"];
        
        $sql = "INSERT INTO fields(formId, type, label) VALUES('$last_id', '$type', '$label')";

        if(mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
    
            foreach($attributes as $val) {
                $attVal = $fields[$i][$i][$val];
                $sql = "INSERT INTO attributes(fieldId, attribute, value) VALUES('$last_id', '$val', '$attVal')";
                mysqli_query($conn, $sql);
            }  
        }
    }


    if(!isset($_SESSION["title"]) || !isset($_SESSION["amntFields"])) {
        header("location:index.php");
    }

    $conn= mysqli_connect("localhost","root","","formGenerator");

    // Check connection
    if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
    }

    if(isset($_POST['sbmt'])) {
        extract($_POST);

        $title = $_SESSION["title"];
        $amntFields = $_SESSION["amntFields"];
        $fields = [];

        print_r($fields);

        if(!$err) {
            $sql = "INSERT INTO forms(title, fields) VALUES('$title', '$amntFields')";

            if (mysqli_query($conn, $sql)) {

                $last_id = mysqli_insert_id($conn);

                for($i = 0; $i < $amntFields; $i++) {
                    if($_POST[$i] == "date") {
                         $fields[$i] = [ $i => [ "type" => "date", "label" =>  $_POST[$i . "label"], "min" => $_POST[$i . "minDate"],  "max" => $_POST[$i . "maxDate"]] ];
                         queryDB($conn, $fields, ["min", "max"], $i, $last_id);
                    } else if($_POST[$i] == "text") {
                        $fields[$i] = [ $i => [ "type" => "text", "label" =>  $_POST[$i . "label"], "minlength" => $_POST[$i . "minText"],  "maxlength" => $_POST[$i . "maxText"]] ];
                        queryDB($conn, $fields, ["minlength", "maxlength"], $i, $last_id);
                    } else if($_POST[$i] == "password") {
                        $fields[$i] = [ $i => [ "type" => "password", "label" =>  $_POST[$i . "label"], "minlength" => $_POST[$i . "minPass"],  "maxlength" => $_POST[$i . "maxPass"]] ];
                        queryDB($conn, $fields, ["minlength", "maxlength"], $i, $last_id);
                    } else if($_POST[$i] == "number") {
                        $fields[$i] = [ $i => [ "type" => "number", "label" =>  $_POST[$i . "label"], "min" => $_POST[$i . "minNum"],  "max" => $_POST[$i . "maxNum"]] ];
                        queryDB($conn, $fields, ["min", "max"], $i, $last_id);
                    }
                }
                header("location:message.php?insert=ok");
              } else {
                header("location:message.php?insert=no");
              }
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
    <style>
        .form-group {
            border:2px dotted transparent;
            transition: border-color 1s ease; 
        }
    
    </style>
</head>
<body>
    <div class="container align-items-center">
        <div class="row align-items-center justify-content-center">
            <div class="col-8">
                <form class="firstForm" method="post">
                    <?php 
                        for($i = 0; $i < $_SESSION["amntFields"]; $i++) :?>
                    <div class="form-group">
                        <label>Field Type</label>
                        <select class="form-control" name="<?php echo $i; ?>" id="<?php echo $i; ?>">
                            <option value="" hidden></option>
                            <option value="text">Text</option>
                            <option value="number">Number</option>
                            <option value="date">Date</option>
                            <option value="password">Password</option>
                        </select>
                    </div>

                        <?php endfor; ?>

                    <p><?php if(isset($_err)) echo $err;  ?></p>

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
<script>

$("select").change(function(){

    if($(this).val() == "date") {
        $num = $(this).attr("id");
        $attributes = `<div class="form-group">
                        <label>Label</label>
                        <input type="text" class="form-control" name="${$num}label" placeholder="Enter label for field..." required>
                    </div>
        <div class='form-row' style="margin:.6rem 0;">
                <div class='col'>
                    <input type="date" class="form-control" name="${$num}minDate" placeholder="Min" required>
                </div>
                <div class="col">
                    <input type="date" class="form-control" name="${$num}maxDate" placeholder="Max" required>
                </div>
        </div>`;
    } else if($(this).val() == "text") {
        $num = $(this).attr("id");
        $attributes = `<div class="form-group">
                        <label>Label</label>
                        <input type="text" class="form-control" name="${$num}label" placeholder="Enter label for field..." required>
                    </div>
        <div class='form-row' style="margin:.6rem 0;">
                <div class='col'>
                    <input type="number" class="form-control" name="${$num}minText" placeholder="Minlength" required>
                </div>
                <div class="col">
                    <input type="number" class="form-control" name="${$num}maxText" placeholder="Maxlength" required>
                </div>
        </div>`;
    } else if($(this).val() == "password") {
        $num = $(this).attr("id");
        $attributes = `<div class="form-group">
                        <label>Label</label>
                        <input type="text" class="form-control" name="${$num}label" placeholder="Enter label for field..." required>
                    </div>
        <div class='form-row' style="margin:.6rem 0;">
                <div class='col'>
                    <input type="number" class="form-control" name="${$num}minPass" placeholder="Minlength" required>
                </div>
                <div class="col">
                    <input type="number" class="form-control" name="${$num}maxPass" placeholder="Maxlength" required>
                </div>
        </div>`;
    } else if($(this).val() == "number") {
        $num = $(this).attr("id");
        $attributes = `<div class="form-group">
                        <label>Label</label>
                        <input type="text" class="form-control" name="${$num}label" placeholder="Enter label for field..." required>
                    </div>
        <div class='form-row' style="margin:.6rem 0;">
                <div class='col'>
                    <input type="number" class="form-control" name="${$num}minNum" placeholder="Min" required>
                </div>
                <div class="col">
                    <input type="number" class="form-control" name="${$num}maxNum" placeholder="Max" required>
                </div>
        </div>`;
    }
    console.log($(this).nextAll(".form-group", ".form-row"))
    $(this).next(".form-group").remove();
    $(this).next(".form-row").remove();
    $($attributes).insertAfter(this);
    $(this).parent().css({"border-color": "red", "padding": ".5rem"});

});

</script>
</body>
</html>