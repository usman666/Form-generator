<?php
    session_start();

    $conn= mysqli_connect("eu-cdbr-west-01.cleardb.com","b53e8aca15beb0","bc48f174","heroku_8c0948aa4569c5c");


    if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $attrs = "";
            $attrsArr = [];

            $sql = "SELECT * FROM forms INNER JOIN fields
                    ON forms.id = fields.formId
                    INNER JOIN attributes ON fields.id = attributes.fieldId
                    WHERE forms.id = '$id'
                    ORDER BY fieldId";
        
            $res = mysqli_query($conn, $sql);

        
            if($res) {
                $forms = mysqli_fetch_all($res, MYSQLI_ASSOC);
                $previous = $forms[0]["fieldId"];
                $current = 0;
                $i = 0;
    
                foreach($forms as $row) {
                    $current = $row['fieldId'];
                    if($previous != $current) {
                        $i++;
                        $attrs= <<<EOF
                        {$row["attribute"]}="{$row["value"]}" 
EOF;
                        $attrsArr[$i] = $attrs; 
                    } else {
                        $attrs.= <<<EOF
                        {$row["attribute"]}="{$row["value"]}" 
EOF;
                        $attrsArr[$i] = $attrs; 
                    }

                    $previous = $row['fieldId'];
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
</head>
<body>
    <div class="container align-items-center">
        <div class="row justify-content-center" style="margin-top:1.5rem;">
            <div class="col-8">
            <h2><?php echo $forms[0]["title"]; ?></h2>
            <form class="firstForm" method="post">

                <?php 
                    $fieldArr = []; 
                    $j = 0;
                ?>
                <?php foreach($forms as $field) : ?>
                    <?php if(!in_array($field['fieldId'], $fieldArr)) :  ?>
                        <?php  
                            array_push($fieldArr, $field['fieldId']);
                        ?>
                        <div class="form-group">
                            <label for="title"><?php echo $field["label"]; ?></label>
                            <input type="<?php echo $field["type"]; ?>" class="form-control"
                            <?php echo $attrsArr[$j]; ?> />
                         </div>
                         <?php $j++; ?>
                    <?php endif; ?>
                <?php endforeach; ?> 

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