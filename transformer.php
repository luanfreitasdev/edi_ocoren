<?php

require('src/EDI/Interpreter.php');

use PHPProceda\EDI\Interpreter;

class EDI {

    private $file;
    private $config;
    /**
     * @var Interpreter
     */
    private $interpreter;

    /**
     * EDI constructor.
     * @param $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    private function setv3Version () {
        $this->config = ['000', '340', '341', '342'];
    }

    public function convertV3ToJSON () {
        $transformer = [];
        $this->setv3Version();
        $this->interpreter = new Interpreter();
        foreach(file($this->file) as $line) {

            $code = substr($line, 0, 3);
            if (in_array($code, $this->config)) {
                $l = $this->interpreter->processLineV3($line);
                $transformer[$code] = $l;
            }
        }
        return $transformer;
    }

}

