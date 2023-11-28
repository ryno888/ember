<?php
namespace incl;

/**
 * @package mod\solid_classes
 * @author Ryno Van Zyl
 */

//-------------------------------------------------------------
//ERROR
//-------------------------------------------------------------
/**
 * ERROR_CODE_LOGIN_INVALID
 * Invalid username and/or password.
 */
if(!defined("ERROR_CODE_LOGIN_INVALID")) define("ERROR_CODE_LOGIN_INVALID", "1");
/**
 * ERROR_CODE_ACCESS_DENIED
 * You do not have permission to access the resource you requested. If you think this is incorrect, please contact support.
 */
if(!defined("ERROR_CODE_ACCESS_DENIED")) define("ERROR_CODE_ACCESS_DENIED", "10");
/**
 * ERROR_CODE_ACCOUNT_LOCKED
 * You have had more than 3 failed login attempts. Your account has been locked for 15 minutes. If you continue to have problems, please contact support.
 */
if(!defined("ERROR_CODE_ACCOUNT_LOCKED")) define("ERROR_CODE_ACCOUNT_LOCKED", "11");
/**
 * ERROR_CODE_CAPTCHA_ERROR
 * The reCAPTCHA test failed. Please try again.
 */
if(!defined("ERROR_CODE_CAPTCHA_ERROR")) define("ERROR_CODE_CAPTCHA_ERROR", "12");
/**
 * ERROR_CODE_SYSTEM_OFFLINE
 * The system is currently offline, we are attending to the problem.
 */
if(!defined("ERROR_CODE_SYSTEM_OFFLINE")) define("ERROR_CODE_SYSTEM_OFFLINE", "13");
/**
 * ERROR_CODE_ACCOUNT_INACTIVE
 * Your account is not active. Please contact support.
 */
if(!defined("ERROR_CODE_ACCOUNT_INACTIVE")) define("ERROR_CODE_ACCOUNT_INACTIVE", "14");
/**
 * ERROR_CODE_CSRF_TOKEN_MISSING
 * The system could not complete this action due to a missing form token. You may have cleared your browser cookies or logged in on a different tab, which could have resulted in the expiry of your current form token.
 */
if(!defined("ERROR_CODE_CSRF_TOKEN_MISSING")) define("ERROR_CODE_CSRF_TOKEN_MISSING", "15");
/**
 * ERROR_CODE_UNAUTHORIZED_FORM_SUBMISSION
 * The system could not complete this action due to an unauthorized form token. Please contact support if the problem persists.
 */
if(!defined("ERROR_CODE_UNAUTHORIZED_FORM_SUBMISSION")) define("ERROR_CODE_UNAUTHORIZED_FORM_SUBMISSION", "16");
/**
 * ERROR_CODE_INTERNAL_ERROR
 * The system encountered an error while processing your request. The administrator has been notified and will be attending to the problem. We apologize for any inconvenience. Please try again later.
 */
if(!defined("ERROR_CODE_INTERNAL_ERROR")) define("ERROR_CODE_INTERNAL_ERROR", "17");
/**
 * ERROR_CODE_LOGIN_ERROR
 * The system encountered an error while logging you in. For assistance, please contact support.
 */
if(!defined("ERROR_CODE_LOGIN_ERROR")) define("ERROR_CODE_LOGIN_ERROR", "18");
/**
 * ERROR_CODE_PENDING_VERIFICATION
 * Your account is pending verification. Should we resend the verification email?
 */
if(!defined("ERROR_CODE_PENDING_VERIFICATION")) define("ERROR_CODE_PENDING_VERIFICATION", "19");
/**
 * ERROR_CODE_LOGIN_INVALID_DETAILS
 * Invalid username, please enter your username to continue.
 */
if(!defined("ERROR_CODE_LOGIN_INVALID_DETAILS")) define("ERROR_CODE_LOGIN_INVALID_DETAILS", "2");
/**
 * ERROR_CODE_SUCCESS_REGISTER
 * Thank you for registering and confirming your new profile.
 */
if(!defined("ERROR_CODE_SUCCESS_REGISTER")) define("ERROR_CODE_SUCCESS_REGISTER", "20");
/**
 * ERROR_CODE_ACCOUNT_UPDATED
 * Your account username and email address has been updated.
 */
if(!defined("ERROR_CODE_ACCOUNT_UPDATED")) define("ERROR_CODE_ACCOUNT_UPDATED", "21");
/**
 * ERROR_CODE_FORGOT_PASSWORD
 * Thank you, an email has been sent to your inbox. Please check it for further instructions on resetting your password
 */
if(!defined("ERROR_CODE_FORGOT_PASSWORD")) define("ERROR_CODE_FORGOT_PASSWORD", "3");
/**
 * ERROR_CODE_DB_ERROR
 * The database is unavailable at the moment, please try again later.
 */
if(!defined("ERROR_CODE_DB_ERROR")) define("ERROR_CODE_DB_ERROR", "4");
/**
 * ERROR_CODE_404
 * The page you are looking for is not available.
 */
if(!defined("ERROR_CODE_404")) define("ERROR_CODE_404", "404");
/**
 * ERROR_CODE_NOT_LOGGED_IN
 * You are not logged in or your session timed out, please click on the login link below.
 */
if(!defined("ERROR_CODE_NOT_LOGGED_IN")) define("ERROR_CODE_NOT_LOGGED_IN", "5");
/**
 * ERROR_CODE_500
 * The system encountered an error while processing your request. The administrator has been notified and will be attending to the problem. We apologize for any inconvenience. Please try again later.
 */
if(!defined("ERROR_CODE_500")) define("ERROR_CODE_500", "500");
/**
 * ERROR_CODE_ACTIVE_SESSION
 * You are already logged in, please logout first.
 */
