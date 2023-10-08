<?php
namespace Classes;

class Cli {
    private $amount;
    private $category;
    private Finance $financeManager;
    private $options = [
        1 => '1. Add Income',
        2 => '2. Add expense',
        3 => '3. View Income',
        4 => '4. View Expense',
        5 => '5. View Savings',
        6 => '6. View Categories',
        7 => '7. Exit',
        8 => '8. Exit and Clear User Data',
    ];

    public function __construct() {
        $this->financeManager = new Finance( new Categories, new FileStorage );

    }
    public function runOptions(): void {
        while ( true ) {
            foreach ( $this->options as $key => $value ) {
                printf( "%s \n", $value );
            }
            $choice = readline( "Enter your choice: " );
            switch ( $choice ) {
            case 1:
                $this->amount = (float) readline( "Enter the amount: " );
                $this->category = (string) readline( "Enter the category: " );
                $this->financeManager->addIncome( $this->amount, $this->category );
                break;
            case 2:
                $this->amount = (float) readline( "Enter the amount: " );
                $this->category = (string) readline( "Enter the category: " );
                $this->financeManager->addExpense( $this->amount, $this->category );
                break;
            case 3:
                $this->financeManager->viewIncome();
                break;
            case 4:
                $this->financeManager->viewExpense();
                break;
            case 5:
                $this->financeManager->viewSavings();
                break;
            case 6:
                $this->financeManager->viewCategories();
                break;
            case 7:return;
            case 8:
                $this->financeManager->exitAndClear();
                return;
            default:
                echo "wrong choices \n";
            }
        }
    }
}