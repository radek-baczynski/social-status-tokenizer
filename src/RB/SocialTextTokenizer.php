<?php

namespace RB;

class SocialTextTokenizer
{
	protected $regexpArray = [
		self::REGEXP_PHONE_NUMBER,
		self::REGEXP_EMOTICON,
		self::REGEXP_HASHTAG,
		self::REGEXP_WEB_ADDRESS,
		self::REGEXP_SCHEMA,
		self::REGEXP_ALONE,
		self::REGEXP_HTTP_GET,
		self::REGEXP_HTML_TAG,
		self::REGEXP_TWITTER_USERNAME,
		self::REGEXP_WORDS
	];

	protected $compiledRegexp;

	function __construct()
	{
//		array_walk($this->regexpArray, function (&$pattern)
//		{
//			$pattern = preg_replace('#\S\n\s#u', '', $pattern);
//		});

		$this->compiledRegexp = sprintf("#(%s)#xui", implode('|', $this->regexpArray));
	}

	public function tokenize($string)
	{
		if(preg_match_all($this->compiledRegexp, $string, $matches))
			return $matches[0];
	}


	const REGEXP_EMOTICON = <<<REGEXP
([\>0-9A-Za-z'\&\-\.\/\(\)=:;]+)|((?::|;|=)(?:-)?(?:\)|D|P))
REGEXP;

	const REGEXP_PHONE_NUMBER = <<<REGEXP
(?:
      (?:
        \+?[01]
        [\-\s.]*
      )?
      (?:
        [\(]?
        \d{3}
        [\-\s.\)]*
      )?
      \d{3}
      [\-\s.]*
      \d{4}
    )
REGEXP;

	const REGEXP_WEB_ADDRESS = <<<REGEXP
(?:(?:http[s]?\:\/\/)?(?:[\p{L}\_\-]+\.)+(?:com|net|gov|edu|info|org|ly|be|gl|co|gs|pr|me|cc|us|gd|nl|ws|am|im|fm|kr|to|jp|sg))
REGEXP;

	const REGEXP_SCHEMA = <<<REGEXP
(?:http[s]?\:\/\/)
REGEXP;

	const REGEXP_ALONE = <<<REGEXP
(?:\[[a-z_]+\])
REGEXP;

	const REGEXP_HTTP_GET = <<<REGEXP
(?:\/\p{L}+\?(?:\;?\p{L}+\=\p{L}+)+)
REGEXP;

	const REGEXP_HTML_TAG = <<<REGEXP
<[^>]+>
REGEXP;

	const REGEXP_TWITTER_USERNAME = <<<REGEXP
(?:@[\w_]+)
REGEXP;

	const REGEXP_HASHTAG = <<<REGEXP
(?:\#+[\p{L}_]+[\p{L}\'_\-]*[\p{L}_]+)
REGEXP;

	const REGEXP_WORDS = <<<REGEXP
(?:[a-z][a-z'\-_]+[a-z])
    |
    (?:[+\-]?\d+[,/.:-]\d+[+\-]?)
    |
    (?:[\p{L}_]+)
    |
    (?:\.(?:\s*\.){1,})
    |
    (?:\S)
REGEXP;
}