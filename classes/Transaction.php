<?php

namespace Classes;
class Transaction {
    private $amount;
    private $category;
    public function setAmount( float $amount ) {
        $this->amount = $amount;
    }

    public function setCategory( $category ) {
        $this->category = $category;
    }
    public function getAmount() {
        return $this->amount;
    }
    public function getCategory() {
        return $this->category;
    }

}