if(!defined("ERROR_CODE_ACTIVE_SESSION")) define("ERROR_CODE_ACTIVE_SESSION", "6");
/**
 * ERROR_CODE_REQUEST_ERROR
 * Your request does not exist or it has expired.
 */
if(!defined("ERROR_CODE_REQUEST_ERROR")) define("ERROR_CODE_REQUEST_ERROR", "7");
/**
 * ERROR_CODE_RECOVERY_PASSWORD
 * Your new access details have been saved.
 */
if(!defined("ERROR_CODE_RECOVERY_PASSWORD")) define("ERROR_CODE_RECOVERY_PASSWORD", "8");
/**
 * ERROR_CODE_MAINTENANCE
 * The system is offline for planned maintenance. Thank you for your patience.
 */
if(!defined("ERROR_CODE_MAINTENANCE")) define("ERROR_CODE_MAINTENANCE", "9");
//-------------------------------------------------------------
//MESSAGE
//-------------------------------------------------------------
/**
 * MESSAGE_CODE_100
 * Thank you for submitting your request. We will be in contact with you shortly.
 */
if(!defined("MESSAGE_CODE_100")) define("MESSAGE_CODE_100", "100");
/**
 * MESSAGE_CODE_101
 * Thank you for submitting your quote. We will be in contact with you shortly.
 */
if(!defined("MESSAGE_CODE_101")) define("MESSAGE_CODE_101", "101");
/**
 * MESSAGE_CODE_102
 * We have sent you an mail. Please click the link to verify your email address.
 */
if(!defined("MESSAGE_CODE_102")) define("MESSAGE_CODE_102", "102");
//-------------------------------------------------------------
//PRODUCT_PROPERTY
//-------------------------------------------------------------
/**
 * PRODUCT_PROPERTY_COLOR_DESCRIPTION
 * 
 */
if(!defined("PRODUCT_PROPERTY_COLOR_DESCRIPTION")) define("PRODUCT_PROPERTY_COLOR_DESCRIPTION", "gs1.product:ColourDescription");
/**
 * PRODUCT_PROPERTY_COST_PRICE
 * 
 */
if(!defined("PRODUCT_PROPERTY_COST_PRICE")) define("PRODUCT_PROPERTY_COST_PRICE", "gs1.price:PriceSpecification:CostPrice");
/**
 * PRODUCT_PROPERTY_DEPTH
 * 
 */
if(!defined("PRODUCT_PROPERTY_DEPTH")) define("PRODUCT_PROPERTY_DEPTH", "gs1.product:depth:outOfPackageDepth");
/**
 * PRODUCT_PROPERTY_DIMENSIONS
 * 
 */
if(!defined("PRODUCT_PROPERTY_DIMENSIONS")) define("PRODUCT_PROPERTY_DIMENSIONS", "gs1.product:Dimensions");
/**
 * PRODUCT_PROPERTY_DISCOUNT
 * 
 */
if(!defined("PRODUCT_PROPERTY_DISCOUNT")) define("PRODUCT_PROPERTY_DISCOUNT", "urn:gs1:gdd:cl:AllowanceChargeTypeCode:DI");
/**
 * PRODUCT_PROPERTY_PRICE_DISCOUNTED
 * 
 */
if(!defined("PRODUCT_PROPERTY_PRICE_DISCOUNTED")) define("PRODUCT_PROPERTY_PRICE_DISCOUNTED", "gs1.product.cost:DISCOUNTED_PRICE");
/**
 * PRODUCT_PROPERTY_EXTERNAL_LINK
 * 
 */
if(!defined("PRODUCT_PROPERTY_EXTERNAL_LINK")) define("PRODUCT_PROPERTY_EXTERNAL_LINK", "gs1.product:EXTERNAL_LINK");
/**
 * PRODUCT_PROPERTY_FEATURE_COLOR
 * 
 */
if(!defined("PRODUCT_PROPERTY_FEATURE_COLOR")) define("PRODUCT_PROPERTY_FEATURE_COLOR", "gs1.product:FEATURE:COLOR");
/**
 * PRODUCT_PROPERTY_FILTER_COLOR
 * 
 */
if(!defined("PRODUCT_PROPERTY_FILTER_COLOR")) define("PRODUCT_PROPERTY_FILTER_COLOR", "gs1.product.filter:ColourDescription");
/**
 * PRODUCT_PROPERTY_FILTER_MATERIAL
 * 
 */
if(!defined("PRODUCT_PROPERTY_FILTER_MATERIAL")) define("PRODUCT_PROPERTY_FILTER_MATERIAL", "gs1.product.filter:material");
/**
 * PRODUCT_PROPERTY_HEIGHT
 * 
 */
if(!defined("PRODUCT_PROPERTY_HEIGHT")) define("PRODUCT_PROPERTY_HEIGHT", "gs1.product:height:outOfPackageHeight");
/**
 * PRODUCT_PROPERTY_IS_FEATURED
 * 
 */
if(!defined("PRODUCT_PROPERTY_IS_FEATURED")) define("PRODUCT_PROPERTY_IS_FEATURED", "gs1.product:IS_FEATURED");
/**
 * PRODUCT_PROPERTY_IS_PARENT
 * 
 */
if(!defined("PRODUCT_PROPERTY_IS_PARENT")) define("PRODUCT_PROPERTY_IS_PARENT", "gs1.product:IS_PARENT");
/**
 * PRODUCT_PROPERTY_KEYWORD
 * 
 */
if(!defined("PRODUCT_PROPERTY_KEYWORD")) define("PRODUCT_PROPERTY_KEYWORD", "gs1:AdditionalProductClassificationDetails");
/**
 * PRODUCT_PROPERTY_LAST_UPDATED
 * 
 */
