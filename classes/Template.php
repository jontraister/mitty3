<?php

/**
 * Minimal PHP Template.
 */
class Template
{

    public $file;
    public $vars;
    public $request;

    /**
     * Construct with path and parameters
     *
     * @param string $file full path to the file
     * @param array $vars parameters to be passed to the template
     */
    public function __construct($file, $vars = array(), $request=null)
    {
        $this->file = $file;
        $this->vars = $vars;
        $this->request = $request;
    }

    /**
     * Output the rendered template.
     *
     * Executes in a clean scope with only the template parameters extracted into the scope.
     *
     * @param string $file file to render, if omitted or null uses <code>$this-&gt;file</code>
     * @param array $vars template variables, if omitted or null uses <code>$this-&gt;vars</code>
     */
    public function render($file = null, $vars = null)
    {
        extract($this->asArray($vars), EXTR_OVERWRITE);
        require(($file === null) ? $this->file : $file);
    }

    protected function asArray($vars)
    {
        if ($vars === null)
            $vars = $this->vars;

        if (is_array($vars))
            return $vars;

        $result = array();

        foreach ($vars as $key => $value)
            $result[$key] = $value;

        return $result;
    }

}