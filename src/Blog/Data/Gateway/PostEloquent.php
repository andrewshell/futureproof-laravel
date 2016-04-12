<?php
namespace Blog\Data\Gateway;

use App\Post;
use Blog\Domain\Entity\Post as PostEntity;
use Blog\Domain\Gateway\Post as PostGateway;
use Exception;
use PDO;

class PostEloquent implements PostGateway
{
    public function getAllPosts()
    {
        $posts = array();

        foreach (Post::all() as $post) {
            $posts[] = $this->postToEntity($post);
        }

        return $posts;
    }

    public function getPostById($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            throw new Exception("No post found with ID: {$id}");
        }
        return $this->postToEntity($post);
    }

    public function savePost(PostEntity $post)
    {
        if ($post->hasId()) {
            $this->replacePost($post);
        } else {
            $this->insertPost($post);
        }
    }

    private function insertPost(PostEntity $postEntity)
    {
        $post = new Post();
        $post->title = $postEntity->getTitle();
        $post->content = $postEntity->getContent();
        $post->excerpt = $postEntity->getExcerpt();
        $post->save();
    }

    private function replacePost(PostEntity $postEntity)
    {
        try {
            $post = $this->getPostById($postEntity->getId());
            $post->title = $postEntity->getTitle();
            $post->content = $postEntity->getContent();
            $post->excerpt = $postEntity->getExcerpt();
            $post->save();
        } catch (Exception $e) {
            $this->insertPost($postEntity);
        }
    }

    private function postToEntity($post)
    {
        return new PostEntity($post->title, $post->content, $post->excerpt, $post->id);
    }
}