if(!defined("PRODUCT_PROPERTY_LAST_UPDATED")) define("PRODUCT_PROPERTY_LAST_UPDATED", "gs1.product:additionalProperty:dateLastUpdated");
/**
 * PRODUCT_PROPERTY_LEAD_TIME
 * 
 */
if(!defined("PRODUCT_PROPERTY_LEAD_TIME")) define("PRODUCT_PROPERTY_LEAD_TIME", "gs1.product:lead_time");
/**
 * PRODUCT_PROPERTY_MATERIAL
 * 
 */
if(!defined("PRODUCT_PROPERTY_MATERIAL")) define("PRODUCT_PROPERTY_MATERIAL", "gs1.product:material");
/**
 * PRODUCT_PROPERTY_METAL_TYPE
 * 
 */
if(!defined("PRODUCT_PROPERTY_METAL_TYPE")) define("PRODUCT_PROPERTY_METAL_TYPE", "gs1.product:metal_type");
/**
 * PRODUCT_PROPERTY_NUMBER_OF_UNITS
 * 
 */
if(!defined("PRODUCT_PROPERTY_NUMBER_OF_UNITS")) define("PRODUCT_PROPERTY_NUMBER_OF_UNITS", "gs1.product:NUMBER_OF_UNITS");
/**
 * PRODUCT_PROPERTY_PACKAGE_DEPTH
 * 
 */
if(!defined("PRODUCT_PROPERTY_PACKAGE_DEPTH")) define("PRODUCT_PROPERTY_PACKAGE_DEPTH", "gs1.product.package:depth");
/**
 * PRODUCT_PROPERTY_PACKAGE_HEIGHT
 * 
 */
if(!defined("PRODUCT_PROPERTY_PACKAGE_HEIGHT")) define("PRODUCT_PROPERTY_PACKAGE_HEIGHT", "gs1.product.package:height");
/**
 * PRODUCT_PROPERTY_PACKAGE_SIZE
 * 
 */
if(!defined("PRODUCT_PROPERTY_PACKAGE_SIZE")) define("PRODUCT_PROPERTY_PACKAGE_SIZE", "gs1:package_size");
/**
 * PRODUCT_PROPERTY_PACKAGE_WEIGHT
 * 
 */
if(!defined("PRODUCT_PROPERTY_PACKAGE_WEIGHT")) define("PRODUCT_PROPERTY_PACKAGE_WEIGHT", "gs1.product.package:weight");
/**
 * PRODUCT_PROPERTY_PACKAGE_WIDTH
 * 
 */
if(!defined("PRODUCT_PROPERTY_PACKAGE_WIDTH")) define("PRODUCT_PROPERTY_PACKAGE_WIDTH", "gs1.product.package:width");
/**
 * PRODUCT_PROPERTY_PARENT_KEY
 * 
 */
if(!defined("PRODUCT_PROPERTY_PARENT_KEY")) define("PRODUCT_PROPERTY_PARENT_KEY", "gs1.product.parent:PRODUCT_KEY");
/**
 * PRODUCT_PROPERTY_PRICE
 * 
 */
if(!defined("PRODUCT_PROPERTY_PRICE")) define("PRODUCT_PROPERTY_PRICE", "urn:gs1:gdd:cl:AllowanceChargeTypeCode:CP");
/**
 * PRODUCT_PROPERTY_PROMOTION_DATE_FROM
 * 
 */
if(!defined("PRODUCT_PROPERTY_PROMOTION_DATE_FROM")) define("PRODUCT_PROPERTY_PROMOTION_DATE_FROM", "gs1.product.promotion:DATE_FROM");
/**
 * PRODUCT_PROPERTY_PROMOTION_DATE_TO
 * 
 */
if(!defined("PRODUCT_PROPERTY_PROMOTION_DATE_TO")) define("PRODUCT_PROPERTY_PROMOTION_DATE_TO", "gs1.product.promotion:DATE_TO");
/**
 * PRODUCT_PROPERTY_PROMOTION_IS_CLEARANCE
 * 
 */
if(!defined("PRODUCT_PROPERTY_PROMOTION_IS_CLEARANCE")) define("PRODUCT_PROPERTY_PROMOTION_IS_CLEARANCE", "gs1.product.promotion:IS_CLEARANCE");
/**
 * PRODUCT_PROPERTY_PROMOTION_PRICE
 * 
 */
if(!defined("PRODUCT_PROPERTY_PROMOTION_PRICE")) define("PRODUCT_PROPERTY_PROMOTION_PRICE", "gs1.product.promotion:PRICE");
/**
 * PRODUCT_PROPERTY_PRO_DESCRIPTION
 * 
 */
if(!defined("PRODUCT_PROPERTY_PRO_DESCRIPTION")) define("PRODUCT_PROPERTY_PRO_DESCRIPTION", "gs1.product:productDescription");
/**
 * PRODUCT_PROPERTY_DEVELOPMENT_NAME
 * 
 */
if(!defined("PRODUCT_PROPERTY_DEVELOPMENT_NAME")) define("PRODUCT_PROPERTY_DEVELOPMENT_NAME", "gs1.product:DEVELOPMENT_NAME");
/**
 * PRODUCT_PROPERTY_PRO_IS_INACTIVE
 * 
 */
if(!defined("PRODUCT_PROPERTY_PRO_IS_INACTIVE")) define("PRODUCT_PROPERTY_PRO_IS_INACTIVE", "product:StateInSystem:IS_INACTIVE");
/**
 * PRODUCT_PROPERTY_PRO_IS_PUBLISHED
 * 
 */
if(!defined("PRODUCT_PROPERTY_PRO_IS_PUBLISHED")) define("PRODUCT_PROPERTY_PRO_IS_PUBLISHED", "product:StateInSystem:IS_PUBLISHED");
/**
 * PRODUCT_PROPERTY_PRO_LENGTH
 * 
 */
