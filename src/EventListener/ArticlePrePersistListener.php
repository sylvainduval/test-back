<?php

namespace App\EventListener;

use App\Entity\Article;
use DateTime;

class ArticlePrePersistListener
{
	public function prePersist(Article $article)
	{
		$article->setCreatedAt(new DateTime());
	}
}
