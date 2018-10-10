<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use Sluggable;
    protected $fillable = ['title','content','date','description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'posts_tags', 'post_id', 'tag_id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function add($fields)
    {
        $post = new static;
        $post->fill($fields);
        $post->user_id = Auth::user()->id;
        $post->save();

        return $post;

    }

    public  function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        Storage::delete('uploads/'.$this->image);
        $this->delete();
    }

    public function uploadImage($image)
    {

        if($image == null){return;}
        Storage::delete('uploads/'.$this->image);
        $filename = str_random(10).'.'.$image->extension();
        $image->storeAs('uploads',$filename);
        $this->image = $filename;
        $this->save();
    }

    public function setCategory($id)
    {
        if ($id == null){return;}
        $this->category_id = $id;
        $this->save();
    }

    public function setTags($ids)
    {
        if ($ids == null){return;}
        $this->tags()->sync($ids);
    }

    public function setDraft()
    {
        $this->status = 0;
        $this->save();
    }

    public function setPublic()
    {
        $this->status = 1;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if ($value == null){
           return $this->setDraft();
        }
        else return $this->setPublic();
    }

    public function setFeatured()
    {
        $this->is_featured = 1;
        $this->save();
    }

    public function setStandart()
    {
        $this->is_featured= 0;
        $this->save();
    }

    public function toggleFeatured($value)
    {
        if ($value == null){
            return $this->setStandart();
        }
        else return $this->setFeatured();
    }

    public function getImage()
    {
        if ($this->image == null){
            return '/img/no-image.png';
        }
        else return '/uploads/'.$this->image;
    }
    public function getTags()
    {
        return implode(', ',$this->tags->pluck('title')->all());

    }

    public function getDate()
    {
        return Carbon::createFromFormat('Y-m-d',$this->date)->format('F d, Y');
    }

    public function hasPrevious()
    {
        return self::where('id','<',$this->id)->max('id');
    }

    public function getPrevious()
    {
        $postId = $this->hasPrevious();
         return self::find($postId);
    }

    public function hasNext()
    {
        return self::where('id','>',$this->id)->min('id');
    }

    public function getNext()
    {
        $postId = $this->hasNext();
        return self::find($postId);
    }

    public function related()
    {

      return self::all()->except(['id'=>$this->id]) ;
    }

}
