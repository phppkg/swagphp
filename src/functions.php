<?php

namespace SwagPhp;

/**
 * Special value to differentiate between null and undefined.
 */
\define('SwagPhp\UNDEFINED', '{SWAG-PHP-UNDEFINED-46EC-07AB32D2-D50C}');
\define('SwagPhp\Schema\UNDEFINED', UNDEFINED);
\define('SwagPhp\Processors\UNDEFINED', UNDEFINED);
\define('SwagPhp\T_NEW_LINE', -1);

/**
 * @param $scanDirs
 * @param array $options
 * @return SwagPhp
 */
function scan($scanDirs, array $options = []): SwagPhp
{
    return SwagPhp::scan($scanDirs, $options);
}
