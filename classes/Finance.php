<?php

namespace Classes;
class Finance {
    private Categories $categories;
    private $userIncomeTransaction = [];
    private $userExpenseTransaction = [];
    private FileStorage $fileHandler;

    public function __construct( Categories $category, FileStorage $filehandler ) {
        $this->categories = $category;
        $this->fileHandler = $filehandler;

    }

    public function addIncome( float $amount, string $category ): void {
        if ( $amount <= 0 ) {
            printf( "Please input the valid amount...\n" );
            return;
        }
        if ( !in_array( strtolower( $category ), $this->categories->default_incomes_categories ) ) {
            echo "invalid categories! \n";
        } else {
            $income = new Transaction();
            $income->setAmount( $amount );
            $income->setCategory( strtolower( $category ) );
            $this->userIncomeTransaction[] = $income;
            $this->fileHandler->save( $this->userIncomeTransaction, "income" );
            printf( "Your Income has saved successfully....\n" );
            printf( "-------------------------------------------\n" );

        }
    }

    public function addExpense( float $amount, string $category ): void {
        if ( $amount <= 0 ) {
            printf( "Please input the valid amount...\n" );
            return;
        }
        if ( !in_array( strtolower( $category ), $this->categories->default_expenses_categories ) ) {
            echo "invalid categories! \n";
        } else {
            $expense = new Transaction();
            $expense->setAmount( $amount );
            $expense->setCategory( strtolower( $category ) );
            $this->userExpenseTransaction[] = $expense;
            $this->fileHandler->save( $this->userExpenseTransaction, "expense" );
            printf( "Your Expense has saved successfully....\n" );
            printf( "-------------------------------------------\n" );

        }
    }

    public function viewIncome(): void {
        $userIncomeData = $this->fileHandler->load( "income" );
        printf( "===============Your Incomes===============\n" );
        if ( $userIncomeData ) {
            foreach ( $userIncomeData as $item ) {
                printf( "Name: %s and Amount: %.2f \n", $item->getCategory(), $item->getAmount() );
            }
        }
        printf( "-------------------------------------------\n" );
    }

    public function viewExpense(): void {
        $userExpenseData = $this->fileHandler->load( "expense" );
        printf( "===============Your Expenses===============\n" );
        if ( $userExpenseData ) {
            foreach ( $userExpenseData as $item ) {
                printf( "Name: %s and Amount: %.2f \n", $item->getCategory(), $item->getAmount() );
            }
        }
        printf( "-------------------------------------------\n" );
    }

    public function viewSavings(): void {
        $totalIncome = 0;
        $totalExpense = 0;
        $balance = 0;
        $userIncomeData = $this->fileHandler->load( "income" );
        $userExpenseData = $this->fileHandler->load( "expense" );
        if ( !$userIncomeData || !$userExpenseData ) {
            return;
        }

        foreach ( $userIncomeData as $item ) {
            $totalIncome += $item->getAmount();
        }
        foreach ( $userExpenseData as $item ) {
            $totalExpense += $item->getAmount();
        }
        $balance = $totalIncome - $totalExpense;
        printf( "===========================Your Balance=========================\n" );
        if ( $balance >= 0 ) {
            printf( "Your Remaining balanced now: %.2f\n", $balance );
            printf( "----------------------------------------------------------------\n" );
        } else {
            printf( "Opps! you have spent more then your income! balanced now: %.2f\n", $balance );
            printf( "----------------------------------------------------------------\n" );
        }
    }

    public function viewCategories(): void {
        $this->categories->showIncomesCategories();
        $this->categories->showExpensesCategories();
    }

    public function exitAndClear(): void {
        $this->fileHandler->clearAllData();
        printf( "User Data has Cleared successfully and Exit... \n" );
    }

}