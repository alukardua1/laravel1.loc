<?php


namespace App\Repository;

use App\Http\Requests\AnimeRequest;
use App\Http\Requests\CommentRequest;
use App\Models\Anime;
use App\Models\Comment;
use App\Repository\Interfaces\AnimeRepositoryInterfaces;
use App\Services\FunctionTrait;
use App\Services\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

/**
 * Class AnimeRepository
 *
 * @package App\Repository
 */
class AnimeRepository implements AnimeRepositoryInterfaces
{
    use FunctionTrait;
    use ImageTrait;

    private Model $model;

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

    public function __construct(Anime $anime)
    {
        $this->model = $anime;
    }

    /**
     * Получает аниме по ID
     *
     * @param  int|null  $id
     * @param  bool      $isAdmin
     *
     * @return mixed
     */
    public function getAnime(int $id = null, bool $isAdmin = false): mixed
    {
        if ($id) {
            return $this->model->where('id', $id);
        } elseif ($isAdmin) {
            return $this->model->orderBy('updated_at', 'DESC')->withTrashed();
        } else {
            return $this->model->where('posted_at', 1)
                ->where('posted_main_page', 1)
                ->orderBy('updated_at', 'DESC');
        }
    }

    /**
     * Получем колличество записей
     *
     * @return mixed
     */
    public function countAnime(): mixed
    {
        return $this->model->where('posted_at', 1)->count();
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
        return $this->model->where('ongoing', 1)
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
        return $this->model->where($columns, $custom)
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
        return $this->model->where('anons', 1)
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
        return $this->model->limit($limit);
    }

    /**
     * Поиск
     *
     * @param  Request   $request  Запрос
     * @param  int|null  $limit    количество выводимых записей
     *
     * @return mixed
     */
    public function getSearchAnime(Request $request, int|null $limit = 5): mixed
    {
        $search = $request->search;
        $result = $this->model->where('title', 'LIKE', "%{$search}%")
            ->orWhere('english', 'LIKE', "%{$search}%")
            ->orWhere('japanese', 'LIKE', "%{$search}%")
            ->orWhere('synonyms', 'LIKE', "%{$search}%")
            ->orWhere('license_name_ru', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%");
        if ($limit) {
            return $result->limit($limit);
        } else {
            return $result;
        }
    }

    /**
     * Добавление/обновление комментариев
     *
     * @param  \App\Http\Requests\CommentRequest  $request  Запрос
     * @param  int                                $id       ID записи
     *
     * @return mixed
     */
    public function setComment(CommentRequest $request, int $id): mixed
    {
        $validated = $request->validated();
        return Comment::create($request->all());
    }

    /**
     * Удаление комментариев
     *
     * @param  int   $anime_id
     * @param  int   $id       ID записи
     * @param  bool  $fullDel  удалить послностью или нет
     *
     * @throws \Exception
     * @return mixed
     */
    public function delComments(int $anime_id, int $id, bool $fullDel = false): mixed
    {
        $deleteComment = Comment::withTrashed()->findOrFail($id);
        $deleteParentComment = Comment::withTrashed()->where('parent_comment_id', $id)->get();

        if (!isEmpty($deleteParentComment) && $fullDel) {
            foreach ($deleteParentComment as $value) {
                if ($value->parent_comment_id = $id) {
                    $deleteComment = $this->delComments($value->anime_id, $value->id, $fullDel);
                }
            }
        }

        if ($deleteComment) {
            if ($fullDel) {
                return $deleteComment->forceDelete();
            } else {
                return $deleteComment->delete();
            }
        }
    }

    /**
     * Добавление/обновление аниме
     *
     * @param  \App\Http\Requests\AnimeRequest  $request  Запрос
     * @param  int|null                         $id       ID записи
     *
     * @return mixed
     */
    public function setAnime(AnimeRequest $request, int $id = null): mixed
    {
        $formRequest = $request->all();
        $update = $this->model->updateOrCreate(['id' => $id], $formRequest); //если нашли то обновляем, иначе добавляем новую запись
        if ($update) {
            if ($formRequest['channel_id'] == null) {
                $formRequest['channel_id'] = 0;
            }
            $this->checkRequest($this->arrCheck, $formRequest, $update);
            $this->syncRequest($this->arrSync, $update, $request);

            if (array_key_exists('poster', $formRequest)) {
                $this->uploadImageNew($update, $formRequest);
            }
            if (!empty($formRequest['otherLink_title'])) {
                $this->setOtherLink($formRequest, $id);
            }
            if (!empty($formRequest['player_name'])) {
                $this->setPlayer($formRequest, $id);
            }

            return $update->save();
        }
    }

    /**
     * Удаляет текущую запись
     *
     * @param  int   $id
     * @param  bool  $fullDel
     *
     * @return mixed
     */
    public function deleteAnime(int $id, bool $fullDel = false): mixed
    {
        $del = $this->model->findOrFail($id, ['*']);
        if ($del) {
            if ($fullDel) {
                return $del->forceDelete();
            }
            return $del->delete();
        }
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function franchise(int $id): mixed
    {
        // TODO: Implement franchise() method.
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function chronology(int $id): mixed
    {
        // TODO: Implement chronology() method.
    }
}
