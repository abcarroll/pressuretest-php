<?php
	// Pressure Test: See what PHP functions leak memory
	// So Far, the only one I've seen is create_function()
	// Even closures don't leak memory.

	$start_time = microtime(1);

	function mem_usage() {
		$x = memory_get_usage();
		$y = memory_get_usage(1);
		$xK = round( ( $x / 1024 ), 2);
		$yK = round( ( $y / 1024 ), 2);
		return "$xK KB ($x b) / $yK KB ($y b)";
	}

	class FakeClass { 
		// does nothing
	}

	echo "Mem Usage Starting: " . mem_usage() . "\n";
	$next_report = time() + 30;
	for($y = 0; $y<100000000;$y++) { 
		
		$test = function($lulz) {
			$zend_version = [zend_version()]; $zend_version = [$zend_version];
			$func_num_args = [func_num_args()]; $func_num_args = [$func_num_args];
			$arg_num = 0;
			$func_get_arg = [func_get_arg($arg_num)]; $func_get_arg = [$func_get_arg];
			$func_get_args = [func_get_args()]; $func_get_args = [$func_get_args];
			$str = "Hello World";
			$strlen = [strlen($str)]; $strlen = [$strlen];
			$str1 = "Hello"; $str2 = "World";
			$strcmp = [strcmp($str1, $str2)]; $strcmp = [$strcmp];
			$len = 3;
			$strncmp = [strncmp($str1, $str2, $len)]; $strncmp = [$strncmp];
			$strcasecmp = [strcasecmp($str1, $str2)]; $strcasecmp = [$strcasecmp];
			$strncasecmp = [strncasecmp($str1, $str2, $len)]; $strncasecmp = [$strncasecmp];
			$arr = ["Hello", "World"];
			$each = [each($arr)]; $each = [$each];
			$new_error_level = E_ALL;
			$error_reporting = [error_reporting($new_error_level)]; $error_reporting = [$error_reporting];
			$constant_name = "CONSTANT"; $value = "FOO"; $case_insensitive = true;
			// Note: @ here, edge case iterating this
			$define = [@define($constant_name, $value, $case_insensitive)]; $define = [$define];
			$defined = [defined($constant_name)]; $defined = [$defined];
			$object = new StdClass();	
			$get_class = [get_class($object)]; $get_class = [$get_class];
			// Note: Generates warnings here, meat of execution isn't happening
			$get_called_class = [@get_called_class()]; $get_called_class = [$get_called_class];
			$get_parent_class = [@get_parent_class($object)]; $get_parent_class = [$get_parent_class];
			$method = "foo";
			$method_exists = [method_exists($object, $method)]; $method_exists = [$method_exists];
			$object_or_class = $object;
			$property_name = "foo";
			$property_exists = [property_exists($object_or_class, $property_name)]; $property_exists = [$property_exists];
			$classname = "FakeClass";
			$autoload = false;
			$class_exists = [class_exists($classname, $autoload)]; $class_exists = [$class_exists];
			$classname = "StdClass";
			$interface_exists = [interface_exists($classname, $autoload)]; $interface_exists = [$interface_exists];
			$traitname = "FakeTrait"; 
			$trait_exists = [trait_exists($traitname, $autoload)]; $trait_exists = [$trait_exists];
			$function_name = "strlen";
			$function_exists = [function_exists($function_name)]; $function_exists = [$function_exists];
			$user_class_name = "FakeClass";
			$alias_name = "ClassFake";
			// Note: @ here, edge case iterating
			$class_alias = [@class_alias($user_class_name, $alias_name, $autoload)]; $class_alias = [$class_alias];
			$get_included_files = [get_included_files()]; $get_included_files = [$get_included_files];
			// Broken in HHVM
			//$get_required_files = [get_required_files()]; $get_required_files = [$get_required_files];
			
			$time = "March 13 2013";
			$strtotime = [strtotime($time)]; $strtotime = [$strtotime]; // Note; parms changed
			$timestamp = time(); // Note: calling time() twice now
			$format = "dDjlNSwzWFmMntLoYyaABgGhHisueIOPTZcrU"; // All
			$date = [date($format, $timestamp)]; $date = [$date];
			$date2 = [date($format)]; $date2 = [$date2];
			$iformat = 'U'; // Note: only testing one format char + 1st parm of idate is $format by reflection not $iformat
			$idate = [idate($iformat, $timestamp)]; $idate = [$idate];
			$idate2 = [idate($iformat)]; $idate = [$idate];
			$gmdate = [gmdate($format, $timestamp)]; $gmdate = [$gmdate];
			$gmdate2 = [gmdate($format)]; $gmdate = [$gmdate];
			$hour = 12; $min = 30; $sec = 20; $mon = 4; $day = 20; $year = 2000;
			$mktime = [mktime($hour, $min, $sec, $mon, $day, $year)]; $mktime = [$mktime];
			$gmmktime = [gmmktime($hour, $min, $sec, $mon, $day, $year)]; $gmmktime = [$gmmktime];
			$month = 4;
			$checkdate = [checkdate($month, $day, $year)]; $checkdate = [$checkdate];
			$fformat = "%a%A%d%e%j%u%w%U%V%W%b%B%h%m%C%g%G%y%Y%H%k%I%l%M%p%P%r%R%S%T%X%z%Z%c%D%F%s%x%n%t%%"; // All
			$strftime = [strftime($fformat, $timestamp)]; $strftime = [$strftime];
			$strftime2 = [strftime($fformat)]; $strftime = [$strftime];
			$gmstrftime = [gmstrftime($fformat, $timestamp)]; $gmstrftime = [$gmstrftime];
			$gmstrftime2 = [gmstrftime($fformat)]; $gmstrftime = [$gmstrftime];
			$time = [time()]; $time = [$time];
			
			
			$ucfirst = [ucfirst($str)]; $ucfirst = [$ucfirst];
			$lcfirst = [lcfirst($str)]; $lcfirst = [$lcfirst];
			$ucwords = [ucwords($str)]; $ucwords = [$ucwords];
			$from = "Hel"; $to = "Wor";
			$strtr = [strtr($str, $from, $to)]; $strtr = [$strtr];
			$addslashes = [addslashes($str)]; $addslashes = [$addslashes];
			$charlist = " ";
			$addcslashes = [addcslashes($str, $charlist)]; $addcslashes = [$addcslashes];
			$character_mask = " ";
			$rtrim = [rtrim($str, $character_mask)]; $rtrim = [$rtrim];
			$search = "Foo";
			$replace = "F";
			$subject = "Foo Bar";
			$str_replace = [str_replace($search, $replace, $subject, $replace_count)]; $str_replace = [$str_replace];
			$str_ireplace = [str_ireplace($search, $replace, $subject, $replace_count)]; $str_ireplace = [$str_ireplace];
			$input = $str;
			$mult = 100;
			$str_repeat = [str_repeat($input, $mult)]; $str_repeat = [$str_repeat];
			$mode = 3; // Note: Only mode '3' 
			$count_chars = [count_chars($input, $mode)]; $count_chars = [$count_chars];
			$chunklen = 20;
			$ending = "W";
			$chunk_split = [chunk_split($str, $chunklen, $ending)]; $chunk_split = [$chunk_split];
			$trim = [trim($str, $character_mask)]; $trim = [$trim];
			$ltrim = [ltrim($str, $character_mask)]; $ltrim = [$ltrim];
			$allowable_tags = "<a>";
			$strip_tags = [strip_tags($str, $allowable_tags)]; $strip_tags = [$strip_tags];
			$similar_text = [similar_text($str1, $str2, $percent)]; $similar_text = [$similar_text];
			$separator = " ";
			$limit = 3;
			$explode = [explode($separator, $str, $limit)]; $explode = [$explode];
			$glue = " "; $pieces = ['Hello', 'World'];
			$implode = [implode($glue, $pieces)]; $implode = [$implode];
			$join = [join($glue, $pieces)]; $join = [$join];
			$value = [
				'a' => 'bigger',
				'array' => 'needs',
				'to' => 'go',
				'here' => [
					'and', 'here', 'too'
				]
			];
			$json_encode = [json_encode($value)]; $json_encode = [$json_encode]; // Note: options not passed
			$json_decode = [json_decode($json_encode[0][0])]; $json_decode = [$json_decode]; // left out different OPTIONS and DEPTHS
			//$json_last_error = [json_last_error()]; $json_last_error = [$json_last_error];
		};

		$test("Just a test string");
		
		$stdclass = new StdClass();
		$stdclass->foo = "Pressure test";
		$stdclass = [$stdclass,$stdclass];

		$a = [$test];
		$a[] = $a;
		if((time() > $next_report)) { 
			echo "Iter " . number_format($y) . ": " . mem_usage();
			echo " | /proc says: ". trim(file_get_contents('/proc/' . posix_getpid() . '/statm')) . "\n";
			echo " -> Time is " . sprintf("%f", microtime(1) - $start_time) . "\n";
			$next_report = time()+30;
		}
	}
