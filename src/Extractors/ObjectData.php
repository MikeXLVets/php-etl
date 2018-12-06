<?php

namespace Marquine\Etl\Extractors;

class ObjectData implements ExtractorInterface
{
    /**
     * Extractor columns.
     *
     * @var object
     */
    public $columns;

    /**
     * Extract data from the given source.
     *
     * @param object $source
     * @return array
     */
    public function extract($source)
    {
        if ($this->columns) {
            $this->columns = array_flip($this->columns);
            var_dump($this->columns);
            $array = [];

            foreach ($this->columns as $key=>$data) {
                $array[$key] = $data;
            }
        }

        return $array;
    }
}
