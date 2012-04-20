<?php
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
 * modification, are permitted provided that the following conditions are met:
 *
 *  Redistributions of source code must retain the above copyright notice, 
 *  this list of conditions and the following disclaimer.
 *  Redistributions in binary form must reproduce the above copyright notice,
 *  this list of conditions and the following disclaimer in the documentation
 *  and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE 
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE 
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR 
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF 
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN 
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE 
 * POSSIBILITY OF SUCH DAMAGE.
 *
 */

/**
 *  Define Pathways for the application and its support files
 *  @global string PATH_TO_APPLICATION
 *  @global string PATH_TO_LIBRARY
 *  @global string PATH_TO_MODULES
 */

define('PATH_TO_APPLICATION', './application/');
define('PATH_TO_LIBRARY', PATH_TO_APPLICATION.'library/');
define('PATH_TO_MODULES', PATH_TO_APPLICATION.'modules/');

set_include_path(get_include_path().PATH_SEPARATOR.PATH_TO_APPLICATION);
set_include_path(get_include_path().PATH_SEPARATOR.PATH_TO_LIBRARY);

/* error reporting */
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);

/* vim:fenc=utf-8:nu:fdm=indent:fdn=1ft=php:ts=3:tw=79:ai:si:cin:sts=3:et:sw=2: */
?>
