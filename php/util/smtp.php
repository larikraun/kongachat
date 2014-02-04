<?php

//thanks to Boss Boye
require_once('class.phpmailer.php');

class Mailer
{

    public static function sendConfirmationMail($url, $email, $name)
    {
        $subject = "Linda.com.ng Account Activation";
        $message = '<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
    <tbody><tr>
		<td>
			<table width="600" align="center" cellpadding="0" cellspacing="0">
				<tbody>
				<tr>
					<td bgcolor="#000000" style="padding:12px 30px 10px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="line-height:0">
									<a href="http://linda.com.ng" target="_blank"><img src="http://www.linda.com.ng/img/linda.png" align="left" border="0" vspace="0" hspace="0" width="96" height="25" alt="Linda"></a>
								</td>
								<td align="right" style="font:11px/12px Arial,Helvetica,sans-serif;color:#fff">

									<a style="color:#fff" href="http://linda.com.ng/login" target="_blank">Sign in</a> or <a style="color:#fff" href="http://linda.com.ng/join" target="_blank">Join Linda</a>

								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>

				<tr>
					<td style="padding:16px 30px 0">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="font:14px/21px Arial,Helvetica,sans-serif;color:#363636;padding:29px 0 13px">
									<b>Hi ' . $name . ',</b><br><br>


    To complete your sign up, please verify your email using the following link:<br><br>

<a href="' . $url . '" target="_blank">' . $url . '</a><br>
<br>

								</td>
							</tr>


							<tr>
								<td style="font:14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 14px">
        Cheers,
								</td>
							</tr>
							<tr>
								<td style="font:bold 14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 7px">
        The Linda Team
    </td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5" style="padding:27px 30px 17px">

						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody>
							<tr>
								<td width="10"></td>
								<td valign="top" width="255">
									<table width="255" cellpadding="0" cellspacing="0">
										<tbody><tr>
											<td style="font:11px/11px Arial,Helvetica,sans-serif;color:#4e4e4e;padding:0 0 9px">
        Join our community
    </td>
										</tr>
										<tr>
											<td>
												<table cellpadding="0" cellspacing="0">
													<tbody><tr>
														<td width="31">
															<a href="https://www.facebook.com/LindaNigeria" target="_blank"><img src="http://www.linda.com.ng/img/fb.png" style="vertical-align:top" border="0" width="31" height="31" alt="Facebook"></a>
														</td>
														<td width="9"></td>
														<td width="31">
															<a href="https://twitter.com/LindaNigeria" target="_blank"><img src="' . SITE_URL . 'img/twee.png" style="vertical-align:top" border="0" width="31" height="31" alt="Twitter"></a>
														</td>
														<td width="9"></td>
														<td width="31">
															<a href="http://www.linkedin.com/company/5025043?trk=tyah&trkInfo=tas%3Alinda%20nig%2Cidx%3A1-1-1" target="_blank"><img src="' . SITE_URL . 'img/link.png" style="vertical-align:top" border="0" width="31" height="31" alt="LinkedIn"></a>
														</td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>

					</td>
				</tr>
				<tr>
					<td style="padding:21px 30px 30px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="font:11px/13px Arial,Helvetica,sans-serif;color:#4e4e4e">
									<br>

								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
</tbody></table>';
        Mailer::sendMail($subject, $message, $email);
    }

