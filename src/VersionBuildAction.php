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

    private  function getLastTag()
    {
        $response = \Http::withToken($this->api_key)
            ->get('https://api.github.com/repos/'.$this->owner.'/'.$this->repository.'/releases/latest');

        return $response['tag_name'];
    }

    private function getLastCommitHash()
    {
        $response = \Http::withToken($this->api_key)
            ->get('https://api.github.com/repos/'.$this->owner.'/'.$this->repository.'/commits/master');

        return substr($response['sha'], 0, 7);
    }
}
