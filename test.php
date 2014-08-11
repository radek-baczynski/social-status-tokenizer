<?php

require_once __DIR__ . '/vendor/autoload.php';

$tokenizer = new \RB\SocialTextTokenizer();

$text = [
	"RT @ #happyfuncoding: this is a typical Twitter tweet :-)",
	"HTML entities &amp; other Web oddities can be an &aacute;cute <em class='grumpy'>pain</em> >:(",
	"It's perhaps noteworthy that phone numbers like +1 (800) 123-4567, (800) 123-4567, and 123-4567 are treated as words despite their whitespace.",
	"This is more like a Facebook message with a url: http://www.youtube.com/watch?v=dQw4w9WgXcQ, youtube.com google.com https://google.com",
	"Już w trakcie kampanii wrześniowej granicę polsko – węgierską zaczęli przekraczać uciekający przed niemiecką armią cywile, a także żołnierze i oficerowie przedwojennej armii II RP."
];

$tokens = $tokenizer->tokenize($text[$argv[1]-1]);

var_dump($tokens);