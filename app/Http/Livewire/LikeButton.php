<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Auth;
use Livewire\Component;

class LikeButton extends Component
{
    private $post;
    public $post_id;
    public $isLiked;
    public $likeCount;

    public function mount($post_id)
    {
        $this->post = Post::findOrFail($post_id);
        if ($this->post != null && auth()->user() != null) {
            $this->post->likedByUser(auth()->user())
                ? $this->isLiked = true
                : $this->isLiked = false;

        }
        $this->likeCount = $this->post->likedByUsers->count();


    }
    public function ToggleLike($post_id)
    {
        $this->post = Post::findOrFail($post_id);
        if ($this->post != null && auth()->user() != null) {
            $this->post->likedByUsers()->toggle(auth()->user());
            $this->post->likedByUser(auth()->user())
                ? $this->isLiked = true
                : $this->isLiked = false;
        } else {
            return redirect('login');
        }
        $this->likeCount = $this->post->likedByUsers->count();

    }
    public function render()
    {
        return view('livewire.like-button');
    }
}