<div class="card">
    <i class="fas fa-th-list"></i>&nbsp;Register<hr>
    <form method="post" action="index.php?page=register">
        <table>
            <tr>
                <td style="width: 10%;"><label for="username">Username</label></td>
                <td style="width: 3%;">:</td>
                <td><input style="width: 100%;" type="text" id="username" name="username" required></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td>:</td>
                <td><input style="width: 100%;" type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td>:</td>
                <td><input style="width: 100%;" type="password" id="password" name="password" required></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button type="submit">Register</button></td>
            </tr>
        </table>
    </form>
</div>

<?php
$key = "informatika";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedpassword = hash_hmac("sha256", $password, $key);

    $query = "INSERT INTO customer (username, email, password) VALUES ('$username', '$email', '$hashedpassword')";
    
    mysqli_query($con, $query);
    header("location:index.php?page=login");
}
?>