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

if (count($argv) < 6) {
    print "Usage: " . $argv[0] . " api_url consumer_key consumer_secret access_token access_token_secret\n";
    exit;
}
 
$api_url = $argv[1];
$oauth_consumer_key = $argv[2];
$oauth_consumer_secret = $argv[3];
$oauth_access_token = $argv[4];
$oauth_access_token_secret = $argv[5];

// Create an OAuth Credential Object
$oauth_cred = new OAuthConsumerCredential($oauth_consumer_key, $oauth_consumer_secret, $oauth_access_token, $oauth_access_token_secret);

// Create a new TripIt object
$t = new TripIt($oauth_cred, $api_url);

// Create a new trip
print "Create a new test trip to New York: \n";
$xml='<Request><Trip><start_date>2009-12-17</start_date><end_date>2009-12-27</end_date><display_name>Test: New York, NY, December 2009</display_name><is_private>true</is_private><primary_location>New York, NY</primary_location></Trip></Request>';
$r = $t->create($xml);
print_r($r);

print "Get my list of travel objects in upcoming trips: \n";
$r = $t->list_trip();
print_r($r);
// The first trip in the list
print_r($r->Trip[0]);
