<?php
// Here is a simple Conf class that stores, retrieves, and sets data in an XML configuration file

class Conf
{
	private $file;
	private $xml;
	private $lastmatch;

	public function __construct(string $file)
	{
		$this->file = $file;
		$this->xml  = simplexml_load_file($file);
	}

	public function write()
	{
		file_put_contents($this->file, $this->xml->asXML());
	}

	public function get(string $str)
	{
		$matches = $this->xml->xpath("/conf/item[@name=\"$str\"]");
		if (count($matches)) {
			$this->lastmatch = $matches[0];
			return (string)$matches[0];
		}
		return null;
	}

	public function set(string $key, string $value)
	{
		if (! is_null($this->get($key))) {
			$this->lastmatch[0]=$value;
			return;
		}

		$conf = $this->xml->conf;
		$this->xml->addChild('item', $value)->addAttribute('name', $key);
	}
}

