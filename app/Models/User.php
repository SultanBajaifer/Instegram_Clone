<?php

namespace App\Models;

use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use \Illuminate\Auth\Authenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'status',
        'bio',
        'url',
        'language',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get all of the posts for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * The follows that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id');
    }
    /**
     * The followers that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'user_id');
    }

    public function following(User $user)
    {
        return $this->follows()->where('following_user_id', $user->id)->exists();
    }
    function setAccepted(User $user)
    {
        if ($user->status == 'public') {
            DB::table('follows')
                ->where('user_id', $this->id)
                ->where('following_user_id', $user->id)
                ->update([
                    'accepted' => true
                ]);
        }
    }
    function accepted(User $user)
    {
        if ($this->status == 'public') {
            return true;
        } else {

            return (bool) DB::table('follows')
                ->where('user_id', $user->id)
                ->where('following_user_id', $this->id)
                ->where('accepted', true)->count();
        }
    }

    function FollowReq()
    {
        if ($this->status == 'private') {
            return $this->followers()
                ->where('following_user_id', $this->id)
                ->where('accepted', false)
                ->latest()->paginate(5);
        }
        return null;
    }
    function pendingFollowReq()
    {
        if ($this->status == 'private') {
            return $this->follows()
                ->where('user_id', $this->id)
                ->where('accepted', false)
                ->latest()->paginate(5);
        }
        return null;
    }
    function followingAndAccepted(User $user)
    {
        return $this->follows()
            ->where('following_user_id', $user->id)
            ->where('accepted', true)->exists();
    }
    function toggleAccepted($user, $status)
    {
        return DB::table('follows')
            ->where('user_id', $user->id)
            ->where('following_user_id', $this->id)
            ->update(['accepted' => $status]);

    }

    public function home()
    {
        $ids = $this->follows()->where('accepted', true)->get()->pluck('id');
        return Post::whereIn('user_id', $ids)->latest()->paginate(5);
    }
    function iFollow()
    {

        return $this->follows()
            ->where('user_id', $this->id)
            ->where('accepted', true)
            ->latest()->get();

    }
    function otherUsers()
    {
        $ifollow = $this->iFollow()->pluck('id')->toArray();
        $pendingFollow = $this->pendingFollowReq()->pluck('id')->toArray();
        array_push($ifollow, $this->id);
        $others = array_merge($ifollow, $pendingFollow);
        return User::whereNotIn('id', $others)->latest()->get();
    }
    function explore()
    {
        $ifollow = $this->iFollow()->pluck('id')->toArray();
        array_push($ifollow, $this->id);
        $public = User::where('status', 'private')->pluck('id')->toArray();
        $others = array_merge($ifollow, $public);
        return Post::whereNotIn('user_id', $others)->latest()->paginate(30);
    }
}