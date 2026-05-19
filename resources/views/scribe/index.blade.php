<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Family Tribe App API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://algfari.test";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.9.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.9.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-login">
                                <a href="#authentication-POSTapi-v1-auth-login">Login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-send-otp">
                                <a href="#authentication-POSTapi-v1-auth-send-otp">Send OTP</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-verify-otp">
                                <a href="#authentication-POSTapi-v1-auth-verify-otp">Verify OTP</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-join-request">
                                <a href="#authentication-POSTapi-v1-auth-join-request">Join Request</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-reset-password">
                                <a href="#authentication-POSTapi-v1-auth-reset-password">Reset Password</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-PUTapi-v1-auth-change-password">
                                <a href="#authentication-PUTapi-v1-auth-change-password">Change Password</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-send-email-verification">
                                <a href="#authentication-POSTapi-v1-auth-send-email-verification">Send Email Verification Code</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-verify-email">
                                <a href="#authentication-POSTapi-v1-auth-verify-email">Verify Email Code</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-send-email-verification-link">
                                <a href="#authentication-POSTapi-v1-auth-send-email-verification-link">Send Email Verification Link (signed URL)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-GETapi-v1-auth-email-verify-link--user_id-">
                                <a href="#authentication-GETapi-v1-auth-email-verify-link--user_id-">Verify Email via Signed Link</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-forgot-password-email">
                                <a href="#authentication-POSTapi-v1-auth-forgot-password-email">Forgot Password via Email</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-password-reset-link--user_id-">
                                <a href="#authentication-POSTapi-v1-auth-password-reset-link--user_id-">Reset Password via Email Link</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-v1-auth-logout">
                                <a href="#authentication-POSTapi-v1-auth-logout">Logout</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-members" class="tocify-header">
                <li class="tocify-item level-1" data-unique="members">
                    <a href="#members">Members</a>
                </li>
                                    <ul id="tocify-subheader-members" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="members-GETapi-v1-members">
                                <a href="#members-GETapi-v1-members">List Members</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="members-GETapi-v1-members--id-">
                                <a href="#members-GETapi-v1-members--id-">Member Details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="members-PUTapi-v1-members--id-">
                                <a href="#members-PUTapi-v1-members--id-">Update Member</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="members-GETapi-v1-members--member_id--card">
                                <a href="#members-GETapi-v1-members--member_id--card">Member Card</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-news" class="tocify-header">
                <li class="tocify-item level-1" data-unique="news">
                    <a href="#news">News</a>
                </li>
                                    <ul id="tocify-subheader-news" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="news-GETapi-v1-news">
                                <a href="#news-GETapi-v1-news">List News</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="news-GETapi-v1-news--id-">
                                <a href="#news-GETapi-v1-news--id-">News Details</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-events" class="tocify-header">
                <li class="tocify-item level-1" data-unique="events">
                    <a href="#events">Events</a>
                </li>
                                    <ul id="tocify-subheader-events" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="events-GETapi-v1-events">
                                <a href="#events-GETapi-v1-events">List Events</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="events-GETapi-v1-events--id-">
                                <a href="#events-GETapi-v1-events--id-">Event Details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="events-POSTapi-v1-events--event_id--rsvp">
                                <a href="#events-POSTapi-v1-events--event_id--rsvp">RSVP to Event</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="events-POSTapi-v1-events--event_id--gallery">
                                <a href="#events-POSTapi-v1-events--event_id--gallery">Upload Gallery Images</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="events-DELETEapi-v1-events--event_id--gallery--media-">
                                <a href="#events-DELETEapi-v1-events--event_id--gallery--media-">Delete Gallery Image</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-offers" class="tocify-header">
                <li class="tocify-item level-1" data-unique="offers">
                    <a href="#offers">Offers</a>
                </li>
                                    <ul id="tocify-subheader-offers" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="offers-GETapi-v1-offers">
                                <a href="#offers-GETapi-v1-offers">List Offers</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="offers-GETapi-v1-offers--id-">
                                <a href="#offers-GETapi-v1-offers--id-">Offer Details</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-family-fund" class="tocify-header">
                <li class="tocify-item level-1" data-unique="family-fund">
                    <a href="#family-fund">Family Fund</a>
                </li>
                                    <ul id="tocify-subheader-family-fund" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="family-fund-GETapi-v1-fund">
                                <a href="#family-fund-GETapi-v1-fund">List Transactions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="family-fund-GETapi-v1-fund-summary">
                                <a href="#family-fund-GETapi-v1-fund-summary">Fund Summary</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="family-fund-GETapi-v1-fund-profile">
                                <a href="#family-fund-GETapi-v1-fund-profile">Fund Profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="family-fund-GETapi-v1-fund-initiatives">
                                <a href="#family-fund-GETapi-v1-fund-initiatives">List Initiatives</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="family-fund-GETapi-v1-fund-support-requests">
                                <a href="#family-fund-GETapi-v1-fund-support-requests">List My Support Requests</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="family-fund-POSTapi-v1-fund-support-requests">
                                <a href="#family-fund-POSTapi-v1-fund-support-requests">Submit Support Request</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="family-fund-GETapi-v1-fund-support-requests--id-">
                                <a href="#family-fund-GETapi-v1-fund-support-requests--id-">Show My Support Request</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-suggestions" class="tocify-header">
                <li class="tocify-item level-1" data-unique="suggestions">
                    <a href="#suggestions">Suggestions</a>
                </li>
                                    <ul id="tocify-subheader-suggestions" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="suggestions-GETapi-v1-suggestions">
                                <a href="#suggestions-GETapi-v1-suggestions">List My Suggestions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="suggestions-POSTapi-v1-suggestions">
                                <a href="#suggestions-POSTapi-v1-suggestions">POST api/v1/suggestions</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-notifications" class="tocify-header">
                <li class="tocify-item level-1" data-unique="notifications">
                    <a href="#notifications">Notifications</a>
                </li>
                                    <ul id="tocify-subheader-notifications" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="notifications-GETapi-v1-notifications">
                                <a href="#notifications-GETapi-v1-notifications">List Notifications</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notifications-PUTapi-v1-notifications--id--read">
                                <a href="#notifications-PUTapi-v1-notifications--id--read">Mark Notification as Read</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="notifications-PUTapi-v1-notifications-read-all">
                                <a href="#notifications-PUTapi-v1-notifications-read-all">Mark All Notifications as Read</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-devices" class="tocify-header">
                <li class="tocify-item level-1" data-unique="devices">
                    <a href="#devices">Devices</a>
                </li>
                                    <ul id="tocify-subheader-devices" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="devices-POSTapi-v1-devices">
                                <a href="#devices-POSTapi-v1-devices">Register Device</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-banat-alqafari" class="tocify-header">
                <li class="tocify-item level-1" data-unique="banat-alqafari">
                    <a href="#banat-alqafari">Banat AlQafari</a>
                </li>
                                    <ul id="tocify-subheader-banat-alqafari" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="banat-alqafari-GETapi-v1-banat">
                                <a href="#banat-alqafari-GETapi-v1-banat">List Banat Profiles</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-contact" class="tocify-header">
                <li class="tocify-item level-1" data-unique="contact">
                    <a href="#contact">Contact</a>
                </li>
                                    <ul id="tocify-subheader-contact" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="contact-GETapi-v1-contact-info">
                                <a href="#contact-GETapi-v1-contact-info">Contact Info</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-health">
                                <a href="#endpoints-GETapi-v1-health">GET api/v1/health</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-test-fcm">
                                <a href="#endpoints-POSTapi-v1-test-fcm">POST api/v1/test-fcm</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-members-children">
                                <a href="#endpoints-POSTapi-v1-members-children">POST api/v1/members/children</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-search">
                                <a href="#endpoints-GETapi-v1-search">GET api/v1/search</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-favorites" class="tocify-header">
                <li class="tocify-item level-1" data-unique="favorites">
                    <a href="#favorites">Favorites</a>
                </li>
                                    <ul id="tocify-subheader-favorites" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="favorites-POSTapi-v1-members--member_id--favorite">
                                <a href="#favorites-POSTapi-v1-members--member_id--favorite">Add to Favorites</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="favorites-DELETEapi-v1-members--member_id--favorite">
                                <a href="#favorites-DELETEapi-v1-members--member_id--favorite">Remove from Favorites</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="favorites-GETapi-v1-favorites">
                                <a href="#favorites-GETapi-v1-favorites">List Favorites</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-home" class="tocify-header">
                <li class="tocify-item level-1" data-unique="home">
                    <a href="#home">Home</a>
                </li>
                                    <ul id="tocify-subheader-home" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="home-GETapi-v1-home">
                                <a href="#home-GETapi-v1-home">Home Screen Payload</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-locations" class="tocify-header">
                <li class="tocify-item level-1" data-unique="locations">
                    <a href="#locations">Locations</a>
                </li>
                                    <ul id="tocify-subheader-locations" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="locations-GETapi-v1-regions">
                                <a href="#locations-GETapi-v1-regions">List Regions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="locations-GETapi-v1-cities">
                                <a href="#locations-GETapi-v1-cities">List Cities</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-news-comments" class="tocify-header">
                <li class="tocify-item level-1" data-unique="news-comments">
                    <a href="#news-comments">News Comments</a>
                </li>
                                    <ul id="tocify-subheader-news-comments" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="news-comments-GETapi-v1-news--news_id--comments">
                                <a href="#news-comments-GETapi-v1-news--news_id--comments">GET api/v1/news/{news_id}/comments</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="news-comments-POSTapi-v1-news--news_id--comments">
                                <a href="#news-comments-POSTapi-v1-news--news_id--comments">POST api/v1/news/{news_id}/comments</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="news-comments-DELETEapi-v1-news--news_id--comments--comment_id-">
                                <a href="#news-comments-DELETEapi-v1-news--news_id--comments--comment_id-">DELETE api/v1/news/{news_id}/comments/{comment_id}</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-news-reactions" class="tocify-header">
                <li class="tocify-item level-1" data-unique="news-reactions">
                    <a href="#news-reactions">News Reactions</a>
                </li>
                                    <ul id="tocify-subheader-news-reactions" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="news-reactions-POSTapi-v1-news--news_id--reactions">
                                <a href="#news-reactions-POSTapi-v1-news--news_id--reactions">POST api/v1/news/{news_id}/reactions</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="news-reactions-DELETEapi-v1-news--news_id--reactions">
                                <a href="#news-reactions-DELETEapi-v1-news--news_id--reactions">DELETE api/v1/news/{news_id}/reactions</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-visitors" class="tocify-header">
                <li class="tocify-item level-1" data-unique="visitors">
                    <a href="#visitors">Visitors</a>
                </li>
                                    <ul id="tocify-subheader-visitors" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="visitors-POSTapi-v1-visitors">
                                <a href="#visitors-POSTapi-v1-visitors">Increment visitor counter</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="visitors-GETapi-v1-visitors">
                                <a href="#visitors-GETapi-v1-visitors">Get visitor count</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: May 17, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>API Documentation for Family/Tribe Management Application</p>
<aside>
    <strong>Base URL</strong>: <code>http://algfari.test</code>
</aside>
<pre><code>This documentation provides all the information you need to work with the Family Tribe App API.

The API supports Arabic and English localization via the `Accept-Language` header.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_TOKEN}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>Authenticate via the <b>POST /api/v1/auth/login</b> endpoint to receive a Bearer token. Include it in the <code>Authorization</code> header as <code>Bearer {token}</code>.</p>

        <h1 id="authentication">Authentication</h1>

    <p>APIs for user authentication and registration.</p>

                                <h2 id="authentication-POSTapi-v1-auth-login">Login</h2>

<p>
</p>

<p>Authenticate user with phone number, national ID, or email.</p>

<span id="example-requests-POSTapi-v1-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/auth/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"login\": \"0551234567\",
    \"password\": \"secret123\",
    \"device_token\": \"fcm-token-abc123xyz\",
    \"platform\": \"android\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/auth/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "login": "0551234567",
    "password": "secret123",
    "device_token": "fcm-token-abc123xyz",
    "platform": "android"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-login">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;full_name&quot;: &quot;محمد القحطاني&quot;,
        &quot;phone_number&quot;: &quot;0551234567&quot;,
        &quot;national_id&quot;: &quot;1234567890&quot;,
        &quot;email&quot;: &quot;mohammed@example.com&quot;,
        &quot;city&quot;: &quot;الرياض&quot;,
        &quot;region&quot;: &quot;منطقة الرياض&quot;,
        &quot;gender&quot;: &quot;male&quot;,
        &quot;role&quot;: &quot;member&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;is_featured&quot;: false,
        &quot;profile_image&quot;: null,
        &quot;profile_image_medium&quot;: null,
        &quot;profile_image_thumb&quot;: null,
        &quot;created_at&quot;: &quot;2026-04-01T10:00:00.000000Z&quot;
    },
    &quot;token&quot;: &quot;1|a2b3c4d5e6f7g8h9i0jklmnopqrstuvwxyz&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401, invalid credentials):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;بيانات الدخول غير صحيحة&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403, inactive account):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;الحساب غير مفعل&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-login" data-method="POST"
      data-path="api/v1/auth/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-login"
                    onclick="tryItOut('POSTapi-v1-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-login"
                    onclick="cancelTryOut('POSTapi-v1-auth-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-auth-login"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>login</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="login"                data-endpoint="POSTapi-v1-auth-login"
               value="0551234567"
               data-component="body">
    <br>
