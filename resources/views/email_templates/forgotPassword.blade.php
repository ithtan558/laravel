<!DOCTYPE html>
<html>
    <head>
        <title>Active verification</title>
    </head>
	<body>
	<h2>Hi {{ $name }},</h2>
	<div>
		<p>{{ $site_name }} recently received a request for a forgotten password.</p>
		<p>To change your {{ $site_name }} account password, please click the link below: {{ $forgot_url }}</p>
		<p>If you did not request this change, you do not need to do anything.</p>
		<p>This link will expire in 24 hour.</p>
	</div>
	<p>Thanks,<br/>{{ $site_name }} Support Team.</p>
	</body>
</html>


<br/><br/>
{{ $site_name }} recently received a request for a forgotten password.
<br/><br/>
To change your {{ $site_name }} account password, please click the link below: !forgot_url
<br/><br/>
If you did not request this change, you do not need to do anything.
<br/><br/>
This link will expire in 24 hour. 

<br/><br/>
Thanks,<br/>
{{ $site_name }} Support Team.