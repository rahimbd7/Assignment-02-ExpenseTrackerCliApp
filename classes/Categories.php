<?php
namespace Classes;
class Categories {
    public $default_incomes_categories = [
        'job',
        'business',
        'outsourcing',
        'freelancing',
    ];
    public $default_expenses_categories = [
        'shopping',
        'market',
        'gift',
        'house rent',
        'electric bill',
    ];

    public function showIncomesCategories() {
        printf( "===========================================\n" );
        foreach ( $this->default_incomes_categories as $value ) {
            echo "Name: " . $value . " and Type INCOME\n";
        }
        printf( "===========================================\n" );

    }
    public function showExpensesCategories() {
        foreach ( $this->default_expenses_categories as $value ) {
            echo "Name: " . $value . " and Type EXPENSES\n";
        }
        printf( "===========================================\n" );
    }

}