<p>Phone number, National ID, or email. Example: <code>0551234567</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-auth-login"
               value="secret123"
               data-component="body">
    <br>
<p>User password. Example: <code>secret123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>device_token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="device_token"                data-endpoint="POSTapi-v1-auth-login"
               value="fcm-token-abc123xyz"
               data-component="body">
    <br>
<p>Optional FCM token; if sent, <code>platform</code> is required. Example: <code>fcm-token-abc123xyz</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>platform</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="platform"                data-endpoint="POSTapi-v1-auth-login"
               value="android"
               data-component="body">
    <br>
<p>Optional <code>ios</code> or <code>android</code>; required with <code>device_token</code>. Example: <code>android</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-auth-send-otp">Send OTP</h2>

<p>
</p>

<p>Send a one-time password to the given phone number.</p>

<span id="example-requests-POSTapi-v1-auth-send-otp">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/auth/send-otp" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"phone_number\": \"0551234567\",
    \"purpose\": \"register\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/auth/send-otp"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "phone_number": "0551234567",
    "purpose": "register"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-send-otp">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تم إرسال رمز التحقق&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-auth-send-otp" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-send-otp"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-send-otp"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-send-otp" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-send-otp">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-send-otp" data-method="POST"
      data-path="api/v1/auth/send-otp"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-send-otp', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-send-otp"
                    onclick="tryItOut('POSTapi-v1-auth-send-otp');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-send-otp"
                    onclick="cancelTryOut('POSTapi-v1-auth-send-otp');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-send-otp"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/send-otp</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-send-otp"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-send-otp"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-auth-send-otp"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_number"                data-endpoint="POSTapi-v1-auth-send-otp"
               value="0551234567"
               data-component="body">
    <br>
<p>The phone number. Example: <code>0551234567</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>purpose</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="purpose"                data-endpoint="POSTapi-v1-auth-send-otp"
               value="register"
               data-component="body">
    <br>
<p>The OTP purpose. Example: <code>register</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-auth-verify-otp">Verify OTP</h2>

<p>
</p>

<p>Verify the OTP code sent to the phone number.</p>

<span id="example-requests-POSTapi-v1-auth-verify-otp">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/auth/verify-otp" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"phone_number\": \"0551234567\",
    \"code\": \"123456\",
    \"purpose\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/auth/verify-otp"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "phone_number": "0551234567",
    "code": "123456",
    "purpose": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-verify-otp">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تم التحقق بنجاح&quot;,
    &quot;verified&quot;: true
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;رمز التحقق غير صالح&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-auth-verify-otp" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-verify-otp"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-verify-otp"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-verify-otp" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-verify-otp">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-verify-otp" data-method="POST"
      data-path="api/v1/auth/verify-otp"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-verify-otp', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-verify-otp"
                    onclick="tryItOut('POSTapi-v1-auth-verify-otp');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-verify-otp"
                    onclick="cancelTryOut('POSTapi-v1-auth-verify-otp');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-verify-otp"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/verify-otp</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-verify-otp"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-verify-otp"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-auth-verify-otp"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_number"                data-endpoint="POSTapi-v1-auth-verify-otp"
               value="0551234567"
               data-component="body">
    <br>
<p>The phone number. Example: <code>0551234567</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-v1-auth-verify-otp"
               value="123456"
               data-component="body">
    <br>
<p>The OTP code. Example: <code>123456</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>purpose</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="purpose"                data-endpoint="POSTapi-v1-auth-verify-otp"
               value="architecto"
               data-component="body">
    <br>
<p>One of: register, reset, verify. For password recovery use reset (then call reset-password without code). Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-auth-join-request">Join Request</h2>

<p>
</p>

<p>Submit a request to join the family/tribe.</p>

<span id="example-requests-POSTapi-v1-auth-join-request">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/auth/join-request" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --form "full_name=محمد أحمد القحطاني"\
    --form "phone_number=0551234567"\
    --form "national_id=1234567890"\
    --form "email=mohammed@example.com"\
    --form "pending_family_name=architecto"\
    --form "region_id=1"\
    --form "password=Secret123"\
    --form "password_confirmation=Secret123"\
    --form "profile_image=@C:\Users\hp\AppData\Local\Temp\php13A2.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/auth/join-request"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

