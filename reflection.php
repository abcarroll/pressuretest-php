<?php
	$functions = get_defined_functions();

	foreach($functions['internal'] as $f) {
		$r = new ReflectionFunction($f);
		$p = $r->getParameters();

		echo "\t\t\t\$$f = [$f(";
		$z = '';
		foreach($p as $i) {
			$pName = $i->getName();
			if($pName == '...' || empty($pName)) continue;
			$z .= '$'.$i->getName();
			if($i->isDefaultValueAvailable()) {
				$z .= ' = ' . $i->getDefaultValue();
			}

			$z .= ', ';
		}
		$z = substr($z, 0, -2);
		echo $z . ")]; \$$f = [\$$f];\n";

	}
