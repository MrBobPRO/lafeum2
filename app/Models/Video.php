<?php

namespace App\Models;

use App\Support\Traits\Favoritable;
use App\Support\Traits\Likeable;
use App\Support\Traits\Publishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Favoritable;
    use Publishable;
    use Likeable;

    protected $appends = ['link', 'embeded_link', 'thumbnail'];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function categories()
    {
        return $this->belongsToMany(VideoCategory::class, 'category_video', 'video_id', 'category_id');
    }

    public function getLinkAttribute()
    {
        return 'https://youtu.be/' . $this->host_id;
    }

    public function getEmbededLinkAttribute()
    {
        return 'https://www.youtube.com/embed/' . $this->host_id;
    }

    public function getThumbnailAttribute()
    {
        return 'https://i.ytimg.com/vi/' . $this->host_id . '/mqdefault.jpg';
    }

    private function getYoutubeId($link)
    {
        $youtubeIdRegEx = '/(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';

        $pregMatchOutput = [];

        $matched = preg_match($youtubeIdRegEx, $link, $pregMatchOutput);

        if ($matched && count($pregMatchOutput) === 2) {
            return $pregMatchOutput[1];
        }

        return null;
    }
}
