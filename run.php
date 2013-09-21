<?php
	// Pressure Test: See what PHP functions leak memory
	// So Far, the only one I've seen is create_function()
	// Even closures don't leak memory.

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
	for($y = 0; $y<100000000;$y++) { 
		$test = function($lulz) {
			$zend_version = [zend_version()]; $f = [$zend_version];
			$func_num_args = [func_num_args()]; $f = [$func_num_args];
			$arg_num = 0;
			$func_get_arg = [func_get_arg($arg_num)]; $f = [$func_get_arg];
			$func_get_args = [func_get_args()]; $f = [$func_get_args];
			$str = "Hello World";
			$strlen = [strlen($str)]; $f = [$strlen];
			$str1 = "Hello"; $str2 = "World";
			$strcmp = [strcmp($str1, $str2)]; $f = [$strcmp];
			$len = 3;
			$strncmp = [strncmp($str1, $str2, $len)]; $f = [$strncmp];
			$strcasecmp = [strcasecmp($str1, $str2)]; $f = [$strcasecmp];
			$strncasecmp = [strncasecmp($str1, $str2, $len)]; $f = [$strncasecmp];
			$arr = ["Hello", "World"];
			$each = [each($arr)]; $f = [$each];
			$new_error_level = E_ALL;
			$error_reporting = [error_reporting($new_error_level)]; $f = [$error_reporting];
			$constant_name = "CONSTANT"; $value = "FOO"; $case_insensitive = true;
			// Note: @ here, edge case iterating this
			$define = [@define($constant_name, $value, $case_insensitive)]; $f = [$define];
			$defined = [defined($constant_name)]; $f = [$defined];
			$object = new StdClass();	
			$get_class = [get_class($object)]; $f = [$get_class];
			// Note: Generates warnings here, meat of execution isn't happening
			$get_called_class = [@get_called_class()]; $f = [$get_called_class];
			$get_parent_class = [@get_parent_class($object)]; $f = [$get_parent_class];
			$method = "foo";
			$method_exists = [method_exists($object, $method)]; $f = [$method_exists];
			$object_or_class = $object;
			$property_name = "foo";
			$property_exists = [property_exists($object_or_class, $property_name)]; $f = [$property_exists];
			$classname = "FakeClass";
			$autoload = false;
			$class_exists = [class_exists($classname, $autoload)]; $f = [$class_exists];
			$classname = "StdClass";
			$interface_exists = [interface_exists($classname, $autoload)]; $f = [$interface_exists];
			$traitname = "FakeTrait"; 
			$trait_exists = [trait_exists($traitname, $autoload)]; $f = [$trait_exists];
			$function_name = "strlen";
			$function_exists = [function_exists($function_name)]; $f = [$function_exists];
			$user_class_name = "FakeClass";
			$alias_name = "ClassFake";
			// Note: @ here, edge case iterating
			$class_alias = [@class_alias($user_class_name, $alias_name, $autoload)]; $f = [$class_alias];
			$get_included_files = [get_included_files()]; $f = [$get_included_files];
			$get_required_files = [get_required_files()]; $f = [$get_required_files];
			$timestamp = time(); // Note: calling time() twice now
			$format = "dDjlNSwzWFmMntLoYyaABgGhHisueIOPTZcrU"; // All
			$date = [date($format, $timestamp)]; $f = [$date];
			$date2 = [date($format)]; $f = [$date];
			$iformat = 'U'; // Note: only testing one format char + 1st parm of idate is $format by reflection not $iformat
			$idate = [idate($iformat, $timestamp)]; $f = [$idate];
			$idate2 = [idate($iformat)]; $f = [$idate];
			$gmdate = [gmdate($format, $timestamp)]; $f = [$gmdate];
			$gmdate2 = [gmdate($format)]; $f = [$gmdate];
			$hour = 12; $min = 30; $sec = 20; $mon = 4; $day = 20; $year = 2000;
			$mktime = [mktime($hour, $min, $sec, $mon, $day, $year)]; $f = [$mktime];
			$gmmktime = [gmmktime($hour, $min, $sec, $mon, $day, $year)]; $f = [$gmmktime];
			$month = 4;
			$checkdate = [checkdate($month, $day, $year)]; $f = [$checkdate];
			$fformat = "%a%A%d%e%j%u%w%U%V%W%b%B%h%m%C%g%G%y%Y%H%k%I%l%M%p%P%r%R%S%T%X%z%Z%c%D%F%s%x%n%t%%"; // All
			$strftime = [strftime($fformat, $timestamp)]; $f = [$strftime];
			$strftime2 = [strftime($fformat)]; $f = [$strftime];
			$gmstrftime = [gmstrftime($fformat, $timestamp)]; $f = [$gmstrftime];
			$gmstrftime2 = [gmstrftime($fformat)]; $f = [$gmstrftime];
			$time = [time()]; $f = [$time];
			$ucfirst = [ucfirst($str)]; $f = [$ucfirst];
			$lcfirst = [lcfirst($str)]; $f = [$lcfirst];
			$ucwords = [ucwords($str)]; $f = [$ucwords];
			$from = "Hel"; $to = "Wor";
			$strtr = [strtr($str, $from, $to)]; $f = [$strtr];
			$addslashes = [addslashes($str)]; $f = [$addslashes];
			$charlist = " ";
			$addcslashes = [addcslashes($str, $charlist)]; $f = [$addcslashes];
			$character_mask = " ";
			$rtrim = [rtrim($str, $character_mask)]; $f = [$rtrim];
			$search = "Foo";
			$replace = "F";
			$subject = "Foo Bar";
			$str_replace = [str_replace($search, $replace, $subject, $replace_count)]; $f = [$str_replace];
			$str_ireplace = [str_ireplace($search, $replace, $subject, $replace_count)]; $f = [$str_ireplace];
			$input = $str;
			$mult = 100;
			$str_repeat = [str_repeat($input, $mult)]; $f = [$str_repeat];
			$mode = 3; // Note: Only mode '3' 
			$count_chars = [count_chars($input, $mode)]; $f = [$count_chars];
			$chunklen = 20;
			$ending = "W";
			$chunk_split = [chunk_split($str, $chunklen, $ending)]; $f = [$chunk_split];
			$trim = [trim($str, $character_mask)]; $f = [$trim];
			$ltrim = [ltrim($str, $character_mask)]; $f = [$ltrim];
			$allowable_tags = "<a>";
			$strip_tags = [strip_tags($str, $allowable_tags)]; $f = [$strip_tags];
			$similar_text = [similar_text($str1, $str2, $percent)]; $f = [$similar_text];
			$separator = " ";
			$limit = 3;
			$explode = [explode($separator, $str, $limit)]; $f = [$explode];
		};

		$test("For the");
		
		$stdclass = new StdClass();
		$stdclass->foo = "Pressure test";
		$stdclass = [$z,$z];

		$a = [$test];
		$a[] = $a;
		if(($y%100000)==0) { 
			echo "Iter " . number_format($y) . ": " . mem_usage();
			echo " | /proc says: ". trim(file_get_contents('/proc/' . posix_getpid() . '/statm')) . "\n";
		}
	}
