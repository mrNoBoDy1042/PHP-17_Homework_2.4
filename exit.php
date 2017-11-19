<?php
require_once('Redirect.php');
session_destroy();
redirect('Location: index.php');
