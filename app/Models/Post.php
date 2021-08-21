<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'short_description',
        'description',
        'image',
        'is_active',
    ];

    /**
     * The attributes that are auto appended to model output.
     *
     * @var array
     */
    protected $appends = ['comments_count', 'is_post_owner'];

    /**
     * Get users' related data only
     *
     * @param $query
     * @param $userId
     * @return mixed
     */
    public function scopeById($query, $id)
    {
        return $query->where('id', $id);
    }

    /**
     * Get users' related data only
     *
     * @param $query
     * @param $userId
     * @return mixed
     */
    public function scopeMine($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope a query to most polular blogs.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query, $flag = true)
    {
        $active = ($flag) ? 1 : 0;
        return $query->where('is_active', $active);
    }

    /**
     * Scope a query to most polular blogs.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(PostComment::class)->orderBy('id', 'DESC');
    }

    /**
     * @return mixed
     */
    public function getCommentsCountAttribute()
    {
        return $this->attributes['comments_count'] = PostComment::byPost($this->attributes['id'])->count();
    }

    /**
     * @return mixed
     */
    public function getIsPostOwnerAttribute()
    {
        $postOwner = false;
        if ($this->attributes['user_id'] == Auth::id()) $postOwner = true;

        return $this->attributes['is_post_owner'] = $postOwner;
    }
}
