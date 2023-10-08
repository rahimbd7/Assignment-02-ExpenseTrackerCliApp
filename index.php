
<?php

use Classes\Cli;

require_once "vendor/autoload.php";

class User {
    protected Cli $user;
    public function __construct( Cli $user ) {
        $this->user = $user;
    }
    public function run() {
        $this->user->runOptions();
    }

}

$user = new User( new Cli );
$user->run();
