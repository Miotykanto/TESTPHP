<?php

$conn = new mysqli("localhost", "root", "", "crud") OR die("Error: " . mysqli_error($conn));

session_start();

// save dada
if(isset($_POST['save'])) {
    if(!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $iQuery = "INSERT INTO account(username, password) values(?, ?)";

        $stmt = $conn->prepare($iQuery);
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            $_SESSION['msg'] = "New record is seccessfully inserted.";
            $_SESSION['alert'] = "alert alert-success";
        }
        $stmt->close();
        $conn->close();
    }
    else {
        $_SESSION['msg'] = "Username and Password should not be empty.";
        $_SESSION['alert'] = "alert alert-warning";

    }
    header("location: index.php");
}

#delete select data 
if(isset($_POST['delete'])) {
    $id = $_POST['delete'];

    $dQuery = "DELETE FROM  account WHERE id = ? ";
    $stmt = $conn->prepare($dQuery);
    $stmt->bind_param('i', $id);
    if($stmt->execute()) {
        $_SESSION['msg'] = "select record is successfully deleted.";
        $_SESSION['alert'] = "alert alert-danger";
    }
    $stmt->close();
    $conn->close();
    header("location: index.php");

}

#update  select user 's data
if (isset($_POST['edit'])){
if(!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_POST['edit'];

    $uQuery = "UPDATE account SET username = ?, password = ? WHERE id = ?";

    $stmt = $conn->prepare($uQuery);
    $stmt->bind_param('ssi', $username, $password, $id);

    if ($stmt->execute()) {
        $_SESSION['msg'] = "Select record is successfully updated.";
        $_SESSION['alert'] = "alert alert-success";
    }
    $stmt->close();
    $conn->close();
}
else {
    $_SESSION['msg'] = "Username and Password should not be empty.";
    $_SESSION['alert'] = "alert alert-warning";

}
header("location :index.php");
};

?>