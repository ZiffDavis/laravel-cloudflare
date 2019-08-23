<?php

namespace ZiffDavis\Laravel\Cloudflare\Http\Controllers\Concerns;

use App\Services\Cloudflare;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait CloudflareTaggable
{
    protected function addCloudflareTag($tag)
    {
        app(Cloudflare::class)
            ->addTag($tag);
    }

    protected function addCloudflareTagFromModel(Model $model)
    {
        if (method_exists($model, 'cloudflareTag')) {
            $this->addCloudflareTag($model->cloudflareTag());
        } else {
            $this->addCloudflareTag($model->getTable() . '_' . $model->getKey());
        }
    }

    protected function addCloudflareTagsFromCollection(Collection $collection)
    {
        $collection->each(function ($item) {
            if ($item instanceof Model) {
                $this->addCloudflareTagFromModel($item);
            }
        });
    }
}
