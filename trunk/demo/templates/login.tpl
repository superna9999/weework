{include file="header.tpl" title="Index"}
{if isset($text)}{$text}{/if}
<form action="{$BASE_HREF}/index/login" method="post">
<input type="text" name="user"/><input type="submit"/>
</form>
{include file="footer.tpl"}
