<?php
require_once '..\controllers\ControllerSession.php';
ControllerSession::startSession();
ControllerSession::destroySession();
header('Location: ../../index.php');
exit();
?>