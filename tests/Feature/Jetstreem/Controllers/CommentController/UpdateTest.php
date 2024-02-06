<?php

use App\Models\Comment;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\put;

it('requires authentication', function () {
    put(route('comments.update', Comment::factory()->create()))
        ->assertRedirect(route('login'));
});

it('can update a comment', function () {
    $comment = Comment::factory()->create();

    $updatedComment = "Updated Body";

    actingAs($comment->user)
        ->put(route('comments.update', $comment), ['body' => $updatedComment]);

    $this->assertDatabaseHas(Comment::class, [
        'id' => $comment->id,
        'body' => $updatedComment,
    ]);

});

it('redirects to the post show page', function () {
    $comment = Comment::factory()->create();

    actingAs($comment->user)
        ->put(route('comments.update', $comment), ['body' => "Updated Body"])
        ->assertRedirect(route('posts.show', $comment->post_id));

});

it('redirects to the correct page of comments', function () {
    $comment = Comment::factory()->create();

    actingAs($comment->user)
        ->put(route('comments.update', ['comment' => $comment, 'page' => 2]), ['body' => "Updated Body"])
        ->assertRedirect(route('posts.show', ['post' => $comment->post_id, 'page' => 2]));
});

it('cannot update a comment from another user', function () {
    $comment = Comment::factory()->create();

    actingAs(User::factory()->create())
        ->put(route('comments.update', $comment), ['body' => "Updated Body"])
        ->assertForbidden();
});


it('requires a valid body', function ($value) {
    $comment = Comment::factory()->create();

    actingAs($comment->user)
        ->put(route('comments.update', $comment), [
            'body' => $value,
        ])
        ->assertInvalid('body');
})->with([
    null,
    1,
    1.5,
    true,
    str_repeat('a', 2501),
]);
