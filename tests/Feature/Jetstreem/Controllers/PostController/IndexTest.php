<?php

use App\Http\Resources\PostResource;
use App\Models\Post;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('should return the correct component', function () {
    get(route('posts.index'))
        ->assertInertia(function (AssertableInertia $inertia) {
            return $inertia->component('Posts/Index', true);
        });
});

it('passes posts to the view', function () {

    $posts = Post::factory(3)->create();

    get(route('posts.index'))
        ->assertHasPaginateResource('posts', PostResource::collection($posts->reverse()));
});
