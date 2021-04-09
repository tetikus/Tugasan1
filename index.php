<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Student Registration</title>
</head>

<body>
    <h2>Student Registration Detail</h2>
    <?php require_once 'process.php'; ?>

    <?php

    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>

    <?php
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } ?>

    <div class="main-kotak">
        <fieldset>
            <table class="kotak">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Club</th>
                    </tr>
                </thead>

                <?php
                while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td class="data-content"> <?php echo $row['fullname']; ?></td>
                        <td class="data-content"> <?php echo $row['gender']; ?></td>
                        <td class="data-content"> <?php echo $row['class']; ?></td>
                        <td class="data-content"> <?php echo $row['club']; ?></td>
                        <td>
                            <a href="process.php?delete= <?php echo $row['id']; ?>" class="butang">Delete</a>
                            <a href="index.php?edit= <?php echo $row['id']; ?>" class="butang">Edit</a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </table>
        </fieldset>
    </div>

    <?php
    function pre_r($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
    ?>
    <form action="process.php" method="POST" class="formBody">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="fullname">Student Name: </label>
        <input type="text" name="fullname" value="<?php echo $fullname; ?>" id="fullname" placeholder="Insert Student Name">
        <label for="gender">Gender: </label>
        <input type="text" name="gender" value="<?php echo $gender; ?>" id="gender" placeholder="Insert Student Gender">
        <label for="class">Class: </label>
        <input type="text" name="class" value="<?php echo $class; ?>" id="class" placeholder="Insert Student Class">
        <label for="club">Club: </label>
        <input type="text" name="club" value="<?php echo $club; ?>" id="club" placeholder="Insert Student Club">

        <?php
        if ($update == true) :
        ?>
            <button type="submit" name="update" class="hantar">Update</button>
        <?php else : ?>
            <button type="submit" name="submit" class="hantar">Submit</button>
        <?php endif; ?>


    </form>
</body>

</html>