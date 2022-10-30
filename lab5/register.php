<?php
session_start();
include 'db_connect.php';
// echo isset($_POST['submit']) ? $_POST['email'] : '';
$domain_error = false;
if (isset($_POST['submit'])) {
    $domain = substr($_POST['email'], -10);
    $domain_error = strtolower($domain) != '@dpu.ac.th'; 
    if (!$domain_error) {
        // $sql = "insert into registration";
        // $sql .= "(fname,lname,gender,dob,email,passw) ";
        // $sql .= "values('{$_POST['fname']}',";
        // $sql .= "'{$_POST['lname']}', '{$_POST['gender']}', ";
        // $sql .= "'{$_POST['dob']}', '{$_POST['email']}', ";
        // $sql .= "'".password_hash($_POST['password'], PASSWORD_DEFAULT)."')";
        // // echo $sql;
        $sql = 'insert into registration(fname,lname,gender,dob,email,passw) values(?,?,?,?,?,?) ';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssss',$_POST['fname'],$_POST['lname'],
                $_POST['gender'],$_POST['dob'],$_POST['email'],$password);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);                   
        try {
        // $conn->query($sql);
        $stmt->execute();
        // echo 'Successful registration';
        // unset($_POST['submit']);
        $_SESSION['email'] = $_POST['email'];
        header('location: welcome.php');
        exit();

      } catch (Exception $e) {
        echo "Error: $sql<br>{$e->getMessage()}";
      }
      $stmt->close();
    } 
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <script>
        function validate() {
            let pass = document.querySelector('#password');
            let repass = document.querySelector('#repass');
            let correct = pass.value == repass.value;
            if (!correct) {
                alert('Password and Re-type Password are not identical');
        }
        return correct;
    }
    </script>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <form action="register.php" onsubmit="return validate();" method="post">
        <p>
            <label for="fname">First name : </label>
            <input type="text" name="fname" id="fname" required>
        </p>
        <p>
            <label for="lname">Last name : </label>
            <input type="text" name="lname" id="lname" required>
        </p>
        <p>
            <fieldset>
                <legend>Gender : </legend>
                <input type="radio" name="gender" id="male" value="M">
                <label for="male">Male : </label>
                <input type="radio" name="gender" id="female" value="F">
                <label for="female">Female : </label>
                <input type="radio" name="gender" id="others" checked value="O">
                <label for="others">Others : </label>
            </fieldset>
        </p>
        <p>
            <label for="dob">Date of birth : </label>
            <input type="date" name="dob" id="dob" required>
        </p>
        <p>
            <label for="email">E-mail : </label>
            <input type="email" name="email" id="email" required>
            <?= $domain_error ? '<h3 class="error"> email must be @dpu.ac.th </h3>' : '' ?>
        </p>
        <p>
            <label for="password">Password : </label>
            <input type="password" name="password" id="password" required>
        </p>
        <p>
            <label for="repass">Re-type Password :</label>
            <input type="password" name="repass" id="repass">
        </p>
        <p>
            <input type="submit" value="Register" name="submit">
        </p>
    </form>
    <script> 
    <?php
    if (isset($_POST['submit'])) {
    ?>
            document.querySelector('#fname').value = '<?= $_POST['fname'] ?>';
            document.querySelector('#lname').value = '<?= $_POST['lname'] ?>';
            document.querySelector('#dob').value = '<?= $_POST['dob'] ?>';
            document.querySelector('#email').value = '<?= $_POST['email'] ?>';
            document.querySelector('#password').value = '<?= $_POST['password'] ?>';
    <?php
    }
    ?>
    </script>
</body>
</html>