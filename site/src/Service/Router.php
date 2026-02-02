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
            $view = $query['view'];

            if (in_array($view, ['game', 'company', 'platform', 'dlc'])) {
                $segments[] = $view;

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

        if (count($segments) >= 1 && in_array($segments[0], ['game', 'company', 'platform', 'dlc'])) {
            $vars['view'] = $segments[0];

            if (isset($segments[1])) {
                $vars['slug'] = $segments[1];
            }

            $segments = [];
        }

        return $vars;
    }
}
