<?=
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL
?>

<rss version="2.0">
    <channel>
        <title><![CDATA[ MPPRE ]]></title>
        <link><![CDATA[ https://mppre.gob.ve/ ]]></link>
        <description><![CDATA[ Ministerio del Poder Popular para Relaciones Exteriores ]]></description>
        <language>en</language>
        <pubDate>{{ now() }}</pubDate>
  
        @foreach($lista as $post)
            <item>
                <title><![CDATA[{{ $post->nombre }}]]></title>
                <link><?php echo url("publicacion") . "/" . $post['id'].'-'.(Str::slug($post['nombre'], "-")); ?></link>
                <author><![CDATA[{{ $post->creador }}]]></author>
                <guid>{{ $post->id }}</guid>
                <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>