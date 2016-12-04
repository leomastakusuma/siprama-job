<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


#global config
define('branchID','BRANCH00116');
define('apiKey','071d6f903864ceb2e1f6');
define('apiSecret','066dbdcfd2eb3d945f4f723b262c5b2e3a7a512f');
define('testUser','netportal');
define('testPassword','netportal123$%^');
/*
define('apiKey','59c9589466c339308038');
define('apiSecret','43613fed57bba63faaf415f8b096a93aee3bedac');
define('testUser','netmediatama');
define('testPassword','alhamdulillah');*/
/*define('branchID','BRANCH00116');
define('apiKey','d332bda1116859aecfb6');
define('apiSecret','ec7f5cf93b52b50f1a257efbae00da39f8898ca6');
define('testUser','lanford21');
define('testPassword','k4nd4pr4t4m4');*/
define('ratio169','1');
define('ratio43','2');
define('ratio11','3');
define('rations','4');
define('rationsImageCover','4');
define('rationsImageBack','4');

// RE = RECOMMENDATION ENGINE
define('BASE_URL_API_RE','http://prediction.codigo.id/api/index.php/');
define('KEY_API_RE','1QGb8QfF90Mv33A2BIOUARPptUVxmjz1BPL1SSxDA4AM0vY5dg3sUCiYBbiclYFF');
define('APPID_API_RE','3');
define('HTTPAUTHUSER_API_RE','admin');
define('HTTPAUTHPASS_API_RE','1234');


#image ratiomin
#16:9
define('minw169','512');
define('minh169','288');
define('minx169','32');
#4:3
define('minw43','400');
define('minh43','300');
define('minx43','100');
#1:1
define('minw11','400');
define('minh11','400');
define('minx11','400');
define('THUMB_URL','https://thumb.netz.stg.codigo.id');


define('TypeInsert','1');
define('TypeUpdate','2');
define('TypeDelete','3');
define('TypeActive','4');
define('TypeNonActive','5');
define('TypeMoveUP','6');
define('TypeMoveDown','7');
define('TypeMoveToTop','8');
define('TypeMoveToDown','9');


/**
CODIGO HEARSAY
**/
define('HEARSAY_BASE_URL','http://yansen.dev.codigo.id/comment-web-services/api/');/*
define('HEARSAY_APPS_ID','11');
define('HEARSAY_APPS_KEY','SGovOHQwclJaY09sTjNzVTZyeWFNUT09');
define('HEARSAY_APPS_SECRET','51f20e0290fbcf58b226bdbf7211cbe7311026c34357a2992d078c825d1c4df7');*/
define('HEARSAY_APPS_ID','15');
define('HEARSAY_APPS_KEY','YlJoYytJVXEzRUhQZnlpK1RLc0NFZz09');
define('HEARSAY_APPS_SECRET','0c4f313728db75b303721ead512c67e5e8cef9ef8ba47e9fb7ecbb43c5fb7e93');

/**
GA
**/
//define('GA_PATH','public_assets/Google/');
//define('GA_KEY_FILE','NETZID-DEV.p12');
//define('GA_SERVICE_ACCOUNT_EMAIL','guest-876@net-portal-project.iam.gserviceaccount.com');
//define('GA_PROJECT_NAME','GUEST');

// /**
// GA
// **/
 define('GA_PATH','public_assets/Google/');
 define('GA_KEY_FILE','NETZID.p12');
 define('GA_SERVICE_ACCOUNT_EMAIL','netzid@wide-axiom-133407.iam.gserviceaccount.com');
 define('GA_PROJECT_NAME','NETZID');


/**
NETCJ
**/
define('BASE_URL_API_NETCJ','admin:1234@api.netcj.arief.dev.codigo.id/1.0/');

/**
 * SYS Type Object
 */
define('TypeObjectChannel',1);
define('TypeObjectKeyword',2);
define('TypeObjectArticle',3);
define('TypeObjectLiveStreaming',4);
define('TypeObjectStory',5);