if(!defined("PRODUCT_PROPERTY_PRO_LENGTH")) define("PRODUCT_PROPERTY_PRO_LENGTH", "gs1.product:length");
/**
 * PRODUCT_PROPERTY_PRO_LONG_DESCRIPTION
 * 
 */
if(!defined("PRODUCT_PROPERTY_PRO_LONG_DESCRIPTION")) define("PRODUCT_PROPERTY_PRO_LONG_DESCRIPTION", "gs1.product:productDescription:LONG");
/**
 * PRODUCT_PROPERTY_PRO_META_DESCRIPTION
 * 
 */
if(!defined("PRODUCT_PROPERTY_PRO_META_DESCRIPTION")) define("PRODUCT_PROPERTY_PRO_META_DESCRIPTION", "gs1.product:productDescription:META");
/**
 * PRODUCT_PROPERTY_PRO_NAME
 * 
 */
if(!defined("PRODUCT_PROPERTY_PRO_NAME")) define("PRODUCT_PROPERTY_PRO_NAME", "gs1.product:productName");
/**
 * PRODUCT_PROPERTY_SEO_CODE
 * 
 */
if(!defined("PRODUCT_PROPERTY_SEO_CODE")) define("PRODUCT_PROPERTY_SEO_CODE", "gs1.product:seo_code");
/**
 * PRODUCT_PROPERTY_PRO_SHORT_DESCRIPTION
 * 
 */
if(!defined("PRODUCT_PROPERTY_PRO_SHORT_DESCRIPTION")) define("PRODUCT_PROPERTY_PRO_SHORT_DESCRIPTION", "gs1.product:productDescription:SHORT");
/**
 * PRODUCT_PROPERTY_RATING
 * 
 */
if(!defined("PRODUCT_PROPERTY_RATING")) define("PRODUCT_PROPERTY_RATING", "gs1:AdditionalProductStarRating");
/**
 * PRODUCT_PROPERTY_SALES_PRICE
 * 
 */
if(!defined("PRODUCT_PROPERTY_SALES_PRICE")) define("PRODUCT_PROPERTY_SALES_PRICE", "gs1.product:SALES_PRICE");
/**
 * PRODUCT_PROPERTY_SECURITY_STATE
 * 
 */
if(!defined("PRODUCT_PROPERTY_SECURITY_STATE")) define("PRODUCT_PROPERTY_SECURITY_STATE", "urn:gs1:gdd:cl:productSecureState");
/**
 * PRODUCT_PROPERTY_SIZE
 * 
 */
if(!defined("PRODUCT_PROPERTY_SIZE")) define("PRODUCT_PROPERTY_SIZE", "gs1.product:SIZE");
/**
 * PRODUCT_PROPERTY_SIZE_TYPE
 * 
 */
if(!defined("PRODUCT_PROPERTY_SIZE_TYPE")) define("PRODUCT_PROPERTY_SIZE_TYPE", "gs1.product:descriptiveSize");
/**
 * PRODUCT_PROPERTY_STOCK
 * 
 */
if(!defined("PRODUCT_PROPERTY_STOCK")) define("PRODUCT_PROPERTY_STOCK", "urn:gs1:gdd:cl:TransactionalReferenceTypeCode:GRN");
/**
 * PRODUCT_PROPERTY_STOCK_ON_HAND
 * 
 */
if(!defined("PRODUCT_PROPERTY_STOCK_ON_HAND")) define("PRODUCT_PROPERTY_STOCK_ON_HAND", "urn:gs1:gdd:cl:TransactionalReferenceTypeCode:GRNonHand");
/**
 * PRODUCT_PROPERTY_TERMS_AND_CONDITIONS
 * 
 */
if(!defined("PRODUCT_PROPERTY_TERMS_AND_CONDITIONS")) define("PRODUCT_PROPERTY_TERMS_AND_CONDITIONS", "gs1.product:terms_and_conditions");
/**
 * PRODUCT_PROPERTY_THRESHOLD
 * 
 */
if(!defined("PRODUCT_PROPERTY_THRESHOLD")) define("PRODUCT_PROPERTY_THRESHOLD", "gs1.product:threshold:generic");
/**
 * PRODUCT_PROPERTY_UNIT_OF_MEASURE
 * 
 */
if(!defined("PRODUCT_PROPERTY_UNIT_OF_MEASURE")) define("PRODUCT_PROPERTY_UNIT_OF_MEASURE", "urn:gs1:gdd:cl:FunctionalBasisUnitCode");
/**
 * PRODUCT_PROPERTY_VOLUME
 * 
 */
if(!defined("PRODUCT_PROPERTY_VOLUME")) define("PRODUCT_PROPERTY_VOLUME", "gs1.product:volume");
/**
 * PRODUCT_PROPERTY_WEIGHT
 * 
 */
if(!defined("PRODUCT_PROPERTY_WEIGHT")) define("PRODUCT_PROPERTY_WEIGHT", "gs1.product:weight:netWeight");
/**
 * PRODUCT_PROPERTY_WIDTH
 * 
 */
if(!defined("PRODUCT_PROPERTY_WIDTH")) define("PRODUCT_PROPERTY_WIDTH", "gs1.product:width:outOfPackageWidth");
//-------------------------------------------------------------
//SETTINGS
//-------------------------------------------------------------
/**
 * SETTING_APP_CURRENCY_REMOVE_DECIMALS
 * 
 */
if(!defined("SETTING_APP_CURRENCY_REMOVE_DECIMALS")) define("SETTING_APP_CURRENCY_REMOVE_DECIMALS", "");
/**
 * SETTING_APP_CURRENCY_VAT_AMOUNT
 * 
 */
if(!defined("SETTING_APP_CURRENCY_VAT_AMOUNT")) define("SETTING_APP_CURRENCY_VAT_AMOUNT", "15");
/**
 * SETTING_BS_DANGER
 * 
 */
