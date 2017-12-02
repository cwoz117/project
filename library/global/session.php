<?php
  function is_logged_in(string $redirect){
    session_start();

    if(!( isset($_SESSION["login"]) && $_SESSION["login"] == "OK")){
      header("Location: ../$redirect");
      exit;
    }

  }

  function fill_user_session(string $user){
    $_SESSION['login'] = 'OK';
    $_SESSION['username'] = $user['username']; # Totes not right but gimme a sec
    
    # TODO Figure out how to make the divide possible here, maybe ADD a type value to the DB?
    # $_SESSION['type'] = "driver"; # also company and admin
    
    if($user['admin'] == 0)
      $_SESSION['admin'] = 'No'
    else
      $_SESSION['admin'] = 'Yes'
  }
?>
