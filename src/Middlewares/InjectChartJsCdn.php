<?php

namespace DefStudio\Uncharted\Middlewares;

use Closure;
use Symfony\Component\HttpFoundation\Request;

class InjectChartJsCdn
{
    /**
     * @param  Request  $request
     */
    public function handle($request, Closure $next): mixed
    {
        $response = $next($request);

        if ($response->isRedirection()) {
            return $response;
        }

        if ($request->isXmlHttpRequest()) {
            return $response;
        }

        if ($request->headers->get('X-Livewire')) {
            return $response;
        }

        $content = $response->getContent();
        if (str($content)->contains('</head>')) {
            $scripts = collect(config('uncharted.cdn'))
                ->filter()
                ->map(fn (string $cdnAddress) => "<script src='$cdnAddress'></script>")
                ->join('');

            if (! empty($scripts)) {
                $content = str($content)->replaceFirst('</head>', "$scripts</head>")->toString();
                $response->setContent($content);
                $response->headers->remove('Content-Length');
            }
        }

        return $response;
    }
}
