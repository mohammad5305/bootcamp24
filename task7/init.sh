#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    CREATE TABLE people (
        id_number INT PRIMARY KEY,
        name VARCHAR(50),
        phone_number VARCHAR(20)
    );
    INSERT INTO people
    ON CONFLICT (id_number) DO NOTHING
    SELECT trunc(random()*1000000000), CONCAT('testname', CAST(trunc(random()*10000) AS TEXT)), CONCAT('+98', CAST(trunc(random()*1000000000) AS TEXT)) || generate_series(0,10000);
EOSQL
