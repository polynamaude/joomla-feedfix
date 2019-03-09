<?php
/***
 * @copyright Copyright (C) 2018 Polyna-Maude R.-Summerside
 * @license No distribution allowed
 * @author Polyna-Maude Racicot-Summerside
 * @package Feed Email Fix PlugIn
 * @subpackage Main entry file
 * @version 0.1
 */

defined('_JEXEC') or die;

class PlgSystemFeedFix extends \Joomla\CMS\Plugin\CMSPlugin
{
    public function onBeforeRender()
    {
        $input = new JInput();
        
        if ($input->get('format','') == 'feed')
        {
            /**
             * Current feed document
             * @var \Joomla\CMS\Document\FeedDocument $doc
             */
            
            $doc = \Joomla\CMS\Factory::getDocument();
            
            if ($this->params->get('authorempty') == '1')
            {
                /**
                 * @var \Joomla\CMS\Document\Feed\FeedItem $item
                 */
                
                foreach ($doc->items as &$item)
                {
                    $item->authorEmail = ' ';
                }
            }
            else 
            {
                /**
                 * @var \Joomla\CMS\Document\Feed\FeedItem $item
                 */
                
                foreach ($doc->items as &$item)
                {
                    $item->authorEmail = $this->params->get('authoremail','noemail@nodomain.com');
                }
            }
            
            if ($this->params->get('editorempty') == '1')
            {
                $doc->editorEmail = ' ';
            }
            else 
            {
                $doc->editorEmail = $this->params->get('editoremail','noemail@nodomain.com');
            }
         }
         
         /**
          * exit gracefully
          */
         
         return true;
    }
}