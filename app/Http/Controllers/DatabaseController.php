<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function fixDBfromOldDB()
    {
        // Add new DayliPOst
        $post = new DailyPost();
        $post->date = now();
        $post->quote_id = '7';
        $post->term_id = '25';
        $post->video_id = '41';
        $post->photo_id = '20';
        $post->save();

        // Categories
        Category::all()->each(function ($item) {
            $model = $item->type . 'Category';

            $category = new $model();
            $category->id = $item->id;
            $category->name = $item->name;
            $category->slug = $item->slug;
            $category->description = $item->description;
            $category->_lft = $item->_lft;
            $category->_rgt = $item->_rgt;
            $category->parent_id = $item->parent_id;
            $category->save();
        });

        // Attach categories
        Category::all()->each(function ($item) {
            switch ($item->categoriable_type) {
                case 'App\Video':
                    $video = Video::find($item->categoriable_id);
                    if ($video) {
                        $video->categories()->attach($item->category_id);
                    }
                    break;

                case 'App\Term':
                    $term = Term::find($item->categoriable_id);
                    if ($term) {
                        $term->categories()->attach($item->category_id);
                    }
                    break;

                case 'App\Quote':
                    $quote = Quote::find($item->categoriable_id);
                    if ($quote) {
                        $quote->categories()->attach($item->category_id);
                    }
                    break;

                default:
                    dd($item);
                    break;
            }
        });

        // Authors
        Author::withTrashed()->get()->each(function ($item) {
            $item->photo = substr($item->photo, 13);
            $item->save();
        });

        // Photos
        Photo::withTrashed()->get()->each(function ($item) {
            $item->path = substr($item->path, 12);
            $item->save();
        });

        // create thumbs
        Photo::withTrashed()->get()->each(function ($item) {
            if (file_exists(public_path('img/photos/' . $item->path))) {
                try {
                    $thumb = Image::make(public_path('img/photos/' . $item->path));

                    $thumb->resize(320, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $thumb->save(public_path('img/photos/thumbs/' . $item->path));
                } catch (Exception $e) {
                    dd("ERROR: " . $item->path);
                }
            }
        });
    }

    public static function fixTermsBodyLinks($terms, $newDomain)
    {
        foreach($terms as $term) {
            $body = $term->body;

            preg_match_all('/<a\s+.*?href=[\"\']?([^\"\' >]*)[^>]*>/i', $body, $links);

            // Replace all links
            foreach($links[0] as $link) {
                $parsed = parse_url($link);
                // Links wich include only id /1235
                if(!array_key_exists('host', $parsed)) {
                    $id = substr($parsed['path'], 1);
                    $post = Post::find($id);

                    if($post) {
                        $body = str_replace($link, "https://{$newDomain}/term/" . $post->postable_id, $body);
                    }
                }

                // Full links https://lafeum.ru/14124
                else if($parsed['host'] == 'lafeum.ru') {
                    $id = substr($parsed['path'], 1);
                    $post = Post::find($id);

                    if($post) {
                        $body = str_replace($link, "https://{$newDomain}/term/" . $post->postable_id, $body);
                    }
                }
            }

            $term->body = $body;
            $term->save();
        }
    }
}
