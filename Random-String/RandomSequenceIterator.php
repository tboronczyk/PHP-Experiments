<?php
/*
 * Copyright (c) 2009, Timothy Boronczyk
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

class RandomSequenceIterator implements Iterator
{
    protected $seqMembers;
    protected $key;
    protected $limit;

    public function __construct() {
        $this->setMembers(null)
             ->setLimit(0)
             ->rewind();
    }

    protected function setMembers($strValue) {
        $this->seqMembers = $strValue;
        return $this;
    }

    protected function getMembers() {
        return $this->seqMembers;
    }

    protected function setLimit($intValue) {
        $this->limit = $intValue;
        return $this;
    }

    protected function getLimit() {
        if (empty($this->limit)) {
            return 0;
        }
        else {
            return $this->limit;
        }
    }

    public function current() {
        $index = rand(0, strlen($this->getMembers()) - 1);
        return substr($this->getMembers(), $index, 1);
    }

    public function valid() {
        return $this->key() < $this->getLimit();
    }

    public function key() {
        return $this->key;
    }

    public function next() {
        $this->key++;
    }

    public function reset() {
        $this->rewind();
    }

    public function rewind() {
        $this->key = 0;
    }
}

