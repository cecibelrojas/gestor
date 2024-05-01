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
      
      <image>
        <url>https://portal.mppre.gob.ve/images/ico/favicon1.png</url>
        <title>MPPRE</title>
        <link>https://portal.mppre.gob.ve</link>
        <width>32</width>
        <height>32</height>
      </image> 


        @foreach($lista as $post)
            <item>
                <title><![CDATA[{{ $post->nombre }}]]></title>
                <link><?php echo url("publicacion") . "/" . $post['id'].'-'.(Str::slug($post['nombre'], "-")); ?></link>
                <author><![CDATA[{{ $post->creador }}]]></author>
                <guid>{{ $post->id }}</guid>
                <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
                <description><![CDATA[<?php echo env('APP_ADMIN') . "/archivos/imagenes/" . $post['imgdestacado']; ?>]]></description>
            </item>
        @endforeach
    </channel>
</rss>