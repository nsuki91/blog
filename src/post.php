<?php

namespace nsuki;

class Post extends DbObject
{
    protected static $db_table = "posts";
    protected static $db_table_fields = array('title', 'context', 'author');

    public $id;
    public $title;
    public $context;
    public $date;
    public $author;

    public static function verifyPost()
    {
        if (isset($_POST['edit'])) {
            if (!empty(Post::findByID($_POST['q']))) {
                header("Location: edit/{$_POST['q']}");
            } else {
                echo 'This ID does not match with a post.';
            }
        }
    }

    public static function checkPost()
    {
        global $db;
        global $logged;
        if (isset($_POST['newpost'])) {
            $newPost = new Post();
            $newPost->title = $db->escapeString($_POST['title']);
            $newPost->context = $db->escapeString($_POST['context']);
            $newPost->author = $logged->username;
            $newPost->create();
        }
    }

    public static function checkUpdate($selected)
    {
        global $db;
        if (isset($_POST['update'])) {
            $selected->title = $db->escapeString($_POST['title']);
            $selected->context = $db->escapeString($_POST['context']);
            $selected->save();
            echo "The post edited successfully";
        }
    }

    public static function checkDelete()
    {
        global $db;
        if (isset($_POST['deletepost'])) {
            $postid = $db->escapeString($_POST['postid']);
            $selected = self::findByID($postid);
            $selected->delete();
            echo 'Post successfully deleted.';
        }
    }

    public static function printPosts($value, $x)
    {
    $template = "
    <h1><a href='post/{$value->id}'>{$value->title}</a></h1>
    <h5><i>{$value->author} - {$value->date}</i></h5>
    <br><br>";
    echo $template;
    }

    public static function listPosts()
    {
        $result = self::findAll();
        $x = 1;
        foreach ($result as $value) {
            self::printPosts($value, $x);
            $x = $x + 1;
        }
    }
}
