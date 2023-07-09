<?php

function getParametersForRoute(string $route): array
{
    $path = $_SERVER["REQUEST_URI"];
    $pathSeparatorPattern = "#/#";

    $routeParts = preg_split($pathSeparatorPattern, trim($route, "/"));
    $pathParts = preg_split($pathSeparatorPattern, trim($path, "/"));

    $parameters = [];

    foreach ($routeParts as $routePartIndex => $routePart) {
        $pathPart = isset($pathParts[$routePartIndex]) ? $pathParts[$routePartIndex] : null;

        if (str_starts_with($routePart, ":")) {
            $parameterName = substr($routePart, 1);
            $parameters[$parameterName] = $pathPart;
        }
    }

    return $parameters;
}
