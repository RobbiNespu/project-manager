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


    public function renderWidget()
    {
        $this->data['elementName'] = $this->elementName;
        $this->data['graphData'] = $this->graphData;

        $template = $this->twig->loadTemplate('widgets/morrisdonut.twig');
        return $template->render($this->data);
    }

}