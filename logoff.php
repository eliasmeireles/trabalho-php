<?php
session_start();
unset($_SESSION['__usuarioConectado']);
header('Location: /');
?>