<?php

namespace App;

use Spatie\MediaLibrary\Conversions\Conversion;
use Spatie\MediaLibrary\Support\FileNamer\FileNamer;

class MediaLibraryFileNamer extends FileNamer
{
    public function conversionFileName(string $fileName, Conversion $conversion) : string
    {
        $strippedFileName = sha1(pathinfo($fileName, PATHINFO_FILENAME));

        return "{$strippedFileName}-{$conversion->getName()}";
    }

    public function responsiveFileName(string $fileName) : string
    {
        return sha1(pathinfo($fileName, PATHINFO_FILENAME));
    }
}
