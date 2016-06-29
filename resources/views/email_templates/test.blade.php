<!DOCTYPE html>
<html>
    <head>
        <title>Active verification</title>
    </head>
	<body>
	<h2>Dear !name,</h2>
	<div>
		<p>Bạn vừa chọn !email để tạo một tài khoản trên {{ $site_name }}<br/><br/>
		Để kích hoạt tài khoản, bạn vui lòng nhấp vào đường dẫn bên dưới hoặc copy vào trình duyệt.<br/>
		!activation_url</p>
	</div>
	<p>Tại sao bạn lại nhân mail này?<br>
		Workspharma yêu cầu bạn xác nhận để chắc chắn rằng email này là của bạn. <br/>
		Tài khoản !site_name sẽ không kích hoạt một số chức năng chính cho tới khi bạn xác nhận.<br>
		You recently selected !email as your new Workspharma account.</p>
	<p>To verify this email address belongs to you,<br>click the link below and then sign in using your username and password.<br/>
	!activation_url</p>
	<p>Why you received this email?<br>
!site_name requests verification whenever an email address is selected as an
!site_name Account. <br/>Your !site_name Account cannot be used until you verify it.
	</p>
<p>Thanks,<br/>
	!site_name Support Team.</p>
	</body>
</html>