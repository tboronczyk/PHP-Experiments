<?php
/*
 * Copyright (c) 2011, Timothy Boronczyk
 *
 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions are met:
 *
 *  1. Redistributions of source code must retain the above copyright notice, 
 *     this list of conditions and the following disclaimer.
 *
 *  2. Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in the
 *     documentation and/or other materials provided with the distribution.
 *
 *  3. The names of the authors may not be used to endorse or promote products 
 *     derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED "AS IS" AND WITHOUT ANY EXPRESS OR IMPLIED 
 * WARRANTIES, INCLUDING, WITHOUT LIMITATION, THE IMPLIED WARRANTIES OF 
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE.
 */

class Fibonacci implements Iterator, ArrayAccess
{
    const PHI = 1.618033989;

    private $i;

    private $a;
    private $b;

    public function __construct() {
    }

    public function rewind() {
        $this->i = 0;
        $this->a = 1;
        $this->b = 0;
    }

    public function current() {
        return $this->b;
    }

    public function key() {
       return $this->i;
    }

    public function next() {
        $this->i++;
        $tmp = $this->a + $this->b;
        $this->a = $this->b;
        $this->b = $tmp;
    }

    public function valid() {
        return $this->offsetExists($this->i);
    }

    public function offsetExists($i) {
        // Fib(1476) = float(1.30698922376E+308)
        // Fib(1477) = float(INF)
        return $i > -1 && $i < 1478;
    }

    public function offsetGet($i) {
        // http://en.wikipedia.org/wiki/Fibonacci_number#Computation_by_rounding
        return floor((pow(self::PHI, $i) / sqrt(5)) + 0.5);
    }

    public function offsetSet($i, $val) {
        throw new Exception("sequence is read-only");
    }

    public function offsetUnset($i) {
        throw new Exception("sequence is read-only");
    }
}

