<?php
require_once 'config/const.php';

echo '<a href="' . BASE_URL . '/processHandle.php/?action=login&value=1">
<input type="submit" name="Login" value ="Login as Applicant"/>
</a> <Br /> <a href="' . BASE_URL . '/processHandle.php/?action=login&value=2">
<input type="submit" name="Login" value ="Login as Reviewer"/>
</a>';
