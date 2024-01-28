<?php

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('should return the correct component', function () {
    get(route('posts.index'))
        ->assertInertia(function (AssertableInertia $inertia) {
            return $inertia->component('Posts/Index', true);
        });
});

it('passes posts to the view', function () {
    AssertableInertia::macro('hasResource', function (string $key, JsonResource $resource) {
        $props = $this->toArray()['props'];

        $compiledResource = $resource->response()->getData(true);

        expect($props)
            ->toHaveKey($key, message: "Key \"{$key}\" not passed as a property to Inertia.")
            ->and($props[$key])
            ->toEqual($compiledResource);
    });

    $posts = Post::factory(3)->create();

    get(route('posts.index'))
        ->assertInertia(fn(AssertableInertia $inertia) => $inertia
            ->hasResource('post', PostResource::make($posts->first()))
        );
});
