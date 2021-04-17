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
	 * Массив для синхронизации
	 *
	 * @var array
	 */
	protected array $arrSync = [
		'category'         => 'getCategory',
		'country'          => 'getCountry',
		'studios'          => 'getStudio',
		'quality'          => 'getQuality',
		'region'           => 'getRegionBlock',
		'copyright_holder' => 'getCopyrightHolder',
		'translate'        => 'getTranslate',
	];

	/**
	 * Массив чекбоксов
	 *
	 * @var array
	 */
	protected array $arrCheck = [
		'anons'      => 'anons',
		'ongoing'    => 'ongoing',
		'posted_at'  => 'posted_at',
		'posted_rss' => 'posted_rss',
		'comment_at' => 'comment_at',
	];

	/**
	 * Получает аниме по ID
	 *
	 * @param  int  $id  ID записи
	 *
	 * @return mixed
	 */
	public function getAnime(int $id): mixed
	{
		return Anime::where('id', $id);
	}

	/**
	 * Получает все аниме с проверкой для админпанели или для сайта
	 *
	 * @param  bool  $isAdmin  админ или нет
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
	 * Формирует для главной страницы
	 *
	 * @param  int  $limit  количество выводимых записей
	 *
	 * @return mixed
	 * @todo доработать
	 *
	 */
	public function getFirstPageAnime(int $limit): mixed
	{
		return Anime::where('ongoing', 1)
			->limit($limit)
			->orderBy('updated_at', 'DESC');
	}

	/**
	 * Вывод варимативного
	 *
	 * @param  string  $columns  столбец
	 * @param  string  $custom   строка поиска
	 *
	 * @return mixed
	 */
	public function getCustomAnime(string $columns, string $custom): mixed
	{
		return Anime::where($columns, $custom)
			->orderBy('updated_at', 'DESC');
	}

	/**
	 * Вывод анонса
	 *
	 * @param  int  $limit  количество выводимых записей
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
	 * Вывод популярного
	 *
	 * @param  int  $limit  количество выводимых записей
	 *
	 * @return mixed
	 */
	public function getPopular(int $limit): mixed
	{
		return Anime::limit($limit);
	}

	/**
	 * Поиск
	 *
	 * @param  Request  $request  Запрос
	 * @param  int      $limit    количество выводимых записей
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
	 * Добавление/обновление комментариев
	 *
	 * @param  int      $id       ID записи
	 * @param  Request  $request  Запрос
	 *
	 * @return mixed
	 */
	public function setComment(int $id, Request $request): mixed
	{
		$validated = $request->validated();
		return Comment::create($request->all());
	}

	/**
	 * Удаление комментариев
	 *
	 * @param  int   $id       ID записи
	 * @param  bool  $fullDel  удалить послностью или нет
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
	 * Добавление/обновление аниме
	 *
	 * @param  Request   $request  Запрос
	 * @param  int|null  $id       ID записи
	 *
	 * @return mixed
	 */
	public function setAnime(Request $request, int $id = null): mixed
	{
		$formRequest = $request->all();
		$updatePost = Anime::firstOrCreate(['id' => $id], $formRequest); //если нашли то обновляем, иначе добавляем новую запись
		if ($updatePost) {
			if ($formRequest['channel_id'] == null) {
				$formRequest['channel_id'] = 0;
			}

			$this->syncRequest($this->arrSync, $updatePost, $request);
			if (!empty($formRequest->otherLink_title)) {
				$this->setOtherLink($formRequest, $id);
			}
			if (!empty($formRequest->player_name)) {
				$this->setPlayer($formRequest, $id);
			}

			return $updatePost->save();
		}
	}

	/**
	 * Удаляет текущую запись
	 *
	 * @param  int  $id
	 *
	 * @return mixed
	 */
	public function destroyAnime(int $id): mixed
	{
		$del = Anime::findOrFail($id, ['*']);
		if ($del) {
		    return $del->forceDelete();
		}
	}
}