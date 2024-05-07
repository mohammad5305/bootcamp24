CREATE TABLE people (
    id_number INT PRIMARY KEY,
    name VARCHAR(50),
    phone_number VARCHAR(20)
);

INSERT INTO people
SELECT trunc(random()*10000000), CONCAT('testname', CAST(trunc(random()*10000) AS TEXT)), CONCAT('+98', CAST(trunc(random()*1000000000) AS TEXT)) || generate_series(0,10000)
ON CONFLICT (id_number) DO NOTHING;
