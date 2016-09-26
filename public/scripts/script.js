function refresh()
{
	$('#input').load('index.php?page=list_message&ajax');
}
$('document').ready(function()
{
	if ($('#input').length > 0)
	{
		if ($('#form').length > 0)
		{
			$('#form').submit(function(e)
			{
				e.preventDefault();
				var form = $(this);
				var content = $('#message').val();
				$.post('index.php?page=tchat&ajax', {message:content}, function()
				{
					$('#message').val('').focus();
					refresh();
				});
				return false;
			});
		}
		setInterval(refresh, 1000);
	}
});