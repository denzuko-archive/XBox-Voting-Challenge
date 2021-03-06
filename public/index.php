<?php
// vim:fenc=utf-8:nu:ts=3:tw=79:ai:si:cin:sts=3:et:sw=3:
/***
 * XBox Voting Application
 * @version 1.0.0
 * A Code Challenge for Nerdery.com - PHP Backend, Revision 4.0
 * Tracks interest in new games for the Xbox360 Console.
 * 
 * @author Dwight Spencer (Denzuko) <denzuko.co.cc>
 * @copyright Copyrighted (C)2012 Dwight Spencer.
 * All Rights Reserved.
 *
 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions 
 * are met:
 *
 *  Redistributions of source code must retain the above copyright 
 *  notice, this list of conditions and the following disclaimer.
 *  Redistributions in binary form must reproduce the above copyright 
 *  notice, this list of conditions and the following disclaimer in the
 *  documentation and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS 
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT 
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS 
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE 
 * COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; 
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER 
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT 
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN 
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE 
 * POSSIBILITY OF SUCH DAMAGE.
 */

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', 
    realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV',
    (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 
    'production'));

error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', true);
date_default_timezone_set('America/Denver');

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap()
            ->run();
