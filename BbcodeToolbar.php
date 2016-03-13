<?php

/**
 * Copyright (C) 2015-2016 FeatherBB
 * based on code by (C) 2008-2012 FluxBB
 * and Rickard Andersson (C) 2002-2008 PunBB
 * License: http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
 */

namespace FeatherBB\Plugins;

use FeatherBB\Core\Plugin as BasePlugin;

class BbcodeToolbar extends BasePlugin
{

    public function run()
    {
        // Add language files into javascript footer block
        Container::get('hooks')->bind('view.alter_data', [$this, 'addLanguage']);
        // Support default actions
        Container::get('hooks')->bind('controller.post.create', [$this, 'addToolbar']);
        Container::get('hooks')->bind('controller.post.edit', [$this, 'addToolbar']);
        Container::get('hooks')->bind('controller.topic.display', [$this, 'addToolbar']);
        // Support PMs plugin
        Container::get('hooks')->bind('conversationsPlugin.send.preview', [$this, 'addToolbar']);
        Container::get('hooks')->bind('conversationsPlugin.send.display', [$this, 'addToolbar']);
    }

    public function addLanguage($data)
    {
        translate('bbeditor', 'featherbb', false, __DIR__.'/lang');
        $lang_bbeditor = array(
            'btnBold' => __('btnBold'),
            'btnItalic' => __('btnItalic'),
            'btnUnderline' => __('btnUnderline'),
            'btnColor' => __('btnColor'),
            'btnLeft' => __('btnLeft'),
            'btnRight' => __('btnRight'),
            'btnJustify' => __('btnJustify'),
            'btnCenter' => __('btnCenter'),
            'btnLink' => __('btnLink'),
            'btnPicture' => __('btnPicture'),
            'btnList' => __('btnList'),
            'btnQuote' => __('btnQuote'),
            'btnCode' => __('btnCode'),
            'promptImage' => __('promptImage'),
            'promptUrl' => __('promptUrl'),
            'promptQuote' => __('promptQuote')
        );
        $data['jsVars']['bbcodeToolbar'] = json_encode($lang_bbeditor);
        return $data;
    }

    public function addToolbar()
    {
        View::addAsset('css', 'plugins/bbcode-toolbar/assets/bbeditor.css', array('type' => 'text/css', 'rel' => 'stylesheet'));
        View::addAsset('css', 'plugins/bbcode-toolbar/assets/colorPicker.css', array('type' => 'text/css', 'rel' => 'stylesheet'));
        View::addAsset('js', 'plugins/bbcode-toolbar/assets/bbeditor.js', array('type' => 'text/javascript'));
        View::addAsset('js', 'plugins/bbcode-toolbar/assets/colorPicker.js', array('type' => 'text/javascript'));
        return true;
    }

}
