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
		if (!file_exists($file)) {
			throw new Exception("Error Processing Request - File does not exists", 1);
			
		}
		$this->xml  = simplexml_load_file($file);
	}

	public function write()
	{
		if (! is_writeable($this->file)) {
			throw new Exception("file '{$this->file}' is not writeable");
		}
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

// Execute the code
try {
	$conf = new Conf(__DIR__ . "/xml/test.xml");
	print "user: " . $conf->get('user') . "\n";
	print "host: " . $conf->get('host') . "\n";
	$conf->set("pass", "newpass");
	$conf->write();
} catch (\Exception $e) {
	die($e->__toString());
}