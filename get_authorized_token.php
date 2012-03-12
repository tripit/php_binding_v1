<?php

// Copyright 2008-2012 Concur Technologies, Inc.
//
// Licensed under the Apache License, Version 2.0 (the "License"); you may
// not use this file except in compliance with the License. You may obtain
// a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
// WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
// License for the specific language governing permissions and limitations
// under the License.

include_once('tripit.php');

$api_url = '';
$oauth_consumer_key = '';
$oauth_consumer_secret = '';
$access_token = '';
$access_token_secret = '';

if (count($argv) < 6) {
    print "Usage: " . $argv[0] . " api_url consumer_key consumer_secret request_token request_token_secret\n";
    exit;
 }

$api_url = $argv[1];
$oauth_consumer_key = $argv[2];
$oauth_consumer_secret = $argv[3];
$request_token = $argv[4];
$request_token_secret = $argv[5];

$oauth_credential = new OAuthConsumerCredential($oauth_consumer_key, $oauth_consumer_secret, $request_token, $request_token_secret);

$tripit = new TripIt($oauth_credential, $api_url);
print serialize($tripit->get_access_token()) . "\n";
