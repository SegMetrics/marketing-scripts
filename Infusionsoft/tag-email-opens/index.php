<?php
/**
 * Tag Contacts Who Open Emails v1.0.0
 * --------------------------------------------------------------------------
 *
 * An easy way to tag contacts who have opened an email in Infusionsoft.
 * Follow steps 1 to 3 to set up the script and start tagging contacts.
 *
 * --------------------------------------------------------------------------
 *
 * Part of the SegMetrics Marketing Scripts Collection
 * Copyright 2018 SegMetrics (https://segmetrics.io)
 * Licensed under MIT (https://github.com/SegMetrics/marketing-scripts/blob/master/LICENSE)
 *
 */

/*
|--------------------------------------------------------------------------
| STEP 1: Install the Novak Infusionsoft SDK
|--------------------------------------------------------------------------
|
| You can find the SDK here: https://github.com/novaksolutions/infusionsoft-php-sdk
| Download it and put it in the "vendor" folder, as written below.
|
*/
define('NOVAK_ISOFT', __DIR__ . '/../vendor/Infusionsoft/infusionsoft.php');


/*
|--------------------------------------------------------------------------
| STEP 2: Set Configuration Options
|--------------------------------------------------------------------------
|
| 1. Choose a random password that will be included in the URL to prevent attacks.
|    This should be a random string of numbers and letters only, NOT your Infusionsoft Password
|
| 2. Add your Infusionsoft host name. This is your ENTIRE infusionsoft URL when you log in:
|    Example: aa111.infusionsoft.com
|
| 3. Add your Infusionsoft Key. You can find it by following the insructions below:
|    - Open the Infusionsoft Admin Settings Page
|    - Click on Application
|    - Scroll down to find your API Key
|
*/
define('PASSWORD', 'XXXXXXXXXXXXXXXXXX');
define('ISOFT_HOST', 'aa111.infusionsoft.com');
define('ISOFT_KEY', 'YYYYYYYYYYYYYYYYYYYYYYYYYYYY');


/*
|--------------------------------------------------------------------------
| STEP 3: Add image to your Emails
|--------------------------------------------------------------------------
|
| 1. From the email editor, add a CODE block to the bottom of your email (Not Image)
|
| 2. Copy and paste the image tag, replacing the following:
|    - Replace the URL with the URL where your script lives
|    - Replace PASSWORD with the value from above
|    - Replace the TAG_ID with the tag id that you want to apply to the contact
|    <img src="https://example.com/tag-email-opens/?p=PASSWORD&tag=TAG_ID&cid=~Contact.Id~" height="0" width="0" />
|
| 3. Send a test email to yourself, and you should see the tag applied to your Infusionsoft contact.
|
*/



// -------------------------------------------------------------
// DON'T CHANGE ANYTHING BELOW THIS LINE
// -------------------------------------------------------------



// Check if our password is correct
// -----------------------------------------
$pw = !empty($_GET['p']) && ($_GET['p'] == PASSWORD) ? $_GET['p'] : null;

// Check if the ID is an integer
// -----------------------------------------
$cid = !empty($_GET['cid']) && is_numeric($_GET['cid']) ? $_GET['cid'] : null;

// Check if we have valid tags
// -----------------------------------------
$tag = !empty($_GET['tag']) && is_numeric($_GET['tag']) ? $_GET['tag'] : null;

// If we have a password, id and tag, then run the API call
// -----------------------------------------
if($pw & $cid && $tag){
    require_once(NOVAK_ISOFT); // include Novak Solutions dependency
    Infusionsoft_AppPool::addApp(new Infusionsoft_App(ISOFT_HOST, ISOFT_KEY, 443)); // Connect the Application
    Infusionsoft_ContactService::addToGroup($cid, $tag); // Add the tag to the contact
}


// Display the image
// -----------------------------------------
header('Content-Type: image/png');
echo base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=');