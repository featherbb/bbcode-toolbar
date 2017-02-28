<?php

/**
 * Copyright (C) 2015-2017 FeatherBB
 * based on code by (C) 2008-2012 FluxBB
 * and Rickard Andersson (C) 2002-2008 PunBB
 * License: http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
 */

namespace FeatherBB\Plugins;

use FeatherBB\Core\Interfaces\Hooks;
use FeatherBB\Core\Interfaces\Lang;
use FeatherBB\Core\Plugin as BasePlugin;

class BbcodeToolbar extends BasePlugin
{

    public function run()
    {
        // Add language files into javascript footer block
        Hooks::bind('view.alter_data', [$this, 'addLanguage']);
        // Support default actions
        Hooks::bind('controller.post.create', [$this, 'addToolbar']);
        Hooks::bind('controller.post.edit', [$this, 'addToolbar']);
        Hooks::bind('controller.topic.display', [$this, 'addToolbar']);
        // Support PMs plugin
        Hooks::bind('conversationsPlugin.send.preview', [$this, 'addToolbar']);
        Hooks::bind('conversationsPlugin.send.display', [$this, 'addToolbar']);
    }

    public function addLanguage($data)
    {
        Lang::load('bbeditor', 'bbcode-toolbar', __DIR__.'/lang');
        $lang_bbeditor = array(
            'btnBold' => d__('bbcode-toolbar' ,'btnBold'),
            'btnItalic' => d__('bbcode-toolbar' ,'btnItalic'),
            'btnUnderline' => d__('bbcode-toolbar' ,'btnUnderline'),
            'btnColor' => d__('bbcode-toolbar' ,'btnColor'),
            'btnLeft' => d__('bbcode-toolbar' ,'btnLeft'),
            'btnRight' => d__('bbcode-toolbar' ,'btnRight'),
            'btnJustify' => d__('bbcode-toolbar' ,'btnJustify'),
            'btnCenter' => d__('bbcode-toolbar' ,'btnCenter'),
            'btnLink' => d__('bbcode-toolbar' ,'btnLink'),
            'btnPicture' => d__('bbcode-toolbar' ,'btnPicture'),
            'btnList' => d__('bbcode-toolbar' ,'btnList'),
            'btnQuote' => d__('bbcode-toolbar' ,'btnQuote'),
            'btnCode' => d__('bbcode-toolbar' ,'btnCode'),
            'promptImage' => d__('bbcode-toolbar', 'promptImage'),
            'promptUrl' => d__('bbcode-toolbar', 'promptUrl'),
            'promptQuote' => d__('bbcode-toolbar', 'promptQuote')
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
