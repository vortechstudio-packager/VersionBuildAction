<?php

namespace Vortechstudio\VersionBuildAction;

class VersionBuildAction
{
    private mixed $api_key;
    public mixed $owner;
    public mixed $repository;

    public function __construct()
    {
        $this->api_key = config('versionbuildaction.gh_token');
        $this->owner = config('versionbuildaction.gh_owner');
        $this->repository = config('versionbuildaction.gh_repository');
    }

    public function getVersionInfo()
    {
        if(in_array(config('app.env'), ['local', 'testing', 'staging'])) {
            return $this->getLastTag().'-'.$this->getLastCommitHash();
        } else {
            return $this->getLastTag();
        }
    }

    public function getLabelEnv(): ?string
    {
        return match (config('app.env')) {
            'local' => "<span class='badge badge-secondary'>Local</span>",
            'testing' || 'staging' => "<span class='badge badge-warning'>Testing</span>",
            default => null
        };
    }

    private  function getLastTag()
    {
        $response = \Http::withToken($this->api_key)
            ->get('https://api.github.com/repos/'.$this->owner.'/'.$this->repository.'/releases/latest');

        if($response) {
            return $response['tag_name'];
        } else {
            return "0.0.0";
        }
    }

    private function getLastCommitHash()
    {
        $response = \Http::withToken($this->api_key)
            ->get('https://api.github.com/repos/'.$this->owner.'/'.$this->repository.'/commits/master');

        if($response) {
            return substr($response['sha'], 0, 7);
        } else {
            return "null";
        }
    }
}
