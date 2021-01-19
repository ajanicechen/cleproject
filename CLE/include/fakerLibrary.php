<?php
//connect to database
require_once "../include/database.php";
//requires faker
require_once "../../vendor/fzaninotto/faker/src/autoload.php";
require_once "../../vendor/fzaninotto/faker/src/Faker/Provider/Base.php";

$faker = Faker\Factory::create();
$randomElement = $faker->randomElement(['Cartoon', 'Full Body', '90s Anime']);

for ($i=0; $i<3; $i++){
    $query = "INSERT INTO commissions (name, twitter, email, style, description)
                VALUES(
                '$faker->firstName',
                '$faker->userName',
                '$faker->safeEmail',
                '$randomElement',
                '$faker->sentence')";
    $result = mysqli_query($db, $query);
    echo $query . "<br>";
}