if(!defined("SETTING_BS_DANGER")) define("SETTING_BS_DANGER", "#dc3f35");
/**
 * SETTING_BS_DARK
 * 
 */
if(!defined("SETTING_BS_DARK")) define("SETTING_BS_DARK", "#212529");
/**
 * SETTING_BS_INFO
 * 
 */
if(!defined("SETTING_BS_INFO")) define("SETTING_BS_INFO", "#0dcaf0");
/**
 * SETTING_BS_LIGHT
 * 
 */
if(!defined("SETTING_BS_LIGHT")) define("SETTING_BS_LIGHT", "#EBEDEC");
/**
 * SETTING_BS_PRIMARY
 * 
 */
if(!defined("SETTING_BS_PRIMARY")) define("SETTING_BS_PRIMARY", "#6a90ca");
/**
 * SETTING_BS_SECONDARY
 * 
 */
if(!defined("SETTING_BS_SECONDARY")) define("SETTING_BS_SECONDARY", "#435A7E");
/**
 * SETTING_BS_SUCCESS
 * 
 */
if(!defined("SETTING_BS_SUCCESS")) define("SETTING_BS_SUCCESS", "#198754");
/**
 * SETTING_BS_VARIABLES_BACKUP
 * 
 */
if(!defined("SETTING_BS_VARIABLES_BACKUP")) define("SETTING_BS_VARIABLES_BACKUP", "");
/**
 * SETTING_BS_WARNING
 * 
 */
if(!defined("SETTING_BS_WARNING")) define("SETTING_BS_WARNING", "#ffc107");
/**
 * SETTING_CALL_TO_ACTION_BUTTON_LINK
 * 
 */
if(!defined("SETTING_CALL_TO_ACTION_BUTTON_LINK")) define("SETTING_CALL_TO_ACTION_BUTTON_LINK", "");
/**
 * SETTING_CALL_TO_ACTION_BUTTON_TEXT
 * 
 */
if(!defined("SETTING_CALL_TO_ACTION_BUTTON_TEXT")) define("SETTING_CALL_TO_ACTION_BUTTON_TEXT", "");
/**
 * SETTING_CALL_TO_ACTION_DESCRIPTION
 * 
 */
if(!defined("SETTING_CALL_TO_ACTION_DESCRIPTION")) define("SETTING_CALL_TO_ACTION_DESCRIPTION", "");
/**
 * SETTING_CALL_TO_ACTION_HEADING
 * 
 */
if(!defined("SETTING_CALL_TO_ACTION_HEADING")) define("SETTING_CALL_TO_ACTION_HEADING", "");
/**
 * SETTING_CALL_TO_ACTION_IMAGE
 * 
 */
if(!defined("SETTING_CALL_TO_ACTION_IMAGE")) define("SETTING_CALL_TO_ACTION_IMAGE", "null");
/**
 * SETTING_CALL_TO_ACTION_YOUTUBE_LINK
 * 
 */
if(!defined("SETTING_CALL_TO_ACTION_YOUTUBE_LINK")) define("SETTING_CALL_TO_ACTION_YOUTUBE_LINK", "");
/**
 * SETTING_COMPANY_ABOUT_US
 * 
 */
if(!defined("SETTING_COMPANY_ABOUT_US")) define("SETTING_COMPANY_ABOUT_US", "");
/**
 * SETTING_COMPANY_ABOUT_US_IMAGE
 * 
 */
if(!defined("SETTING_COMPANY_ABOUT_US_IMAGE")) define("SETTING_COMPANY_ABOUT_US_IMAGE", "null");
/**
 * SETTING_COMPANY_ABOUT_YOUTUBE_EMBED_CODE
 * 
 */
if(!defined("SETTING_COMPANY_ABOUT_YOUTUBE_EMBED_CODE")) define("SETTING_COMPANY_ABOUT_YOUTUBE_EMBED_CODE", "");
/**
 * SETTING_COMPANY_ABOUT_US_YOUTUBE_LINK
 * 
 */
if(!defined("SETTING_COMPANY_ABOUT_US_YOUTUBE_LINK")) define("SETTING_COMPANY_ABOUT_US_YOUTUBE_LINK", "");
/**
 * SETTING_COMPANY_COMPANY_ADDRESS_REF
 * 
 */
if(!defined("SETTING_COMPANY_COMPANY_ADDRESS_REF")) define("SETTING_COMPANY_COMPANY_ADDRESS_REF", "null");
/**
 * SETTING_COMPANY_COPYRIGHT
 * 
 */
if(!defined("SETTING_COMPANY_COPYRIGHT")) define("SETTING_COMPANY_COPYRIGHT", "© Patriot RSA %s. Copyright");
/**
 * SETTING_COMPANY_EMAIL
 * 
 */
if(!defined("SETTING_COMPANY_EMAIL")) define("SETTING_COMPANY_EMAIL", "admin@patriotapparel.co.za");
/**
 * SETTING_COMPANY_EMAIL_ACCOUNTS
 * 
 */
if(!defined("SETTING_COMPANY_EMAIL_ACCOUNTS")) define("SETTING_COMPANY_EMAIL_ACCOUNTS", "admin@patriotapparel.co.za");
/**
 * SETTING_COMPANY_EMAIL_ADMIN
 * 
 */
if(!defined("SETTING_COMPANY_EMAIL_ADMIN")) define("SETTING_COMPANY_EMAIL_ADMIN", "admin@patriotapparel.co.za");
/**
 * SETTING_COMPANY_EMAIL_APPOINTMENT
 * 
 */
if(!defined("SETTING_COMPANY_EMAIL_APPOINTMENT")) define("SETTING_COMPANY_EMAIL_APPOINTMENT", "admin@patriotapparel.co.za");
/**
 * SETTING_COMPANY_EMAIL_CONTACT
 * 
 */
