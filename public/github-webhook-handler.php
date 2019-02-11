<?php
/**
 */
$pathInfo = pathinfo(__FILE__);

$rootPath = $pathInfo['dirname'];
//读取配置文件
if (is_file($rootPath . '.env')) {
    $env = parse_ini_file($rootPath . '.env', true);
    foreach ($env as $key => $val) {
        $name = strtoupper($key);
        if (is_array($val)) {
            foreach ($val as $k => $v) {
                $item = $name . '_' . strtoupper($k);
                putenv("$item=$v");
            }
        } else {
            putenv("$name=$val");
        }
    }
}
$hookSecret = getenv('github_webhook_secret');
set_error_handler(function ($severity, $message, $file, $line) {
    throw new \ErrorException($message, 0, $severity, $file, $line);
});
set_exception_handler(function ($e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo "Error on line {$e->getLine()}: " . htmlSpecialChars($e->getMessage());
    die();
});
$rawPost = NULL;
if ($hookSecret !== NULL) {
    if (!isset($_SERVER['HTTP_X_HUB_SIGNATURE'])) {
        throw new \Exception("HTTP header 'X-Hub-Signature' is missing.");
    } elseif (!extension_loaded('hash')) {
        throw new \Exception("Missing 'hash' extension to check the secret code validity.");
    }
    list($algo, $hash) = explode('=', $_SERVER['HTTP_X_HUB_SIGNATURE'], 2) + array('', '');
    if (!in_array($algo, hash_algos(), TRUE)) {
        throw new \Exception("Hash algorithm '$algo' is not supported.");
    }
    $rawPost = file_get_contents('php://input');
    if ($hash !== hash_hmac($algo, $rawPost, $hookSecret)) {
        throw new \Exception('Hook secret does not match.');
    }
};
if (!isset($_SERVER['HTTP_CONTENT_TYPE'])) {
    throw new \Exception("Missing HTTP 'Content-Type' header.");
} elseif (!isset($_SERVER['HTTP_X_GITHUB_EVENT'])) {
    throw new \Exception("Missing HTTP 'X-Github-Event' header.");
}
switch ($_SERVER['HTTP_CONTENT_TYPE']) {
    case 'application/json':
        $json = $rawPost ?: file_get_contents('php://input');
        break;
    case 'application/x-www-form-urlencoded':
        $json = $_POST['payload'];
        break;
    default:
        throw new \Exception("Unsupported content type: $_SERVER[HTTP_CONTENT_TYPE]");
}

$payload = json_decode($json);
switch (strtolower($_SERVER['HTTP_X_GITHUB_EVENT'])) {
    case 'ping':
        echo 'pong';
        break;
	case 'push':
        $local = getenv('project_workspace');
        echo shell_exec("cd {$local} && git pull 2>&1");
        die("done " . date('Y-m-d H:i:s', time()));
		break;
//	case 'create':
//		break;
    default:
        header('HTTP/1.0 404 Not Found');
        echo "Event:$_SERVER[HTTP_X_GITHUB_EVENT] Payload:\n";
        print_r($payload); # For debug only. Can be found in GitHub hook log.
        die();
}