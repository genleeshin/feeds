<?php 

function d($var){
	if(is_array($var) || is_object($var))
		return parr($var);
		
	var_dump($var);
}

function dd($var){
	die(d($var));
}

function parr($array){
	echo '<pre>' . var_dump($array) . '</pre>';
}

function value($value, $default=''){
	return isset($value)?$value:$default;
}

function config($key=false, $val=null){
    if($val)
        return \Feeds\Core\Config::set($key, $val);

    return array_get(Feeds\Core\Config::all(), $key);

}

function array_get($array, $key, $default = null)
{
    if (is_null($key)) return $array;
    if (isset($array[$key])) return $array[$key];

    if(strpos($key, '.')===false) return [];
    foreach (explode('.', $key) as $segment)
    {
        if ( ! is_array($array) || ! array_key_exists($segment, $array))
        {
            return $default;
        }
        $array = $array[$segment];
    }
    
    return $array;
}

function cout($m){
    echo "\n-------------------------\n";
    echo $m;
    echo "\n-------------------------\n";
}
