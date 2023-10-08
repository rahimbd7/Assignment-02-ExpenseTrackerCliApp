<?php
namespace Classes;
class FileStorage {
    const INCOME = "INCOME";
    const EXPENSE = "EXPENSE";
    private $incomeFilePath;
    private $expenseFilePath;

    public function __construct() {
        $this->incomeFilePath = getcwd() . "//data//income.txt";
        $this->expenseFilePath = getcwd() . "//data//expense.txt";
    }

    public function save( $userData, $type ) {
        if ( !strtoupper( $type ) == self::INCOME || !strtoupper( $type ) == self::EXPENSE ) {
            return;
        }
        if ( strtoupper( $type ) == self::INCOME ) {
            $encodedUserData = serialize( $userData );
            $this->writeDataToFile( $this->incomeFilePath, $encodedUserData );
        } else {
            $encodedUserData = serialize( $userData );
            $this->writeDataToFile( $this->expenseFilePath, $encodedUserData );
        }
    }

    public function load( string $type ) {
        if ( !strtoupper( $type ) == self::INCOME || !strtoupper( $type ) == self::EXPENSE ) {
            return;
        }
        if ( strtoupper( $type ) == self::INCOME ) {
            return $this->readDataFromFile( $this->incomeFilePath );
        } else {
            return $this->readDataFromFile( $this->expenseFilePath );
        }
    }

    private function writeDataToFile( $filePath, $data ): void {
        file_put_contents( $filePath, $data );
    }

    private function readDataFromFile( $filePath ) {
        $decodedData = unserialize( file_get_contents( $filePath ) );
        return $decodedData;
    }

    public function clearAllData() {
        file_put_contents( $this->incomeFilePath, "" );
        file_put_contents( $this->expenseFilePath, "" );
    }

}