<?php

declare(strict_types=1);

namespace App\Repository;

use Psr\Cache\CacheItemInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Throwable;

final class MixRepository
{
    public function __construct(
        private readonly CacheInterface $cache,
        private readonly HttpClientInterface $githubContentClient,
    ) {}

    public function findAll(): array
    {
        try {
            return $this->cache->get('mixes_data', function(CacheItemInterface $cacheItem) {
                $response = $this->githubContentClient->request('GET', '/SymfonyCasts/vinyl-mixes/main/mixes.json');

                return $response->toArray();
            });
        } catch (Throwable) {
            return [];
        }
    }
}