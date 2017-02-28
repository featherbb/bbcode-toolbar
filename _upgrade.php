<?php

/**
 * Copyright (C) 2015-2017 FeatherBB
 * based on code by (C) 2008-2012 FluxBB
 * and Rickard Andersson (C) 2002-2008 PunBB
 * License: http://www.gnu.org/licenses/gpl.html GPL version 2 or higher
 */

namespace FeatherBB\Plugins;

use FeatherBB\Core\AdminUtils;

// Make sure no one attempts to run this script "directly"
if (isset($upgrade_script)) {
    // Check if 'style' folder from version <= 0.2.2 exists
    if (is_dir(__DIR__.'/style')) {
        AdminUtils::deleteFolder(__DIR__.'/style');
    }
}
