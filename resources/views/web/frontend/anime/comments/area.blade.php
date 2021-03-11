<section class="comments">
	<div class="comments__inner">
		<!-- Рекурсивное подключение шаблона комментариев. -->
		<ol class="comments__list">
			@each('web.frontend.anime.comments.show', $comments, 'comment')
		</ol>
	</div>
</section>