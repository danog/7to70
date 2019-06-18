<?php

namespace danog\Php7to70;

use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use danog\Php7to70\Exceptions\InvalidParameter;
use danog\Php7to70\NodeVisitors\YieldReturnDetector;

class Converter
{
    /** @var string */
    protected $pathToPhp7Code;

    /**
     * @param string $pathToPhp7Code
     *
     * @throws \danog\Php7to70\Exceptions\InvalidParameter
     */
    public function __construct($pathToPhp7Code)
    {
        if (!file_exists($pathToPhp7Code)) {
            throw InvalidParameter::fileDoesNotExist($pathToPhp7Code);
        }

        $this->pathToPhp7Code = $pathToPhp7Code;
    }

    /**
     * @param string $destination
     */
    public function saveAsPhp5($destination)
    {
        file_put_contents($destination, $this->getPhp5Code());
    }

    /**
     * @return string
     */
    public function getPhp5Code()
    {
        ini_set('xdebug.max_nesting_level', 9000);

        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);

        $php7code = file_get_contents($this->pathToPhp7Code);

        $php7Statements = $parser->parse($php7code);

        $traverser = $this->getTraverser();

        $php5Statements = $traverser->traverse($php7Statements);

        //$php5Statements = $traverser->traverse($php5Statements);

        return (new \PhpParser\PrettyPrinter\Standard())->prettyPrintFile($php5Statements);
    }


    /**
     * @return \PhpParser\NodeTraverser
     */
    public static function getTraverser()
    {
        $traverser = new NodeTraverser();

        foreach (glob(__DIR__.'/NodeVisitors/*.php') as $nodeVisitorFile) {
            $className = pathinfo($nodeVisitorFile, PATHINFO_FILENAME);

            $fullClassName = '\\danog\\Php7to70\\NodeVisitors\\'.$className;

            $traverser->addVisitor(new $fullClassName());
        }

        return $traverser;
    }
}
