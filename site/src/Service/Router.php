<?php

namespace DGInxreal\Component\Games\Site\Service;

defined('_JEXEC') or die;

use Joomla\CMS\Component\Router\RouterBase;

class Router extends RouterBase
{
    public function build(&$query): array
    {
        $segments = [];

        if (isset($query['view'])) {
            if ($query['view'] === 'game') {
                $segments[] = 'game';

                if (isset($query['slug'])) {
                    $segments[] = $query['slug'];
                    unset($query['slug']);
                }
            }

            unset($query['view']);
        }

        return $segments;
    }

    public function parse(&$segments): array
    {
        $vars = [];

        if (count($segments) >= 1 && $segments[0] === 'game') {
            $vars['view'] = 'game';

            if (isset($segments[1])) {
                $vars['slug'] = $segments[1];
            }

            $segments = [];
        }

        return $vars;
    }
}
