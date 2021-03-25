<?php


namespace App\Repository;

use App\Models\Anime;
use App\Models\Comment;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use App\Services\FunctionTrait;
use Illuminate\Http\Request;

/**
 * Class AnimeRepository
 *
 * @package App\Repository
 */
class AnimeRepository implements AnimeRepositoryInterfaces
{
	use FunctionTrait;

	/**
	 * @param  int  $id
	 *
	 * @return mixed
	 */
	public function getAnime(int $id): mixed
	{
		return Anime::where('id', $id);
	}

	/**
	 * @param  bool  $isAdmin
	 *
	 * @return mixed
	 */
	public function getAllAnime(bool $isAdmin = false): mixed
	{
		if ($isAdmin) {
			return Anime::orderBy('updated_at', 'DESC');
		}

		return Anime::where('posted_at', 1)
			->orderBy('updated_at', 'DESC');
	}

	/**
	 * @param  int  $limit
	 *
	 * @return mixed
	 */
	public function getFirstPageAnime(int $limit): mixed
	{
		return Anime::where('ongoing', 1)
			->limit($limit)
			->orderBy('updated_at', 'DESC');
	}

	/**
	 * @param  string  $columns
	 * @param  string  $custom
	 *
	 * @return mixed
	 */
	public function getCustomAnime(string $columns, string $custom): mixed
	{
		return Anime::where($columns, $custom)
			->orderBy('updated_at', 'DESC');
	}

	/**
	 * @param  int  $limit
	 *
	 * @return mixed
	 */
	public function getAnons(int $limit): mixed
	{
		return Anime::where('anons', 1)
			->limit($limit)
			->orderBy('read_count', 'DESC');
	}

	/**
	 * @param  int  $limit
	 *
	 * @return mixed
	 */
	public function getPopular(int $limit): mixed
	{
		return Anime::limit($limit);
	}

	/**
	 * @param  Request  $request
	 * @param  int      $limit
	 *
	 * @return mixed
	 */
	public function getSearchAnime(Request $request, int $limit = 5): mixed
	{
		return Anime::where('name', 'LIKE', "%{$request->search}%")
			->orWhere('english', 'LIKE', "%{$request->search}%")
			->orWhere('japanese', 'LIKE', "%{$request->search}%")
			->orWhere('synonyms', 'LIKE', "%{$request->search}%")
			->orWhere('license_name_ru', 'LIKE', "%{$request->search}%")
			->orWhere('description', 'LIKE', "%{$request->search}%")
			->limit($limit)
			->get();
	}

	/**
	 * @param  int      $id
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setComment(int $id, Request $request): mixed
	{
		$validated = $request->validated();
		return Comment::create($request->all());
	}

	/**
	 * @param  int   $id
	 * @param  bool  $fullDel
	 *
	 * @throws \Exception
	 * @return mixed
	 */
	public function delComments(int $id, bool $fullDel): mixed
	{
		$deleteComment = Comment::withTrashed()->where('id', $id)->first();
		$deleteParentComment = Comment::withTrashed()->where('parent_comment_id', $id)->get();

		if (!empty($fullDel)) {
			if ($deleteParentComment) {
				foreach ($deleteParentComment as $value) {
					if ($value->parent_comment_id = $id) {
						$deleteComment = $this->delComments($value->id, true);
					}
				}
			}
		}

		if ($deleteComment and empty($fullDel)) {
			return $deleteComment->delete();
		} else {
			return $deleteComment->forceDelete();
		}
	}

	/**
	 * @param  Request  $request
	 * @param  int      $id
	 *
	 * @return mixed
	 */
	public function setAnime(Request $request, int $id): mixed
	{
		$formRequest = $request->all();
		$update = Anime::findOrNew($id, $formRequest);
		if ($update) {
			if ($formRequest['category']) {
				$update->fill($request->except('category'));
				$update->getCategory()->sync($request['category']);
			}
			if ($formRequest['country']) {
				$update->fill($request->except('country'));
				$update->getCountry()->sync($request['country']);
			}
			if ($formRequest['studios']) {
				$update->fill($request->except('studios'));
				$update->getStudio()->sync($request['studios']);
			}
			if ($formRequest['quality']) {
				$update->fill($request->except('quality'));
				$update->getQuality()->sync($request['quality']);
			}
			$this->setOtherLink($formRequest, $id);
			$this->setPlayer($formRequest, $id);
			$update->kind_id = $formRequest['kind'];
			$update->anons = $this->check($formRequest, 'anons');
			$update->ongoing = $this->check($formRequest, 'ongoing');
			$update->posted_at = $this->check($formRequest, 'posted_at');
			$update->posted_rss = $this->check($formRequest, 'posted_rss');
			$update->comment_at = $this->check($formRequest, 'comment_at');
			if ($formRequest['channel_id'] == null) {
				$update->channel_id = 0;
			} else {
				$update->channel_id = $formRequest['channel_id'];
			}

			return $update->save();
		}
		//dd(__METHOD__, $formRequest, $id, $update, 2222);
	}
}