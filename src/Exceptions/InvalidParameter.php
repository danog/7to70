<?php

namespace danog\Php7to70\Exceptions;

use Exception;

class InvalidParameter extends Exception
{
    public static function sourceDoesNotExist($sourceName)
    {
        return new static("Source file or directory `{$sourceName}` does not exist");
    }

    /**
     * @param string $directoryName
     *
     * @return \danog\Php7to70\Exceptions\InvalidParameter
     */
    public static function directoryDoesNotExist($directoryName)
    {
        return new static("Directory `{$directoryName}` does not exist");
    }

    /**
     * @param string $fileName
     *
     * @return \danog\Php7to70\Exceptions\InvalidParameter
     */
    public static function fileDoesNotExist($fileName)
    {
        return new static("File `{$fileName}` does not exist");
    }

    /**
     * @return \danog\Php7to70\Exceptions\InvalidParameter
     */
    public static function directoryIsRequired()
    {
        return new static('A directory must be specified');
    }

    public static function wrongDestinationDirectory()
    {
        return new static("A destination directory can't be inside of a source directory!");
    }

    public static function destinationDirectoryIsSource()
    {
        return new static('A destination directory is a source directory. If you want to overwrite it, you must specify that as an option.');
    }

    public static function destinationExist()
    {
        return new static('A destination directory or file with a given name already exists. If you want to overwrite it, you must specify that as an option.');
    }
}
