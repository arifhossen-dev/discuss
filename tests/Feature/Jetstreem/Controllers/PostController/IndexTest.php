<?php

use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('should return the correct component', function () {
  get(route('posts.index'))
    ->assertInertia(function (AssertableInertia $inertia) {
      return $inertia->component('Posts/Index', true);
    });
});

it('passes posts to the view', function () {
  get(route('posts.index'))
    ->assertInertia(function (AssertableInertia $inertia) {
      return $inertia->has('posts');
    });
});
