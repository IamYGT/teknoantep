<?php
define('INC', true);
//SQLi Protection
    
    //XSS Protection - Block infected requests
    //header("X-XSS-Protection: 1; mode=block");
    
        //XSS Protection - Sanitize infected requests
        @header("X-XSS-Protection: 1");
    
        //Clickjacking Protection
        @header("X-Frame-Options: sameorigin");
    
        //Prevents attacks based on MIME-type mismatch
        @header("X-Content-Type-Options: nosniff");
    
        //Force secure connection
        @header("Strict-Transport-Security: max-age=15552000; preload");
    
        //Hide PHP Version
        @header('X-Powered-By: Project SECURITY');
    
    //Sanitization of all fields and requests
    //$_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    //$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    
	if (!function_exists('cleanInput')) {
    function cleanInput($input)
    {
        $search = array(
            '@<script[^>]*?>.*?</script>@si', // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@' // Strip multi-line comments
        );
        
        $output = preg_replace($search, '', $input);
        return $output;
    }
	}
    
	if (!function_exists('sanitize')) {
    function sanitize($input)
    {
        if (is_array($input)) {
            foreach ($input as $var => $val) {
                $output[$var] = sanitize($val);
            }
        } else {
            $input  = str_replace('"', "", $input);
            $input  = str_replace("'", "", $input);
            $input  = cleanInput($input);
            $output = htmlentities($input, ENT_QUOTES);
        }
        return @$output;
    }
	}
    
        $_POST    = sanitize($_POST);
        $_GET     = sanitize($_GET);
        $_REQUEST = sanitize($_REQUEST);
        $_COOKIE  = sanitize($_COOKIE);
        if (isset($_SESSION)) {
            $_SESSION = sanitize($_SESSION);
        }
    
    $request_uri  = $_SERVER['REQUEST_URI'];
    $query_string = $_SERVER['QUERY_STRING'];
    
    //Patterns, used to detect Malicous Request (SQL Injection)
    $patterns = array(
        "union",
        "coockie",
        "concat",
        "alter",
        "exec",
        "shell",
        "wget",
        "**/",
        "/**",
        "0x3a",
        "null",
        "DR/**/OP/",
        "drop",
        "/*",
        "*/",
        "*",
        "--",
        ";",
        "||",
        "' #",
        "or 1=1",
        "'1'='1",
        "BUN",
        "S@BUN",
        "char",
        "OR%",
        "`",
        "[",
        "]",
        "<",
        ">",
        "++",
        "1,1",
        "substring",
        "ascii",
        "sleep(",
        "insert",
        "between",
        "values",
        "truncate",
        "benchmark",
        "sql",
        "mysql",
        "%27",
        "%22",
        "(",
        ")",
        "<?",
        "<?php",
        "?>",
        "../",
        "/localhost",
        "127.0.0.1",
        "loopback",
        ":",
        "%0A",
        "%0D",
        "%3C",
        "%3E",
        "%00",
        "%2e%2e",
        "input_file",
        "execute",
        "mosconfig",
        "environ",
        "scanner",
        "path=.",
        "mod=.",
        "eval\(",
        "javascript:",
        "base64_",
        "boot.ini",
        "etc/passwd",
        "self/environ",
        "md5",
        "echo.*kae",
        "=%27$"
    );
    foreach ($patterns as $pattern) {
        if (strlen($query_string) > 255 OR strpos(strtolower($query_string), strtolower($pattern)) != false) {
            
			include "ip_details.php";
			
            $querya = strip_tags(addslashes($query_string));
            $type   = "SQLi";
			$yonlendir = 'https://www.google.com.ru';
									  
			$data = [
					'ip' => getRealIpAddr(),
					'date' => $tarih,
					'time' => $saat,
					'page' => $_SERVER['PHP_SELF'],
					'type' => $querya,
					'referer_url' => $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']
					];
			
			$yaz = $db->table('dbo_ban_ip')->insert($data);
														  
			$f = fopen(".htaccess", "a+");
			fwrite($f, "\ndeny from ".getRealIpAddr()."");
			fclose($f);
            
            echo '<meta http-equiv="refresh" content="0;url=' . $yonlendir . '" />';
            exit;
        }
    }

?>