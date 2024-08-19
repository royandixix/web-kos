<?php $db = mysqli_connect
(
    "localhost",
    "root",
    "",
    "db_siswa"
);



$result = mysqli_query(
    $db,
    // OERDER BY id
    // ASC
    // DESC
    // WHERE nik = ''
    "SELECT * FROM "

);


function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $rows;

    }
    return $rows;
}









?>