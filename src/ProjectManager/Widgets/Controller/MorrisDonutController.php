<?php


namespace ProjectManager\Widgets\Controller;


use SIOFramework\Common\Controller\WidgetController;


class MorrisDonutController extends WidgetController
{

    /**
     * @var string
     */
    protected $elementName;

    /**
     * @var array
     */
    protected $graphData = array();


    /**
     * @var string
     */
    protected $formatter;

    /**
     * @var string
     */
    protected $colors;

    /**
     * @return array
     */
    public function getGraphData()
    {
        return $this->graphData;
    }

    /**
     * @param $key string
     * @param $value string
     */
    public function addGraphData($key, $value)
    {
        $this->graphData[$key] = $value;
    }

    /**
     * @param $name string
     */
    public function setElementName($name)
    {
        $this->elementName = $name;
    }

    /**
     * @return string
     */
    public function getElementName()
    {
        return $this->elementName;
    }

    /**
     * @return string
     */
    public function getFormatter()
    {
        return $this->formatter;
    }

    /**
     * @param string $formatter
     */
    public function setFormatter($formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @return string
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @param string $colors
     */
    public function setColors($colors)
    {
        $this->colors = $colors;
    }



    public function renderWidget()
    {
        $this->data['elementName'] = $this->elementName;
        $this->data['graphData'] = $this->graphData;
        $this->data['formatter'] = $this->formatter;
        $this->data['colors'] = $this->colors;

        $template = $this->twig->loadTemplate('widgets/morrisdonut.twig');
        return $template->render($this->data);
    }

}