{!! '<'.'?'.'xml version="1.0" encoding="UTF-8" ?>' !!}
<rss xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:media="http://search.yahoo.com/mrss/"
	 xmlns:turbo="http://turbo.yandex.ru" version="2.0">
	<channel>
		<title>{{env('APP_NAME')}}</title>
		<link>{{env('APP_URL')}}</link>
		<language>{{config('app.locale')}}</language>
		<description>{{env('APP_DESCRIPTION')}}</description>
		<generator>{{env('APP_NAME')}}</generator>
		@foreach($items as $item)
			<item turbo="true">
				<title>{{$item['title']}}</title>
				<guid isPermaLink="true">{{$item['link']}}</guid>
				<link>{{$item['link']}}</link>
				<description><![CDATA[{!! $item['description'] !!}]]></description>
				<content:encoded><![CDATA[<img style="width: 250px; float: left; margin: 7px 7px 7px 0;" src="{{$item['poster']}}"
											   alt="Постер к {{$item['title']}}" title="Постер к {{$item['title']}}"/>{!! $item['content'] !!}]]>
				</content:encoded>
				<turbo:content>
					<![CDATA[<img style="width: 250px; float: left; margin: 7px 7px 7px 0;" src="{{$item['poster']}}"
								  alt="Постер к {{$item['title']}}" title="Постер к {{$item['title']}}"/>{!! $item['content'] !!}]]>
				</turbo:content>
				@if (!empty($item['category']))
					<category>
						@foreach($item['category'] as $cat)
							@if ($loop->last)
								{{ $cat->title }}
							@else
								{{ $cat->title }},
							@endif
						@endforeach
					</category>
				@endif
				<dc:creator xmlns:dc="http://purl.org/dc/elements/1.1/">{!! $item['author'] !!}</dc:creator>
				<pubDate>{{ $item['pubdate'] }}</pubDate>
			</item>
		@endforeach
	</channel>
</rss>