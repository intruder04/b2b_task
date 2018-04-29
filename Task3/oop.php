<?php

/**
 * Подобие yii ActiveRecord
 */


class User extends ActiveRecord
{
    public static function tableName()
    {
        return 'users';
    }

    public function getUserPosts()
    {
        return $this->hasMany(Post::className(), ['author_id' => 'user_id']);
    }

    public function createPost ()
    {
        return new Post();
    }
    
}


class Post extends ActiveRecord
{
    public static function tableName()
    {
        return 'posts';
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['user_id' => 'author_id'])->one();
    }

    public function changePostAuthor($newAuthor)
    {
        $this->author = $newAuthor;
        return $this->author;
    }

}