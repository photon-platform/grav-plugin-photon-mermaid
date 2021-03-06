<?php
namespace Grav\Plugin;

use \Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

class PhotonMermaidPlugin extends Plugin
{
    protected $theme;

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPageContentRaw' => ['onPageContentRaw', 0],
            'onTwigSiteVariables'   => ['onTwigSiteVariables', 0]
        ];
    }

    public function onPageContentRaw(Event $event)
    {
        // Variables
        $this->align = $this->config->get('plugins.photon-mermaid.align');

        $page = $event['page'];
        $twig = $this->grav['twig'];
        $config = $this->mergeConfig($page);

        if ($config->get('enabled')) {

            // Get initial content
            $raw = $page->getRawContent();


            /*****************************
             * MERMAID PART
             */

            $match_mermaid = function ($matches) use (&$page, &$twig, &$config) {
                // Get the matching content
                $search_mermaid = $matches[0];

                // Remove the tab selector
                $search_mermaid = str_replace("[mermaid]", "", $search_mermaid);
                $search_mermaid = str_replace("[/mermaid]", "", $search_mermaid);

                // Creating the replacement structure
                $replace_header = "<div class=\"mermaid\" style=\"text-align:".$this->align."\">";
                $replace_footer = "</div>";
                $replace_content = $search_mermaid;
                $replace = "$replace_header" . "$replace_content" . "$replace_footer";

                return $replace;
            };

            $raw = $this->parseInjectMermaid($raw, $match_mermaid);

            /*****************************
             * REFERENCES PART
             */

            $match_references = function ($matches) use (&$page, &$twig, &$config) {
                // Get the matching content
                $search_references = $matches[0];

                // Remove the tab selector
                $search_references = str_replace("[references]", "", $search_references);
                $search_references = str_replace("[/references]", "", $search_references);

                // Creating the replacement structure
                $replace_header = "## References\n<div class=\"mermaid\" style=\"text-align:".$this->align."\">";
                $replace_footer = "</div>";
                $replace_content = $search_references;
                $replace = "$replace_header" . "$replace_content" . "$replace_footer";

                return $replace;
            };

            $raw = $this->parseInjectReferences($raw, $match_references);

            /*****************************
             * APPLY CHANGES
             */
            $page->setRawContent($raw);
        }
    }


    /**
     *  Applies a specific function to the result of the flow's regexp
     */
    protected function parseInjectMermaid($content, $function)
    {
        // Regular Expression for selection
        $regex = '/\[mermaid\]([\s\S]*?)\[\/mermaid\]/';
        return preg_replace_callback($regex, $function, $content);
    }

    /**
     *  Applies a specific function to the result of the flow's regexp
     */
    protected function parseInjectReferences($content, $function)
    {
        // Regular Expression for selection
        $regex = '/\[references\]([\s\S]*?)\[\/references\]/';
        return preg_replace_callback($regex, $function, $content);
    }

    /**
     * Set needed ressources to display and convert charts
     */
    public function onTwigSiteVariables()
    {
        $page = $this->grav['page'];
        $assets = $this->grav['assets'];

        // only load the vars if this datatype page
        $header = $page->header();
        $mermaid = isset($header->mermaid) ? $header->mermaid : false;

        if ( $mermaid )
        {
          $this->theme = $this->config->get('plugins.photon-mermaid.theme');
          $this->font_size = $this->config->get('plugins.photon-mermaid.font.size');
          $this->font_color = $this->config->get('plugins.photon-mermaid.font.color');
          $this->line_color = $this->config->get('plugins.photon-mermaid.line.color');
          $this->element_color = $this->config->get('plugins.photon-mermaid.line.color');
          $this->condition_yes = $this->config->get('plugins.photon-mermaid.condition.yes');
          $this->condition_no = $this->config->get('plugins.photon-mermaid.condition.no');
          $this->gantt_axis = $this->config->get('plugins.photon-mermaid.gantt.axis');

          // Resources for the conversion
          $assets->addJs('plugin://photon-mermaid/js/mermaid.min.js');
          $assets->addCss('plugin://photon-mermaid/css/mermaid.css');

          // Used to start the conversion of the div "diagram" when the page is loaded
          $init = "
        // mermaid init
        $(document).ready(function() {
          var config = {
            startOnLoad:true,
            flowchart:{
              useMaxWidth:true,
              htmlLabels:false,
            },
            theme:null,
          }
          mermaid.initialize(config);
          mermaid.ganttConfig = {
            axisFormatter: [[\"".$this->gantt_axis."\", function (d){return d.getDay() == 1;}]]
          };
        });";
          $assets->addInlineJs($init);
        }

    }
}
