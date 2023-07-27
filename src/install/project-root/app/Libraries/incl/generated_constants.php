<?php
namespace incl;

/**
 * @package mod\solid_classes
 * @author Ryno Van Zyl
 */

//-------------------------------------------------------------
//ERROR_CODE_1
//-------------------------------------------------------------
/**
 * ERROR_CODE_LOGIN_INVALID
 * Invalid username and/or password.
 */
if(!defined("ERROR_CODE_LOGIN_INVALID")) define("ERROR_CODE_LOGIN_INVALID", "1");
//-------------------------------------------------------------
//ERROR_CODE_10
//-------------------------------------------------------------
/**
 * ERROR_CODE_ACCESS_DENIED
 * You do not have permission to access the resource you requested. If you think this is incorrect, please contact support.
 */
if(!defined("ERROR_CODE_ACCESS_DENIED")) define("ERROR_CODE_ACCESS_DENIED", "10");
//-------------------------------------------------------------
//ERROR_CODE_11
//-------------------------------------------------------------
/**
 * ERROR_CODE_ACCOUNT_LOCKED
 * You have had more than 3 failed login attempts. Your account has been locked for 15 minutes. If you continue to have problems, please contact support.
 */
if(!defined("ERROR_CODE_ACCOUNT_LOCKED")) define("ERROR_CODE_ACCOUNT_LOCKED", "11");
//-------------------------------------------------------------
//ERROR_CODE_12
//-------------------------------------------------------------
/**
 * ERROR_CODE_CAPTCHA_ERROR
 * The reCAPTCHA test failed. Please try again.
 */
if(!defined("ERROR_CODE_CAPTCHA_ERROR")) define("ERROR_CODE_CAPTCHA_ERROR", "12");
//-------------------------------------------------------------
//ERROR_CODE_13
//-------------------------------------------------------------
/**
 * ERROR_CODE_SYSTEM_OFFLINE
 * The system is currently offline, we are attending to the problem.
 */
if(!defined("ERROR_CODE_SYSTEM_OFFLINE")) define("ERROR_CODE_SYSTEM_OFFLINE", "13");
//-------------------------------------------------------------
//ERROR_CODE_14
//-------------------------------------------------------------
/**
 * ERROR_CODE_ACCOUNT_INACTIVE
 * Your account is not active. Please contact support.
 */
if(!defined("ERROR_CODE_ACCOUNT_INACTIVE")) define("ERROR_CODE_ACCOUNT_INACTIVE", "14");
//-------------------------------------------------------------
//ERROR_CODE_15
//-------------------------------------------------------------
/**
 * ERROR_CODE_CSRF_TOKEN_MISSING
 * The system could not complete this action due to a missing form token. You may have cleared your browser cookies or logged in on a different tab, which could have resulted in the expiry of your current form token.
 */
if(!defined("ERROR_CODE_CSRF_TOKEN_MISSING")) define("ERROR_CODE_CSRF_TOKEN_MISSING", "15");
//-------------------------------------------------------------
//ERROR_CODE_16
//-------------------------------------------------------------
/**
 * ERROR_CODE_UNAUTHORIZED_FORM_SUBMISSION
 * The system could not complete this action due to an unauthorized form token. Please contact support if the problem persists.
 */
if(!defined("ERROR_CODE_UNAUTHORIZED_FORM_SUBMISSION")) define("ERROR_CODE_UNAUTHORIZED_FORM_SUBMISSION", "16");
//-------------------------------------------------------------
//ERROR_CODE_17
//-------------------------------------------------------------
/**
 * ERROR_CODE_INTERNAL_ERROR
 * The system encountered an error while processing your request. The administrator has been notified and will be attending to the problem. We apologize for any inconvenience. Please try again later.
 */
if(!defined("ERROR_CODE_INTERNAL_ERROR")) define("ERROR_CODE_INTERNAL_ERROR", "17");
//-------------------------------------------------------------
//ERROR_CODE_18
//-------------------------------------------------------------
/**
 * ERROR_CODE_LOGIN_ERROR
 * The system encountered an error while logging you in. For assistance, please contact support.
 */
if(!defined("ERROR_CODE_LOGIN_ERROR")) define("ERROR_CODE_LOGIN_ERROR", "18");
//-------------------------------------------------------------
//ERROR_CODE_19
//-------------------------------------------------------------
/**
 * ERROR_CODE_PENDING_VERIFICATION
 * Your account is pending verification. Should we resend the verification email?
 */
if(!defined("ERROR_CODE_PENDING_VERIFICATION")) define("ERROR_CODE_PENDING_VERIFICATION", "19");
//-------------------------------------------------------------
//ERROR_CODE_2
//-------------------------------------------------------------
/**
 * ERROR_CODE_LOGIN_INVALID_DETAILS
 * Invalid username, please enter your username to continue.
 */
if(!defined("ERROR_CODE_LOGIN_INVALID_DETAILS")) define("ERROR_CODE_LOGIN_INVALID_DETAILS", "2");
//-------------------------------------------------------------
//ERROR_CODE_20
//-------------------------------------------------------------
/**
 * ERROR_CODE_SUCCESS_REGISTER
 * Thank you for registering and confirming your new profile.
 */
