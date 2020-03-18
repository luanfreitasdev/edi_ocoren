<?php

namespace PHPProceda\EDI;

use PHPProceda\EDI\Interpreter;

class Transformer extends Interpreter {

    private $file;
    private $config;

    /**
     * EDI constructor.
     * @param $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }


}

