<?php

namespace App;

interface converterInterface{
    public function toDecimal():int;
    public function toBinary():string;
    public function toHexa():string;
}