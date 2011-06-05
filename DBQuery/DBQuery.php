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

class DBQuery implements Iterator
{
    protected $_db;
    protected $_query;
    protected $_result;
    protected $_index;
    protected $_num_rows;

    public function __construct($host, $dbname, $username, $password) {
        $this->_db = new PDO("mysql:dbname=$dbname;host=$host",
                $username, $password);
    }

    public function __get($query) {
        $this->_query = $query;
        $this->_result = $this->_db->query($query);
        return $this->_num_rows = $this->_result->rowCount();
    }

    public function quote($value) {
        return PDO::quote($value);
    }

    public function __call($query, $values) {
        $this->_query = $query;
        $this->_result = $this->_db->prepare($this->_query);
        $this->_result->execute($values[0]);
        return $this->_num_rows = $this->_result->rowCount();
    }

    public function clear() {
        $this->_index = 0;
        $this->_num_rows = 0;
        $this->_query = '';
        $this->_result->closeCursor();
    }

    public function rewind() {
        $this->_index = 0;
    }

    public function current() {
        return $this->_result->fetch(PDO::FETCH_ASSOC,
                PDO::FETCH_ORI_ABS, $this->_index);
    }

    public function key() {
        return $this->_index;
    }

    public function next() {
        $this->_index++;
    }

    public function valid() {
        return ($this->_index < $this->_num_rows);
    }

    public function __toString() {
        return $this->_query;
    }
}

