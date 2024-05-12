<?php
    $dbconn = pg_connect("host=database dbname=hugedata user=postgres password=password");
    pg_query('CREATE TABLE IF NOT EXISTS "people" (
        id_number SERIAL PRIMARY KEY,
        name VARCHAR,
        age INT,
        gender CHAR,
        married BOOLEAN,
        national_code VARCHAR(30), 
        mobile VARCHAR(20)
    )');

    if (pg_fetch_array(pg_query("SELECT COUNT(*) FROM people"), null)[0] == 0) {
        $faker = Faker\Factory::create('fa_IR');


        $query = 'INSERT INTO "people" ("name", "age", "gender", "married", "national_code", "mobile")
                VALUES ($1, $2, $3, $4, $5, $6)';

        for ($i = 1; $i <= 10_000_000; $i++) {
            $gender = $faker->boolean() ? "m" : "f";
            $name = $faker->name($gender ? "male" : "female");
            $married = $faker->numberBetween(0, 1) == 1 ? "True" : "False";
            $national = $faker->nationalCode();
            $age = $faker->numberBetween(10, 100);
            $mobile = "+98".strval($faker->numberBetween(1_000_000_000));

            pg_query_params($dbconn, $query, array($name, $age, $gender, $married, $national, $mobile));
        }

    }

    pg_flush($dbconn);
    pg_close($dbconn);

?>
