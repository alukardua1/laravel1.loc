<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaticPageSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$data = [
			[
				'title'       => 'Правообладателям',
				'url'         => Str::slug('Правообладателям'),
				'description' => '<p>Ресурс <span style="font-family:Bangers, cursive;">AnimeFree</span> является общедоступным для всех пользователей интернета и осуществляет свою деятельность с соблюдением действующего законодательства РФ. Администрация ресурса резко отрицательно относится к нарушению авторских прав. Поэтому, если Вы являетесь правообладателем исключительных имущественных прав, включая:<br><br>- исключительное право на воспроизведение;<br><br>- исключительное право на распространение;<br><br>- исключительное право на публичный показ;<br><br>- исключительное право на доведение до всеобщего сведения.<br><br>И Ваши права тем или иным образом нарушаются с использованием данного ресурса, мы просим незамедлительно сообщать в службу рассмотрения жалоб письмом (в электронном виде), в котором укажите нам следующую информацию:<br><br>1. Документальное подтверждение Ваших прав на материал, защищённый авторским правом: сканированный документ с печатью, либо иная контактная информация, позволяющая однозначно идентифицировать вас, как правообладателя данного материала.<br><br>2. Прямые ссылки на страницы сайта, которые содержат объекты необходимые закрыть.<br><br>Жалоба будет рассмотрена в срок, не превышающий 5 (пяти) рабочих дней<br><br>Наш email: <span class="mail-tech"><a href="mailto:info@anime-free.ru">info@anime-free.ru</a></span><br><br><br>На самом ресурсе AnimeFree не хранится ни одного материала. Весь материал взят с других ресурсов и размещен на сайте для ознакомления. Все размещенные на ресурсе AnimeFree новости или иные материалы являются собственностью разместивших их пользователей до тех пор, пока не будет оснований считать иначе. Ресурс не несет ответственности за использование (как правомерное, так и неправомерное) третьими лицами материалов, размещенных на ресурсе. Понимая актуальность соблюдения прав авторов хотим заверить Вас, что как только факт нарушения Ваших прав будет установлен, мы предпримем все зависящие от нас меры для пресечения такого нарушения и, по возможности, постараемся посодействовать недопущению в дальнейшем подобных ситуаций.</p>',
				'public_at'   => 1,
			],
		];

		DB::table('static_pages')->insert($data);
	}
}
