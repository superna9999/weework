{include file="header.tpl" title="Index"}
{if isset($text)}{$text}{/if}
<form action="{$BASE_HREF}/index/login" method="post">
<input type="text" name="user"/><input type="submit"/>
</form>
<p>Let see the args given to the Default method :
Page:{$page}<br/>
Part:{$part}<br/>
Args:
{html_table loop=$args}
</p>
{include file="footer.tpl"}
