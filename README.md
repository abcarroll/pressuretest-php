# PressureTest for PHP #

So here you have, the "Pressure Test".  It's meant to see if it's leaky.  If you've ever replaced 
a spigot or plumbing, you're well aware of the pressure test afterwards.

It is an attempt to call __every__ PHP function that is thought to not leak memory, to see if it 
does or not not actually leak memory.  It doesn't call __every__ function, please help improve that.

This code will leak horrifically on pre-PHP 5.3 installs.  Just don't even download it.  It will
leak and be killed by the kernel, if you're lucky.

It has no `sleep()` or `usleep()` so it will likely consume 100% CPU until you kill it.

## To Do ##
* Call a lot more functions, and call a lot more functions in a lot of different ways.

## Known Leaks ##
* `create_function()` seems to leak a massive amount of memory.

## Other deamon / -CLI issues ##
* There is no way to gracefully free memory held by an object except removing all references for it or wait for the GC to pick it up.  You cannot force removal of an object by just calling the destructor, or doing `unset($this)`.  I find this annoying.
* The ncurses library is horrifically underdocumented and unnecessarily overcomplicated.  Please see my unfinished __uncurses__ project here on github.

You are welcome to expand and report results of your `run.php`.
You are also welcome to add more function calls to `run.php`.  Currently, `run.php` doesn't call all functions, or even close.  It does call a lot of core functions and commonly used functions, but each function is being manually called.  I decided against attempting to automatically call all function using `get_defined_functions()` and reflections.  Instead, I wrote a code generator `reflection.php`, which I used to generate `mirror.php`.  `mirror.php` contains all functions that __aren't__ being called but were present on my Ubuntu installtion.

This code is messy, it is just a test suite.  Feel free to clean up anything if you feel like it.
