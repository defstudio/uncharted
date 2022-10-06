<?php

namespace DefStudio\Uncharted\Middlewares;

use Closure;
use Symfony\Component\HttpFoundation\Request;

class InjectChartJsCdn
{
    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next): mixed
    {
        $response = $next($request);

        $cdn = config('uncharted.cdn');
        if ($cdn === null) {
            return $response;
        }

        if($response->isRedirection())
            return $response;

        if($request->isXmlHttpRequest())
            return $response;

        if($request->headers->get('X-Livewire')){
            return $response;
        }

        $content = $response->getContent();
        if(str($content)->contains("</head>")){
            $content = str($content)->replaceFirst("</head>", "<script src='$cdn'></script></head>")->toString();
            $response->setContent($content);
            $response->headers->remove('Content-Length');
        }

        return $response;
    }
}
