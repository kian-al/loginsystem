<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کتابخونه</title>
</head>
<body>
<?php
//------------------------------------users--------------------------------
$users = []; 
//------------------------------------/users--------------------------------

//------------------------------------function for add user--------------------------------
function addUser(&$users, $name, $email, $age) {
    $users[] = ["name" => $name, "email" => $email, "age" => $age];
}
//------------------------------------/function for add user--------------------------------

//------------------------------------function for search user by email--------------------------------
function searchUserByEmail($users, $email) {
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return $user;
        }
    }
    return null;
}
//------------------------------------/function for search user by email--------------------------------

//------------------------------------function for search user by invalid email--------------------------------
function findInvalidEmails($users) {
    $invalidUsers = [];
    foreach ($users as $user) {
        if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $invalidUsers[] = $user;
        }
    }
    return $invalidUsers;
}
//------------------------------------/function for search user by invalid email--------------------------------

//------------------------------------testing functions--------------------------------

//------------------------------------add new user
echo "<b>لیست کاربران : </b><br><br>";
addUser($users, "Nima", "nima@gmail.com", 28);
addUser($users, "ali", "ali@gmail.com", 20);
addUser($users, "amir", "amir@gmail.com", 26);
addUser($users, "kian", "kian@gmail.com", 23);
addUser($users, "matin", "matin@gmail.com", 21);
foreach($users as $list){
    echo "<b>name :</b> ".$list["name"] ."<br>"."<b>email :</b> ". $list["email"]."<br>"."<b>age : </b>".$list["age"]."<br>";
}
echo "<br>";
//------------------------------------search user by email
$emailToSearch = "ali@gmail.com";
$foundUser = searchUserByEmail($users, $emailToSearch);
if ($foundUser) {
    echo "<b>کاربر یافت شد: </b><br>" ;
    echo "name : ".$foundUser["name"] ."<br>"."email : ". $foundUser["email"]."<br>"."age : ".$foundUser["age"];
    echo "<br>";
    
} else {
    echo "<b>کاربر با ایمیل $emailToSearch یافت نشد</b><br><br>";
}
//------------------------------------find invalidusers
$invalidUsers = findInvalidEmails($users);
if (count($invalidUsers) > 0) {
    echo "کاربران با ایمیل نامعتبر: <br>" ;
    foreach($invalidUsers as $user){
        echo $user["email"]."<br>";
        
    }
} else {
    echo "همه کاربران ایمیل معتبر دارند.<br>";
}
?>
<span>
    <a href="login.php">logout
    <?php 
    session_start();
    session_destroy();
    header("Location: login.html");
    exit;
    ?>
    </a>
</span>

</body>
</html>