    public static function sendMail($subject, $message, $email, $is_html = true)
    {
        $mail = new PHPMailer();
        $mail->IsSendmail();
        $mail->SetFrom('noreply@linda.com.ng', $subject);
        $mail->AddAddress($email, "");

        $mail->Subject = $subject;
        if ($is_html) {
            $mail->MsgHTML($message);
        } else {
            $mail->Body = $message;
        }
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            //echo "Message sent!";
        }
    }

    public static function sendRequestMail($requester, $date)
    {
        $userModel = new UserModel();
        $date = $userModel->getById($date);
        $requester = $userModel->getById($requester);
        $subject = "Date Request from linda.com.ng";
        $message = '<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
    <tbody><tr>
		<td>
			<table width="600" align="center" cellpadding="0" cellspacing="0">
				<tbody>
				<tr>
					<td bgcolor="#000000" style="padding:12px 30px 10px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="line-height:0">
									<a href="http://linda.com.ng" target="_blank"><img src="http://www.linda.com.ng/img/linda.png" align="left" border="0" vspace="0" hspace="0" width="96" height="25" alt="Linda"></a>
								</td>
								<td align="right" style="font:11px/12px Arial,Helvetica,sans-serif;color:#fff">

									<a style="color:#fff" href="http://linda.com.ng/login" target="_blank">Sign in</a> or <a style="color:#fff" href="http://linda.com.ng/join" target="_blank">Join Linda</a>

								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>

				<tr>
					<td style="padding:16px 30px 0">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="font:14px/21px Arial,Helvetica,sans-serif;color:#363636;padding:29px 0 13px">
									<b>Hi ' . $date[User_Auth::$nickname] . ',</b><br><br>


    You have a date request on linda from ' . $requester[User_Auth::$nickname] . '<br><br>
    You can accept or reject the request <a href="' . SITE_URL . 'login" target="_blank">here</a><br>

<br

								</td>
							</tr>


							<tr>
								<td style="font:14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 14px">
        Cheers,
								</td>
							</tr>
							<tr>
								<td style="font:bold 14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 7px">
        The Linda Team
    </td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5" style="padding:27px 30px 17px">

						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody>
							<tr>
								<td width="10"></td>
								<td valign="top" width="255">
									<table width="255" cellpadding="0" cellspacing="0">
										<tbody><tr>
											<td style="font:11px/11px Arial,Helvetica,sans-serif;color:#4e4e4e;padding:0 0 9px">
        Join our community
    </td>
										</tr>
										<tr>
											<td>
												<table cellpadding="0" cellspacing="0">
													<tbody><tr>
														<td width="31">
															<a href="https://www.facebook.com/LindaNigeria" target="_blank"><img src="http://www.linda.com.ng/img/fb.png" style="vertical-align:top" border="0" width="31" height="31" alt="Facebook"></a>
														</td>
														<td width="9"></td>
														<td width="31">
															<a href="https://twitter.com/LindaNigeria" target="_blank"><img src="' . SITE_URL . 'img/twee.png" style="vertical-align:top" border="0" width="31" height="31" alt="Twitter"></a>
														</td>
														<td width="9"></td>
														<td width="31">
															<a href="http://www.linkedin.com/company/5025043?trk=tyah&trkInfo=tas%3Alinda%20nig%2Cidx%3A1-1-1" target="_blank"><img src="' . SITE_URL . 'img/link.png" style="vertical-align:top" border="0" width="31" height="31" alt="LinkedIn"></a>
														</td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>

					</td>
				</tr>
				<tr>
					<td style="padding:21px 30px 30px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="font:11px/13px Arial,Helvetica,sans-serif;color:#4e4e4e">
									<br>

								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
</tbody></table>';
        Mailer::sendMail($subject, $message, $date[User_Auth::$email]);
    }

    public static function sendAcceptMail($requester, $date)
    {

        $sex = ($date[User_Auth::$sex] == 1) ? "his" : "her";
        $sex_2 = ($date[User_Auth::$sex] == 1) ? "him" : "her";

        $subject = "Request Accepted - linda.com.ng";
        $message = '<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
    <tbody><tr>
		<td>
			<table width="600" align="center" cellpadding="0" cellspacing="0">
				<tbody>
				<tr>
					<td bgcolor="#000000" style="padding:12px 30px 10px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="line-height:0">
									<a href="http://linda.com.ng" target="_blank"><img src="http://www.linda.com.ng/img/linda.png" align="left" border="0" vspace="0" hspace="0" width="96" height="25" alt="Linda"></a>
								</td>
								<td align="right" style="font:11px/12px Arial,Helvetica,sans-serif;color:#fff">

									<a style="color:#fff" href="http://linda.com.ng/login" target="_blank">Sign in</a> or <a style="color:#fff" href="http://linda.com.ng/join" target="_blank">Join Linda</a>

								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>

				<tr>
					<td style="padding:16px 30px 0">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="font:14px/21px Arial,Helvetica,sans-serif;color:#363636;padding:29px 0 13px">
									<b>Hi ' . $requester[User_Auth::$nickname] . ',</b><br><br>


    ' . $date[User_Auth::$nickname] . ' has accepted your date request on linda. You can <a href="' . SITE_URL . 'login" target="_blank">log in</a> to view ' . $sex . 'profile or call ' . $sex_2 . ' on ' . $date[User_Profile::$phone] . '<br><br>

								</td>
							</tr>


							<tr>
								<td style="font:14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 14px">
        Cheers,
								</td>
							</tr>
							<tr>
								<td style="font:bold 14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 7px">
        The Linda Team
    </td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5" style="padding:27px 30px 17px">

						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody>
							<tr>
								<td width="10"></td>
								<td valign="top" width="255">
									<table width="255" cellpadding="0" cellspacing="0">
										<tbody><tr>
											<td style="font:11px/11px Arial,Helvetica,sans-serif;color:#4e4e4e;padding:0 0 9px">
        Join our community
    </td>
										</tr>
										<tr>
											<td>
												<table cellpadding="0" cellspacing="0">
													<tbody><tr>
														<td width="31">
															<a href="https://www.facebook.com/LindaNigeria" target="_blank"><img src="http://www.linda.com.ng/img/fb.png" style="vertical-align:top" border="0" width="31" height="31" alt="Facebook"></a>
														</td>
														<td width="9"></td>
														<td width="31">
															<a href="https://twitter.com/LindaNigeria" target="_blank"><img src="' . SITE_URL . 'img/twee.png" style="vertical-align:top" border="0" width="31" height="31" alt="Twitter"></a>
														</td>
														<td width="9"></td>
														<td width="31">
															<a href="http://www.linkedin.com/company/5025043?trk=tyah&trkInfo=tas%3Alinda%20nig%2Cidx%3A1-1-1" target="_blank"><img src="' . SITE_URL . 'img/link.png" style="vertical-align:top" border="0" width="31" height="31" alt="LinkedIn"></a>
														</td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>

					</td>
				</tr>
				<tr>
					<td style="padding:21px 30px 30px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="font:11px/13px Arial,Helvetica,sans-serif;color:#4e4e4e">
									<br>

								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
</tbody></table>';
        Mailer::sendMail($subject, $message, $requester[User_Auth::$email]);

        $subject = "Request Accepted - Linda.com.ng";
        $message = '<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
    <tbody><tr>
		<td>
			<table width="600" align="center" cellpadding="0" cellspacing="0">
				<tbody>
				<tr>
					<td bgcolor="#000000" style="padding:12px 30px 10px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="line-height:0">
									<a href="http://linda.com.ng" target="_blank"><img src="http://www.linda.com.ng/img/linda.png" align="left" border="0" vspace="0" hspace="0" width="96" height="25" alt="Linda"></a>
								</td>
								<td align="right" style="font:11px/12px Arial,Helvetica,sans-serif;color:#fff">

									<a style="color:#fff" href="http://linda.com.ng/login" target="_blank">Sign in</a> or <a style="color:#fff" href="http://linda.com.ng/join" target="_blank">Join Linda</a>

								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>

				<tr>
					<td style="padding:16px 30px 0">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="font:14px/21px Arial,Helvetica,sans-serif;color:#363636;padding:29px 0 13px">
									<b>Hi ' . $date[User_Auth::$nickname] . ',</b><br><br>


    You have accepted to date ' . $requester[User_Auth::$nickname] . ' on linda. <br><br>

								</td>
							</tr>


							<tr>
								<td style="font:14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 14px">
        Cheers,
								</td>
							</tr>
							<tr>
								<td style="font:bold 14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 7px">
        The Linda Team
    </td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5" style="padding:27px 30px 17px">

						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody>
							<tr>
								<td width="10"></td>
								<td valign="top" width="255">
									<table width="255" cellpadding="0" cellspacing="0">
										<tbody><tr>
											<td style="font:11px/11px Arial,Helvetica,sans-serif;color:#4e4e4e;padding:0 0 9px">
        Join our community
    </td>
										</tr>
										<tr>
											<td>
												<table cellpadding="0" cellspacing="0">
													<tbody><tr>
														<td width="31">
															<a href="https://www.facebook.com/LindaNigeria" target="_blank"><img src="http://www.linda.com.ng/img/fb.png" style="vertical-align:top" border="0" width="31" height="31" alt="Facebook"></a>
														</td>
														<td width="9"></td>
														<td width="31">
															<a href="https://twitter.com/LindaNigeria" target="_blank"><img src="' . SITE_URL . 'img/twee.png" style="vertical-align:top" border="0" width="31" height="31" alt="Twitter"></a>
														</td>
														<td width="9"></td>
														<td width="31">
															<a href="http://www.linkedin.com/company/5025043?trk=tyah&trkInfo=tas%3Alinda%20nig%2Cidx%3A1-1-1" target="_blank"><img src="' . SITE_URL . 'img/link.png" style="vertical-align:top" border="0" width="31" height="31" alt="LinkedIn"></a>
														</td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>

					</td>
				</tr>
				<tr>
					<td style="padding:21px 30px 30px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="font:11px/13px Arial,Helvetica,sans-serif;color:#4e4e4e">
									<br>

								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
</tbody></table>';
        Mailer::sendMail($subject, $message, $date[User_Auth::$email]);
    }

    public static function sendRejectMail($requester, $date)
    {

        $subject = "Request Rejected - Linda.com.ng";
        $message = '<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
    <tbody><tr>
		<td>
			<table width="600" align="center" cellpadding="0" cellspacing="0">
				<tbody>
				<tr>
					<td bgcolor="#000000" style="padding:12px 30px 10px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="line-height:0">
									<a href="http://linda.com.ng" target="_blank"><img src="http://www.linda.com.ng/img/linda.png" align="left" border="0" vspace="0" hspace="0" width="96" height="25" alt="Linda"></a>
								</td>
								<td align="right" style="font:11px/12px Arial,Helvetica,sans-serif;color:#fff">

									<a style="color:#fff" href="http://linda.com.ng/login" target="_blank">Sign in</a> or <a style="color:#fff" href="http://linda.com.ng/join" target="_blank">Join Linda</a>

								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>

				<tr>
					<td style="padding:16px 30px 0">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="font:14px/21px Arial,Helvetica,sans-serif;color:#363636;padding:29px 0 13px">
									<b>Hi ' . $requester[User_Auth::$nickname] . ',</b><br><br>


    ' . $date[User_Auth::$nickname] . ' has rejeccted your date request on linda. You can make another search <a href="' . SITE_URL . 'search" target="_blank">here</a>. <br><br>

								</td>
							</tr>


							<tr>
								<td style="font:14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 14px">
        Cheers,
								</td>
							</tr>
							<tr>
								<td style="font:bold 14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 7px">
        The Linda Team
    </td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5" style="padding:27px 30px 17px">

						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody>
							<tr>
								<td width="10"></td>
								<td valign="top" width="255">
									<table width="255" cellpadding="0" cellspacing="0">
										<tbody><tr>
											<td style="font:11px/11px Arial,Helvetica,sans-serif;color:#4e4e4e;padding:0 0 9px">
        Join our community
    </td>
										</tr>
										<tr>
											<td>
												<table cellpadding="0" cellspacing="0">
													<tbody><tr>
														<td width="31">
															<a href="https://www.facebook.com/LindaNigeria" target="_blank"><img src="http://www.linda.com.ng/img/fb.png" style="vertical-align:top" border="0" width="31" height="31" alt="Facebook"></a>
														</td>
														<td width="9"></td>
														<td width="31">
															<a href="https://twitter.com/LindaNigeria" target="_blank"><img src="' . SITE_URL . 'img/twee.png" style="vertical-align:top" border="0" width="31" height="31" alt="Twitter"></a>
														</td>
														<td width="9"></td>
														<td width="31">
															<a href="http://www.linkedin.com/company/5025043?trk=tyah&trkInfo=tas%3Alinda%20nig%2Cidx%3A1-1-1" target="_blank"><img src="' . SITE_URL . 'img/link.png" style="vertical-align:top" border="0" width="31" height="31" alt="LinkedIn"></a>
														</td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>

					</td>
				</tr>
				<tr>
					<td style="padding:21px 30px 30px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="font:11px/13px Arial,Helvetica,sans-serif;color:#4e4e4e">
									<br>

								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
</tbody></table>';
        Mailer::sendMail($subject, $message, $requester[User_Auth::$email]);
    }

    public static function sendReportMail($user_id, $report)
    {
        $subject = "Linda.com.ng User Report";
        $userModel = new UserModel();
        $user = $userModel->getById($user_id);
        $nickname = $user[User_Auth::$nickname];
        $email = $user[User_Auth::$email];
        $admin_email = "info@linda.com.ng";
        $report = "From: $nickname <$email><br><br>" . $report;
        Mailer::sendMail($subject, $report, $admin_email);
    }

    public static function sendApprovalMail($name, $email)
    {
        $message = '<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
    <tbody><tr>
		<td>
			<table width="600" align="center" cellpadding="0" cellspacing="0">
				<tbody>
				<tr>
					<td bgcolor="#000000" style="padding:12px 30px 10px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="line-height:0">
									<a href="http://linda.com.ng" target="_blank"><img src="http://www.linda.com.ng/img/linda.png" align="left" border="0" vspace="0" hspace="0" width="96" height="25" alt="Linda"></a>
								</td>
								<td align="right" style="font:11px/12px Arial,Helvetica,sans-serif;color:#fff">

									<a style="color:#fff" href="http://linda.com.ng/login" target="_blank">Sign in</a> or <a style="color:#fff" href="http://linda.com.ng/join" target="_blank">Join Linda</a>

								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>

				<tr>
					<td style="padding:16px 30px 0">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="font:14px/21px Arial,Helvetica,sans-serif;color:#363636;padding:29px 0 13px">
									<b>Hi ' . $name . ',</b><br><br>


    Your account on Linda has just been approved.<br><br>

Click <a href="' . SITE_URL . 'login" target="_blank">here </a> to login.
<br>

								</td>
							</tr>


							<tr>
								<td style="font:14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 14px">
        Cheers,
								</td>
							</tr>
							<tr>
								<td style="font:bold 14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 7px">
        The Linda Team
    </td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5" style="padding:27px 30px 17px">

						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody>
							<tr>
								<td width="10"></td>
								<td valign="top" width="255">
									<table width="255" cellpadding="0" cellspacing="0">
										<tbody><tr>
											<td style="font:11px/11px Arial,Helvetica,sans-serif;color:#4e4e4e;padding:0 0 9px">
        Join our community
    </td>
										</tr>
										<tr>
											<td>
												<table cellpadding="0" cellspacing="0">
													<tbody><tr>
														<td width="31">
															<a href="https://www.facebook.com/LindaNigeria" target="_blank"><img src="http://www.linda.com.ng/img/fb.png" style="vertical-align:top" border="0" width="31" height="31" alt="Facebook"></a>
														</td>
														<td width="9"></td>
														<td width="31">
															<a href="https://twitter.com/LindaNigeria" target="_blank"><img src="' . SITE_URL . 'img/twee.png" style="vertical-align:top" border="0" width="31" height="31" alt="Twitter"></a>
														</td>
														<td width="9"></td>
														<td width="31">
															<a href="http://www.linkedin.com/company/5025043?trk=tyah&trkInfo=tas%3Alinda%20nig%2Cidx%3A1-1-1" target="_blank"><img src="' . SITE_URL . 'img/link.png" style="vertical-align:top" border="0" width="31" height="31" alt="LinkedIn"></a>
														</td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>

					</td>
				</tr>
				<tr>
					<td style="padding:21px 30px 30px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="font:11px/13px Arial,Helvetica,sans-serif;color:#4e4e4e">
									<br>

								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
</tbody></table>';
        Mailer::sendMail("Linda Account Approval", $message, $email);
    }

    public static function sendVerificationMail($name, $email)
    {
        $message = file_get_contents("../email/verification.html");
        $message = str_replace("%s", $name, $message);
        Mailer::sendMail("Linda.com.ng - Account Activated", $message, $email);
    }

    public static function sendFeedbackMail($date_id, $user_id)
    {
        $userModel = new UserModel();
        $user = $userModel->getById($user_id);
        $date = new DateModel();
        $date = $userModel->getById($date[Date::$date]);

        $subject = "Please rate your date with ". $date[User_Auth::$nickname];
        $message = '<table width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
    <tbody><tr>
		<td>
			<table width="600" align="center" cellpadding="0" cellspacing="0">
				<tbody>
				<tr>
					<td bgcolor="#000000" style="padding:12px 30px 10px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="line-height:0">
									<a href="http://linda.com.ng" target="_blank"><img src="http://www.linda.com.ng/img/linda.png" align="left" border="0" vspace="0" hspace="0" width="96" height="25" alt="Linda"></a>
								</td>
								<td align="right" style="font:11px/12px Arial,Helvetica,sans-serif;color:#fff">

									<a style="color:#fff" href="http://linda.com.ng/login" target="_blank">Sign in</a> or <a style="color:#fff" href="http://linda.com.ng/join" target="_blank">Join Linda</a>

								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>

				<tr>
					<td style="padding:16px 30px 0">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="font:14px/21px Arial,Helvetica,sans-serif;color:#363636;padding:29px 0 13px">
									<b>Hi there ' . $user[User_Auth::$nickname] . '!</b><br><br>


    Thanks for taking out time to use our service by going out on a date with ' .$date[User_Auth::$nickname].'<br>In order to continuously improve our service and keep the standards high, we need YOUR support and feedback.<br>Kindly rate your date <a href="' . SITE_URL . 'feedback/' . $date_id . '/' . $user_id . '">here</a>

<br

								</td>
							</tr>


							<tr>
								<td style="font:14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 14px">
        Cheers,
								</td>
							</tr>
							<tr>
								<td style="font:bold 14px/16px Arial,Helvetica,sans-serif;color:#363636;padding:0 0 7px">
        The Linda Team
    </td>
							</tr>
						</tbody></table>
					</td>
				</tr>
				<tr>
					<td bgcolor="#f5f5f5" style="padding:27px 30px 17px">

						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody>
							<tr>
								<td width="10"></td>
								<td valign="top" width="255">
									<table width="255" cellpadding="0" cellspacing="0">
										<tbody><tr>
											<td style="font:11px/11px Arial,Helvetica,sans-serif;color:#4e4e4e;padding:0 0 9px">
        Join our community
    </td>
										</tr>
										<tr>
											<td>
												<table cellpadding="0" cellspacing="0">
													<tbody><tr>
														<td width="31">
															<a href="https://www.facebook.com/LindaNigeria" target="_blank"><img src="http://www.linda.com.ng/img/fb.png" style="vertical-align:top" border="0" width="31" height="31" alt="Facebook"></a>
														</td>
														<td width="9"></td>
														<td width="31">
															<a href="https://twitter.com/LindaNigeria" target="_blank"><img src="' . SITE_URL . 'img/twee.png" style="vertical-align:top" border="0" width="31" height="31" alt="Twitter"></a>
														</td>
														<td width="9"></td>
														<td width="31">
															<a href="http://www.linkedin.com/company/5025043?trk=tyah&trkInfo=tas%3Alinda%20nig%2Cidx%3A1-1-1" target="_blank"><img src="' . SITE_URL . 'img/link.png" style="vertical-align:top" border="0" width="31" height="31" alt="LinkedIn"></a>
														</td>
													</tr>
												</tbody></table>
											</td>
										</tr>
									</tbody></table>
								</td>
							</tr>
						</tbody></table>

					</td>
				</tr>
				<tr>
					<td style="padding:21px 30px 30px">
						<table width="100%" cellpadding="0" cellspacing="0">
							<tbody><tr>
								<td style="font:11px/13px Arial,Helvetica,sans-serif;color:#4e4e4e">
									<br>

								</td>
							</tr>
						</tbody></table>
					</td>
				</tr>
			</tbody></table>
		</td>
	</tr>
</tbody></table>';
        Mailer::sendMail($subject, $message, $user[User_Auth::$email]);


    }

}
