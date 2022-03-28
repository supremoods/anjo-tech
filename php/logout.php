<?php

    include("config.php");
    session_destroy();
    $google_client->revokeToken();

   



?>