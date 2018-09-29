<?php

// Copyright 2008-2018 Concur Technologies, Inc.
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

$xml = <<<EOT
<Request>
  <Trip>
    <start_date>2018-12-09</start_date>
    <end_date>2018-12-27</end_date>
    <primary_location>New York, NY</primary_location>
  </Trip>
</Request>
EOT;

$json = <<<EOT
{"Trip":
   {"start_date":"2015-12-09",
    "end_date":"2015-12-27",
    "primary_location":"New York, NY"
   }
}
EOT;

// Create a new trip
print "Create a new test trip using XML to New York: \n";
$r = $t->create($xml);
print_r($r);

print "Create a new test trip using JSON to New York: \n";
$r = $t->create($json, 'json');
print_r($r);

print "Get my list of travel objects in upcoming trips: \n";
$r = $t->list_trip();
print_r($r);
// The first trip in the list
print_r($r->Trip[0]);

print "Get my list of travel objects in past trips, in JSON: \n";
$filter  = [];
$filter["past"] = "true";
$filter["include_objects"] = "true";
$filter['format'] = 'json';
$r = $t->list_trip($filter);
print_r($r);