if(!defined("SETTING_COMPANY_EMAIL_CONTACT")) define("SETTING_COMPANY_EMAIL_CONTACT", "admin@patriotapparel.co.za");
/**
 * SETTING_COMPANY_EMAIL_FROM
 * 
 */
if(!defined("SETTING_COMPANY_EMAIL_FROM")) define("SETTING_COMPANY_EMAIL_FROM", "admin@patriotapparel.co.za");
/**
 * SETTING_COMPANY_EMAIL_NO_REPLY
 * 
 */
if(!defined("SETTING_COMPANY_EMAIL_NO_REPLY")) define("SETTING_COMPANY_EMAIL_NO_REPLY", "admin@patriotapparel.co.za");
/**
 * SETTING_COMPANY_EMAIL_ORDER
 * 
 */
if(!defined("SETTING_COMPANY_EMAIL_ORDER")) define("SETTING_COMPANY_EMAIL_ORDER", "admin@patriotapparel.co.za");
/**
 * SETTING_COMPANY_EMAIL_REPAIRS
 * 
 */
if(!defined("SETTING_COMPANY_EMAIL_REPAIRS")) define("SETTING_COMPANY_EMAIL_REPAIRS", "admin@patriotapparel.co.za");
/**
 * SETTING_COMPANY_EMAIL_SALES
 * 
 */
if(!defined("SETTING_COMPANY_EMAIL_SALES")) define("SETTING_COMPANY_EMAIL_SALES", "admin@patriotapparel.co.za");
/**
 * SETTING_COMPANY_EMAIL_SUPPORT
 * 
 */
if(!defined("SETTING_COMPANY_EMAIL_SUPPORT")) define("SETTING_COMPANY_EMAIL_SUPPORT", "admin@patriotapparel.co.za");
/**
 * SETTING_COMPANY_EMAIL_TEST_CC
 * 
 */
if(!defined("SETTING_COMPANY_EMAIL_TEST_CC")) define("SETTING_COMPANY_EMAIL_TEST_CC", "");
/**
 * SETTING_COMPANY_COMPANY_FAVICON_REF
 * 
 */
if(!defined("SETTING_COMPANY_COMPANY_FAVICON_REF")) define("SETTING_COMPANY_COMPANY_FAVICON_REF", "null");
/**
 * SETTING_COMPANY_JOIN_OUR_TEAM
 * 
 */
if(!defined("SETTING_COMPANY_JOIN_OUR_TEAM")) define("SETTING_COMPANY_JOIN_OUR_TEAM", "");
/**
 * SETTING_COMPANY_JOIN_OUR_TEAM_IMAGE
 * 
 */
if(!defined("SETTING_COMPANY_JOIN_OUR_TEAM_IMAGE")) define("SETTING_COMPANY_JOIN_OUR_TEAM_IMAGE", "null");
/**
 * SETTING_COMPANY_JOIN_OUR_TEAM_YOUTUBE_LINK
 * 
 */
if(!defined("SETTING_COMPANY_JOIN_OUR_TEAM_YOUTUBE_LINK")) define("SETTING_COMPANY_JOIN_OUR_TEAM_YOUTUBE_LINK", "");
/**
 * SETTING_COMPANY_COMPANY_LOGO_DARK_REF
 * 
 */
if(!defined("SETTING_COMPANY_COMPANY_LOGO_DARK_REF")) define("SETTING_COMPANY_COMPANY_LOGO_DARK_REF", "null");
/**
 * SETTING_COMPANY_COMPANY_LOGO_LIGHT_REF
 * 
 */
if(!defined("SETTING_COMPANY_COMPANY_LOGO_LIGHT_REF")) define("SETTING_COMPANY_COMPANY_LOGO_LIGHT_REF", "null");
/**
 * SETTING_COMPANY_MAP_CODE
 * 
 */
if(!defined("SETTING_COMPANY_MAP_CODE")) define("SETTING_COMPANY_MAP_CODE", "");
/**
 * SETTING_COMPANY_NAME
 * 
 */
if(!defined("SETTING_COMPANY_NAME")) define("SETTING_COMPANY_NAME", "PatriotRSA Ontwerpe");
/**
 * SETTING_COMPANY_NOTES
 * 
 */
if(!defined("SETTING_COMPANY_NOTES")) define("SETTING_COMPANY_NOTES", "");
/**
 * SETTING_COMPANY_PREFIX
 * 
 */
if(!defined("SETTING_COMPANY_PREFIX")) define("SETTING_COMPANY_PREFIX", "");
/**
 * SETTING_COMPANY_REG_NO
 * 
 */
