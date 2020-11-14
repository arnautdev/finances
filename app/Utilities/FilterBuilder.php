<?php


namespace App\Utilities;


class FilterBuilder
{
    /**
     * @var
     */
    protected $query;

    /**
     * @var
     */
    protected $filters;

    /**
     * @var
     */
    protected $namespace;

    /**
     * FilterBuilder constructor.
     * @param $query
     * @param $filters
     * @param $namespace
     */
    public function __construct($query, $filters, $namespace)
    {
        $this->query = $query;
        $this->filters = $filters;
        $this->namespace = $namespace;
    }

    /**
     * @return mixed
     */
    public function apply()
    {
        if (!empty($this->filters)) {
            foreach ($this->filters as $name => $value) {
                if ($name == 'page') {
                    continue;
                }
                $normailizedName = ucfirst($name);
                $class = $this->namespace . "\\{$normailizedName}";

                if (!class_exists($class)) {
                    throw new \Exception($class);
                }

                if (strlen($value)) {
                    (new $class($this->query))->handle($value);
                } else {
                    (new $class($this->query))->handle();
                }
            }
        }

        return $this->query;
    }
}
