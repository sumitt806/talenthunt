<?php

namespace Imanghafoori\LaravelMicroscope;

use Illuminate\Support\Facades\View;
use Imanghafoori\LaravelMicroscope\SpyClasses\ViewsData;
use Symfony\Component\Finder\Finder;

class BladeFiles
{
    public static $checkedFilesNum = 0;

    public static function check($methods)
    {
        $hints = self::getNamespacedPaths();
        $hints['1'] = View::getFinder()->getPaths();
        foreach ($hints as $paths) {
            self::checkPaths($paths, $methods);
        }
    }

    private static function getNamespacedPaths()
    {
        $hints = View::getFinder()->getHints();
        unset($hints['notifications'], $hints['pagination']);

        return $hints;
    }

    public static function checkPaths($paths, $methods)
    {
        foreach ($paths as $path) {
            $files = (new Finder())->name('*.blade.php')->files()->in($path);

            foreach ($files as $blade) {
                self::$checkedFilesNum++;
                /**
                 * @var \Symfony\Component\Finder\SplFileInfo $blade
                 */
                $tokens = ViewsData::getBladeTokens($blade->getPathname());
                foreach ($methods as $method) {
                    call_user_func_array([$method, 'check'], [$tokens, $blade->getPathname()]);
                }
            }
        }
    }
}
