<section class="comments">
	<div class="comments__inner">
		<!-- Рекурсивное подключение шаблона комментариев. -->
		<ol class="comments__list">
			@each('web.frontend.comments.show', $comments, 'comment')
		</ol>

		<form ...>
			<!-- Тут может быть форма для комментирования. -->
		</form>
	</div>
</section>