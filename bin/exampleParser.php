<?php

require __DIR__.'/../vendor/autoload.php';

use TierJig\CodeExample;

class ExampleFinder {

    private $files;
    private $examples = [];
    
    /** @var CodeExample */
    private $currentExample = null;

    function __construct($srcDirectory) {
        $directory = new RecursiveDirectoryIterator($srcDirectory);
        $iterator = new RecursiveIteratorIterator($directory);
        $this->files = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::MATCH);
    }

    /**
     * @param $category
     * @param $function
     * @param $description
     * @param $file
     * @param $startLine
     */
    function startExample($category, $function, $description, $file, $startLine)
    {
        $this->currentExample = new CodeExample(
            $category,
            $function,
            '',
            $description,
            $startLine
        );
    }


    /**
     * 
     */
    function   endExample($lineCount) {
        if ($this->currentExample !== null) {
            $this->currentExample->setEndLine($lineCount);
            $category = strtolower($this->currentExample->getCategory());
            $function = strtolower($this->currentExample->getFunctionName());
            $this->examples[$category][$function][] = serialize($this->currentExample); 
        }

        $this->currentExample = null;
    }

    /**
     * @return array
     * @throws Exception
     */
    function getExamples() {
        $category = null;
        $function = null;

        foreach ($this->files as $file) {
            /** @var $file SplFileInfo */
            $filename = $file->getPath()."/".$file->getFilename();

            // open the file 
            $fileLines = file($filename);

            if (!$fileLines) {
                throw new \Exception("Failed to open $filename");
            }

            $pattern = '#\w*//Example (Jig|Tier)::(\w+)\s?(.*)?#';

            $endPattern = '#\w*//Example end.*#';

            $lineCount = 0;
            foreach ($fileLines as $fileLine) {
                $lineCount++;

                $matchCount = preg_match($pattern, $fileLine, $matches);

                if ($matchCount == true) {
                    if ($this->currentExample) {
                        throw new \Exception(
                            "Example ".$this->currentExample->getFunctionName()." in file ".
                            $filename." line ".$lineCount." is still open."
                        );
                    }
                    $this->endExample($lineCount); //End any previous example
                    $pathedFilename = $matches[1].'/'.$file->getBasename();                    
                    $this->startExample($matches[1], $matches[2], $matches[3], $pathedFilename, $lineCount);
                }
                else if ($this->currentExample !== null) {

                    $matchCount = preg_match($endPattern, $fileLine, $matches);
                    
                    //if(substr_compare($fileLine, "//Example end", 0, strlen("//Example end")) === 0) {
                    if ($matchCount) {
                        $this->endExample($lineCount);
                        continue;
                    }
                    $this->currentExample->appendLine($fileLine);
                    //TODO - need to only end on new example
//                    if (substr_compare($fileLine, "}", 0, 1) === 0 ) {
//                        $this->endExample($lineCount);
//                    }
                }
            }

            //finished file - example has ended
            $this->endExample($lineCount);
        }

        return $this->examples;
    }
}





//
//function normalizeString($string) {
//
//    if (is_array($string)) {
//        return normalizeArray($string);
//    }
//
//    $string = preg_replace(
//        '#available.0x(\d)(\d)(\d);#iu',
//        "Available since $1.$2.$3",
//        $string
//    );
//
//
//    $replacements = [
//        //'0x657;' => ''
//    ];
//
//    return str_replace(array_keys($replacements), array_values($replacements), $string);
//}
//
//
//function normalizeArray($strings) {
//    return array_map('normalizeString', $strings);
//}



$exampleFinder = new ExampleFinder('../src');
$examples = $exampleFinder->getExamples();

$exampleEntries = var_export($examples, true);

var_dump($exampleEntries);
//$manualEntries = var_export($manualEntries, true);

//$output = <<< END
//<?php
//
//namespace ImagickDemo;
//
//class DocHelper {
//    protected \$exampleEntries = $exampleEntries;
//    protected \$manualEntries = $manualEntries;
//    protected \$category;
//    protected \$example;
//    protected \$categoryCase;
//    protected \$exampleCase;
//
//
//    function __construct(\ImagickDemo\Helper\PageInfo \$pageInfo)
//    {
//        \$category = \$pageInfo->getCategory();
//        \$example = \$pageInfo->getExample();
//    
//        \$this->category = strtolower(\$category);
//        \$this->example = strtolower(\$example);
//    }
//}
//END;
//
//
//$path = "../src/ImagickDemo/DocHelper.php";
//
//$result = file_put_contents($path, $output);
//
//if ($result === false) {
//    throw new \Exception("Failed to write file.");
//}
