<?php

/** @generate-class-entries */

/** @not-serializable */
class PDOSqlite extends PDO
{


// Whether SQLITE_OMIT_LOAD_EXTENSION is defined or not depends on how
// SQLite was compiled: https://www.sqlite.org/compile.html
#ifndef SQLITE_OMIT_LOAD_EXTENSION
    public function loadExtension(string $name): bool {}
#endif

    public function openBlob(
        string $table,
        string $column,
        int $rowid,
        ?string $dbname = "main", //null,
        int $flags = PDO::SQLITE_OPEN_READONLY
    ): mixed /* resource|false */ {}

//SQLITE_OPEN_READONLY
//SQLITE_OPEN_READWRITE
//SQLITE_OPEN_CREATE


    // Registers an aggregating User Defined Function for use in SQL statements
    public function createAggregate(
        string $name,
        callable $step,
        callable $finalize,
        int $numArgs = -1
    ): bool {}

    // Registers a User Defined Function for use as a collating function in SQL statements
    public function createCollation(string $name, callable $callback): bool {}

    public function createFunction(
        string $function_name,
        callable $callback,
        int $num_args = -1,
        int $flags = 0
    ): bool {}


    public function deleteAggregate(string $name): void {}

    public function deleteCollation(string $name): bool {}

    public function deleteFunction(string $name, int $num_args = -1): bool {}
}
