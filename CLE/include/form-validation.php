<?php
$errors = [];
if ($name == "") {
    $errors['name'] = '!! Name cannot be empty !!';
}
if ($twitter == "") {
    $errors['twitter'] = '!! Twitter cannot be empty !!';
}

if ($email == "") {
    $errors['email'] = '!! Email cannot be empty !!';
}

if ($style == "") {
    $errors['style'] = '!! Style cannot be empty !!' . '<br>';
}

if ($description == "") {
    $errors['description'] = '!! Description cannot be empty !!';
}

?>