if(!defined("ERROR_CODE_SUCCESS_REGISTER")) define("ERROR_CODE_SUCCESS_REGISTER", "20");
//-------------------------------------------------------------
//ERROR_CODE_21
//-------------------------------------------------------------
/**
 * ERROR_CODE_ACCOUNT_UPDATED
 * Your account username and email address has been updated.
 */
if(!defined("ERROR_CODE_ACCOUNT_UPDATED")) define("ERROR_CODE_ACCOUNT_UPDATED", "21");
//-------------------------------------------------------------
//ERROR_CODE_3
//-------------------------------------------------------------
/**
 * ERROR_CODE_FORGOT_PASSWORD
 * Thank you, an email has been sent to your inbox. Please check it for further instructions on resetting your password
 */
if(!defined("ERROR_CODE_FORGOT_PASSWORD")) define("ERROR_CODE_FORGOT_PASSWORD", "3");
//-------------------------------------------------------------
//ERROR_CODE_4
//-------------------------------------------------------------
/**
 * ERROR_CODE_DB_ERROR
 * The database is unavailable at the moment, please try again later.
 */
if(!defined("ERROR_CODE_DB_ERROR")) define("ERROR_CODE_DB_ERROR", "4");
//-------------------------------------------------------------
//ERROR_CODE_404
//-------------------------------------------------------------
/**
 * ERROR_CODE_404
 * The page you are looking for is not available.
 */
if(!defined("ERROR_CODE_404")) define("ERROR_CODE_404", "404");
//-------------------------------------------------------------
//ERROR_CODE_5
//-------------------------------------------------------------
/**
 * ERROR_CODE_NOT_LOGGED_IN
 * You are not logged in or your session timed out, please click on the login link below.
 */
if(!defined("ERROR_CODE_NOT_LOGGED_IN")) define("ERROR_CODE_NOT_LOGGED_IN", "5");
//-------------------------------------------------------------
//ERROR_CODE_500
//-------------------------------------------------------------
/**
 * ERROR_CODE_500
 * The system encountered an error while processing your request. The administrator has been notified and will be attending to the problem. We apologize for any inconvenience. Please try again later.
 */
if(!defined("ERROR_CODE_500")) define("ERROR_CODE_500", "500");
//-------------------------------------------------------------
//ERROR_CODE_6
//-------------------------------------------------------------
/**
 * ERROR_CODE_ACTIVE_SESSION
 * You are already logged in, please logout first.
 */
if(!defined("ERROR_CODE_ACTIVE_SESSION")) define("ERROR_CODE_ACTIVE_SESSION", "6");
//-------------------------------------------------------------
//ERROR_CODE_7
//-------------------------------------------------------------
/**
 * ERROR_CODE_REQUEST_ERROR
 * Your request does not exist or it has expired.
 */
if(!defined("ERROR_CODE_REQUEST_ERROR")) define("ERROR_CODE_REQUEST_ERROR", "7");
//-------------------------------------------------------------
//ERROR_CODE_8
//-------------------------------------------------------------
/**
 * ERROR_CODE_RECOVERY_PASSWORD
 * Your new access details have been saved.
 */
if(!defined("ERROR_CODE_RECOVERY_PASSWORD")) define("ERROR_CODE_RECOVERY_PASSWORD", "8");
//-------------------------------------------------------------
//ERROR_CODE_9
//-------------------------------------------------------------
/**
 * ERROR_CODE_MAINTENANCE
 * The system is offline for planned maintenance. Thank you for your patience.
 */
if(!defined("ERROR_CODE_MAINTENANCE")) define("ERROR_CODE_MAINTENANCE", "9");
//-------------------------------------------------------------
//MESSAGE_CODE_100
//-------------------------------------------------------------
/**
 * MESSAGE_CODE_100
 * Thank you for submitting your request. We will be in contact with you shortly.
 */
if(!defined("MESSAGE_CODE_100")) define("MESSAGE_CODE_100", "100");
//-------------------------------------------------------------
//MESSAGE_CODE_101
//-------------------------------------------------------------
/**
 * MESSAGE_CODE_101
 * Thank you for submitting your quote. We will be in contact with you shortly.
 */
if(!defined("MESSAGE_CODE_101")) define("MESSAGE_CODE_101", "101");
//-------------------------------------------------------------
//MESSAGE_CODE_102
//-------------------------------------------------------------
/**
 * MESSAGE_CODE_102
 * We have sent you an mail. Please click the link to verify your email address.
 */
if(!defined("MESSAGE_CODE_102")) define("MESSAGE_CODE_102", "102");
//-------------------------------------------------------------
//ADMIN
//-------------------------------------------------------------
/**
 * USER_ROLE_ADMIN
 * User has administrative rights in the system
 */
if(!defined("USER_ROLE_ADMIN")) define("USER_ROLE_ADMIN", "ADMIN");
//-------------------------------------------------------------
//CLIENT
//-------------------------------------------------------------
/**
 * USER_ROLE_CLIENT
 * Client User
 */
if(!defined("USER_ROLE_CLIENT")) define("USER_ROLE_CLIENT", "CLIENT");
//-------------------------------------------------------------
//DEV
//-------------------------------------------------------------
/**
 * USER_ROLE_DEV
 * User has development rights in the system
 */
if(!defined("USER_ROLE_DEV")) define("USER_ROLE_DEV", "DEV");