const body = new FormData();
body.append('full_name', 'محمد أحمد القحطاني');
body.append('phone_number', '0551234567');
body.append('national_id', '1234567890');
body.append('email', 'mohammed@example.com');
body.append('pending_family_name', 'architecto');
body.append('region_id', '1');
body.append('password', 'Secret123');
body.append('password_confirmation', 'Secret123');
body.append('profile_image', document.querySelector('input[name="profile_image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-join-request">
            <blockquote>
            <p>Example response (201, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تم تقديم طلب الانضمام بنجاح&quot;,
    &quot;join_request&quot;: {
        &quot;id&quot;: 1,
        &quot;full_name&quot;: &quot;محمد أحمد القحطاني&quot;,
        &quot;phone_number&quot;: &quot;0551234567&quot;,
        &quot;national_id&quot;: &quot;1234567890&quot;,
        &quot;email&quot;: &quot;mohammed@example.com&quot;,
        &quot;pending_family_name&quot;: null,
        &quot;region_id&quot;: 1,
        &quot;region&quot;: {
            &quot;id&quot;: 1,
            &quot;country_id&quot;: 1,
            &quot;name&quot;: {
                &quot;ar&quot;: &quot;منطقة الرياض&quot;,
                &quot;en&quot;: &quot;Riyadh Region&quot;
            }
        },
        &quot;status&quot;: &quot;pending&quot;,
        &quot;rejection_reason&quot;: null,
        &quot;profile_image&quot;: null,
        &quot;profile_image_medium&quot;: null,
        &quot;profile_image_thumb&quot;: null,
        &quot;reviewed_at&quot;: null,
        &quot;created_at&quot;: &quot;2026-04-13T10:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-auth-join-request" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-join-request"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-join-request"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-join-request" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-join-request">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-join-request" data-method="POST"
      data-path="api/v1/auth/join-request"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-join-request', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-join-request"
                    onclick="tryItOut('POSTapi-v1-auth-join-request');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-join-request"
                    onclick="cancelTryOut('POSTapi-v1-auth-join-request');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-join-request"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/join-request</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-join-request"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-join-request"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-auth-join-request"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>full_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="full_name"                data-endpoint="POSTapi-v1-auth-join-request"
               value="محمد أحمد القحطاني"
               data-component="body">
    <br>
<p>Full name (Arabic/Latin letters, numbers, spaces, . ' -). Min 3 chars. Example: <code>محمد أحمد القحطاني</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_number"                data-endpoint="POSTapi-v1-auth-join-request"
               value="0551234567"
               data-component="body">
    <br>
<p>Saudi mobile: 10 digits starting with 05, or +9665… / 9665… (normalized to 05…). Example: <code>0551234567</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>national_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="national_id"                data-endpoint="POSTapi-v1-auth-join-request"
               value="1234567890"
               data-component="body">
    <br>
<p>Optional. 10 digits, must start with 1 or 2. Example: <code>1234567890</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-join-request"
               value="mohammed@example.com"
               data-component="body">
    <br>
<p>Optional unique email (not used by another member or pending join request). Example: <code>mohammed@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>pending_family_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="pending_family_name"                data-endpoint="POSTapi-v1-auth-join-request"
               value="architecto"
               data-component="body">
    <br>
<p>Optional free-text family name (min 2 chars when sent). Stored until admin links the member after approval. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>region_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="region_id"                data-endpoint="POSTapi-v1-auth-join-request"
               value="1"
               data-component="body">
    <br>
<p>Must exist in <code>regions.id</code>. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-auth-join-request"
               value="Secret123"
               data-component="body">
    <br>
<p>Min 8 characters, must include letters and numbers. Example: <code>Secret123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>profile_image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="profile_image"                data-endpoint="POSTapi-v1-auth-join-request"
               value=""
               data-component="body">
    <br>
<p>Profile image (max 5MB, image format). Example: <code>C:\Users\hp\AppData\Local\Temp\php13A2.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-v1-auth-join-request"
               value="Secret123"
               data-component="body">
    <br>
<p>Must match <code>password</code>. Example: <code>Secret123</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-auth-reset-password">Reset Password</h2>

<p>
</p>

<p>Step 3 of password recovery (UI): set a new password after OTP was verified in
<code>verify-otp</code> with purpose <code>reset</code>. Does not accept the code again.</p>

<span id="example-requests-POSTapi-v1-auth-reset-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/auth/reset-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"phone_number\": \"0551234567\",
    \"password\": \"newsecret123\",
    \"password_confirmation\": \"newsecret123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/auth/reset-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "phone_number": "0551234567",
    "password": "newsecret123",
    "password_confirmation": "newsecret123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-reset-password">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تم إعادة تعيين كلمة المرور بنجاح&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;المستخدم غير موجود&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;...&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-auth-reset-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-reset-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-reset-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-reset-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-reset-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-reset-password" data-method="POST"
      data-path="api/v1/auth/reset-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-reset-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-reset-password"
                    onclick="tryItOut('POSTapi-v1-auth-reset-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-reset-password"
                    onclick="cancelTryOut('POSTapi-v1-auth-reset-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-reset-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/reset-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-auth-reset-password"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone_number</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone_number"                data-endpoint="POSTapi-v1-auth-reset-password"
               value="0551234567"
               data-component="body">
    <br>
<p>Same phone used for send-otp / verify-otp. Example: <code>0551234567</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-auth-reset-password"
               value="newsecret123"
               data-component="body">
    <br>
<p>New password (min 6 chars). Example: <code>newsecret123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-v1-auth-reset-password"
               value="newsecret123"
               data-component="body">
    <br>
<p>Password confirmation. Example: <code>newsecret123</code></p>
        </div>
        </form>

                    <h2 id="authentication-PUTapi-v1-auth-change-password">Change Password</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Change the authenticated user's password.</p>

<span id="example-requests-PUTapi-v1-auth-change-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://algfari.test/api/v1/auth/change-password" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"current_password\": \"oldsecret123\",
    \"password\": \"newsecret123\",
    \"password_confirmation\": \"newsecret123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/auth/change-password"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "current_password": "oldsecret123",
    "password": "newsecret123",
    "password_confirmation": "newsecret123"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-auth-change-password">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تم تغيير كلمة المرور بنجاح&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;كلمة المرور الحالية غير صحيحة&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v1-auth-change-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-auth-change-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-auth-change-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-auth-change-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-auth-change-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-auth-change-password" data-method="PUT"
      data-path="api/v1/auth/change-password"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-auth-change-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-auth-change-password"
                    onclick="tryItOut('PUTapi-v1-auth-change-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-auth-change-password"
                    onclick="cancelTryOut('PUTapi-v1-auth-change-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-auth-change-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/auth/change-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-auth-change-password"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-auth-change-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-auth-change-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="PUTapi-v1-auth-change-password"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>current_password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="current_password"                data-endpoint="PUTapi-v1-auth-change-password"
               value="oldsecret123"
               data-component="body">
    <br>
<p>Current password. Example: <code>oldsecret123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="PUTapi-v1-auth-change-password"
               value="newsecret123"
               data-component="body">
    <br>
<p>New password (min 6 chars). Example: <code>newsecret123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="PUTapi-v1-auth-change-password"
               value="newsecret123"
               data-component="body">
    <br>
<p>Password confirmation. Example: <code>newsecret123</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-auth-send-email-verification">Send Email Verification Code</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Send a 6-digit verification code to the authenticated user's email address.</p>

<span id="example-requests-POSTapi-v1-auth-send-email-verification">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/auth/send-email-verification" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/auth/send-email-verification"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-send-email-verification">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تم إرسال رمز التحقق إلى بريدك الإلكتروني.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;لا يوجد بريد إلكتروني مرتبط بحسابك.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;البريد الإلكتروني مُحقَّق مسبقًا.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-auth-send-email-verification" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-send-email-verification"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-send-email-verification"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-send-email-verification" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-send-email-verification">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-send-email-verification" data-method="POST"
      data-path="api/v1/auth/send-email-verification"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-send-email-verification', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-send-email-verification"
                    onclick="tryItOut('POSTapi-v1-auth-send-email-verification');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-send-email-verification"
                    onclick="cancelTryOut('POSTapi-v1-auth-send-email-verification');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-send-email-verification"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/send-email-verification</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-auth-send-email-verification"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-send-email-verification"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-send-email-verification"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-auth-send-email-verification"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        </form>

                    <h2 id="authentication-POSTapi-v1-auth-verify-email">Verify Email Code</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Verify the 6-digit code sent to the authenticated user's email.</p>

<span id="example-requests-POSTapi-v1-auth-verify-email">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/auth/verify-email" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"code\": \"482910\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/auth/verify-email"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "code": "482910"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-verify-email">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تم التحقق من البريد الإلكتروني بنجاح.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;رمز التحقق غير صحيح أو منتهي الصلاحية.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-auth-verify-email" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-verify-email"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-verify-email"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-verify-email" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-verify-email">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-verify-email" data-method="POST"
      data-path="api/v1/auth/verify-email"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-verify-email', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-verify-email"
                    onclick="tryItOut('POSTapi-v1-auth-verify-email');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-verify-email"
                    onclick="cancelTryOut('POSTapi-v1-auth-verify-email');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-verify-email"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/verify-email</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-auth-verify-email"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-verify-email"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-verify-email"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-auth-verify-email"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-v1-auth-verify-email"
               value="482910"
               data-component="body">
    <br>
<p>The 6-digit verification code. Example: <code>482910</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-auth-send-email-verification-link">Send Email Verification Link (signed URL)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Sends a 24h signed link to the authenticated user's email.</p>

<span id="example-requests-POSTapi-v1-auth-send-email-verification-link">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/auth/send-email-verification-link" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/auth/send-email-verification-link"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-send-email-verification-link">
</span>
<span id="execution-results-POSTapi-v1-auth-send-email-verification-link" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-send-email-verification-link"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-send-email-verification-link"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-send-email-verification-link" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-send-email-verification-link">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-send-email-verification-link" data-method="POST"
      data-path="api/v1/auth/send-email-verification-link"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-send-email-verification-link', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-send-email-verification-link"
                    onclick="tryItOut('POSTapi-v1-auth-send-email-verification-link');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-send-email-verification-link"
                    onclick="cancelTryOut('POSTapi-v1-auth-send-email-verification-link');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-send-email-verification-link"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/send-email-verification-link</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-auth-send-email-verification-link"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-send-email-verification-link"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-send-email-verification-link"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-auth-send-email-verification-link"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        </form>

                    <h2 id="authentication-GETapi-v1-auth-email-verify-link--user_id-">Verify Email via Signed Link</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Public endpoint hit when the user clicks the email link.</p>

<span id="example-requests-GETapi-v1-auth-email-verify-link--user_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/auth/email/verify-link/1" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/auth/email/verify-link/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-auth-email-verify-link--user_id-">
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;رابط التحقق غير صالح أو منتهي الصلاحية.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-auth-email-verify-link--user_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-auth-email-verify-link--user_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-auth-email-verify-link--user_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-auth-email-verify-link--user_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-auth-email-verify-link--user_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-auth-email-verify-link--user_id-" data-method="GET"
      data-path="api/v1/auth/email/verify-link/{user_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-auth-email-verify-link--user_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-auth-email-verify-link--user_id-"
                    onclick="tryItOut('GETapi-v1-auth-email-verify-link--user_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-auth-email-verify-link--user_id-"
                    onclick="cancelTryOut('GETapi-v1-auth-email-verify-link--user_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-auth-email-verify-link--user_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/auth/email/verify-link/{user_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-auth-email-verify-link--user_id-"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-auth-email-verify-link--user_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-auth-email-verify-link--user_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-auth-email-verify-link--user_id-"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="GETapi-v1-auth-email-verify-link--user_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="authentication-POSTapi-v1-auth-forgot-password-email">Forgot Password via Email</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-forgot-password-email">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/auth/forgot-password/email" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"email\": \"gbailey@example.net\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/auth/forgot-password/email"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "email": "gbailey@example.net"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-forgot-password-email">
</span>
<span id="execution-results-POSTapi-v1-auth-forgot-password-email" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-forgot-password-email"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-forgot-password-email"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-forgot-password-email" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-forgot-password-email">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-forgot-password-email" data-method="POST"
      data-path="api/v1/auth/forgot-password/email"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-forgot-password-email', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-forgot-password-email"
                    onclick="tryItOut('POSTapi-v1-auth-forgot-password-email');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-forgot-password-email"
                    onclick="cancelTryOut('POSTapi-v1-auth-forgot-password-email');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-forgot-password-email"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/forgot-password/email</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-forgot-password-email"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-forgot-password-email"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-auth-forgot-password-email"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-forgot-password-email"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Example: <code>gbailey@example.net</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-auth-password-reset-link--user_id-">Reset Password via Email Link</h2>

<p>
</p>

<p>Called by the link target after the user submits new password.</p>

<span id="example-requests-POSTapi-v1-auth-password-reset-link--user_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/auth/password/reset-link/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"password\": \"|]|{+-\",
    \"password_confirmation\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/auth/password/reset-link/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "password": "|]|{+-",
    "password_confirmation": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-password-reset-link--user_id-">
</span>
<span id="execution-results-POSTapi-v1-auth-password-reset-link--user_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-password-reset-link--user_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-password-reset-link--user_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-password-reset-link--user_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-password-reset-link--user_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-password-reset-link--user_id-" data-method="POST"
      data-path="api/v1/auth/password/reset-link/{user_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-password-reset-link--user_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-password-reset-link--user_id-"
                    onclick="tryItOut('POSTapi-v1-auth-password-reset-link--user_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-password-reset-link--user_id-"
                    onclick="cancelTryOut('POSTapi-v1-auth-password-reset-link--user_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-password-reset-link--user_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/password/reset-link/{user_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-password-reset-link--user_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-password-reset-link--user_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-auth-password-reset-link--user_id-"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="POSTapi-v1-auth-password-reset-link--user_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-auth-password-reset-link--user_id-"
               value="|]|{+-"
               data-component="body">
    <br>
<p>min:8 letters+numbers Example: <code>|]|{+-</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-v1-auth-password-reset-link--user_id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-v1-auth-logout">Logout</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Revoke the current access token.</p>

<span id="example-requests-POSTapi-v1-auth-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/auth/logout" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/auth/logout"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-logout">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تم تسجيل الخروج بنجاح&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-auth-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-logout" data-method="POST"
      data-path="api/v1/auth/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-logout"
                    onclick="tryItOut('POSTapi-v1-auth-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-logout"
                    onclick="cancelTryOut('POSTapi-v1-auth-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-auth-logout"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-auth-logout"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        </form>

                <h1 id="members">Members</h1>

    <p>APIs for managing family/tribe members.</p>

                                <h2 id="members-GETapi-v1-members">List Members</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of active members. Supports search and filtering.</p>

<span id="example-requests-GETapi-v1-members">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/members?search=%D9%85%D8%AD%D9%85%D8%AF&amp;family=architecto&amp;family_id=16&amp;city=%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6&amp;gender=male&amp;is_featured=1&amp;per_page=15" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/members"
);

const params = {
    "search": "محمد",
    "family": "architecto",
    "family_id": "16",
    "city": "الرياض",
    "gender": "male",
    "is_featured": "1",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-members">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;full_name&quot;: &quot;محمد القحطاني&quot;,
            &quot;phone_number&quot;: &quot;0551234567&quot;,
            &quot;national_id&quot;: &quot;1234567890&quot;,
            &quot;email&quot;: &quot;mohammed@example.com&quot;,
            &quot;city&quot;: &quot;الرياض&quot;,
            &quot;region&quot;: &quot;منطقة الرياض&quot;,
            &quot;bio&quot;: &quot;مهندس برمجيات&quot;,
            &quot;gender&quot;: &quot;male&quot;,
            &quot;role&quot;: &quot;member&quot;,
            &quot;status&quot;: &quot;active&quot;,
            &quot;is_featured&quot;: false,
            &quot;profile_image&quot;: null,
            &quot;created_at&quot;: &quot;2026-04-01T10:00:00.000000Z&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://algfari.test/api/v1/members?page=1&quot;,
        &quot;last&quot;: &quot;http://algfari.test/api/v1/members?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;per_page&quot;: 15,
        &quot;total&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-members" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-members"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-members"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-members" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-members">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-members" data-method="GET"
      data-path="api/v1/members"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-members', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-members"
                    onclick="tryItOut('GETapi-v1-members');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-members"
                    onclick="cancelTryOut('GETapi-v1-members');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-members"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/members</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-members"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-members"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-members"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-members"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-v1-members"
               value="محمد"
               data-component="query">
    <br>
<p>Search by name or phone. Example: <code>محمد</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>family</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="family"                data-endpoint="GETapi-v1-members"
               value="architecto"
               data-component="query">
    <br>
<p>Search member family name (partial match). Example: <code>architecto</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>family_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="family_id"                data-endpoint="GETapi-v1-members"
               value="16"
               data-component="query">
    <br>
<p>Filter by linked family id. Example: <code>16</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="GETapi-v1-members"
               value="الرياض"
               data-component="query">
    <br>
<p>Filter by city. Example: <code>الرياض</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="GETapi-v1-members"
               value="male"
               data-component="query">
    <br>
<p>Filter by gender (male/female). Example: <code>male</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>is_featured</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="GETapi-v1-members" style="display: none">
            <input type="radio" name="is_featured"
                   value="1"
                   data-endpoint="GETapi-v1-members"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-members" style="display: none">
            <input type="radio" name="is_featured"
                   value="0"
                   data-endpoint="GETapi-v1-members"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Filter featured members only. Example: <code>true</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-members"
               value="15"
               data-component="query">
    <br>
<p>Items per page. Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="members-GETapi-v1-members--id-">Member Details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get detailed information about a specific member.</p>

<span id="example-requests-GETapi-v1-members--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/members/1" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/members/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-members--id-">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;full_name&quot;: &quot;محمد القحطاني&quot;,
        &quot;phone_number&quot;: &quot;0551234567&quot;,
        &quot;national_id&quot;: &quot;1234567890&quot;,
        &quot;email&quot;: &quot;mohammed@example.com&quot;,
        &quot;city&quot;: &quot;الرياض&quot;,
        &quot;region&quot;: &quot;منطقة الرياض&quot;,
        &quot;bio&quot;: &quot;مهندس برمجيات&quot;,
        &quot;gender&quot;: &quot;male&quot;,
        &quot;role&quot;: &quot;member&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;is_featured&quot;: false,
        &quot;social_links&quot;: {
            &quot;twitter&quot;: &quot;https://twitter.com/mohammed&quot;
        },
        &quot;profile_image&quot;: &quot;http://algfari.test/storage/media/1/profile.jpg&quot;,
        &quot;created_at&quot;: &quot;2026-04-01T10:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-members--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-members--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-members--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-members--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-members--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-members--id-" data-method="GET"
      data-path="api/v1/members/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-members--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-members--id-"
                    onclick="tryItOut('GETapi-v1-members--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-members--id-"
                    onclick="cancelTryOut('GETapi-v1-members--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-members--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/members/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-members--id-"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-members--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-members--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-members--id-"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-members--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the member. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>member</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="member"                data-endpoint="GETapi-v1-members--id-"
               value="1"
               data-component="url">
    <br>
<p>The member user id. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="members-PUTapi-v1-members--id-">Update Member</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update a member's profile information.</p>

<span id="example-requests-PUTapi-v1-members--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://algfari.test/api/v1/members/1" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --form "full_name=محمد أحمد"\
    --form "email=mohammed@example.com"\
    --form "family_id=16"\
    --form "pending_family_name=architecto"\
    --form "workplace=g"\
    --form "current_job=z"\
    --form "city_id=16"\
    --form "region_id=16"\
    --form "bio=مطور برمجيات"\
    --form "city=الرياض"\
    --form "region=منطقة الرياض"\
    --form "profile_image=@C:\Users\hp\AppData\Local\Temp\php13F3.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/members/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

const body = new FormData();
body.append('full_name', 'محمد أحمد');
body.append('email', 'mohammed@example.com');
body.append('family_id', '16');
body.append('pending_family_name', 'architecto');
body.append('workplace', 'g');
body.append('current_job', 'z');
body.append('city_id', '16');
body.append('region_id', '16');
body.append('bio', 'مطور برمجيات');
body.append('city', 'الرياض');
body.append('region', 'منطقة الرياض');
body.append('profile_image', document.querySelector('input[name="profile_image"]').files[0]);

fetch(url, {
    method: "PUT",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-members--id-">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تم التحديث بنجاح&quot;,
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;full_name&quot;: &quot;محمد أحمد&quot;,
        &quot;phone_number&quot;: &quot;0551234567&quot;,
        &quot;email&quot;: &quot;mohammed@example.com&quot;,
        &quot;city&quot;: &quot;الرياض&quot;,
        &quot;region&quot;: &quot;منطقة الرياض&quot;,
        &quot;bio&quot;: &quot;مطور برمجيات&quot;,
        &quot;gender&quot;: &quot;male&quot;,
        &quot;role&quot;: &quot;member&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;is_featured&quot;: false
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, validation error):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;The email has already been taken.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v1-members--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-members--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-members--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-members--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-members--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-members--id-" data-method="PUT"
      data-path="api/v1/members/{id}"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-members--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-members--id-"
                    onclick="tryItOut('PUTapi-v1-members--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-members--id-"
                    onclick="cancelTryOut('PUTapi-v1-members--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-members--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/members/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/members/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-members--id-"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-members--id-"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-members--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="PUTapi-v1-members--id-"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-members--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the member. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>member</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="member"                data-endpoint="PUTapi-v1-members--id-"
               value="1"
               data-component="url">
    <br>
<p>The member user id. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>full_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="full_name"                data-endpoint="PUTapi-v1-members--id-"
               value="محمد أحمد"
               data-component="body">
    <br>
<p>Full name. Example: <code>محمد أحمد</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-v1-members--id-"
               value="mohammed@example.com"
               data-component="body">
    <br>
<p>Email address. Example: <code>mohammed@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>family_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="family_id"                data-endpoint="PUTapi-v1-members--id-"
               value="16"
               data-component="body">
    <br>
<p>Admin only: set linked family. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>pending_family_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="pending_family_name"                data-endpoint="PUTapi-v1-members--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Free-text family name (creates admin review request). Send empty to withdraw. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>workplace</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="workplace"                data-endpoint="PUTapi-v1-members--id-"
               value="g"
               data-component="body">
    <br>
<p>validation.max. Example: <code>g</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>current_job</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="current_job"                data-endpoint="PUTapi-v1-members--id-"
               value="z"
               data-component="body">
    <br>
<p>validation.max. Example: <code>z</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="city_id"                data-endpoint="PUTapi-v1-members--id-"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the cities table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>region_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="region_id"                data-endpoint="PUTapi-v1-members--id-"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the regions table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bio</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bio"                data-endpoint="PUTapi-v1-members--id-"
               value="مطور برمجيات"
               data-component="body">
    <br>
<p>Biography. Example: <code>مطور برمجيات</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>social_links</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="social_links"                data-endpoint="PUTapi-v1-members--id-"
               value=""
               data-component="body">
    <br>
<p>Social media links.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>profile_image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="profile_image"                data-endpoint="PUTapi-v1-members--id-"
               value=""
               data-component="body">
    <br>
<p>Profile image (max 5MB). Example: <code>C:\Users\hp\AppData\Local\Temp\php13F3.tmp</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>city</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="city"                data-endpoint="PUTapi-v1-members--id-"
               value="الرياض"
               data-component="body">
    <br>
<p>City. Example: <code>الرياض</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>region</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="region"                data-endpoint="PUTapi-v1-members--id-"
               value="منطقة الرياض"
               data-component="body">
    <br>
<p>Region. Example: <code>منطقة الرياض</code></p>
        </div>
        </form>

                    <h2 id="members-GETapi-v1-members--member_id--card">Member Card</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get the membership card information for a member.</p>

<span id="example-requests-GETapi-v1-members--member_id--card">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/members/1/card" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/members/1/card"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-members--member_id--card">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;full_name&quot;: &quot;محمد القحطاني&quot;,
        &quot;phone_number&quot;: &quot;0551234567&quot;,
        &quot;national_id&quot;: &quot;1234567890&quot;,
        &quot;city&quot;: &quot;الرياض&quot;,
        &quot;region&quot;: &quot;منطقة الرياض&quot;,
        &quot;gender&quot;: &quot;male&quot;,
        &quot;role&quot;: &quot;member&quot;,
        &quot;profile_image&quot;: &quot;http://algfari.test/storage/media/1/profile.jpg&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-members--member_id--card" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-members--member_id--card"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-members--member_id--card"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-members--member_id--card" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-members--member_id--card">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-members--member_id--card" data-method="GET"
      data-path="api/v1/members/{member_id}/card"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-members--member_id--card', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-members--member_id--card"
                    onclick="tryItOut('GETapi-v1-members--member_id--card');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-members--member_id--card"
                    onclick="cancelTryOut('GETapi-v1-members--member_id--card');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-members--member_id--card"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/members/{member_id}/card</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-members--member_id--card"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-members--member_id--card"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-members--member_id--card"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-members--member_id--card"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>member_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="member_id"                data-endpoint="GETapi-v1-members--member_id--card"
               value="1"
               data-component="url">
    <br>
<p>The ID of the member. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>member</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="member"                data-endpoint="GETapi-v1-members--member_id--card"
               value="1"
               data-component="url">
    <br>
<p>The member user id. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="news">News</h1>

    <p>APIs for browsing family/tribe news.</p>

                                <h2 id="news-GETapi-v1-news">List News</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of published news articles. Urgent items appear first.</p>

<span id="example-requests-GETapi-v1-news">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/news?search=%D8%A7%D8%AC%D8%AA%D9%85%D8%A7%D8%B9&amp;per_page=15" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/news"
);

const params = {
    "search": "اجتماع",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-news">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;title&quot;: {
                &quot;ar&quot;: &quot;اجتماع مجلس العائلة السنوي&quot;,
                &quot;en&quot;: &quot;Annual family council meeting&quot;
            },
            &quot;content&quot;: {
                &quot;ar&quot;: &quot;تفاصيل الخبر...&quot;,
                &quot;en&quot;: &quot;Full article...&quot;
            },
            &quot;is_urgent&quot;: false,
            &quot;published_at&quot;: &quot;2026-04-10T08:00:00.000000Z&quot;,
            &quot;time_from&quot;: &quot;10:00:00&quot;,
            &quot;time_to&quot;: &quot;14:00:00&quot;,
            &quot;cover_image&quot;: &quot;http://algfari.test/storage/media/5/cover.jpg&quot;,
            &quot;cover_image_medium&quot;: &quot;http://algfari.test/storage/media/5/conversions/cover-medium.jpg&quot;,
            &quot;cover_image_thumb&quot;: &quot;http://algfari.test/storage/media/5/conversions/cover-thumb.jpg&quot;,
            &quot;gallery&quot;: [
                {
                    &quot;url&quot;: &quot;...&quot;,
                    &quot;medium&quot;: &quot;...&quot;,
                    &quot;thumb&quot;: &quot;...&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-04-10T08:00:00.000000Z&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://algfari.test/api/v1/news?page=1&quot;,
        &quot;last&quot;: &quot;http://algfari.test/api/v1/news?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;per_page&quot;: 15,
        &quot;total&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-news" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-news"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-news"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-news" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-news">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-news" data-method="GET"
      data-path="api/v1/news"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-news', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-news"
                    onclick="tryItOut('GETapi-v1-news');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-news"
                    onclick="cancelTryOut('GETapi-v1-news');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-news"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/news</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-news"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-news"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-news"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-news"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-v1-news"
               value="اجتماع"
               data-component="query">
    <br>
<p>Search in title and content (Arabic and English). Example: <code>اجتماع</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-news"
               value="15"
               data-component="query">
    <br>
<p>Items per page. Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="news-GETapi-v1-news--id-">News Details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get details of a specific news article.</p>

<span id="example-requests-GETapi-v1-news--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/news/1" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/news/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-news--id-">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;title&quot;: {
            &quot;ar&quot;: &quot;اجتماع مجلس العائلة السنوي&quot;,
            &quot;en&quot;: &quot;Annual family council meeting&quot;
        },
        &quot;content&quot;: {
            &quot;ar&quot;: &quot;نص الخبر الكامل...&quot;,
            &quot;en&quot;: &quot;Full article text...&quot;
        },
        &quot;is_urgent&quot;: true,
        &quot;published_at&quot;: &quot;2026-04-10T08:00:00.000000Z&quot;,
        &quot;time_from&quot;: &quot;10:00:00&quot;,
        &quot;time_to&quot;: &quot;14:00:00&quot;,
        &quot;cover_image&quot;: &quot;http://algfari.test/storage/media/5/cover.jpg&quot;,
        &quot;cover_image_medium&quot;: &quot;http://algfari.test/storage/media/5/conversions/cover-medium.jpg&quot;,
        &quot;cover_image_thumb&quot;: &quot;http://algfari.test/storage/media/5/conversions/cover-thumb.jpg&quot;,
        &quot;gallery&quot;: [
            {
                &quot;url&quot;: &quot;http://algfari.test/storage/media/6/photo1.jpg&quot;,
                &quot;medium&quot;: &quot;...&quot;,
                &quot;thumb&quot;: &quot;...&quot;
            }
        ],
        &quot;created_at&quot;: &quot;2026-04-10T08:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-news--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-news--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-news--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-news--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-news--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-news--id-" data-method="GET"
      data-path="api/v1/news/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-news--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-news--id-"
                    onclick="tryItOut('GETapi-v1-news--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-news--id-"
                    onclick="cancelTryOut('GETapi-v1-news--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-news--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/news/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-news--id-"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-news--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-news--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-news--id-"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-news--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the news. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>news</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="news"                data-endpoint="GETapi-v1-news--id-"
               value="1"
               data-component="url">
    <br>
<p>The news ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="events">Events</h1>

    <p>APIs for browsing events and managing RSVPs.</p>

                                <h2 id="events-GETapi-v1-events">List Events</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of active events.</p>

<span id="example-requests-GETapi-v1-events">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/events?event_type=wedding&amp;upcoming=1&amp;per_page=15" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/events"
);

const params = {
    "event_type": "wedding",
    "upcoming": "1",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-events">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;c3d4e5f6-7890-1abc-def2-345678901bcd&quot;,
            &quot;title&quot;: &quot;حفل زفاف آل محمد&quot;,
            &quot;description&quot;: &quot;حفل زفاف الأخ محمد بن عبدالله، يسعدنا دعوتكم للحضور.&quot;,
            &quot;event_type&quot;: &quot;wedding&quot;,
            &quot;event_date&quot;: &quot;2026-05-01T18:00:00.000000Z&quot;,
            &quot;end_date&quot;: &quot;2026-05-01T23:00:00.000000Z&quot;,
            &quot;location_name&quot;: &quot;قاعة الأمير سلطان - الرياض&quot;,
            &quot;location_lat&quot;: &quot;24.71370000&quot;,
            &quot;location_lng&quot;: &quot;46.67530000&quot;,
            &quot;is_active&quot;: true,
            &quot;attendees_count&quot;: 45,
            &quot;creator&quot;: {
                &quot;id&quot;: &quot;9a8b7c6d-1234-5678-abcd-ef0123456789&quot;,
                &quot;full_name&quot;: &quot;عبدالله القحطاني&quot;
            },
            &quot;cover_image&quot;: &quot;http://algfari.test/storage/media/10/event-cover.jpg&quot;,
            &quot;created_at&quot;: &quot;2026-04-05T12:00:00.000000Z&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://algfari.test/api/v1/events?page=1&quot;,
        &quot;last&quot;: &quot;http://algfari.test/api/v1/events?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;per_page&quot;: 15,
        &quot;total&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-events" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-events"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-events"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-events" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-events">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-events" data-method="GET"
      data-path="api/v1/events"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-events', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-events"
                    onclick="tryItOut('GETapi-v1-events');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-events"
                    onclick="cancelTryOut('GETapi-v1-events');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-events"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/events</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-events"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-events"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-events"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-events"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>event_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="event_type"                data-endpoint="GETapi-v1-events"
               value="wedding"
               data-component="query">
    <br>
<p>Filter by type (wedding/death/other). Example: <code>wedding</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>upcoming</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="GETapi-v1-events" style="display: none">
            <input type="radio" name="upcoming"
                   value="1"
                   data-endpoint="GETapi-v1-events"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-events" style="display: none">
            <input type="radio" name="upcoming"
                   value="0"
                   data-endpoint="GETapi-v1-events"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Show only upcoming events. Example: <code>true</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-events"
               value="15"
               data-component="query">
    <br>
<p>Items per page. Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="events-GETapi-v1-events--id-">Event Details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get details of a specific event with attendee count.</p>

<span id="example-requests-GETapi-v1-events--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/events/1" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/events/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-events--id-">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;c3d4e5f6-7890-1abc-def2-345678901bcd&quot;,
        &quot;title&quot;: &quot;حفل زفاف آل محمد&quot;,
        &quot;description&quot;: &quot;حفل زفاف الأخ محمد بن عبدالله، يسعدنا دعوتكم للحضور والمشاركة في هذه المناسبة السعيدة.&quot;,
        &quot;event_type&quot;: &quot;wedding&quot;,
        &quot;event_date&quot;: &quot;2026-05-01T18:00:00.000000Z&quot;,
        &quot;end_date&quot;: &quot;2026-05-01T23:00:00.000000Z&quot;,
        &quot;location_name&quot;: &quot;قاعة الأمير سلطان - الرياض&quot;,
        &quot;location_lat&quot;: &quot;24.71370000&quot;,
        &quot;location_lng&quot;: &quot;46.67530000&quot;,
        &quot;is_active&quot;: true,
        &quot;attendees_count&quot;: 45,
        &quot;creator&quot;: {
            &quot;id&quot;: &quot;9a8b7c6d-1234-5678-abcd-ef0123456789&quot;,
            &quot;full_name&quot;: &quot;عبدالله القحطاني&quot;
        },
        &quot;cover_image&quot;: &quot;http://algfari.test/storage/media/10/event-cover.jpg&quot;,
        &quot;created_at&quot;: &quot;2026-04-05T12:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-events--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-events--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-events--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-events--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-events--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-events--id-" data-method="GET"
      data-path="api/v1/events/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-events--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-events--id-"
                    onclick="tryItOut('GETapi-v1-events--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-events--id-"
                    onclick="cancelTryOut('GETapi-v1-events--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-events--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/events/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-events--id-"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-events--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-events--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-events--id-"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-events--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the event. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>event</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="event"                data-endpoint="GETapi-v1-events--id-"
               value="9a8b7c6d-1234-5678-abcd-ef0123456789"
               data-component="url">
    <br>
<p>The event UUID. Example: <code>9a8b7c6d-1234-5678-abcd-ef0123456789</code></p>
            </div>
                    </form>

                    <h2 id="events-POSTapi-v1-events--event_id--rsvp">RSVP to Event</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Submit or update your RSVP status for an event.</p>

<span id="example-requests-POSTapi-v1-events--event_id--rsvp">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/events/1/rsvp" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"status\": \"going\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/events/1/rsvp"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "status": "going"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-events--event_id--rsvp">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تم تحديث الحضور&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-events--event_id--rsvp" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-events--event_id--rsvp"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-events--event_id--rsvp"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-events--event_id--rsvp" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-events--event_id--rsvp">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-events--event_id--rsvp" data-method="POST"
      data-path="api/v1/events/{event_id}/rsvp"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-events--event_id--rsvp', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-events--event_id--rsvp"
                    onclick="tryItOut('POSTapi-v1-events--event_id--rsvp');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-events--event_id--rsvp"
                    onclick="cancelTryOut('POSTapi-v1-events--event_id--rsvp');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-events--event_id--rsvp"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/events/{event_id}/rsvp</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-events--event_id--rsvp"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-events--event_id--rsvp"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-events--event_id--rsvp"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-events--event_id--rsvp"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>event_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="event_id"                data-endpoint="POSTapi-v1-events--event_id--rsvp"
               value="1"
               data-component="url">
    <br>
<p>The ID of the event. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>event</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="event"                data-endpoint="POSTapi-v1-events--event_id--rsvp"
               value="9a8b7c6d-1234-5678-abcd-ef0123456789"
               data-component="url">
    <br>
<p>The event UUID. Example: <code>9a8b7c6d-1234-5678-abcd-ef0123456789</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-v1-events--event_id--rsvp"
               value="going"
               data-component="body">
    <br>
<p>RSVP status (going/maybe/declined). Example: <code>going</code></p>
        </div>
        </form>

                    <h2 id="events-POSTapi-v1-events--event_id--gallery">Upload Gallery Images</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Upload one or more images to the event's gallery. Only the creator or an admin can upload.</p>

<span id="example-requests-POSTapi-v1-events--event_id--gallery">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/events/1/gallery" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --form "images[]=@C:\Users\hp\AppData\Local\Temp\php1462.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/events/1/gallery"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

const body = new FormData();
body.append('images[]', document.querySelector('input[name="images[]"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-events--event_id--gallery">
</span>
<span id="execution-results-POSTapi-v1-events--event_id--gallery" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-events--event_id--gallery"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-events--event_id--gallery"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-events--event_id--gallery" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-events--event_id--gallery">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-events--event_id--gallery" data-method="POST"
      data-path="api/v1/events/{event_id}/gallery"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-events--event_id--gallery', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-events--event_id--gallery"
                    onclick="tryItOut('POSTapi-v1-events--event_id--gallery');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-events--event_id--gallery"
                    onclick="cancelTryOut('POSTapi-v1-events--event_id--gallery');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-events--event_id--gallery"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/events/{event_id}/gallery</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-events--event_id--gallery"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-events--event_id--gallery"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-events--event_id--gallery"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-events--event_id--gallery"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>event_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="event_id"                data-endpoint="POSTapi-v1-events--event_id--gallery"
               value="1"
               data-component="url">
    <br>
<p>The ID of the event. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>images</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="images[0]"                data-endpoint="POSTapi-v1-events--event_id--gallery"
               data-component="body">
        <input type="file" style="display: none"
               name="images[1]"                data-endpoint="POSTapi-v1-events--event_id--gallery"
               data-component="body">
    <br>
<p>Up to 10 images (max 10MB each).</p>
        </div>
        </form>

                    <h2 id="events-DELETEapi-v1-events--event_id--gallery--media-">Delete Gallery Image</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-events--event_id--gallery--media-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://algfari.test/api/v1/events/1/gallery/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/events/1/gallery/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-events--event_id--gallery--media-">
</span>
<span id="execution-results-DELETEapi-v1-events--event_id--gallery--media-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-events--event_id--gallery--media-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-events--event_id--gallery--media-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-events--event_id--gallery--media-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-events--event_id--gallery--media-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-events--event_id--gallery--media-" data-method="DELETE"
      data-path="api/v1/events/{event_id}/gallery/{media}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-events--event_id--gallery--media-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-events--event_id--gallery--media-"
                    onclick="tryItOut('DELETEapi-v1-events--event_id--gallery--media-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-events--event_id--gallery--media-"
                    onclick="cancelTryOut('DELETEapi-v1-events--event_id--gallery--media-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-events--event_id--gallery--media-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/events/{event_id}/gallery/{media}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-events--event_id--gallery--media-"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-events--event_id--gallery--media-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-events--event_id--gallery--media-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="DELETEapi-v1-events--event_id--gallery--media-"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>event_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="event_id"                data-endpoint="DELETEapi-v1-events--event_id--gallery--media-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the event. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>media</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="media"                data-endpoint="DELETEapi-v1-events--event_id--gallery--media-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                <h1 id="offers">Offers</h1>

    <p>APIs for browsing member offers and services.</p>

                                <h2 id="offers-GETapi-v1-offers">List Offers</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of active, non-expired offers.</p>

<span id="example-requests-GETapi-v1-offers">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/offers?category=commercial&amp;per_page=15" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/offers"
);

const params = {
    "category": "commercial",
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-offers">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;d4e5f6a7-8901-2bcd-ef34-567890123cde&quot;,
            &quot;title&quot;: &quot;خدمة صيانة المكيفات&quot;,
            &quot;description&quot;: &quot;صيانة وتركيب جميع أنواع المكيفات بأسعار مخفضة لأبناء القبيلة&quot;,
            &quot;category&quot;: &quot;contractor&quot;,
            &quot;service_address&quot;: &quot;الرياض - حي النسيم&quot;,
            &quot;contact_phone&quot;: &quot;0559876543&quot;,
            &quot;contact_whatsapp&quot;: &quot;0559876543&quot;,
            &quot;is_active&quot;: true,
            &quot;expires_at&quot;: &quot;2026-06-01T00:00:00.000000Z&quot;,
            &quot;offered_by&quot;: {
                &quot;id&quot;: &quot;9a8b7c6d-1234-5678-abcd-ef0123456789&quot;,
                &quot;full_name&quot;: &quot;خالد العتيبي&quot;
            },
            &quot;offer_image&quot;: &quot;http://algfari.test/storage/media/15/offer.jpg&quot;,
            &quot;created_at&quot;: &quot;2026-04-01T10:00:00.000000Z&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://algfari.test/api/v1/offers?page=1&quot;,
        &quot;last&quot;: &quot;http://algfari.test/api/v1/offers?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;per_page&quot;: 15,
        &quot;total&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-offers" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-offers"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-offers"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-offers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-offers">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-offers" data-method="GET"
      data-path="api/v1/offers"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-offers', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-offers"
                    onclick="tryItOut('GETapi-v1-offers');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-offers"
                    onclick="cancelTryOut('GETapi-v1-offers');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-offers"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/offers</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-offers"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-offers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-offers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-offers"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category"                data-endpoint="GETapi-v1-offers"
               value="commercial"
               data-component="query">
    <br>
<p>Filter by category (commercial/contractor). Example: <code>commercial</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-offers"
               value="15"
               data-component="query">
    <br>
<p>Items per page. Example: <code>15</code></p>
            </div>
                </form>

                    <h2 id="offers-GETapi-v1-offers--id-">Offer Details</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get details of a specific offer.</p>

<span id="example-requests-GETapi-v1-offers--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/offers/1" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/offers/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-offers--id-">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: &quot;d4e5f6a7-8901-2bcd-ef34-567890123cde&quot;,
        &quot;title&quot;: &quot;خدمة صيانة المكيفات&quot;,
        &quot;description&quot;: &quot;صيانة وتركيب جميع أنواع المكيفات بأسعار مخفضة لأبناء القبيلة. نوفر خدمة منزلية.&quot;,
        &quot;category&quot;: &quot;contractor&quot;,
        &quot;service_address&quot;: &quot;الرياض - حي النسيم&quot;,
        &quot;contact_phone&quot;: &quot;0559876543&quot;,
        &quot;contact_whatsapp&quot;: &quot;0559876543&quot;,
        &quot;is_active&quot;: true,
        &quot;expires_at&quot;: &quot;2026-06-01T00:00:00.000000Z&quot;,
        &quot;offered_by&quot;: {
            &quot;id&quot;: &quot;9a8b7c6d-1234-5678-abcd-ef0123456789&quot;,
            &quot;full_name&quot;: &quot;خالد العتيبي&quot;
        },
        &quot;offer_image&quot;: &quot;http://algfari.test/storage/media/15/offer.jpg&quot;,
        &quot;gallery&quot;: [
            &quot;http://algfari.test/storage/media/16/gallery1.jpg&quot;,
            &quot;http://algfari.test/storage/media/17/gallery2.jpg&quot;
        ],
        &quot;created_at&quot;: &quot;2026-04-01T10:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-offers--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-offers--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-offers--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-offers--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-offers--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-offers--id-" data-method="GET"
      data-path="api/v1/offers/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-offers--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-offers--id-"
                    onclick="tryItOut('GETapi-v1-offers--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-offers--id-"
                    onclick="cancelTryOut('GETapi-v1-offers--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-offers--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/offers/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-offers--id-"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-offers--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-offers--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-offers--id-"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-offers--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the offer. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>offer</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="offer"                data-endpoint="GETapi-v1-offers--id-"
               value="9a8b7c6d-1234-5678-abcd-ef0123456789"
               data-component="url">
    <br>
<p>The offer UUID. Example: <code>9a8b7c6d-1234-5678-abcd-ef0123456789</code></p>
            </div>
                    </form>

                <h1 id="family-fund">Family Fund</h1>

    <p>APIs for the family fund: profile content, initiatives, transactions, support requests.</p>

                                <h2 id="family-fund-GETapi-v1-fund">List Transactions</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-fund">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/fund?type=architecto&amp;per_page=16" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/fund"
);

const params = {
    "type": "architecto",
    "per_page": "16",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-fund">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-fund" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-fund"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-fund"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-fund" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-fund">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-fund" data-method="GET"
      data-path="api/v1/fund"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-fund', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-fund"
                    onclick="tryItOut('GETapi-v1-fund');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-fund"
                    onclick="cancelTryOut('GETapi-v1-fund');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-fund"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/fund</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-fund"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-fund"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-fund"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-fund"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="GETapi-v1-fund"
               value="architecto"
               data-component="query">
    <br>
<p>Filter by transaction type (donation/expense). Example: <code>architecto</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-fund"
               value="16"
               data-component="query">
    <br>
<p>Items per page. Example: <code>16</code></p>
            </div>
                </form>

                    <h2 id="family-fund-GETapi-v1-fund-summary">Fund Summary</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-fund-summary">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/fund/summary" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/fund/summary"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-fund-summary">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-fund-summary" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-fund-summary"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-fund-summary"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-fund-summary" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-fund-summary">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-fund-summary" data-method="GET"
      data-path="api/v1/fund/summary"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-fund-summary', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-fund-summary"
                    onclick="tryItOut('GETapi-v1-fund-summary');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-fund-summary"
                    onclick="cancelTryOut('GETapi-v1-fund-summary');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-fund-summary"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/fund/summary</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-fund-summary"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-fund-summary"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-fund-summary"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-fund-summary"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        </form>

                    <h2 id="family-fund-GETapi-v1-fund-profile">Fund Profile</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Returns the fund's about/vision/mission/goals static content.</p>

<span id="example-requests-GETapi-v1-fund-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/fund/profile" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/fund/profile"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-fund-profile">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-fund-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-fund-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-fund-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-fund-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-fund-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-fund-profile" data-method="GET"
      data-path="api/v1/fund/profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-fund-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-fund-profile"
                    onclick="tryItOut('GETapi-v1-fund-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-fund-profile"
                    onclick="cancelTryOut('GETapi-v1-fund-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-fund-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/fund/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-fund-profile"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-fund-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-fund-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-fund-profile"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        </form>

                    <h2 id="family-fund-GETapi-v1-fund-initiatives">List Initiatives</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-fund-initiatives">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/fund/initiatives" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/fund/initiatives"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-fund-initiatives">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-fund-initiatives" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-fund-initiatives"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-fund-initiatives"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-fund-initiatives" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-fund-initiatives">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-fund-initiatives" data-method="GET"
      data-path="api/v1/fund/initiatives"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-fund-initiatives', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-fund-initiatives"
                    onclick="tryItOut('GETapi-v1-fund-initiatives');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-fund-initiatives"
                    onclick="cancelTryOut('GETapi-v1-fund-initiatives');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-fund-initiatives"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/fund/initiatives</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-fund-initiatives"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-fund-initiatives"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-fund-initiatives"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-fund-initiatives"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        </form>

                    <h2 id="family-fund-GETapi-v1-fund-support-requests">List My Support Requests</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-fund-support-requests">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/fund/support-requests" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/fund/support-requests"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-fund-support-requests">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-fund-support-requests" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-fund-support-requests"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-fund-support-requests"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-fund-support-requests" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-fund-support-requests">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-fund-support-requests" data-method="GET"
      data-path="api/v1/fund/support-requests"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-fund-support-requests', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-fund-support-requests"
                    onclick="tryItOut('GETapi-v1-fund-support-requests');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-fund-support-requests"
                    onclick="cancelTryOut('GETapi-v1-fund-support-requests');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-fund-support-requests"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/fund/support-requests</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-fund-support-requests"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-fund-support-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-fund-support-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-fund-support-requests"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        </form>

                    <h2 id="family-fund-POSTapi-v1-fund-support-requests">Submit Support Request</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-fund-support-requests">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/fund/support-requests" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --form "title=architecto"\
    --form "description=Eius et animi quos velit et."\
    --form "amount_requested=4326.41688"\
    --form "attachments[]=@C:\Users\hp\AppData\Local\Temp\php14A2.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/fund/support-requests"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

const body = new FormData();
body.append('title', 'architecto');
body.append('description', 'Eius et animi quos velit et.');
body.append('amount_requested', '4326.41688');
body.append('attachments[]', document.querySelector('input[name="attachments[]"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-fund-support-requests">
</span>
<span id="execution-results-POSTapi-v1-fund-support-requests" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-fund-support-requests"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-fund-support-requests"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-fund-support-requests" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-fund-support-requests">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-fund-support-requests" data-method="POST"
      data-path="api/v1/fund/support-requests"
      data-authed="1"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-fund-support-requests', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-fund-support-requests"
                    onclick="tryItOut('POSTapi-v1-fund-support-requests');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-fund-support-requests"
                    onclick="cancelTryOut('POSTapi-v1-fund-support-requests');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-fund-support-requests"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/fund/support-requests</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-fund-support-requests"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-fund-support-requests"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-fund-support-requests"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-fund-support-requests"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-v1-fund-support-requests"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-v1-fund-support-requests"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount_requested</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="amount_requested"                data-endpoint="POSTapi-v1-fund-support-requests"
               value="4326.41688"
               data-component="body">
    <br>
<p>Example: <code>4326.41688</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>attachments</code></b>&nbsp;&nbsp;
<small>file[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="attachments[0]"                data-endpoint="POSTapi-v1-fund-support-requests"
               data-component="body">
        <input type="file" style="display: none"
               name="attachments[1]"                data-endpoint="POSTapi-v1-fund-support-requests"
               data-component="body">
    <br>
<p>Optional attachments (pdf/jpg/png/doc).</p>
        </div>
        </form>

                    <h2 id="family-fund-GETapi-v1-fund-support-requests--id-">Show My Support Request</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-fund-support-requests--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/fund/support-requests/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/fund/support-requests/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-fund-support-requests--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-fund-support-requests--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-fund-support-requests--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-fund-support-requests--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-fund-support-requests--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-fund-support-requests--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-fund-support-requests--id-" data-method="GET"
      data-path="api/v1/fund/support-requests/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-fund-support-requests--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-fund-support-requests--id-"
                    onclick="tryItOut('GETapi-v1-fund-support-requests--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-fund-support-requests--id-"
                    onclick="cancelTryOut('GETapi-v1-fund-support-requests--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-fund-support-requests--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/fund/support-requests/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-fund-support-requests--id-"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-fund-support-requests--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-fund-support-requests--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-fund-support-requests--id-"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-v1-fund-support-requests--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the support request. Example: <code>architecto</code></p>
            </div>
                    </form>

                <h1 id="suggestions">Suggestions</h1>

    <p>APIs for submitting member suggestions.</p>

                                <h2 id="suggestions-GETapi-v1-suggestions">List My Suggestions</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of the authenticated user's submitted suggestions, optionally filtered by status.</p>

<span id="example-requests-GETapi-v1-suggestions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/suggestions?status=under_review&amp;per_page=20" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"status\": \"accepted\",
    \"per_page\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/suggestions"
);

const params = {
    "status": "under_review",
    "per_page": "20",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "status": "accepted",
    "per_page": 1
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-suggestions">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;title&quot;: {
                &quot;ar&quot;: &quot;اقتراح جديد&quot;,
                &quot;en&quot;: &quot;New suggestion&quot;
            },
            &quot;description&quot;: {
                &quot;ar&quot;: &quot;وصف الاقتراح&quot;,
                &quot;en&quot;: &quot;Suggestion description&quot;
            },
            &quot;status&quot;: &quot;under_review&quot;,
            &quot;admin_response&quot;: null,
            &quot;reviewed_at&quot;: null,
            &quot;created_at&quot;: &quot;2026-05-17T10:00:00.000000Z&quot;
        }
    ],
    &quot;current_page&quot;: 1,
    &quot;last_page&quot;: 1,
    &quot;per_page&quot;: 20,
    &quot;total&quot;: 1
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-suggestions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-suggestions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-suggestions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-suggestions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-suggestions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-suggestions" data-method="GET"
      data-path="api/v1/suggestions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-suggestions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-suggestions"
                    onclick="tryItOut('GETapi-v1-suggestions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-suggestions"
                    onclick="cancelTryOut('GETapi-v1-suggestions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-suggestions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/suggestions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-suggestions"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-suggestions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-suggestions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-suggestions"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-v1-suggestions"
               value="under_review"
               data-component="query">
    <br>
<p>Filter by status. Allowed values: under_review, accepted, rejected, in_progress. Example: <code>under_review</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-suggestions"
               value="20"
               data-component="query">
    <br>
<p>Items per page (default 20). Example: <code>20</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-v1-suggestions"
               value="accepted"
               data-component="body">
    <br>
<p>Example: <code>accepted</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>under_review</code></li> <li><code>accepted</code></li> <li><code>rejected</code></li> <li><code>in_progress</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-suggestions"
               value="1"
               data-component="body">
    <br>
<p>validation.min validation.max. Example: <code>1</code></p>
        </div>
        </form>

                    <h2 id="suggestions-POSTapi-v1-suggestions">POST api/v1/suggestions</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-suggestions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/suggestions" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"title\": {
        \"ar\": \"b\",
        \"en\": \"n\"
    },
    \"description\": {
        \"ar\": \"architecto\",
        \"en\": \"architecto\"
    },
    \"category\": \"complaint\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/suggestions"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "title": {
        "ar": "b",
        "en": "n"
    },
    "description": {
        "ar": "architecto",
        "en": "architecto"
    },
    "category": "complaint"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-suggestions">
</span>
<span id="execution-results-POSTapi-v1-suggestions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-suggestions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-suggestions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-suggestions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-suggestions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-suggestions" data-method="POST"
      data-path="api/v1/suggestions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-suggestions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-suggestions"
                    onclick="tryItOut('POSTapi-v1-suggestions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-suggestions"
                    onclick="cancelTryOut('POSTapi-v1-suggestions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-suggestions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/suggestions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-suggestions"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-suggestions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-suggestions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-suggestions"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
 &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title.ar"                data-endpoint="POSTapi-v1-suggestions"
               value="b"
               data-component="body">
    <br>
<p>validation.max. Example: <code>b</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>en</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title.en"                data-endpoint="POSTapi-v1-suggestions"
               value="n"
               data-component="body">
    <br>
<p>validation.max. Example: <code>n</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
 &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>ar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description.ar"                data-endpoint="POSTapi-v1-suggestions"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>en</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description.en"                data-endpoint="POSTapi-v1-suggestions"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="category"                data-endpoint="POSTapi-v1-suggestions"
               value="complaint"
               data-component="body">
    <br>
<p>Example: <code>complaint</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>social_initiative</code></li> <li><code>activity</code></li> <li><code>service</code></li> <li><code>complaint</code></li> <li><code>other</code></li></ul>
        </div>
        </form>

                <h1 id="notifications">Notifications</h1>

    <p>APIs for managing user notifications.</p>

                                <h2 id="notifications-GETapi-v1-notifications">List Notifications</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of the authenticated user's notifications.</p>

<span id="example-requests-GETapi-v1-notifications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/notifications" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/notifications"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-notifications">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: &quot;b8c9d0e1-2345-6f78-a901-234567890bcd&quot;,
            &quot;title&quot;: &quot;خبر جديد: اجتماع مجلس العائلة&quot;,
            &quot;body&quot;: &quot;تم نشر خبر جديد بعنوان اجتماع مجلس العائلة السنوي&quot;,
            &quot;type&quot;: &quot;news&quot;,
            &quot;is_read&quot;: false,
            &quot;created_at&quot;: &quot;2026-04-13T10:00:00.000000Z&quot;
        },
        {
            &quot;id&quot;: &quot;c9d0e1f2-3456-7a89-b012-345678901cde&quot;,
            &quot;title&quot;: &quot;فعالية جديدة: حفل زفاف&quot;,
            &quot;body&quot;: &quot;تم إنشاء فعالية جديدة بعنوان حفل زفاف آل محمد&quot;,
            &quot;type&quot;: &quot;event&quot;,
            &quot;is_read&quot;: true,
            &quot;created_at&quot;: &quot;2026-04-12T14:30:00.000000Z&quot;
        }
    ],
    &quot;current_page&quot;: 1,
    &quot;last_page&quot;: 1,
    &quot;per_page&quot;: 20,
    &quot;total&quot;: 2
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-notifications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-notifications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-notifications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-notifications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-notifications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-notifications" data-method="GET"
      data-path="api/v1/notifications"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-notifications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-notifications"
                    onclick="tryItOut('GETapi-v1-notifications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-notifications"
                    onclick="cancelTryOut('GETapi-v1-notifications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-notifications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/notifications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-notifications"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-notifications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-notifications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-notifications"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        </form>

                    <h2 id="notifications-PUTapi-v1-notifications--id--read">Mark Notification as Read</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mark a single notification as read.</p>

<span id="example-requests-PUTapi-v1-notifications--id--read">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://algfari.test/api/v1/notifications/9a8b7c6d-1234-5678-abcd-ef0123456789/read" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/notifications/9a8b7c6d-1234-5678-abcd-ef0123456789/read"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-notifications--id--read">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تم قراءة الإشعار&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;غير موجود&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v1-notifications--id--read" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-notifications--id--read"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-notifications--id--read"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-notifications--id--read" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-notifications--id--read">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-notifications--id--read" data-method="PUT"
      data-path="api/v1/notifications/{id}/read"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-notifications--id--read', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-notifications--id--read"
                    onclick="tryItOut('PUTapi-v1-notifications--id--read');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-notifications--id--read"
                    onclick="cancelTryOut('PUTapi-v1-notifications--id--read');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-notifications--id--read"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/notifications/{id}/read</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-notifications--id--read"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-notifications--id--read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-notifications--id--read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="PUTapi-v1-notifications--id--read"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-v1-notifications--id--read"
               value="9a8b7c6d-1234-5678-abcd-ef0123456789"
               data-component="url">
    <br>
<p>The notification UUID. Example: <code>9a8b7c6d-1234-5678-abcd-ef0123456789</code></p>
            </div>
                    </form>

                    <h2 id="notifications-PUTapi-v1-notifications-read-all">Mark All Notifications as Read</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mark all unread notifications as read for the authenticated user.</p>

<span id="example-requests-PUTapi-v1-notifications-read-all">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://algfari.test/api/v1/notifications/read-all" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/notifications/read-all"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-notifications-read-all">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تم قراءة جميع الإشعارات&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-v1-notifications-read-all" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-notifications-read-all"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-notifications-read-all"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-notifications-read-all" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-notifications-read-all">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-notifications-read-all" data-method="PUT"
      data-path="api/v1/notifications/read-all"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-notifications-read-all', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-notifications-read-all"
                    onclick="tryItOut('PUTapi-v1-notifications-read-all');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-notifications-read-all"
                    onclick="cancelTryOut('PUTapi-v1-notifications-read-all');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-notifications-read-all"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/notifications/read-all</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-notifications-read-all"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-notifications-read-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-notifications-read-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="PUTapi-v1-notifications-read-all"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        </form>

                <h1 id="devices">Devices</h1>

    

                                <h2 id="devices-POSTapi-v1-devices">Register Device</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Register a device for push notifications.</p>

<span id="example-requests-POSTapi-v1-devices">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/devices" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"device_token\": \"fcm-token-abc123xyz\",
    \"platform\": \"android\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/devices"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "device_token": "fcm-token-abc123xyz",
    "platform": "android"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-devices">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تم تسجيل الجهاز بنجاح&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-devices" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-devices"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-devices"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-devices" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-devices">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-devices" data-method="POST"
      data-path="api/v1/devices"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-devices', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-devices"
                    onclick="tryItOut('POSTapi-v1-devices');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-devices"
                    onclick="cancelTryOut('POSTapi-v1-devices');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-devices"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/devices</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-devices"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-devices"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-devices"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-devices"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>device_token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="device_token"                data-endpoint="POSTapi-v1-devices"
               value="fcm-token-abc123xyz"
               data-component="body">
    <br>
<p>The FCM device token. Example: <code>fcm-token-abc123xyz</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>platform</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="platform"                data-endpoint="POSTapi-v1-devices"
               value="android"
               data-component="body">
    <br>
<p>The device platform. Example: <code>android</code></p>
        </div>
        </form>

                <h1 id="banat-alqafari">Banat AlQafari</h1>

    <p>APIs for the "Banat AlQafari" (Daughters of QFRI) section.</p>

                                <h2 id="banat-alqafari-GETapi-v1-banat">List Banat Profiles</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-banat">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/banat?search=architecto&amp;per_page=16" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/banat"
);

const params = {
    "search": "architecto",
    "per_page": "16",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-banat">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-banat" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-banat"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-banat"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-banat" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-banat">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-banat" data-method="GET"
      data-path="api/v1/banat"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-banat', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-banat"
                    onclick="tryItOut('GETapi-v1-banat');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-banat"
                    onclick="cancelTryOut('GETapi-v1-banat');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-banat"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/banat</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-banat"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-banat"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-banat"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-banat"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-v1-banat"
               value="architecto"
               data-component="query">
    <br>
<p>Filter by full name. Example: <code>architecto</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-banat"
               value="16"
               data-component="query">
    <br>
<p>Items per page. Example: <code>16</code></p>
            </div>
                </form>

                <h1 id="contact">Contact</h1>

    <p>Public contact information for the family app.</p>

                                <h2 id="contact-GETapi-v1-contact-info">Contact Info</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Returns public contact channels (phone, email, social URLs).</p>

<span id="example-requests-GETapi-v1-contact-info">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/contact-info" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/contact-info"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-contact-info">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;contact_phone&quot;: null,
    &quot;contact_whatsapp&quot;: null,
    &quot;contact_email&quot;: null,
    &quot;social&quot;: {
        &quot;twitter&quot;: null,
        &quot;instagram&quot;: null,
        &quot;snapchat&quot;: null,
        &quot;tiktok&quot;: null,
        &quot;youtube&quot;: null
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-contact-info" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-contact-info"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-contact-info"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-contact-info" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-contact-info">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-contact-info" data-method="GET"
      data-path="api/v1/contact-info"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-contact-info', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-contact-info"
                    onclick="tryItOut('GETapi-v1-contact-info');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-contact-info"
                    onclick="cancelTryOut('GETapi-v1-contact-info');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-contact-info"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/contact-info</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-contact-info"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-contact-info"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-contact-info"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-contact-info"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        </form>

                <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-v1-health">GET api/v1/health</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-health">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/health" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/health"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-health">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: &quot;ok&quot;,
    &quot;time&quot;: &quot;2026-05-17T18:42:11.000580Z&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-health" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-health"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-health"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-health" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-health">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-health" data-method="GET"
      data-path="api/v1/health"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-health', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-health"
                    onclick="tryItOut('GETapi-v1-health');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-health"
                    onclick="cancelTryOut('GETapi-v1-health');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-health"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/health</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-health"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-health"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-health"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-health"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-test-fcm">POST api/v1/test-fcm</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-test-fcm">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/test-fcm" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"fcm_token\": \"architecto\",
    \"title\": \"architecto\",
    \"body\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/test-fcm"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "fcm_token": "architecto",
    "title": "architecto",
    "body": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-test-fcm">
</span>
<span id="execution-results-POSTapi-v1-test-fcm" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-test-fcm"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-test-fcm"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-test-fcm" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-test-fcm">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-test-fcm" data-method="POST"
      data-path="api/v1/test-fcm"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-test-fcm', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-test-fcm"
                    onclick="tryItOut('POSTapi-v1-test-fcm');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-test-fcm"
                    onclick="cancelTryOut('POSTapi-v1-test-fcm');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-test-fcm"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/test-fcm</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-test-fcm"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-test-fcm"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-test-fcm"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-test-fcm"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>fcm_token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="fcm_token"                data-endpoint="POSTapi-v1-test-fcm"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>title</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="title"                data-endpoint="POSTapi-v1-test-fcm"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>body</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="body"                data-endpoint="POSTapi-v1-test-fcm"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-members-children">POST api/v1/members/children</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-members-children">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/members/children" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"name\": \"b\",
    \"gender\": \"male\",
    \"birthday\": \"2022-06-11\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/members/children"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "name": "b",
    "gender": "male",
    "birthday": "2022-06-11"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-members-children">
</span>
<span id="execution-results-POSTapi-v1-members-children" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-members-children"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-members-children"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-members-children" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-members-children">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-members-children" data-method="POST"
      data-path="api/v1/members/children"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-members-children', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-members-children"
                    onclick="tryItOut('POSTapi-v1-members-children');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-members-children"
                    onclick="cancelTryOut('POSTapi-v1-members-children');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-members-children"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/members/children</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-members-children"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-members-children"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-members-children"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-members-children"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-members-children"
               value="b"
               data-component="body">
    <br>
<p>validation.max. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gender</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gender"                data-endpoint="POSTapi-v1-members-children"
               value="male"
               data-component="body">
    <br>
<p>Example: <code>male</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>male</code></li> <li><code>female</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birthday</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birthday"                data-endpoint="POSTapi-v1-members-children"
               value="2022-06-11"
               data-component="body">
    <br>
<p>validation.date validation.before_or_equal. Example: <code>2022-06-11</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-search">GET api/v1/search</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-search">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/search" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"q\": \"bngzmiyvdljnikhw\",
    \"per_type_limit\": 17
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/search"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "q": "bngzmiyvdljnikhw",
    "per_type_limit": 17
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-search">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-search" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-search"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-search"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-search" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-search">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-search" data-method="GET"
      data-path="api/v1/search"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-search', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-search"
                    onclick="tryItOut('GETapi-v1-search');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-search"
                    onclick="cancelTryOut('GETapi-v1-search');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-search"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/search</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-search"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-search"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-search"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-search"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>q</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="q"                data-endpoint="GETapi-v1-search"
               value="bngzmiyvdljnikhw"
               data-component="body">
    <br>
<p>validation.min. Example: <code>bngzmiyvdljnikhw</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_type_limit</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_type_limit"                data-endpoint="GETapi-v1-search"
               value="17"
               data-component="body">
    <br>
<p>validation.min validation.max. Example: <code>17</code></p>
        </div>
        </form>

                <h1 id="favorites">Favorites</h1>

    <p>APIs for managing favorite members.</p>

                                <h2 id="favorites-POSTapi-v1-members--member_id--favorite">Add to Favorites</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Add a member to the authenticated user's favorites.</p>

<span id="example-requests-POSTapi-v1-members--member_id--favorite">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/members/1/favorite" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/members/1/favorite"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-members--member_id--favorite">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تمت الإضافة إلى المفضلة بنجاح.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;هذا العضو موجود بالفعل في المفضلة.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-members--member_id--favorite" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-members--member_id--favorite"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-members--member_id--favorite"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-members--member_id--favorite" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-members--member_id--favorite">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-members--member_id--favorite" data-method="POST"
      data-path="api/v1/members/{member_id}/favorite"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-members--member_id--favorite', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-members--member_id--favorite"
                    onclick="tryItOut('POSTapi-v1-members--member_id--favorite');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-members--member_id--favorite"
                    onclick="cancelTryOut('POSTapi-v1-members--member_id--favorite');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-members--member_id--favorite"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/members/{member_id}/favorite</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-members--member_id--favorite"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-members--member_id--favorite"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-members--member_id--favorite"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-members--member_id--favorite"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>member_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="member_id"                data-endpoint="POSTapi-v1-members--member_id--favorite"
               value="1"
               data-component="url">
    <br>
<p>The ID of the member. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>member</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="member"                data-endpoint="POSTapi-v1-members--member_id--favorite"
               value="1"
               data-component="url">
    <br>
<p>The member user id. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="favorites-DELETEapi-v1-members--member_id--favorite">Remove from Favorites</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Remove a member from the authenticated user's favorites.</p>

<span id="example-requests-DELETEapi-v1-members--member_id--favorite">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://algfari.test/api/v1/members/1/favorite" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/members/1/favorite"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-members--member_id--favorite">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;تمت الإزالة من المفضلة بنجاح.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-v1-members--member_id--favorite" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-members--member_id--favorite"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-members--member_id--favorite"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-members--member_id--favorite" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-members--member_id--favorite">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-members--member_id--favorite" data-method="DELETE"
      data-path="api/v1/members/{member_id}/favorite"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-members--member_id--favorite', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-members--member_id--favorite"
                    onclick="tryItOut('DELETEapi-v1-members--member_id--favorite');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-members--member_id--favorite"
                    onclick="cancelTryOut('DELETEapi-v1-members--member_id--favorite');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-members--member_id--favorite"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/members/{member_id}/favorite</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-members--member_id--favorite"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-members--member_id--favorite"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-members--member_id--favorite"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="DELETEapi-v1-members--member_id--favorite"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>member_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="member_id"                data-endpoint="DELETEapi-v1-members--member_id--favorite"
               value="1"
               data-component="url">
    <br>
<p>The ID of the member. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>member</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="member"                data-endpoint="DELETEapi-v1-members--member_id--favorite"
               value="1"
               data-component="url">
    <br>
<p>The member user id. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="favorites-GETapi-v1-favorites">List Favorites</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Get a paginated list of the authenticated user's favorited members.</p>

<span id="example-requests-GETapi-v1-favorites">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/favorites?per_page=15" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/favorites"
);

const params = {
    "per_page": "15",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-favorites">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;full_name&quot;: &quot;محمد القحطاني&quot;,
            &quot;phone_number&quot;: &quot;0551234567&quot;,
            &quot;profile_image&quot;: null
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;...&quot;,
        &quot;last&quot;: &quot;...&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;per_page&quot;: 15,
        &quot;total&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-favorites" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-favorites"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-favorites"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-favorites" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-favorites">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-favorites" data-method="GET"
      data-path="api/v1/favorites"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-favorites', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-favorites"
                    onclick="tryItOut('GETapi-v1-favorites');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-favorites"
                    onclick="cancelTryOut('GETapi-v1-favorites');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-favorites"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/favorites</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-favorites"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-favorites"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-favorites"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-favorites"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-favorites"
               value="15"
               data-component="query">
    <br>
<p>Items per page. Example: <code>15</code></p>
            </div>
                </form>

                <h1 id="home">Home</h1>

    <p>Aggregated data for the mobile app home screen.</p>

                                <h2 id="home-GETapi-v1-home">Home Screen Payload</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Returns stats, breaking news, featured offers and upcoming events in one call.</p>

<span id="example-requests-GETapi-v1-home">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/home" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/home"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-home">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;stats&quot;: {
        &quot;members&quot;: 0,
        &quot;families&quot;: 0,
        &quot;events&quot;: 0,
        &quot;offers&quot;: 0
    },
    &quot;breaking_news&quot;: [],
    &quot;featured_offers&quot;: [],
    &quot;upcoming_events&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-home" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-home"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-home"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-home" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-home">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-home" data-method="GET"
      data-path="api/v1/home"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-home', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-home"
                    onclick="tryItOut('GETapi-v1-home');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-home"
                    onclick="cancelTryOut('GETapi-v1-home');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-home"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/home</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-home"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-home"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-home"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-home"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        </form>

                <h1 id="locations">Locations</h1>

    <p>Reference data for countries / regions / cities (read-only).</p>

                                <h2 id="locations-GETapi-v1-regions">List Regions</h2>

<p>
</p>

<p>Paginated regions. Filter by <code>country_id</code> or search in localized names (Arabic / English).</p>

<span id="example-requests-GETapi-v1-regions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/regions?country_id=1&amp;search=%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6&amp;per_page=50" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"country_id\": 16,
    \"search\": \"n\",
    \"per_page\": 7
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/regions"
);

const params = {
    "country_id": "1",
    "search": "الرياض",
    "per_page": "50",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "country_id": 16,
    "search": "n",
    "per_page": 7
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-regions">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;country_id&quot;: 1,
            &quot;name&quot;: {
                &quot;ar&quot;: &quot;منطقة الرياض&quot;,
                &quot;en&quot;: &quot;Riyadh Region&quot;
            },
            &quot;cities_count&quot;: 12,
            &quot;country&quot;: {
                &quot;id&quot;: 1,
                &quot;code&quot;: &quot;SA&quot;,
                &quot;name&quot;: {
                    &quot;ar&quot;: &quot;المملكة العربية السعودية&quot;,
                    &quot;en&quot;: &quot;Saudi Arabia&quot;
                }
            },
            &quot;created_at&quot;: &quot;2026-04-17T10:00:00.000000Z&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://algfari.test/api/v1/regions?page=1&quot;,
        &quot;last&quot;: &quot;http://algfari.test/api/v1/regions?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;per_page&quot;: 50,
        &quot;total&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-regions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-regions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-regions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-regions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-regions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-regions" data-method="GET"
      data-path="api/v1/regions"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-regions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-regions"
                    onclick="tryItOut('GETapi-v1-regions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-regions"
                    onclick="cancelTryOut('GETapi-v1-regions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-regions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/regions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-regions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-regions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-regions"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>country_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="country_id"                data-endpoint="GETapi-v1-regions"
               value="1"
               data-component="query">
    <br>
<p>Filter by country. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-v1-regions"
               value="الرياض"
               data-component="query">
    <br>
<p>Search in region name (both locales). Example: <code>الرياض</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-regions"
               value="50"
               data-component="query">
    <br>
<p>Items per page (1–100). Example: <code>50</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="country_id"                data-endpoint="GETapi-v1-regions"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the countries table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-v1-regions"
               value="n"
               data-component="body">
    <br>
<p>validation.max. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-regions"
               value="7"
               data-component="body">
    <br>
<p>validation.min validation.max. Example: <code>7</code></p>
        </div>
        </form>

                    <h2 id="locations-GETapi-v1-cities">List Cities</h2>

<p>
</p>

<p>Paginated cities. Filter by <code>region_id</code> and/or <code>country_id</code>, or search in localized names.</p>

<span id="example-requests-GETapi-v1-cities">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/cities?region_id=3&amp;country_id=1&amp;search=%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6&amp;per_page=50" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"region_id\": 16,
    \"country_id\": 16,
    \"search\": \"n\",
    \"per_page\": 7
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/cities"
);

const params = {
    "region_id": "3",
    "country_id": "1",
    "search": "الرياض",
    "per_page": "50",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "region_id": 16,
    "country_id": 16,
    "search": "n",
    "per_page": 7
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-cities">
            <blockquote>
            <p>Example response (200, success):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;region_id&quot;: 1,
            &quot;name&quot;: {
                &quot;ar&quot;: &quot;الرياض&quot;,
                &quot;en&quot;: &quot;Riyadh&quot;
            },
            &quot;region&quot;: {
                &quot;id&quot;: 1,
                &quot;country_id&quot;: 1,
                &quot;name&quot;: {
                    &quot;ar&quot;: &quot;منطقة الرياض&quot;,
                    &quot;en&quot;: &quot;Riyadh Region&quot;
                },
                &quot;country&quot;: {
                    &quot;id&quot;: 1,
                    &quot;code&quot;: &quot;SA&quot;,
                    &quot;name&quot;: {
                        &quot;ar&quot;: &quot;المملكة العربية السعودية&quot;,
                        &quot;en&quot;: &quot;Saudi Arabia&quot;
                    }
                }
            },
            &quot;created_at&quot;: &quot;2026-04-17T10:00:00.000000Z&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://algfari.test/api/v1/cities?page=1&quot;,
        &quot;last&quot;: &quot;http://algfari.test/api/v1/cities?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 1,
        &quot;per_page&quot;: 50,
        &quot;total&quot;: 1
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-cities" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-cities"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-cities"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-cities" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-cities">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-cities" data-method="GET"
      data-path="api/v1/cities"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-cities', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-cities"
                    onclick="tryItOut('GETapi-v1-cities');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-cities"
                    onclick="cancelTryOut('GETapi-v1-cities');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-cities"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/cities</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-cities"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-cities"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-cities"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>region_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="region_id"                data-endpoint="GETapi-v1-cities"
               value="3"
               data-component="query">
    <br>
<p>Filter by region. Example: <code>3</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>country_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="country_id"                data-endpoint="GETapi-v1-cities"
               value="1"
               data-component="query">
    <br>
<p>Filter by country (via region). Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-v1-cities"
               value="الرياض"
               data-component="query">
    <br>
<p>Search in city name (both locales). Example: <code>الرياض</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-cities"
               value="50"
               data-component="query">
    <br>
<p>Items per page (1–100). Example: <code>50</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>region_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="region_id"                data-endpoint="GETapi-v1-cities"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the regions table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>country_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="country_id"                data-endpoint="GETapi-v1-cities"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the countries table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-v1-cities"
               value="n"
               data-component="body">
    <br>
<p>validation.max. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-cities"
               value="7"
               data-component="body">
    <br>
<p>validation.min validation.max. Example: <code>7</code></p>
        </div>
        </form>

                <h1 id="news-comments">News Comments</h1>

    

                                <h2 id="news-comments-GETapi-v1-news--news_id--comments">GET api/v1/news/{news_id}/comments</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-news--news_id--comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/news/1/comments" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/news/1/comments"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-news--news_id--comments">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-news--news_id--comments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-news--news_id--comments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-news--news_id--comments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-news--news_id--comments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-news--news_id--comments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-news--news_id--comments" data-method="GET"
      data-path="api/v1/news/{news_id}/comments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-news--news_id--comments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-news--news_id--comments"
                    onclick="tryItOut('GETapi-v1-news--news_id--comments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-news--news_id--comments"
                    onclick="cancelTryOut('GETapi-v1-news--news_id--comments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-news--news_id--comments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/news/{news_id}/comments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-news--news_id--comments"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-news--news_id--comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-news--news_id--comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-news--news_id--comments"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>news_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="news_id"                data-endpoint="GETapi-v1-news--news_id--comments"
               value="1"
               data-component="url">
    <br>
<p>The ID of the news. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="news-comments-POSTapi-v1-news--news_id--comments">POST api/v1/news/{news_id}/comments</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-news--news_id--comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/news/1/comments" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"content\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/news/1/comments"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "content": "b"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-news--news_id--comments">
</span>
<span id="execution-results-POSTapi-v1-news--news_id--comments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-news--news_id--comments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-news--news_id--comments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-news--news_id--comments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-news--news_id--comments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-news--news_id--comments" data-method="POST"
      data-path="api/v1/news/{news_id}/comments"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-news--news_id--comments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-news--news_id--comments"
                    onclick="tryItOut('POSTapi-v1-news--news_id--comments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-news--news_id--comments"
                    onclick="cancelTryOut('POSTapi-v1-news--news_id--comments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-news--news_id--comments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/news/{news_id}/comments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-news--news_id--comments"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-news--news_id--comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-news--news_id--comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-news--news_id--comments"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>news_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="news_id"                data-endpoint="POSTapi-v1-news--news_id--comments"
               value="1"
               data-component="url">
    <br>
<p>The ID of the news. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>content</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="content"                data-endpoint="POSTapi-v1-news--news_id--comments"
               value="b"
               data-component="body">
    <br>
<p>validation.min validation.max. Example: <code>b</code></p>
        </div>
        </form>

                    <h2 id="news-comments-DELETEapi-v1-news--news_id--comments--comment_id-">DELETE api/v1/news/{news_id}/comments/{comment_id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-news--news_id--comments--comment_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://algfari.test/api/v1/news/1/comments/16" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/news/1/comments/16"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-news--news_id--comments--comment_id-">
</span>
<span id="execution-results-DELETEapi-v1-news--news_id--comments--comment_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-news--news_id--comments--comment_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-news--news_id--comments--comment_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-news--news_id--comments--comment_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-news--news_id--comments--comment_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-news--news_id--comments--comment_id-" data-method="DELETE"
      data-path="api/v1/news/{news_id}/comments/{comment_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-news--news_id--comments--comment_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-news--news_id--comments--comment_id-"
                    onclick="tryItOut('DELETEapi-v1-news--news_id--comments--comment_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-news--news_id--comments--comment_id-"
                    onclick="cancelTryOut('DELETEapi-v1-news--news_id--comments--comment_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-news--news_id--comments--comment_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/news/{news_id}/comments/{comment_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-news--news_id--comments--comment_id-"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-news--news_id--comments--comment_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-news--news_id--comments--comment_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="DELETEapi-v1-news--news_id--comments--comment_id-"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>news_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="news_id"                data-endpoint="DELETEapi-v1-news--news_id--comments--comment_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the news. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>comment_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="comment_id"                data-endpoint="DELETEapi-v1-news--news_id--comments--comment_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the comment. Example: <code>16</code></p>
            </div>
                    </form>

                <h1 id="news-reactions">News Reactions</h1>

    

                                <h2 id="news-reactions-POSTapi-v1-news--news_id--reactions">POST api/v1/news/{news_id}/reactions</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-news--news_id--reactions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/news/1/reactions" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar" \
    --data "{
    \"type\": \"love\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/news/1/reactions"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};

let body = {
    "type": "love"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-news--news_id--reactions">
</span>
<span id="execution-results-POSTapi-v1-news--news_id--reactions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-news--news_id--reactions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-news--news_id--reactions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-news--news_id--reactions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-news--news_id--reactions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-news--news_id--reactions" data-method="POST"
      data-path="api/v1/news/{news_id}/reactions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-news--news_id--reactions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-news--news_id--reactions"
                    onclick="tryItOut('POSTapi-v1-news--news_id--reactions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-news--news_id--reactions"
                    onclick="cancelTryOut('POSTapi-v1-news--news_id--reactions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-news--news_id--reactions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/news/{news_id}/reactions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-news--news_id--reactions"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-news--news_id--reactions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-news--news_id--reactions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-news--news_id--reactions"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>news_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="news_id"                data-endpoint="POSTapi-v1-news--news_id--reactions"
               value="1"
               data-component="url">
    <br>
<p>The ID of the news. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-v1-news--news_id--reactions"
               value="love"
               data-component="body">
    <br>
<p>Example: <code>love</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>like</code></li> <li><code>love</code></li> <li><code>sad</code></li> <li><code>pray</code></li></ul>
        </div>
        </form>

                    <h2 id="news-reactions-DELETEapi-v1-news--news_id--reactions">DELETE api/v1/news/{news_id}/reactions</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-news--news_id--reactions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://algfari.test/api/v1/news/1/reactions" \
    --header "Authorization: Bearer {YOUR_AUTH_TOKEN}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/news/1/reactions"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_TOKEN}",
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-news--news_id--reactions">
</span>
<span id="execution-results-DELETEapi-v1-news--news_id--reactions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-news--news_id--reactions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-news--news_id--reactions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-news--news_id--reactions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-news--news_id--reactions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-news--news_id--reactions" data-method="DELETE"
      data-path="api/v1/news/{news_id}/reactions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-news--news_id--reactions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-news--news_id--reactions"
                    onclick="tryItOut('DELETEapi-v1-news--news_id--reactions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-news--news_id--reactions"
                    onclick="cancelTryOut('DELETEapi-v1-news--news_id--reactions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-news--news_id--reactions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/news/{news_id}/reactions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-news--news_id--reactions"
               value="Bearer {YOUR_AUTH_TOKEN}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_TOKEN}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-news--news_id--reactions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-news--news_id--reactions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="DELETEapi-v1-news--news_id--reactions"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>news_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="news_id"                data-endpoint="DELETEapi-v1-news--news_id--reactions"
               value="1"
               data-component="url">
    <br>
<p>The ID of the news. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="visitors">Visitors</h1>

    <p>Track and read the total app visitor count.</p>

                                <h2 id="visitors-POSTapi-v1-visitors">Increment visitor counter</h2>

<p>
</p>

<p>Call once per app open / session start.</p>

<span id="example-requests-POSTapi-v1-visitors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://algfari.test/api/v1/visitors" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/visitors"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-visitors">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;count&quot;: 42
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-visitors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-visitors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-visitors"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-visitors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-visitors">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-visitors" data-method="POST"
      data-path="api/v1/visitors"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-visitors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-visitors"
                    onclick="tryItOut('POSTapi-v1-visitors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-visitors"
                    onclick="cancelTryOut('POSTapi-v1-visitors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-visitors"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/visitors</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-visitors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-visitors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="POSTapi-v1-visitors"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        </form>

                    <h2 id="visitors-GETapi-v1-visitors">Get visitor count</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-visitors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://algfari.test/api/v1/visitors" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --header "Accept-Language: ar"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://algfari.test/api/v1/visitors"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Accept-Language": "ar",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-visitors">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;count&quot;: 42
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-visitors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-visitors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-visitors"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-visitors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-visitors">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-visitors" data-method="GET"
      data-path="api/v1/visitors"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-visitors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-visitors"
                    onclick="tryItOut('GETapi-v1-visitors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-visitors"
                    onclick="cancelTryOut('GETapi-v1-visitors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-visitors"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/visitors</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-visitors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-visitors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept-Language</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept-Language"                data-endpoint="GETapi-v1-visitors"
               value="ar"
               data-component="header">
    <br>
<p>Example: <code>ar</code></p>
            </div>
                        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
