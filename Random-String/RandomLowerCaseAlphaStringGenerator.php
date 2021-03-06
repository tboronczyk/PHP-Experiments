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

class RandomLowerCaseAlphaStringGenerator extends RandomGeneratorBase
{
    const VALID_MEMBERS = "abcdefghijklmnopqrstuvwxyz";

    protected function __construct() {
        parent::__construct();
        self::$generator->setChars(self::VALID_MEMBERS);
    }

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

