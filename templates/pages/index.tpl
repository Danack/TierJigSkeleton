<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
	<title>Teh intahwebz</title>

	<style>

	@-webkit-keyframes blink {
		from { opacity: 1.0; }
		to { opacity: 0.0; }
		0% { opacity: 1.0; }
		50% { opacity: 0.0; }
		100% { opacity: 1.0; }
	}
	@keyframes blink {
		from { opacity: 1.0; }
		to { opacity: 0.0; }
		0% { opacity: 1.0; }
		50% { opacity: 0.0; }
		100% { opacity: 1.0; }
	}

	.blink {
		-webkit-animation-name: blink;
		-webkit-animation-iteration-count: infinite;
		-webkit-animation-timing-function: steps(1);
		-webkit-animation-duration: 1s;
		animation-name: blink;
		animation-iteration-count: infinite;
		animation-timing-function: steps(1);
		animation-duration: 1s;
	}

	</style>

</head>
<body>

<p style='font-size: 48px'>
You are surifng teh <span class='blink'>intahwebz</span>!1!
</p>

<p>
	This is actually just a placeholder domain so that I can safely use Intahwebz as the top level name space in my code, without having to worry about any clashes.</p>

<p>
	You can find most of my code on <a href="https://github.com/Danack">Github</a> <!--or at my <a href="http://basereality.com">real domain</a>.

	Though there's also a little <a href='/DynamicInheritance/index.php'>dynamic inheritance example here
    </a> -->

</p>

<p>
    {inject name='links' type='Intahwebz\Model\InterestingLinks'}
    
    Here are some maybe interesting links:<br/>
    {$links->render() | nofilter}
</p>


DIE BLINKEN LICHT SCHON FUNKTIONIEREN WIRD
</body>
</html>