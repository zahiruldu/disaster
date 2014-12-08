<?php
require_once ("db.php");
require_once ("functions.php");

session_destroy();

header("Location: index.php");