if(!defined("SETTING_COMPANY_REG_NO")) define("SETTING_COMPANY_REG_NO", "");
/**
 * SETTING_COMPANY_SERVICES_ASSET_MANAGEMENT
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_ASSET_MANAGEMENT")) define("SETTING_COMPANY_SERVICES_ASSET_MANAGEMENT", "");
/**
 * SETTING_COMPANY_SERVICES_ASSET_MANAGEMENT_IMAGE
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_ASSET_MANAGEMENT_IMAGE")) define("SETTING_COMPANY_SERVICES_ASSET_MANAGEMENT_IMAGE", "null");
/**
 * SETTING_COMPANY_SERVICES_ASSET_MANAGEMENT_YOUTUBE_LINK
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_ASSET_MANAGEMENT_YOUTUBE_LINK")) define("SETTING_COMPANY_SERVICES_ASSET_MANAGEMENT_YOUTUBE_LINK", "");
/**
 * SETTING_COMPANY_SERVICES_AUCTIONS
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_AUCTIONS")) define("SETTING_COMPANY_SERVICES_AUCTIONS", "");
/**
 * SETTING_COMPANY_SERVICES_AUCTIONS_IMAGE
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_AUCTIONS_IMAGE")) define("SETTING_COMPANY_SERVICES_AUCTIONS_IMAGE", "null");
/**
 * SETTING_COMPANY_SERVICES_AUCTIONS_YOUTUBE_LINK
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_AUCTIONS_YOUTUBE_LINK")) define("SETTING_COMPANY_SERVICES_AUCTIONS_YOUTUBE_LINK", "");
/**
 * SETTING_COMPANY_SERVICES_DEVELOPMENTS
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_DEVELOPMENTS")) define("SETTING_COMPANY_SERVICES_DEVELOPMENTS", "");
/**
 * SETTING_COMPANY_SERVICES_DEVELOPMENTS_IMAGE
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_DEVELOPMENTS_IMAGE")) define("SETTING_COMPANY_SERVICES_DEVELOPMENTS_IMAGE", "null");
/**
 * SETTING_COMPANY_SERVICES_DEVELOPMENTS_YOUTUBE_LINK
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_DEVELOPMENTS_YOUTUBE_LINK")) define("SETTING_COMPANY_SERVICES_DEVELOPMENTS_YOUTUBE_LINK", "");
/**
 * SETTING_COMPANY_SERVICES_SELLING
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_SELLING")) define("SETTING_COMPANY_SERVICES_SELLING", "");
/**
 * SETTING_COMPANY_SERVICES_SELLING_IMAGE
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_SELLING_IMAGE")) define("SETTING_COMPANY_SERVICES_SELLING_IMAGE", "null");
/**
 * SETTING_COMPANY_SERVICES_SELLING_YOUTUBE_LINK
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_SELLING_YOUTUBE_LINK")) define("SETTING_COMPANY_SERVICES_SELLING_YOUTUBE_LINK", "");
/**
 * SETTING_COMPANY_SERVICES_VALUATIONS
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_VALUATIONS")) define("SETTING_COMPANY_SERVICES_VALUATIONS", "");
/**
 * SETTING_COMPANY_SERVICES_VALUATIONS_IMAGE
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_VALUATIONS_IMAGE")) define("SETTING_COMPANY_SERVICES_VALUATIONS_IMAGE", "null");
/**
 * SETTING_COMPANY_SERVICES_VALUATIONS_YOUTUBE_LINK
 * 
 */
if(!defined("SETTING_COMPANY_SERVICES_VALUATIONS_YOUTUBE_LINK")) define("SETTING_COMPANY_SERVICES_VALUATIONS_YOUTUBE_LINK", "");
/**
 * SETTING_COMPANY_TELLNR_CONTACT
 * 
 */
if(!defined("SETTING_COMPANY_TELLNR_CONTACT")) define("SETTING_COMPANY_TELLNR_CONTACT", "");
/**
 * SETTING_COMPANY_TELLNR_FAX
 * 
 */
if(!defined("SETTING_COMPANY_TELLNR_FAX")) define("SETTING_COMPANY_TELLNR_FAX", "");
/**
 * SETTING_COMPANY_TELLNR_GENERAL
 * 
 */
if(!defined("SETTING_COMPANY_TELLNR_GENERAL")) define("SETTING_COMPANY_TELLNR_GENERAL", "");
/**
 * SETTING_COMPANY_TELLNR_OFFICE
 * 
 */
if(!defined("SETTING_COMPANY_TELLNR_OFFICE")) define("SETTING_COMPANY_TELLNR_OFFICE", "");
/**
 * SETTING_COMPANY_TELLNR_SALES
 * 
 */
if(!defined("SETTING_COMPANY_TELLNR_SALES")) define("SETTING_COMPANY_TELLNR_SALES", "");
/**
 * SETTING_COMPANY_TELLNR_WORK
 * 
 */
if(!defined("SETTING_COMPANY_TELLNR_WORK")) define("SETTING_COMPANY_TELLNR_WORK", "");
/**
 * SETTING_COMPANY_VALUE_ADDED_SERVICES
 * 
 */
if(!defined("SETTING_COMPANY_VALUE_ADDED_SERVICES")) define("SETTING_COMPANY_VALUE_ADDED_SERVICES", "");
/**
 * SETTING_COMPANY_VALUE_ADDED_SERVICES_IMAGE
 * 
 */
if(!defined("SETTING_COMPANY_VALUE_ADDED_SERVICES_IMAGE")) define("SETTING_COMPANY_VALUE_ADDED_SERVICES_IMAGE", "null");
/**
 * SETTING_COMPANY_VALUE_ADDED_SERVICES_YOUTUBE_LINK
 * 
 */
if(!defined("SETTING_COMPANY_VALUE_ADDED_SERVICES_YOUTUBE_LINK")) define("SETTING_COMPANY_VALUE_ADDED_SERVICES_YOUTUBE_LINK", "");
/**
 * SETTING_COMPANY_VAT_NO
 * 
 */
if(!defined("SETTING_COMPANY_VAT_NO")) define("SETTING_COMPANY_VAT_NO", "");
/**
 * SETTING_COMPANY_WEBSITE
 * 
 */
if(!defined("SETTING_COMPANY_WEBSITE")) define("SETTING_COMPANY_WEBSITE", "");
/**
 * SETTING_COMPANY_EMAIL_DISCLAIMER
 * 
 */
if(!defined("SETTING_COMPANY_EMAIL_DISCLAIMER")) define("SETTING_COMPANY_EMAIL_DISCLAIMER", "");
/**
 * SETTING_ENABLE_CART
 * 
 */
if(!defined("SETTING_ENABLE_CART")) define("SETTING_ENABLE_CART", "");
/**
 * SETTING_EXTERNAL_PUBLISHING_PLATFORM_ENABLE_GUMTREE
 * 
 */
