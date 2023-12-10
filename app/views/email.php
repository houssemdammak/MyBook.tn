<?php
//var_dump($_POST); // Debugging to check POST data

$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$paymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : '';
$totalPrice=isset($_POST['totalPrice']) ? $_POST['totalPrice'] : '';

$emailContent='
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no">
    <link rel="stylesheet" href="../../assets/css/email.css">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #efefef;">
    <center role="article" aria-roledescription="email" lang="en" style="width: 100%; background-color: #efefef;">
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="600"
            style="margin: auto;" class="contentMainTable">
            <tr class="wp-block-editor-spacerblock-v1">
                <td style="background-color:#EFEFEF;line-height:30px;font-size:30px;width:100%;min-width:100%">&nbsp;
                </td>
            </tr>
            <tr class="wp-block-editor-imageblock-v1">
                <td style="background-color:#e8cea3;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px"
                    align="center">
                    <table align="center" width="397.6" class="imageBlockWrapper" style="width:397.6px"
                        role="presentation">
                        <tbody>
                            <tr>
                                <td style="padding:0"><img
                                        src="https://api.smtprelay.co/userfile/34cb0e47-5580-4cdc-bde7-cc38fd5a3256/logo.png"
                                        width="397.6" height="" alt=""
                                        style="border-radius:0px;display:block;height:auto;width:100%;max-width:100%;border:0"
                                        class="g-img"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr class="wp-block-editor-headingblock-v1">
                <td valign="top"
                    style="background-color:#fff;display:block;padding-top:32px;padding-right:20px;padding-bottom:20px;padding-left:20px">
                    <p style="font-family:Helvetica, sans-serif;line-height:32.20px;font-size:28px;background-color:#fff;color:#4A5568;margin:0;word-break:normal"
                        class="heading1">Thank you for&nbsp;<span style="color:#05a49a">your purchase !</span></p>
                </td>
            </tr>
            <tr class="wp-block-editor-paragraphblock-v1">
                <td valign="top" style="padding:0px 20px 20px 20px;background-color:#fff">
                    <p class="paragraph"
                        style="font-family:Helvetica, sans-serif;line-height:21.00px;font-size:14px;margin:0;color:#4A5568;word-break:normal">
                        Mr/Mrs '.$firstName.' '.$lastName.', we ensure you that your
                        purchase is received and your books are on the way.
                    </p>
                </td>
            </tr>
            <tr>
                <td style="padding-top:0;padding-left:0;padding-right:0;padding-bottom:0;background-color:#fff">
                    <table role="presentation" class="multi-column"
                        style="width:600px;border-collapse:collapse !important" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr style="padding-top:0;padding-left:0;padding-right:0;padding-bottom:0"
                                class="wp-block-editor-twocolumnsfiftyfiftyblock-v1">
                                <td style="width:300px;float:left" class="wp-block-editor-column single-column">
                                    <table role="presentation" align="left" border="0" class="single-column" width="300"
                                        style="width:300px;float:left;border-collapse:collapse !important"
                                        cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr class="wp-block-editor-paragraphblock-v1">
                                                <td valign="top"
                                                    style="padding:20px 20px 20px 20px;background-color:#fff">
                                                    <p class="paragraph"
                                                        style="font-family:Helvetica, sans-serif;line-height:16.10px;font-size:14px;margin:0;color:#4A5568;word-break:normal">
                                                        The delivery delay is between 48h and 72h.<br><br>You used the '.$paymentMethod.'
                                                        payment method.
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td style="width:300px;float:left" class="wp-block-editor-column single-column">
                                    <table role="presentation" align="right" border="0" class="single-column"
                                        width="300" style="width:300px;float:left;border-collapse:collapse !important"
                                        cellspacing="0" cellpadding="0">
                                        <tbody>
                                            <tr class="wp-block-editor-headingblock-v1">
                                                <td valign="top"
                                                    style="background-color:#fff;display:block;padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px">
                                                    <p style="font-family:Helvetica, sans-serif;line-height:32.20px;font-size:28px;background-color:#fff;color:#4A5568;margin:0;word-break:normal"
                                                        class="heading1">Total&nbsp;<span
                                                            style="color:#EA8A03">Price:</span></p>
                                                </td>
                                            </tr>
                                            <tr class="wp-block-editor-paragraphblock-v1">
                                                <td valign="top"
                                                    style="padding:0px 20px 20px 24px;background-color:#fff">
                                                    <p class="paragraph"
                                                        style="font-family:Helvetica, sans-serif;line-height:16.10px;font-size:14px;margin:0;color:#4A5568;word-break:normal">
                                                        You Paid :'.$totalPrice.' </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr class="wp-block-editor-imageblock-v1">
                <td style="background-color:#fff;padding-top:0;padding-bottom:0;padding-left:0;padding-right:0"
                    align="center">
                    <table align="center" width="600" class="imageBlockWrapper" style="width:600px" role="presentation">
                        <tbody>
                            <tr>
                                <td style="padding:0"><img
                                        src="https://api.smtprelay.co/userfile/34cb0e47-5580-4cdc-bde7-cc38fd5a3256/bookbackground-email.png"
                                        width="600" height="" alt=""
                                        style="border-radius:0px;display:block;height:auto;width:100%;max-width:100%;border:0"
                                        class="g-img"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr class="wp-block-editor-headingblock-v1">
                <td valign="top"
                    style="background-color:#fff;display:block;padding-top:20px;padding-right:20px;padding-bottom:20px;padding-left:20px;text-align:center">
                    <p style="font-family:Helvetica, sans-serif;text-align:center;line-height:32.20px;font-size:28px;background-color:#fff;color:#4A5568;margin:0;word-break:normal"
                        class="heading1">Comeback&nbsp;<span style="color:#8f202a">Soon !</span></p>
                </td>
            </tr>
            <center>
            <tr class="wp-block-editor-socialiconsblock-v1" role="article" aria-roledescription="social-icons"
                style="display:table-row;background-color:#fff">
                <td style="width:100%">
                    <table
                        style="background-color:#fff;width:100%;padding-top:32px;padding-bottom:32px;padding-left:32px;padding-right:32px;border-collapse:separate !important"
                        cellpadding="0" cellspacing="0" role="presentation">
                        <tbody>
                            <tr>
                                <td align="center" valign="top">
                                    <div style="max-width:536px">
                                        <table role="presentation" style="width:100%" cellpadding="0" cellspacing="0"
                                            width="100%">
                                            <tbody>
                                                <tr>
                                                    <td valign="top">
                                                        <div
                                                            style="margin-left:auto;margin-right:auto;margin-top:-5px;margin-bottom:-5px;width:100%;max-width:156px">
                                                            <table role="presentation" style="padding-left:190"
                                                                width="100%" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <table role="presentation" align="left"
                                                                                style="float:left"
                                                                                class="single-social-icon"
                                                                                cellpadding="0" cellspacing="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td valign="top"
                                                                                            style="padding-top:5px;padding-bottom:5px;padding-left:10px;padding-right:10px;border-collapse:collapse !important;border-spacing:0;font-size:0">
                                                                                            <a class="social-icon--link"
                                                                                                href="https://facebook.com"
                                                                                                target="_blank"
                                                                                                rel="noreferrer"><img
                                                                                                    src="https://template-editor-assets.s3.eu-west-3.amazonaws.com/assets/social-icons/facebook/facebook-square-outline-color.png"
                                                                                                    width="32"
                                                                                                    height="32"
                                                                                                    style="max-width:32px;display:block;border:0"
                                                                                                    alt="Facebook"></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table role="presentation" align="left"
                                                                                style="float:left"
                                                                                class="single-social-icon"
                                                                                cellpadding="0" cellspacing="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td valign="top"
                                                                                            style="padding-top:5px;padding-bottom:5px;padding-left:10px;padding-right:10px;border-collapse:collapse !important;border-spacing:0;font-size:0">
                                                                                            <a class="social-icon--link"
                                                                                                href="https://twitter.com"
                                                                                                target="_blank"
                                                                                                rel="noreferrer"><img
                                                                                                    src="https://template-editor-assets.s3.eu-west-3.amazonaws.com/assets/social-icons/x/x-square-outline-color.png"
                                                                                                    width="32"
                                                                                                    height="32"
                                                                                                    style="max-width:32px;display:block;border:0"
                                                                                                    alt="X (formerly Twitter)"></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table role="presentation" align="left"
                                                                                style="float:left"
                                                                                class="single-social-icon"
                                                                                cellpadding="0" cellspacing="0">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td valign="top"
                                                                                            style="padding-top:5px;padding-bottom:5px;padding-left:10px;padding-right:10px;border-collapse:collapse !important;border-spacing:0;font-size:0">
                                                                                            <a class="social-icon--link"
                                                                                                href="https://youtube.com"
                                                                                                target="_blank"
                                                                                                rel="noreferrer"><img
                                                                                                    src="https://template-editor-assets.s3.eu-west-3.amazonaws.com/assets/social-icons/youtube/youtube-square-outline-color.png"
                                                                                                    width="32"
                                                                                                    height="32"
                                                                                                    style="max-width:32px;display:block;border:0"
                                                                                                    alt="Youtube"></a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </center>
        </table>
    </center>
</body>

</html>
';
echo $emailContent;
?>