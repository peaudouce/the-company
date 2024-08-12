<?php

require "Database.php";

class User extends Database{

    //save a user
    public function createUser($request){
        
        $password = password_hash($request['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name, last_name, username, `password`) 
                VALUES ('".$request['first_name']."', 
                        '".$request['last_name']."', 
                        '".$request['username']."', 
                        '".$password."')";
        if($this->conn->query($sql)){
            header("location: ../views"); // goto views/index.php
            exit;
        }else{
            die("Error creating the user: ".$this->conn->error);
        }
    }

    public function login($request){

        $sql = "SELECT * FROM users WHERE username = '".$request['username']."'";

        $result = $this->conn->query($sql);

        if($result->num_rows == 1){ //check if username is found
            //check password
            $user = $result->fetch_assoc(); //get the 1 row from sql results

            if(password_verify($request['password'], $user['password'])){
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['first_name']."  ".$user['last_name'];

                header('location: ../views/dashboard.php');
                exit;
            }else{
                die("Password is incorrect.");                
            }
        }else{
            die("Username is not found.");
        
        }
    }

    // get all users
    public function getAllUsers(){

        $sql = "SELECT * FROM users";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error returning all users: ".$this->conn->error);
        }
        
    }

    //get/find data of 1 user
    public function findUser($id){
        
        $sql = "SELECT * FROM users WHERE id = $id";
        
        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc(); //return 1 row
        }else{
            die("Error finding user: ".$this->conn->error);
        }
    }

    //update user
    public function updateUser($request){

        $sql = "UPDATE users SET last_name = '".$request['last_name']."',
                                first_name = '".$request['first_name']."',
                                username = '".$request['username']."'
                            WHERE id = ".$request['id'];

        if($this->conn->query($sql)){
            //successful update
            //if updated user is logged-in user, update the session
            session_start();
            if($request['id'] == $_SESSION['id']){
                $_SESSION['username'] = $request['username'];
                $_SESSION['full_name'] = $request['first_name']."  ".$request['last_name'];
            }
            //go to dashboard page
            header('location: ../views/dashboard.php');
            exit;
        }else{
            die("Error updating user: ".$this->conn->error);
        }
    }

    //delete user
    public function deleteUser($id){
        $sql = "DELETE FROM users WHERE id = $id";

        if($this->conn->query($sql)){
            //success, go to dashboard
            header('location: ../views/dashboard.php');
            exit;
        }else{
            die("Error deleting user: ".$this->conn->error);
        }
    }

    //log out
    public function logout(){
        session_start();
        session_unset();
        session_destroy();

        //got to login
        header('location: ../views');
        exit;
    }

    //upload photo
    public function uploadPhoto($request, $files){

        session_start();
        $id = $_SESSION['id'];
        $file_name = $files['photo']['name'];
        $temp_ame = $files['photo']['tmp_name'];

        $sql = "UPDATE users SET photo = '$file_name' WHERE id = $id";

        if($this->conn->query($sql)){
            //success updating the file name in users table;
            //move the file to the photos folder
            $destination = "../assets/images/photos/$file_name";
            if(move_uploaded_file($temp_ame, $destination)){
                //success; got to profile page
                header('location: ../views/profile.php');
                exit;
            }else{
                die("Error moving photo: ");
            }
        }else{
            die("Error updating photo: ".$this->conn->error);
        }
    }

}
?>