
CREATE TABLE mahasiswa (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(100),
    alamat VARCHAR(255),
    umur INT
);

TRUNCATE TABLE mahasiswa RESTART IDENTITY;