if(!defined("SETTING_EXTERNAL_PUBLISHING_PLATFORM_ENABLE_GUMTREE")) define("SETTING_EXTERNAL_PUBLISHING_PLATFORM_ENABLE_GUMTREE", "");
/**
 * SETTING_EXTERNAL_PUBLISHING_PLATFORM_ENABLE_PRIVATE_PROPERTY
 * 
 */
if(!defined("SETTING_EXTERNAL_PUBLISHING_PLATFORM_ENABLE_PRIVATE_PROPERTY")) define("SETTING_EXTERNAL_PUBLISHING_PLATFORM_ENABLE_PRIVATE_PROPERTY", "");
/**
 * SETTING_EXTERNAL_PUBLISHING_PLATFORM_GUMTREE
 * 
 */
if(!defined("SETTING_EXTERNAL_PUBLISHING_PLATFORM_GUMTREE")) define("SETTING_EXTERNAL_PUBLISHING_PLATFORM_GUMTREE", "");
/**
 * SETTING_EXTERNAL_PUBLISHING_PLATFORM_PRIVATE_PROPERTY
 * 
 */
if(!defined("SETTING_EXTERNAL_PUBLISHING_PLATFORM_PRIVATE_PROPERTY")) define("SETTING_EXTERNAL_PUBLISHING_PLATFORM_PRIVATE_PROPERTY", "");
/**
 * SETTING_MAILCHIMP_API_KEY
 * Log into mailchimp account
Go to https://us1.admin.mailchimp.com/account/api
Scroll down and add API key
 */
if(!defined("SETTING_MAILCHIMP_API_KEY")) define("SETTING_MAILCHIMP_API_KEY", "");
/**
 * SETTING_MAILCHIMP_AUDIENCE_ID
 * Log into mailchimp account
Click Audience.
Click All contacts.
If you have more than one audience, click the Current audience drop-down and choose the one you want to work with.
Click the Settings drop-down and choose Audience name and defaults.
In the Audience ID section, you’ll see a string of letters and numbers. This is your audience ID.
 */
if(!defined("SETTING_MAILCHIMP_AUDIENCE_ID")) define("SETTING_MAILCHIMP_AUDIENCE_ID", "");
/**
 * SETTING_MAILCHIMP_SERVER_PREFIX
 * Log into mailchimp account
Extract server prefix from URL
IE: https://[SERVER_PREFIX].admin.mailchimp.com/
IE: us7
 */
if(!defined("SETTING_MAILCHIMP_SERVER_PREFIX")) define("SETTING_MAILCHIMP_SERVER_PREFIX", "");
/**
 * SETTING_OCTOAPI_SERVICE_PASSWORD
 * 
 */
if(!defined("SETTING_OCTOAPI_SERVICE_PASSWORD")) define("SETTING_OCTOAPI_SERVICE_PASSWORD", "");
/**
 * SETTING_OCTOAPI_SERVICE_URL
 * 
 */
if(!defined("SETTING_OCTOAPI_SERVICE_URL")) define("SETTING_OCTOAPI_SERVICE_URL", "");
/**
 * SETTING_OCTOAPI_SERVICE_USERNAME
 * 
 */
if(!defined("SETTING_OCTOAPI_SERVICE_USERNAME")) define("SETTING_OCTOAPI_SERVICE_USERNAME", "");
/**
 * SETTING_ORDER_PREFIX
 * 
 */
if(!defined("SETTING_ORDER_PREFIX")) define("SETTING_ORDER_PREFIX", "");
/**
 * SETTING_POLICY_PRIVACY
 * 
 */
if(!defined("SETTING_POLICY_PRIVACY")) define("SETTING_POLICY_PRIVACY", "");
/**
 * SETTING_POLICY_RETURNS
 * 
 */
if(!defined("SETTING_POLICY_RETURNS")) define("SETTING_POLICY_RETURNS", "");
/**
 * SETTING_POLICY_SHIPPING
 * 
 */
if(!defined("SETTING_POLICY_SHIPPING")) define("SETTING_POLICY_SHIPPING", "");
/**
 * SETTING_PROMOTION_VOUCHER_PREFIX
 * 
 */
if(!defined("SETTING_PROMOTION_VOUCHER_PREFIX")) define("SETTING_PROMOTION_VOUCHER_PREFIX", "");
/**
 * SETTING_RESERVE_OVERRIDE_END_TIME
 * 
 */
if(!defined("SETTING_RESERVE_OVERRIDE_END_TIME")) define("SETTING_RESERVE_OVERRIDE_END_TIME", "");
/**
 * SETTING_RESERVE_OVERRIDE_START_TIME
 * 
 */
if(!defined("SETTING_RESERVE_OVERRIDE_START_TIME")) define("SETTING_RESERVE_OVERRIDE_START_TIME", "");
/**
 * SETTING_SHARING_TERMS_AND_CONDITIONS
 * 
 */
if(!defined("SETTING_SHARING_TERMS_AND_CONDITIONS")) define("SETTING_SHARING_TERMS_AND_CONDITIONS", "");
/**
 * SETTING_TERMS_AND_CONDITIONS
 * 
 */
if(!defined("SETTING_TERMS_AND_CONDITIONS")) define("SETTING_TERMS_AND_CONDITIONS", "");
//-------------------------------------------------------------
//USER_ROLE
//-------------------------------------------------------------
/**
 * USER_ROLE_ADMIN
 * User has administrative rights in the system
 */
if(!defined("USER_ROLE_ADMIN")) define("USER_ROLE_ADMIN", "ADMIN");
/**
 * USER_ROLE_CLIENT
 * Client User
 */
if(!defined("USER_ROLE_CLIENT")) define("USER_ROLE_CLIENT", "CLIENT");
/**
 * USER_ROLE_DEV
 * User has development rights in the system
 */
if(!defined("USER_ROLE_DEV")) define("USER_ROLE_DEV", "DEV");

